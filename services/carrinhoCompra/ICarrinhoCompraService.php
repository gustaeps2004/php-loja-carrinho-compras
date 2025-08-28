<?php namespace APP\Services\CarrinhoCompra;

use APP\Messaging\Request\CarrinhoCompra\CarrinhoCompraRequest;

interface ICarrinhoCompraService
{
  public function inserir(CarrinhoCompraRequest $request) : void;
}
?>