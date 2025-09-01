<?php namespace APP\Repositories\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraExistenteRawQueryResult;

interface ICarrinhoCompraRepository
{
  public function inserir(CarrinhoCompra $carrinhoCompra) : void;
  public function atualizarQuantidadeItem(int $id, int $quantidadeNova) : void;
  public function obter(int $pedidoID, int $produtoID) : ?CarrinhoCompraExistenteRawQueryResult;
}
?>