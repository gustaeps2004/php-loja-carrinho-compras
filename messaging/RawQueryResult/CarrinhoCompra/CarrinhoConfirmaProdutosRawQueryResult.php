<?php namespace APP\Messaging\RawQueryResult\CarrinhoCompra;

class CarrinhoConfirmaProdutosRawQueryResult
{
  public int $ID;
  public int $ProdutoID;
  public string $Titulo;
  public float $Valor;
  public int $QuantidadeItem;
  public ?bool $Selecionado;
}
?>