<?php namespace APP\Controllers;

use APP\Services\Pedido\IPedidoService;
use APP\Controllers\Base\BaseController;

class PedidosController extends BaseController
{
  private readonly IPedidoService $_pedidoService;

  public function __construct(IPedidoService $pedidoService)
  {
    $this->_pedidoService = $pedidoService;
  }

  public function finalizar(int $usuarioID, int $metodoPagamento)
  {
    $this->_pedidoService->finalizar($usuarioID, $metodoPagamento);
  }
}
?>