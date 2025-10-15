<?php namespace APP\Services\Pedido;

use APP\Assets\Enums\SituacaoEntrega;
use APP\Entities\Pedido;
use APP\Entities\PedidoEntrega;
use APP\Entities\PedidoProduto;
use APP\Messaging\Requests\Entrega\EntregaRequest;
use APP\Messaging\Responses\Historico\HistoricoPedidosResponse;
use APP\Repositories\CarrinhoCompra\ICarrinhoCompraRepository;
use APP\Repositories\Connections\Firebase\IFirebaseRepository;
use APP\Repositories\Pedido\IPedidoRepository;
use APP\Repositories\PedidoEntrega\IPedidoEntregaRepository;

class PedidoService implements IPedidoService
{
  private readonly IPedidoRepository $_pedidoRepository;
  private readonly ICarrinhoCompraRepository $_carrinhoCompraRepository;
  private readonly IFirebaseRepository $_firebaseRepository; 
  private readonly IPedidoEntregaRepository $_pedidoEntregaRepository;

  public function __construct(
    IPedidoRepository $pedidoRepository,
    ICarrinhoCompraRepository $carrinhoCompraRepository,
    IFirebaseRepository $firebaseRepository,
    IPedidoEntregaRepository $pedidoEntregaRepository)
  {
    $this->_pedidoRepository = $pedidoRepository;
    $this->_carrinhoCompraRepository = $carrinhoCompraRepository;
    $this->_firebaseRepository = $firebaseRepository;
    $this->_pedidoEntregaRepository = $pedidoEntregaRepository;
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

    $this->_pedidoEntregaRepository->inserir(
      new PedidoEntrega(
        $pedido->ID,
        SituacaoEntrega::PedidoSeparado->value
      )
    );

    $this->_firebaseRepository->inserir(
      $pedido->ID,
      new EntregaRequest()
    );
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

  public function cancelar(int $usuarioID) : void
  {
    $pedido = $this->_pedidoRepository->obterAtivoPorUsuario($usuarioID);

    if ($pedido == null)
      return;

    $this->_pedidoRepository->cancelar($pedido->ID);
  }

  public function listarEntregas(int $usuarioID) : array
  {
    return $this->_pedidoRepository->listarEntregas($usuarioID);
  }

  public function atualizarEntrega($data, $pedidoID) : void
  {
    $entregaRequest = json_decode($data, false);
    $pedidoEntrega = $this->_pedidoEntregaRepository->obterPorPedidoID($pedidoID);
    
    if ($pedidoEntrega->Situacao == $entregaRequest->SituacaoEntrega)
      return;

    $this->_pedidoEntregaRepository->inserir(
      new PedidoEntrega(
        $pedidoID,
        $entregaRequest->SituacaoEntrega
      )
    );
  }

  public function listarHistorico(int $usuarioID) : array
  {
    return $this->_pedidoRepository->listarHistorico($usuarioID);
  }

  public function obter(int $id) : HistoricoPedidosResponse
  {
    
  }
}
