<?php namespace APP\Controllers;

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
            </div>'; 
    }
  }
}
?>