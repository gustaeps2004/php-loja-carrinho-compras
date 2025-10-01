<?php

use APP\Socket\Connection\WebSocketConnection;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use APP\Repositories\Connections\Firebase\IFirebaseRepository;

require __DIR__.'/vendor/autoload.php';
$container = require __DIR__.'/index.php';
$repository = $container->get(APP\Repositories\Connections\Firebase\IFirebaseRepository::class);

$server = IoServer::factory(
  new HttpServer(
    new WsServer(
      new WebSocketConnection($repository)
    )
  ),
  3333
);

$server->run();