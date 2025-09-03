<?php

use APP\Controllers\CarrinhoCompraController;

  $container = require __DIR__.'/../../index.php';

  if ($_SERVER["REQUEST_METHOD"] != "POST")
    return;

  $carrinhoController = $container->get(CarrinhoCompraController::class);

  $carrinhoID = (int)$_GET["carrinhoID"];
  $opcao = (int)$_GET["opcao"];

  $carrinhoController->remover($carrinhoID, $opcao);

  header("Location: ../../html/carrinho/carrinho.php");
  exit;
?>