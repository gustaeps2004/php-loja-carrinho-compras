<?php namespace APP\Services\Pedido;

use APP\Messaging\Responses\Historico\HistoricoPedidosResponse;

interface IPedidoService
{
  function inserir(int $usuarioID) : int;
  function finalizar(int $usuarioID, int $metodoPagamento) : void;
  function cancelar(int $usuarioID) : void;
  function listarEntregas(int $usuarioID) : array;
  function atualizarEntrega($data, $pedidoID) : void;
  function listarHistorico(int $usuarioID) : array;
  function obter(int $id) : HistoricoPedidosResponse;
}
