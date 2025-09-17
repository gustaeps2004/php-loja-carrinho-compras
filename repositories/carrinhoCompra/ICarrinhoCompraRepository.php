<?php namespace APP\Repositories\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraExistenteRawQueryResult;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraQtdItemRawQueryResult;

interface ICarrinhoCompraRepository
{
  function inserir(CarrinhoCompra $carrinhoCompra) : void;
  function atualizarQuantidadeItem(int $id, int $quantidadeNova) : void;
  function obter(int $pedidoID, int $produtoID) : ?CarrinhoCompraExistenteRawQueryResult;
  function listar(int $usuarioID) : array;
  function remover(int $id) : void;
  function obterQtdItemPorId(int $id) : ?CarrinhoCompraQtdItemRawQueryResult;
  function atualizarSelecionado(int $id, bool $selecionado) : void;
  function listarSelecionados(int $usuarioID) : array;
}
?>