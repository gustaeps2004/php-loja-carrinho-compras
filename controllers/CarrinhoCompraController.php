<?php namespace APP\Controllers;

use APP\Controllers\Base\BaseController;
use APP\Messaging\Request\CarrinhoCompra\CarrinhoCompraRequest;
use APP\Services\CarrinhoCompra\ICarrinhoCompraService;

class CarrinhoCompraController extends BaseController
{
  private readonly ICarrinhoCompraService $_carrinhoCompraService;

  public function __construct(ICarrinhoCompraService $carrinhoCompraService)
  {
    $this->_carrinhoCompraService = $carrinhoCompraService;
  }

  public function inserir(CarrinhoCompraRequest $request)
  {
    $request->atualizarUsuarioID($this->obterUsuarioLogado());

    $this->_carrinhoCompraService->inserir($request);
  }
}
?>