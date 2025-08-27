<?php namespace APP\Entities;

  use APP\Entities\Base\EntitieBase;
  use DateTime;

  class CarrinhoCompra extends EntitieBase
  {
    public DateTime $DtInclusao;
    public int $QuantidadeItem;
    public int $PedidoID;
    public int $ProdutoID;

    public function __construct(
      int $quantidadeItem,
      int $pedidoID,
      int $produtoID)
    {
      $this->DtInclusao = new DateTime();
      $this->QuantidadeItem = $quantidadeItem;
      $this->PedidoID = $pedidoID;
      $this->ProdutoID = $produtoID;
    }

    public function validar() : void
    {
      
    }
  }
?>