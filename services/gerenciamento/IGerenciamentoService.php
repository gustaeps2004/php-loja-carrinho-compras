<?php namespace APP\Services\Gerenciamento;

use APP\Dtos\DownloadRelatorioDto;
use APP\Messaging\Responses\Gerenciamento\DadosGraficosResponse;

interface IGerenciamentoService
{  
  public function obterValoresGrafico() : DadosGraficosResponse;
  function obterRelatorio(DownloadRelatorioDto $downloadDto, int $usuarioID) : string;
}