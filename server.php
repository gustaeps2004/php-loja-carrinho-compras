<?php

use APP\Socket\Connection\WebSocketConnection;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require __DIR__.'/vendor/autoload.php';

$server = IoServer::factory(
  new HttpServer(
    new WsServer(
      new WebSocketConnection()
    )
  ),
  3333
);

$server->run();