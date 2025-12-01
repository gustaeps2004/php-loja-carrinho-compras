<?php namespace APP\Controllers;

use APP\Controllers\Base\BaseController;
use APP\Dtos\DownloadRelatorioDto;
use APP\Messaging\Responses\Gerenciamento\DadosGraficosResponse;
use APP\Services\Gerenciamento\IGerenciamentoService;

class GerenciamentosController extends BaseController
{
  private readonly IGerenciamentoService $_gerenciamentoService;

  public function __construct(IGerenciamentoService $gerenciamentoService)
  {
    $this->_gerenciamentoService = $gerenciamentoService;
  }

  public function obterValoresGrafico() : DadosGraficosResponse
  {
    return $this->_gerenciamentoService->obterValoresGrafico();
  }

  public function obterRelatorio(DownloadRelatorioDto $downloadDto, int $usuarioID) : string
  {
    return $this->_gerenciamentoService->obterRelatorio($downloadDto, $usuarioID);
  }
}
