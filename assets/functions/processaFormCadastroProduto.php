<?php
  $container = require __DIR__.'/../../index.php';

  use APP\Controllers\ProdutosController;
  use APP\Messaging\Requests\Produto\ProdutoRequest;

  if ($_SERVER["REQUEST_METHOD"] != "POST" && isset($_FILES["arquivo"]))
    return;

  $produtosController = $container->get(ProdutosController::class);

  $request = new ProdutoRequest(
    $_POST["txtdescricao"],
    $_POST["txttitulo"],
    $_FILES["arquivo"]["tmp_name"],
    $_FILES["arquivo"]["name"],
    $_POST["selCategoria"]
  );

  $response = $produtosController->inserir($request);

  header("Location: ../../html/administracao/administracao.php");
  exit;
?>