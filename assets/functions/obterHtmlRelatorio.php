<?php

use APP\Controllers\GerenciamentosController;
use APP\Dtos\DownloadRelatorioDto;
require __DIR__.'../../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

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

$dto = new DownloadRelatorioDto(
  $data->totalAnual,
  $data->totalMensal,
  $data->projecaoAnual,
  $data->projecaoMensal,
  $data->produtosVendidos
);

$response = $gerenciamentosController->obterRelatorio($dto, 1);

$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// 2. Carrega no Dompdf
$dompdf->loadHtml($response);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// 3. Output seguro
$output = $dompdf->output();

if (ob_get_length()) ob_clean(); // Limpa sujeira

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="relatorio.pdf"');
header('Content-Length: ' . strlen($output));

echo $output;
exit;