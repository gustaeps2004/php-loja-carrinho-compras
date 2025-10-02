<?php namespace APP\Socket\Connection;

require __DIR__.'../../../vendor/autoload.php';

use APP\Repositories\Connections\Firebase\IFirebaseRepository;
use APP\Services\Pedido\IPedidoService;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use SplObjectStorage;

date_default_timezone_set("America/Sao_Paulo");
class WebSocketConnection implements  MessageComponentInterface
{
  private readonly IFirebaseRepository $_firebaseRepository;
  private readonly IPedidoService $_pedidoService;
  protected SplObjectStorage $clients;

  public function __construct(
    IFirebaseRepository $firebaseRepository,
    IPedidoService $pedidoService)
  {
    $this->clients = new SplObjectStorage;
    $this->_firebaseRepository = $firebaseRepository;
    $this->_pedidoService = $pedidoService;
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
    $data = $this->_firebaseRepository->obter($msg);
    $this->_pedidoService->atualizarEntrega($data, $msg);
    
    $from->send($data);
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
