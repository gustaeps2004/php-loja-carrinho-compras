<?php
$container = require __DIR__.'/../../index.php';

use APP\Controllers\CarrinhoCompraController;

if ($_SERVER["REQUEST_METHOD"] != "POST")
  return;

$carrinhoCompraController = $container->get(CarrinhoCompraController::class);

$carrinhoCompraController->inserir(
  1, 
  (int)$_POST["txtidProduto"],
  (int)$_GET["usuarioID"]);

header("Location: ../../html/produtos.php");
exit;

?>