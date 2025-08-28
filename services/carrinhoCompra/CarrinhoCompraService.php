<?php namespace APP\Services\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
use APP\Messaging\Request\CarrinhoCompra\CarrinhoCompraRequest;
use APP\Repositories\CarrinhoCompra\ICarrinhoCompraRepository;

class CarrinhoCompraService implements ICarrinhoCompraService
{
  private readonly ICarrinhoCompraRepository $_carrinhoCompraRepository;

  public function __construct(ICarrinhoCompraRepository $carrinhoCompraRepository)
  {
    $this->_carrinhoCompraRepository = $carrinhoCompraRepository;
  }

  public function inserir(CarrinhoCompraRequest $request) : void
  {
    $compraCarrinho = new CarrinhoCompra(
                          $request->QuantidadeItem,
                          $request->PedidoID,
                          $request->ProdutoID);
  }
}
?>