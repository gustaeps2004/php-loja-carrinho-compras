<?php namespace APP\Socket\Connection;

require __DIR__.'../../../vendor/autoload.php';
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

date_default_timezone_set("America/Sao_Paulo");
class WebSocketConnection implements  MessageComponentInterface
{
  protected SplObjectStorage $clients;

  public function __construct()
  {
    $this->clients = new SplObjectStorage;
    $this->setLog("Servidor iniciado as");
  }

  protected function setLog($log)
  {
    echo $log." ".date("d/m/Y H:i:s");
  }

  public function onOpen(ConnectionInterface $conn)
  {
    $this->clients->attach($conn);
  }

  public function onMessage(ConnectionInterface $from, $msg)
  {
    $from->send("chegou");
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
