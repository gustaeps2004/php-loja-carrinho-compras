<?php namespace APP\Services\CarrinhoCompra;

interface ICarrinhoCompraService
{
  public function inserir(
    int $quantidadeItem,
    int $usuarioID,
    int $produtoID) : void;
    
  public function listar(int $usuarioID) : array;
  public function remover(int $id, int $opcao) : void;
  public function atualizarSelecionado(int $id, bool $selecionado) : void;
}
?>