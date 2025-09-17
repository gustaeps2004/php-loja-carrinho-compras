<?php namespace APP\Services\Pedido;

use APP\Entities\Pedido;
use APP\Entities\PedidoProduto;
use APP\Repositories\CarrinhoCompra\ICarrinhoCompraRepository;
use APP\Repositories\Pedido\IPedidoRepository;

class PedidoService implements IPedidoService
{
  private readonly IPedidoRepository $_pedidoRepository;
  private readonly ICarrinhoCompraRepository $_carrinhoCompraRepository;

  public function __construct(
    IPedidoRepository $pedidoRepository,
    ICarrinhoCompraRepository $carrinhoCompraRepository)
  {
    $this->_pedidoRepository = $pedidoRepository;
    $this->_carrinhoCompraRepository = $carrinhoCompraRepository;
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

  public function finalizar(int $usuarioID, int $metodoPagamento) : void
  {
    $carrinho = $this->filtrarSelecionado($usuarioID);
    $pedido = $this->_pedidoRepository->obterAtivoPorUsuario($usuarioID);

    $valorTotal = 0;

    foreach ($carrinho as $produto)
    {
      $valorProduto = $produto->Valor * $produto->QuantidadeItem;
      $valorTotal += $valorProduto;

      $this->_pedidoRepository->inserirPedidoProduto(
        new PedidoProduto(
          $pedido->ID,
          $produto->ProdutoID,
          $produto->QuantidadeItem,
          $valorProduto,
        )
      );

      $this->_carrinhoCompraRepository->remover($produto->ID);
    }

    $this->_pedidoRepository->finalizar(
      $pedido->ID,
      $valorTotal,
      $metodoPagamento
    );

    $novoPedidoID = $this->inserir($usuarioID);
    $this->_carrinhoCompraRepository->atualizarNaoFinalizados($usuarioID, $novoPedidoID);
  }

  private function filtrarSelecionado(int $usuarioID) : array
  {
    $carrinho = $this->_carrinhoCompraRepository->listarSelecionados($usuarioID);
    
    $selecionados = array_filter($carrinho, function ($item) {
      return $item->Selecionado == true;
    });
  
    if (empty($selecionados))
      return $carrinho;

    return $selecionados;
  }
}
?>