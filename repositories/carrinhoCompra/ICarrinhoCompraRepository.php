<?php namespace APP\Repositories\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;

interface ICarrinhoCompraRepository
{
  public function inserir(CarrinhoCompra $carrinhoCompra) : void;
}
?>