<?php namespace APP\Repositories\PedidoEntrega;

use APP\Entities\PedidoEntrega;
use APP\Messaging\RawQueryResult\PedidoEntrega\PedidoEntregaRawQueryResult;

interface IPedidoEntregaRepository
{
  function inserir(PedidoEntrega $pedidoEntrega) : void;
  function obterPorPedidoID(int $pedidoID) : PedidoEntregaRawQueryResult;
}