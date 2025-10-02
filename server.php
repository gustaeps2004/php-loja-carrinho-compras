<?php

use APP\Socket\Connection\WebSocketConnection;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use APP\Repositories\Connections\Firebase\IFirebaseRepository;
use APP\Services\Pedido\IPedidoService;

require __DIR__.'/vendor/autoload.php';
$container = require __DIR__.'/index.php';
$repository = $container->get(IFirebaseRepository::class);
$service = $container->get(IPedidoService::class);

$server = IoServer::factory(
  new HttpServer(
    new WsServer(
      new WebSocketConnection(
        $repository,
        $service)
    )
  ),
  3333
);

$server->run();