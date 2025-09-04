<?php namespace APP\Messaging\RawQueryResult\CarrinhoCompra;

  class CarrinhoCompraRawQueryResult
  {
    public int $ID;
    public string $DtInclusao;
    public string $DtSituacao;
    public int $QuantidadeItem;
    public string $Titulo;
    public string $DescricaoProduto;
    public string $CaminhoImagem;
    public string $Categoria;
    public string $Valor;
    public ?bool $Selecionado;
  }
?>