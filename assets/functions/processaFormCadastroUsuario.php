<?php
  $container = require __DIR__.'/../../index.php';
  
  use APP\Controllers\UsuariosController;
  use APP\Assets\Extensions\StringFormats;

  if ($_SERVER["REQUEST_METHOD"] != "POST")
    return;

  $usuariosController = $container->get(UsuariosController::class);
  $stringFormats = $container->get(StringFormats::class);

  $nome = $_POST['txtnome']; 
  $email = $_POST['txtemail'];
  $documentoFederal = $stringFormats->RemoverCaracteresEspeciais($_POST['txtdocumento']);
  $permissaoID = $_POST['selPermissao'];
  $senha = $_POST['txtsenha'];

  $usuariosController->inserir(
    $nome,
    $email,
    $documentoFederal,
    $permissaoID,
    $senha);

  header("Location: ../../html/administracao/administracao.php");
  exit;
?>