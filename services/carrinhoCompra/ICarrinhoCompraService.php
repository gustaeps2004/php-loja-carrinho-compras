<?php namespace APP\Services\CarrinhoCompra;

interface ICarrinhoCompraService
{
  public function inserir(
    int $quantidadeItem,
    int $usuarioID,
    int $produtoID) : void;
    
  public function listar(int $usuarioID) : array;
}
?>