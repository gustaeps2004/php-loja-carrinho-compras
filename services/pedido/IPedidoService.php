<?php namespace APP\Services\Pedido;

interface IPedidoService
{
  function inserir(int $usuarioID) : int;
  function finalizar(int $usuarioID, int $metodoPagamento) : void;
  function cancelar(int $usuarioID) : void;
}
?>