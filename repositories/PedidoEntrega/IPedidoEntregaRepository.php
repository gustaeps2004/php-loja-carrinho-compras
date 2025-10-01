<?php namespace APP\Repositories\PedidoEntrega;

use APP\Entities\PedidoEntrega;

interface IPedidoEntregaRepository
{
  function inserir(PedidoEntrega $pedidoEntrega) : void;
}