<?php namespace APP\Messaging\Responses\Gerenciamento;

class DadosGraficosResponse
{
  public array $TotalAnual;
  public array $TotalMensal;
  public array $ProjecaoAnual;

  public function __construct(
    array $totalAnual,
    array $totalMensal)
  {
    $this->TotalAnual = $totalAnual;
    $this->TotalMensal = $totalMensal;
    $this->ProjecaoAnual = $this->gerarProjecaoAnual(max($totalAnual));
  }

  private function gerarProjecaoAnual($totalUltimoMes) : array
  {
    $projecaoAnual = [];
    $valorMesAnterior = clone $totalUltimoMes;

    for ($count = 1; $count <= 3; $count++)
    {
      $valorMesAnterior->Campo = (int) $valorMesAnterior->Campo + 1;
      $valorMesAnterior->Valor = (float) $valorMesAnterior->Valor * 1.3;

      array_push($projecaoAnual, clone $valorMesAnterior);
    }

    return $projecaoAnual;
  }
}

