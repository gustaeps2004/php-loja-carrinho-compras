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

  public function listarHistorico(int $usuarioID)
  {
    $pedidoHistorico = $this->_pedidoService->listarHistorico($usuarioID);

    if (empty($pedidoHistorico))
      return;

    foreach ($pedidoHistorico as $historico)
    {
      echo '<div class="opcao-historico-pedido">
              <div  class="opcao-historico-pedido-box-text">
                <p><b>Data da compra:</b> '.StringFormats::formatarData($historico->DtAtualizacaoEntrega).'</p>
                <p><b>Situação:</b> '.EnumExtensions::obterDescricaoSituacaoEntrega($historico->SituacaoEntrega).'</p>
              </div>
              <div class="opcao-historico-pedido-box-botao">
                <button onclick="abrirModalEntrega('.$historico->ID.')">Acompanhar entrega</button>
              </div>
            </div>';
    }  
  }
}