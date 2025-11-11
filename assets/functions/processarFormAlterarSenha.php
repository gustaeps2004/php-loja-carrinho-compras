<?php

use APP\Controllers\AutenticacoesController;

$container = require __DIR__.'/../../index.php';

if ($_SERVER["REQUEST_METHOD"] != "POST")
  return;

$autenticacoesController = $container->get(AutenticacoesController::class);

$token = $_POST["txttoken"];
$id = (int)$_POST["txtidUsuario"];
$senha = $_POST["txtsenha"];
$confirmacaoSenha = $_POST["txtconfirmacaoSenha"];

$autenticacoesController->alterarSenhas(
  $token,
  $senha,
  $confirmacaoSenha,
  $id
);
 
header("Location: ../../html/login/login.php");
exit;