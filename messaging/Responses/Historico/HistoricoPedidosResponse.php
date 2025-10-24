<?php namespace APP\Messaging\Responses\Historico;

use APP\Messaging\RawQueryResult\Historico\DetalhePedidosRawQueryResult;
use APP\Messaging\RawQueryResult\Pedido\DetalhePedidosProdutosRawQueryResult;

class HistoricoPedidosResponse
{
  public string $ValorTotal = "";
  public string $DataPedido = "";
  public int $FormaPagamento = 0;
  public array $DetalhesProdutos = [];

  public function __construct(
    DetalhePedidosRawQueryResult $detalheRawQuery,
    array $detalhesProdutos)
  {
    $this->ValorTotal = $detalheRawQuery->ValorTotal;
    $this->DataPedido = $detalheRawQuery->DtInclusao;
    $this->FormaPagamento = $detalheRawQuery->FormaPagamento;

    $this->DetalhesProdutos = $detalhesProdutos;
  }
}