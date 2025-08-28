<?php namespace APP\Services\Pedido;

use APP\Entities\Pedido;
use APP\Repositories\Pedido\IPedidoRepository;

class PedidoService implements IPedidoService
{
  private readonly IPedidoRepository $_pedidoRepository;

  public function __construct(IPedidoRepository $pedidoRepository)
  {
    $this->_pedidoRepository = $pedidoRepository;
  }

  public function inserir(int $usuarioID) : int
  {
    $pedido = $this->_pedidoRepository->obterAtivoPorUsuario($usuarioID);

    if ($pedido != null)
      return $pedido->ID;

    $pedidoNovo = new Pedido($usuarioID);
    $this->_pedidoRepository->inserir($pedidoNovo);

    return $this->_pedidoRepository->obterAtivoPorUsuario($usuarioID)->ID;
  }
}
?>