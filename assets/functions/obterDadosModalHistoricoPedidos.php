<?php

use APP\Controllers\PedidosController;

$container = require __DIR__.'/../../index.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405); 
  echo json_encode(['erro' => 'Método não permitido.']);
  exit;
}

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, false);

$pedidosController = $container->get(PedidosController::class);

$response = $pedidosController->obter($data["pedidoID"]);

$response = [
  'status' => "success",
  'mensagem' => $jsonData
];

echo json_encode($response);
exit;