<?php namespace APP\Controllers;

use APP\Assets\Extensions\EnumExtensions;
use APP\Assets\Extensions\StringFormats;
use APP\Services\Pedido\IPedidoService;
use APP\Controllers\Base\BaseController;

class PedidosController extends BaseController
{
  private readonly IPedidoService $_pedidoService;

  public function __construct(IPedidoService $pedidoService)
  {
    $this->_pedidoService = $pedidoService;
  }

  public function finalizar(int $usuarioID, int $metodoPagamento)
  {
    $this->_pedidoService->finalizar($usuarioID, $metodoPagamento);
  }

  public function cancelar(int $usuarioID)
  {
    $this->_pedidoService->cancelar($usuarioID);
  }

  public function listarEntregas(int $usuarioID)
  {
    $entregas = $this->_pedidoService->listarEntregas($usuarioID);

    if (empty($entregas))
      return;

    foreach ($entregas as $entrega)
    {
      echo '<div class="opcao-entrega-pedido">
              <div  class="opcao-entrega-pedido-box-text">
                <p><b>Data da compra:</b> '.StringFormats::formatarData($entrega->DtAtualizacaoEntrega).'</p>
                <p><b>Situação:</b> '.EnumExtensions::obterDescricaoSituacaoEntrega($entrega->SituacaoEntrega).'</p>
              </div>
              <div class="opcao-entrega-pedido-box-botao">
                <button onclick="abrirModalEntrega('.$entrega->ID.')">Acompanhar entrega</button>
              </div>
            </div>';
    }  
  }
}