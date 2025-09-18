<?php
$container = require __DIR__.'/../../index.php';
use APP\Controllers\PedidosController;

$pedidosController = $container->get(PedidosController::class);

$usuarioID = (int)$_GET["usuarioID"];
$pedidosController->cancelar($usuarioID);

header("Location: ../../html/carrinho/carrinho.php?usuarioID=".$usuarioID);
exit;
?>