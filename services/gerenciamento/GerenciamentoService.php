<?php namespace APP\Services\Gerenciamento;

use APP\Messaging\Responses\Gerenciamento\DadosGraficosResponse;
use APP\Repositories\Pedido\IPedidoRepository;

class GerenciamentoService implements IGerenciamentoService
{
  private readonly IPedidoRepository $_pedidoRepository;

  public function __construct(IPedidoRepository $pedidoRepository)
  {
    $this->_pedidoRepository = $pedidoRepository;
  }
  
  public function obterValoresGrafico(int $usuarioID) : DadosGraficosResponse
  {
    $totalAnual = $this->_pedidoRepository->obterTotalPedidosPorAno($usuarioID);
    $totalMensal = $this->_pedidoRepository->obterTotalPedidosPorMes($usuarioID);

    return new DadosGraficosResponse(
    $totalAnual,
    $totalMensal
    );
  }
}