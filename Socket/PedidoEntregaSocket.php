<?php namespace APP\Socket;

require __DIR__.'../../vendor/autoload.php';
use APP\Socket\Connection\WebSocketConnection;
use Ratchet\ConnectionInterface;

class PedidoEntregaSocket extends WebSocketConnection
{
  public function __construct()
  {
    parent::__construct();
  }

  protected function onSendMessage(ConnectionInterface $from, $data): void
  {
    foreach ($this->clients as $client) 
    {
      $client->send(json_encode([
        "situacao" => "teste",
        "dtAtualizacao" => $data
      ]));
    }
  }
}
?>