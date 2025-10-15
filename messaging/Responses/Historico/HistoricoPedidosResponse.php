<?php namespace APP\Messaging\Responses\Historico;

use APP\Messaging\RawQueryResult\Historico\DetalhePedidosRawQueryResult;

class HistoricoPedidosResponse
{
  public int $ValorTotal = 0;
  public string $DataPedido = "";

  public function __construct(DetalhePedidosRawQueryResult $detalheRawQuery)
  {
    $this->ValorTotal = $detalheRawQuery->ValorTotal;
    $this->DataPedido = $detalheRawQuery->DataPedido;
  }
}