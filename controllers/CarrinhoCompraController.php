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

  public function inserir(int $quantidadeItem, int $produtoID)
  {
    $this->_carrinhoCompraService->inserir(
      $quantidadeItem,
      $this->obterUsuarioLogado(),
      $produtoID
    );
  }

  public function listar() : void
  {
    $usuarioID = $this->obterUsuarioLogado();
    $produtosCarrinho = $this->_carrinhoCompraService->listar($usuarioID);

    if (empty($produtosCarrinho))
      return;

    $apensUmItem = OpcaoExclusaoProdutoCarrinho::Item->value;
    $completo = OpcaoExclusaoProdutoCarrinho::Completo->value;

    foreach ($produtosCarrinho as $produto)
    {
      echo '<div class="opcaoCarrinho">
              <p>'.$produto->Titulo.'</p>
              <img src="../../'.$produto->CaminhoImagem.'" alt="'.$produto->Titulo.'" title="'.$produto->DescricaoProduto.'">
              <div class="texto">
                <p>Categoria: '.$produto->Categoria.'</p>
                <p>Quantidade: '.$produto->QuantidadeItem.'</p>
                <p>Data inclusão: '.StringFormats::formatarData($produto->DtInclusao).'</p>
                <p>Data alteração: '.StringFormats::formatarData($produto->DtSituacao).'</p>
              </div>
              <div class="opcoesCarrinhoButtons">
                <form action="../../assets/functions/processaFormRemoveProdutoCarrinho.php?opcao='.$apensUmItem.'&carrinhoID='.$produto->ID.'" method="POST">
                  <button class="btnRemoveItem">REMOVER ITEM</button>
                </form>
                <form action="../../assets/functions/processaFormRemoveProdutoCarrinho.php?opcao='.$completo.'&carrinhoID='.$produto->ID.'" method="POST">
                  <button class="btnRemoveProduto">REMOVER PRODUTO</button>
                </form>
                <div class="checkboxWrapper">
                  <input type="checkbox" id="checkProduto" name="checkProduto" />
                  <label for="checkProduto">Selecionar produto</label>
                </div>
              </div>
            </div>'; 
    }
  }

  public function remover(int $id, int $opcao) : void
  {
    $this->_carrinhoCompraService->remover($id, $opcao);
  }
}
?>