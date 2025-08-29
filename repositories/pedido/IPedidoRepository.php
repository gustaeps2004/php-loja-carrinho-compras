<?php namespace APP\repositories\Pedido;

use APP\Entities\Pedido;
use APP\Messaging\RawQueryResult\Pedido\PedidoAtivoUsuarioRawQueryResult;

interface IPedidoRepository
{
  public function obterAtivoPorUsuario($usuarioID) : ?PedidoAtivoUsuarioRawQueryResult;
  public function inserir(Pedido $pedido) : void;
}
?>