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

  public function finalizar(int $usuarioID, int $metodoPagamento): void
  {
    $this->_pedidoService->finalizar($usuarioID, $metodoPagamento);
  }

  public function cancelar(int $usuarioID): void
  {
    $this->_pedidoService->cancelar($usuarioID);
  }

  public function listarEntregas(int $usuarioID): void
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

  public function listarHistorico(int $usuarioID): void
  {
    $pedidos = $this->_pedidoService->listarHistorico($usuarioID);
    
    if (empty($pedidos))
      return;

    foreach ($pedidos as $pedido)
    { 
      $html = '<div class="opcao-pedido-historico">
                <div class="opcao-pedido-historico-text">
                  <p><b>Situação pedido: </b>'.EnumExtensions::obterDescricaoSituacaoPedido($pedido->Situacao).'</p>
                  <p><b>Data pedido: </b>'.StringFormats::formatarData($pedido->DtInclusao).'</p>';

      if ($pedido->SituacaoEntrega != null)
      {
        $html .= '<p><b>Situação entrega: </b>'.EnumExtensions::obterDescricaoSituacaoEntrega($pedido->SituacaoEntrega).'</p>
                  <p><b>Data entrega: </b>'.StringFormats::formatarData($pedido->DtInclusaoEntrega).'</p>
                </div>';
      }
      else
      {
        $html .= '</div>';
      }

      $html .= ' <div class="opcao-pedido-historico-botoes">
                  <button 
                    class="opcao-pedido-historico-botoes-abrir-detalhes" 
                    onclick="abrirModal('.$pedido->ID.')">
                      Abrir detalhes
                  </button>
                </div>
              </div>';

      echo $html; 
    }
  }
}