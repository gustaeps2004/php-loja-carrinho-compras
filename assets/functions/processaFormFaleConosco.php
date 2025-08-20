<?php
  $container = require __DIR__.'/../../index.php';

  use APP\Controllers\FaleConoscoController;
  use APP\Assets\Extensions\StringFormats;

  if ($_SERVER["REQUEST_METHOD"] != "POST")
    return;

  $faleConoscoController = $container->get(FaleConoscoController::class);
  $stringFormats = $container->get(StringFormats::class);

  $nome = $_POST['txtnome']; 
  $email = $_POST['txtemail'];
  $telefone = $stringFormats->RemoverCaracteresEspeciais($_POST['txtfone']);
  $documentoFederal = $stringFormats->RemoverCaracteresEspeciais($_POST['txtdocumento']);
  $motivoContatoID = formatarMotivo($_POST['selmotivo'] ?? '');
  $comentario = formatarMotivo($_POST['txacomentario'] ?? '');
 
  $faleConoscoController->inserir(
    $nome,
    $email,
    $telefone,
    $documentoFederal,
    $motivoContatoID,
    $comentario
  );

  header("Location: ../../html/faleConosco.php");
  exit;

  function formatarMotivo($motivo) {
    return $motivo != '' ? $motivo : null;
  }
?>