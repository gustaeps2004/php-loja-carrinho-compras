<?php namespace APP\Repositories\Pedido;

use APP\Entities\Pedido;
use APP\Entities\PedidoProduto;
use APP\Messaging\RawQueryResult\Historico\DetalhePedidosRawQueryResult;
use APP\Messaging\RawQueryResult\Pedido\PedidoAtivoUsuarioRawQueryResult;

interface IPedidoRepository
{
  function obterAtivoPorUsuario($usuarioID) : ?PedidoAtivoUsuarioRawQueryResult;
  function inserir(Pedido $pedido) : void;
  function inserirPedidoProduto(PedidoProduto $pedidoProduto) : void;
  function finalizar(int $id, float $valorTotal, int $formaPagamento) : void;
  function cancelar(int $id) : void;
  function listarEntregas(int $usuarioID) : array;
  function listarHistorico(int $usuarioID) : array;
  function obter(int $id): DetalhePedidosRawQueryResult;
  function obterDetalhePedidosProdutos(int $id) : array;
  function obterHistoricoEntregas($id) : array;
  public function obterTotalPedidosPorAno() : array;
  function obterTotalPedidosPorMes() : array;
  function obterQtdProdutosVendidos() : array;
}