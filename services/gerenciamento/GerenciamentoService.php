<?php namespace APP\Services\Gerenciamento;

require __DIR__.'../../../vendor/autoload.php';

use APP\Dtos\DownloadRelatorioDto;
use APP\Messaging\Responses\Gerenciamento\DadosGraficosResponse;
use APP\Repositories\Pedido\IPedidoRepository;
use APP\Repositories\Usuario\IUsuarioRepository;
use DateTime;
use Mpdf\Mpdf;

date_default_timezone_set('America/Sao_Paulo');

class GerenciamentoService implements IGerenciamentoService
{
  private readonly IPedidoRepository $_pedidoRepository;
  private readonly IUsuarioRepository $_usuarioRepository;

  public function __construct(
    IPedidoRepository $pedidoRepository,
    IUsuarioRepository $usuarioRepository)
  {
    $this->_pedidoRepository = $pedidoRepository;
    $this->_usuarioRepository = $usuarioRepository;
  }
  
  public function obterValoresGrafico() : DadosGraficosResponse
  {
    $totalAnual = $this->_pedidoRepository->obterTotalPedidosPorAno();
    $totalMensal = $this->_pedidoRepository->obterTotalPedidosPorMes();
    $qtdProdutosVendidos = $this->_pedidoRepository->obterQtdProdutosVendidos();

    return new DadosGraficosResponse(
    $totalAnual,
    $totalMensal,
    $qtdProdutosVendidos
    );
  }

  public function obterRelatorio(DownloadRelatorioDto $downloadDto, int $usuarioID) : string
  {
    $nomeUsuario = $this->_usuarioRepository->obterNome($usuarioID);
    $dataAtual = new DateTime();
    $valores = $this->obterValoresGrafico();

    return '<!doctype html>
              <html lang="pt-BR">
              <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width,initial-scale=1" />
                <title>Relatório - DownloadRelatorio</title>
                <style>
                '.$this->obterEstilizacao().'
                </style>
              </head>
              <body>
                <div class="container">
                  <div class="card">
                    <header class="report-header">
                      <div class="left">
                        <div class="title">Relatório de Solicitação</div>
                        <div class="meta" aria-hidden="true">
                          <div class="item">Solicitante: <strong>'.$nomeUsuario.'</strong></div>
                          <div class="item">Data solicitação: <strong>'.$dataAtual->format('d/m/Y H:i:s').'</strong></div>
                        </div>
                      </div>
                    </header>
                    <br/>                      
                    <div id="reportForm" class="report-form" >
                      ' . (
                        $downloadDto->TotalAnual 
                          ? '
                            <div class="field">
                              <label for="totalAnual">Total anual</label>
                              <div class="input-prefix">
                                <input id="totalAnual" name="totalAnual" type="number" step="0.01" value="'.ceil($valores->TotalAnual[0]->Valor).'" />
                              </div>
                            </div>'
                          : ''
                      ) . '

                      ' . (
                        $downloadDto->TotalMensal
                          ? '
                            <div class="field">
                              <label for="totalMensal">Total mês atual</label>
                              <div class="input-prefix">
                                <input id="totalMensal" name="totalMensal" type="number" step="0.01" value="'.ceil($valores->TotalMensal[0]->Valor).'" />
                              </div>
                            </div>'
                          : ''
                      ) . '

                      ' . (
                        $downloadDto->ProjecaoAnual
                          ? '
                            <div class="field">
                              <label for="projecaoAnual">Projeção anual</label>
                              <div class="input-prefix">
                                <input id="projecaoAnual" name="projecaoAnual" type="number" step="0.01" value="'.ceil($valores->ProjecaoAnual[0]->Valor).'" />
                              </div>
                            </div>'
                          : ''
                      ) . '

                      ' . (
                        $downloadDto->ProdutosVendidos
                          ? '       
                                    <div class="field">
                                      <label for="produtosVendidos">'.$valores->QtdProdutosVendidos[0]->Campo.'</label>
                                      <div class="input-prefix">
                                        <input 
                                          id="produtosVendidos" 
                                          name="produtosVendidos" 
                                          type="number" 
                                          step="1" 
                                          value="'.ceil($valores->QtdProdutosVendidos[0]->Valor).'" />
                                      </div>
                                      
                                    </div>
                                    <div class="field">
                                      <label for="produtosVendidos">'.$valores->QtdProdutosVendidos[1]->Campo.'</label>
                                      <div class="input-prefix">
                                        <input 
                                          id="produtosVendidos" 
                                          name="produtosVendidos" 
                                          type="number" 
                                          step="1" 
                                          value="'.ceil($valores->QtdProdutosVendidos[1]->Valor).'" />
                                      </div>
                                    </div>'
                          : ''
                      ) . '

                    </div>
                  </div>
              </div>
              </body>
              </html>';
  }
  
  private function obterEstilizacao() : string
  {
      return '
      /* Reset e Fontes */
      body {
          font-family: sans-serif;
          color: #111827;
          margin: 0;
          background: #ffffff;
          padding: 20px;
      }
  
      .container {
          width: 100%;
          max-width: 900px; /* Se quiser ocupar a folha toda, mude para 100% */
          margin: 0 auto;
      }
  
      .card {
          background: white;
          border: 1px solid #e6e9ee;
          border-radius: 12px;
          padding: 10px; /* Adicionei um padding interno no card */
      }
  
      /* Cabeçalho */
      header.report-header {
          background-color: #0284c7;
          padding: 22px;
          border-radius: 12px;
          margin-bottom: 22px;
          color: white;
          overflow: hidden; 
      }
  
      .title {
          font-size: 22px;
          font-weight: 700;
          color: white;
          margin-bottom: 12px;
      }
  
      /* Meta Dados */
      .meta {
          width: 100%;
          overflow: hidden;
      }
  
      .meta .item {
          display: inline-block;
          background: white;
          color: #374151;
          padding: 6px 12px;
          border-radius: 8px;
          border: 1px dashed rgba(255,255,255,0.4);
          font-size: 14px;
          margin-right: 10px;
          margin-bottom: 5px;
      }
  
      /* --- ALTERAÇÕES PARA FICAR UM EMBAIXO DO OUTRO AQUI --- */
      
      .report-form {
          width: 100%;
          margin-top: 4px;
      }
  
      .field {
          /* Removemos float e width 48% */
          display: block;
          width: 100%;       /* Ocupa a largura total */
          margin-right: 0;
          margin-bottom: 15px; /* Espaço entre as linhas */
          clear: both;       /* Garante que não suba nada ao lado */
      }
      
      /* Removemos a regra do nth-child pois não há mais colunas */
  
      label {
          display: block;
          font-size: 13px;
          font-weight: bold;
          color: #6b7280;
          margin-bottom: 6px;
      }
  
      /* Inputs ocupando a largura total */
      input[type="text"],
      input[type="date"],
      input[type="number"] {
          width: 96%; /* Deixamos uma folga pequena para não estourar a margem */
          font-size: 16px;
          padding: 10px;
          border: 1px solid #d0d0d0;
          border-radius: 4px;
          background: white;
          display: block;
      }
  
      .input-prefix {
          display: block;
          width: 100%;
      }
      
      @page {
          margin: 0px;
      }
      ';
  }
}