<?php namespace APP\Controllers;

use APP\Assets\Enums\OpcaoExclusaoProdutoCarrinho;
use APP\Assets\Extensions\StringFormats;
use APP\Controllers\Base\BaseController;
use APP\Services\CarrinhoCompra\ICarrinhoCompraService;

class CarrinhoCompraController extends BaseController
{
  private readonly ICarrinhoCompraService $_carrinhoCompraService;

  public function __construct(ICarrinhoCompraService $carrinhoCompraService)
  {
    $this->_carrinhoCompraService = $carrinhoCompraService;
  }

  public function inserir(int $quantidadeItem, int $produtoID, int $usuarioID)
  {
    $this->_carrinhoCompraService->inserir(
      $quantidadeItem,
      $usuarioID,
      $produtoID
    );
  }

  public function listar($usuarioID) : void
  {
    $produtosCarrinho = $this->_carrinhoCompraService->listar($usuarioID);

    if (empty($produtosCarrinho))
    {
      $this->inserirValorTotal("0,00");
      return;
    }

    $apensUmItem = OpcaoExclusaoProdutoCarrinho::Item->value;
    $completo = OpcaoExclusaoProdutoCarrinho::Completo->value;

    $valorTotal = 0.0;

    foreach ($produtosCarrinho as $produto)
    {
      $valorTotal += $produto->Valor * $produto->QuantidadeItem;
      $checked = $produto->Selecionado == true ? "checked" : "";

      echo '<div class="opcaoCarrinho">
              <p>'.$produto->Titulo.'</p>
              <img src="../../'.$produto->CaminhoImagem.'" alt="'.$produto->Titulo.'" title="'.$produto->DescricaoProduto.'">
              <div class="texto">
                <p>Categoria: '.$produto->Categoria.'</p>
                <p>Quantidade: '.$produto->QuantidadeItem.'</p>
                <p>Valor unitário: R$ '.number_format($produto->Valor, 2, ',', '.').'</p>
                <p>Valor total: R$ '.number_format($produto->Valor * $produto->QuantidadeItem, 2, ',', '.').'</p>
                <p>Data inclusão: '.StringFormats::formatarData($produto->DtInclusao).'</p>
              </div>
              <div class="opcoesCarrinhoButtons">
                <form action="../../assets/functions/processaFormRemoveProdutoCarrinho.php?opcao='.$apensUmItem.'&carrinhoID='.$produto->ID.'&usuarioID='.$usuarioID.'" method="POST">
                  <button class="btnRemoveItem">REMOVER ITEM</button>
                </form>
                <form action="../../assets/functions/processaFormRemoveProdutoCarrinho.php?opcao='.$completo.'&carrinhoID='.$produto->ID.'&usuarioID='.$usuarioID.'" method="POST">
                  <button class="btnRemoveProduto">REMOVER PRODUTO</button>
                </form>
                <div class="checkboxWrapper">
                  <input 
                      type="checkbox" 
                      id="checkProduto_'.$produto->ID.'" 
                      name="checkProduto" 
                      '.$checked.'
                      onchange="marcarProdutoSelecionado('.$produto->ID.')"/>
                  <label for="checkProduto_'.$produto->ID.'">Selecionar produto</label>
                </div>
              </div>
            </div>';
    }

    $this->inserirValorTotal(number_format($valorTotal, 2, ',', '.'));
  }

  public function remover(int $id, int $opcao) : void
  {
    $this->_carrinhoCompraService->remover($id, $opcao);
  }

  public function atualizarSelecionado(int $id, bool $selecionado) : void
  {
    $this->_carrinhoCompraService->atualizarSelecionado($id, $selecionado);
  }

  public function listarSelecionados(int $usuarioID)
  {
    $carrinho = $this->_carrinhoCompraService->listarSelecionados($usuarioID);
    
    if (empty($carrinho))
    {
      echo '<div class="content-step-confirmacao">
              <div class="content-step-confirmacao-produto">
                <p class="content-step-confirmacao-produto-paragrafo">Adicione um produto em seu carrinho!</p>
              </div>
            </div>';
      return;
    }

    foreach ($carrinho as $produtoCarrinho)
    {
      $valorTotalItem = $produtoCarrinho->QuantidadeItem * $produtoCarrinho->Valor;

      echo '<div class="content-step-confirmacao">
              <div class="content-step-confirmacao-produto">
                <p class="content-step-confirmacao-produto-paragrafo">Produto: '.$produtoCarrinho->Titulo.'</p>
                <p class="content-step-confirmacao-produto-paragrafo">Quantidade: '.$produtoCarrinho->QuantidadeItem.'</p>
                <p class="content-step-confirmacao-produto-paragrafo">Valor total: '.number_format($valorTotalItem, 2, ',', '.').'</p>
              </div>
            </div>';
    }
  }

  private function inserirValorTotal(string $valorTotal)
  {
    echo "<script>
            document.getElementById('valorTotalCarrinho').textContent = '".$valorTotal."'
          </script>";
  }
}
?>