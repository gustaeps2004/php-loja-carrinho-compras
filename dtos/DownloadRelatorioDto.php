<?php namespace APP\Dtos;

class DownloadRelatorioDto
{
  public bool $TotalAnual;
  public bool $TotalMensal;
  public bool $ProjecaoAnual;
  public bool $ProjecaoMensal;
  public bool $ProdutosVendidos;

  public function __construct(
    bool $totalAnual,
    bool $totalMensal,
    bool $projecaoAnual,
    bool $projecaoMensal,
    bool $produtosVendidos
) {
    $this->TotalAnual = $totalAnual;
    $this->TotalMensal = $totalMensal;
    $this->ProjecaoAnual = $projecaoAnual;
    $this->ProjecaoMensal = $projecaoMensal;
    $this->ProdutosVendidos = $produtosVendidos;
}
}