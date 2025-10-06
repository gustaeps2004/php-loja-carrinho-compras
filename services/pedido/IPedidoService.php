<?php namespace APP\Services\Pedido;

interface IPedidoService
{
  function inserir(int $usuarioID) : int;
  function finalizar(int $usuarioID, int $metodoPagamento) : void;
  function cancelar(int $usuarioID) : void;
  function listarEntregas(int $usuarioID) : array;
  function atualizarEntrega($data, $pedidoID) : void;
}
