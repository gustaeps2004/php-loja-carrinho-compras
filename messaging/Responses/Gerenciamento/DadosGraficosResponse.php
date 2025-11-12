<?php namespace APP\Messaging\Responses\Gerenciamento;

class DadosGraficosResponse
{
  public array $TotalAnual;
  public array $TotalMensal;

  public function __construct(
    array $totalAnual,
    array $totalMensal)
  {
    $this->TotalAnual = $totalAnual;
    $this->TotalMensal = $totalMensal;
  }
}

