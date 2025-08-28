<?php namespace APP\Services\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
use APP\Messaging\Request\CarrinhoCompra\CarrinhoCompraRequest;
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

  public function inserir(CarrinhoCompraRequest $request) : void
  {
    $pedidoID = $this->_pedidoService->inserir($request->UsuarioID);
    $carrinhoRawQuery = $this->_carrinhoCompraRepository->obter($pedidoID, $request->ProdutoID);

    if ($carrinhoRawQuery == null)
    {
      $carrinhoCompra = new CarrinhoCompra(
                          $request->QuantidadeItem,
                          $pedidoID,
                          $request->ProdutoID);

      $this->_carrinhoCompraRepository->inserir($carrinhoCompra);

      return;
    }

    $quantidadeNova = $carrinhoRawQuery->QuantidadeItem + $request->QuantidadeItem;

    $this->_carrinhoCompraRepository->atualizarQuantidadeItem(
      $carrinhoRawQuery->ID, 
      $quantidadeNova);
  }
}
?>