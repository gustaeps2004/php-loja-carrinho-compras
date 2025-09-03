<?php namespace APP\Services\CarrinhoCompra;

use APP\Assets\Enums\OpcaoExclusaoProdutoCarrinho;
use APP\Entities\CarrinhoCompra;
use APP\Exceptions\LojaException;
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

  public function listar(int $usuarioID) : array
  {
    return $this->_carrinhoCompraRepository->listar($usuarioID);
  }

  public function remover(int $id, int $opcao) : void
  {
    $qtdRawQueryResult = $this->_carrinhoCompraRepository->obterQtdItemPorId($id);

    if ($qtdRawQueryResult == null)
      throw new LojaException("Não foi possível localizar o produto no carrinho.");

    $quantidadeNova = $qtdRawQueryResult->QuantidadeItem - 1;

    if ($this->existeRemocaoProduto($opcao, $quantidadeNova))
    {
      $this->_carrinhoCompraRepository->remover($id);
      return;
    }

    $this->_carrinhoCompraRepository->atualizarQuantidadeItem($id, $quantidadeNova);
  }

  private function existeRemocaoProduto(int $opcao, int $quantidadeNova) : bool
  {
    return $opcao == OpcaoExclusaoProdutoCarrinho::Completo->value || $quantidadeNova <= 0;
  }
}
?>