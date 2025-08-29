<?php namespace APP\Services\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
use APP\Repositories\CarrinhoCompra\ICarrinhoCompraRepository;
use APP\Services\Pedido\IPedidoService;

class CarrinhoCompraService implements ICarrinhoCompraService
{
  private readonly ICarrinhoCompraRepository $_carrinhoCompraRepository;
  private readonly IPedidoService $_pedidoService;

  public function __construct(
    ICarrinhoCompraRepository $carrinhoCompraRepository,
    IPedidoService $pedidoService)
  {
    $this->_carrinhoCompraRepository = $carrinhoCompraRepository;
    $this->_pedidoService = $pedidoService;
  }

  public function inserir(
    int $quantidadeItem,
    int $usuarioID,
    int $produtoID) : void
  {
    $pedidoID = $this->_pedidoService->inserir($usuarioID);
    $carrinhoRawQuery = $this->_carrinhoCompraRepository->obter($pedidoID, $produtoID);

    if ($carrinhoRawQuery == null)
    {
      $carrinhoCompra = new CarrinhoCompra(
                          $quantidadeItem,
                          $pedidoID,
                          $produtoID);

      $this->_carrinhoCompraRepository->inserir($carrinhoCompra);

      return;
    }

    $quantidadeNova = $carrinhoRawQuery->QuantidadeItem + $quantidadeItem;

    $this->_carrinhoCompraRepository->atualizarQuantidadeItem(
      $carrinhoRawQuery->ID, 
      $quantidadeNova);
  }
}
?>