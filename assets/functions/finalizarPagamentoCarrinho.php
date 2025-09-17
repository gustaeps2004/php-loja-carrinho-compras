<?php
$container = require __DIR__.'/../../index.php';
use APP\Controllers\PedidosController;

$pedidosController = $container->get(PedidosController::class);

$pedidosController->finalizar(
  (int)$_GET["usuarioID"],
  (int)$_GET["metodoPagamento"]
);

header("Location: ../../html/carrinho/carrinho.php?usuarioID=".$_GET["usuarioID"])."&compraFinalizada=true";
exit;
?>