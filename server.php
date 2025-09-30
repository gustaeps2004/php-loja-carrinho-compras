<?php
use Ratchet\App;
use APP\Socket\PedidoEntregaSocket;

require __DIR__.'/vendor/autoload.php';

$container = require __DIR__.'/index.php';

$pedidoEntregaSocket = $container->get(PedidoEntregaSocket::class);

$app = new App('localhost', 3333);
//$app->route('/entrega', $pedidoEntrega, ['*']);
$app->run();
?>