<?php namespace APP\Messaging\Responses\Gerenciamento;

use APP\Assets\Extensions\StringExtensions;

class DadosGraficosResponse
{
  public array $TotalAnual;
  public array $TotalMensal;
  public array $ProjecaoAnual;
  public array $ProjecaoMensal;
  public array $QtdProdutosVendidos;

  public function __construct(
    array $totalAnual,
    array $totalMensal,
    array $qtdProdutosVendidos)
  {
    $this->TotalAnual = $totalAnual;
    $this->TotalMensal = $this->formatarMes($totalMensal);
    $this->ProjecaoMensal = $this->formatarProjecaoMensal(totalUltimoMes: reset($totalMensal));
    $this->ProjecaoAnual = $this->gerarProjecaoAnual(max($totalAnual));
    $this->QtdProdutosVendidos = $qtdProdutosVendidos;
  }

  private function formatarProjecaoMensal($totalUltimoMes) : array
  {
    $projecaoMensalTratado = [];
    
    $ultimoMes = (int)StringExtensions::obterNumeroMes($totalUltimoMes->Campo) + 1;

    for ($count = 1; $count <= 3; $count++)
    {
      $totalUltimoMes->Campo = StringExtensions::obterMes($ultimoMes);
      $totalUltimoMes->Valor = (float) $totalUltimoMes->Valor * 1.3;

      array_push($projecaoMensalTratado, clone $totalUltimoMes);

      $ultimoMes++;

      if ($ultimoMes == 13)
        $ultimoMes = 1;
    }

    return $projecaoMensalTratado;
  }

  private function formatarMes($totalMensal) : array
  {
    $totalMensalTratado = [];

    foreach ($totalMensal as $mensal)
    {
      $mensal->Campo = StringExtensions::obterMes($mensal->Campo);
      array_push($totalMensalTratado, clone $mensal);
    }

    return $totalMensalTratado;
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

