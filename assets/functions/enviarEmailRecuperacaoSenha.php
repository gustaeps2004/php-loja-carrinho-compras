<?php

use APP\Controllers\AutenticacoesController;

$container = require __DIR__.'/../../index.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405); 
  echo json_encode(['erro' => 'Método não permitido.']);
  exit;
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, false);

$autenticacoesController = $container->get(AutenticacoesController::class);
$response = $autenticacoesController->enviarEmailRecuperacaoSenha($data->email);

echo json_encode($response);
exit;