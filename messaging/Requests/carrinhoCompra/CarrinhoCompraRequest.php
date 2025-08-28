<?php namespace APP\Messaging\Request\CarrinhoCompra;

class CarrinhoCompraRequest
{
  public int $QuantidadeItem;
  public int $ProdutoID;
  public ?int $UsuarioID;

  public function __construct(
    int $quantidadeItem,
    int $produtoID)
  {
    $this->QuantidadeItem = $quantidadeItem;
    $this->ProdutoID = $produtoID;
  }

  public function atualizarUsuarioID(int $usuarioID)
  {
    $this->UsuarioID = $usuarioID;
  }
}
?>