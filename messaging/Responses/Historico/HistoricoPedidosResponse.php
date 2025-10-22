<?php namespace APP\Messaging\Responses\Historico;

use APP\Messaging\RawQueryResult\Historico\DetalhePedidosRawQueryResult;

class HistoricoPedidosResponse
{
  public string $ValorTotal = "";
  public string $DataPedido = "";
  public int $FormaPagamento = 0;

  public function __construct(DetalhePedidosRawQueryResult $detalheRawQuery)
  {
    $this->ValorTotal = $detalheRawQuery->ValorTotal;
    $this->DataPedido = $detalheRawQuery->DtInclusao;
    $this->FormaPagamento = $detalheRawQuery->FormaPagamento;
  }
}