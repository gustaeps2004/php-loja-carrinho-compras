<?php namespace APP\Services\Gerenciamento;

use APP\Messaging\Responses\Gerenciamento\DadosGraficosResponse;

interface IGerenciamentoService
{  
  public function obterValoresGrafico(int $usuarioID) : DadosGraficosResponse;
}