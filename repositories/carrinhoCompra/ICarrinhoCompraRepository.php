<?php namespace APP\Repositories\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraExistenteRawQueryResult;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraQtdItemRawQueryResult;

interface ICarrinhoCompraRepository
{
  public function inserir(CarrinhoCompra $carrinhoCompra) : void;
  public function atualizarQuantidadeItem(int $id, int $quantidadeNova) : void;
  public function obter(int $pedidoID, int $produtoID) : ?CarrinhoCompraExistenteRawQueryResult;
  public function listar(int $usuarioID) : array;
  public function remover(int $id) : void;
  public function obterQtdItemPorId(int $id) : ?CarrinhoCompraQtdItemRawQueryResult;
  public function atualizarSelecionado(int $id, bool $selecionado) : void;
}
?>