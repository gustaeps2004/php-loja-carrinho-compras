<?php namespace APP\Services\Pedido;

interface IPedidoService
{
  public function inserir(int $usuarioID) : int;
}
?>