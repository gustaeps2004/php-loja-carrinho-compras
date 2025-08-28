<?php namespace APP\Messaging\Request\CarrinhoCompra;

class CarrinhoCompraRequest
{
  public int $QuantidadeItem;
  public int $PedidoID;
  public int $ProdutoID;

  public function __construct(
    int $quantidadeItem,
    int $pedidoID,
    int $produtoID)
  {
    $this->QuantidadeItem = $quantidadeItem;
    $this->PedidoID = $pedidoID;
    $this->ProdutoID = $produtoID;
  }
}
?>