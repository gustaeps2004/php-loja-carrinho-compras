<?php namespace APP\Messaging\Responses\Gerenciamento;

class DadosGraficosResponse
{
  public array $TotalAnual;

  public function __construct(
    array $totalAnual)
  {
    $this->TotalAnual = $totalAnual;
  }
}

