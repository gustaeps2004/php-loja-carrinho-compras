<?php namespace APP\Services\CarrinhoCompra;

interface ICarrinhoCompraService
{
  function inserir(
    int $quantidadeItem,
    int $usuarioID,
    int $produtoID) : void;
    
  function listar(int $usuarioID) : array;
  function remover(int $id, int $opcao) : void;
  function atualizarSelecionado(int $id, bool $selecionado) : void;
  function listarSelecionados(int $usuarioID) : array;
}
?>