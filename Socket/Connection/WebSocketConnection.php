<?php namespace APP\Socket\Connection;

require __DIR__.'../../../vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

class WebSocketConnection implements  MessageComponentInterface
{
  protected SplObjectStorage $clients;

  public function __construct()
  {
    $this->clients = new SplObjectStorage;
  }

  public function onOpen(ConnectionInterface $conn)
  {
    $this->clients->attach($conn);
  }

  public function onMessage(ConnectionInterface $from, $msg)
  {
    $decoded = json_decode($msg, true);

    if (!$decoded || !isset($decoded['event'])) {
      $from->send(json_encode([
        "error" => "Formato inválido. Use {event: string, data: mixed}"
      ]));
      return;
    }

    $event = ucfirst($decoded['event']);
    $method = "on{$event}";

    if (method_exists($this, $method)) {
      $this->$method($from, $decoded['data'] ?? null);
    } else {
      $from->send(json_encode([
        "error" => "Evento '{$decoded['event']}' não suportado"
      ]));
    }
  }

  public function onClose(ConnectionInterface $conn)
  {
    $this->clients->detach($conn);
  }

  public function onError(ConnectionInterface $conn, \Exception $e)
  {
    $conn->close();
  }
}
?>