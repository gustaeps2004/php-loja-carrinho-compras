<?php namespace APP\Controllers;

use APP\Controllers\Base\BaseController;
use APP\Services\CarrinhoCompra\ICarrinhoCompraService;

class CarrinhoCompraController extends BaseController
{
  private readonly ICarrinhoCompraService $_carrinhoCompraService;

  public function __construct(ICarrinhoCompraService $carrinhoCompraService)
  {
    $this->_carrinhoCompraService = $carrinhoCompraService;
  }

  public function inserir(int $quantidadeItem, int $produtoID)
  {
    $this->_carrinhoCompraService->inserir(
      $quantidadeItem,
      $this->obterUsuarioLogado(),
      $produtoID
    );
  }
}
?>