<?php

use APP\Controllers\GerenciamentosController;

$container = require __DIR__.'/../../index.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405); 
  echo json_encode(['erro' => 'Método não permitido.']);
  exit;
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, false);

$gerenciamentosController = $container->get(GerenciamentosController::class);

$response = $gerenciamentosController->obterValoresGrafico();

$response = [
  'status' => "success",
  'mensagem' => $response
];

http_response_code(200); 
echo json_encode($response);
exit;