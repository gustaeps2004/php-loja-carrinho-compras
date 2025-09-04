<?php
  $container = require __DIR__.'/../../index.php';
  use APP\Controllers\CarrinhoCompraController;

  $carrinhoCompraController = $container->get(CarrinhoCompraController::class);
  echo $_GET["checked"];
  $carrinhoCompraController->atualizarSelecionado(
    (int)$_GET["produtoID"],
    $_GET["checked"] == "true" ? true : false
  );

  header("Location: ../../html/carrinho/carrinho.php");
  exit;
?>