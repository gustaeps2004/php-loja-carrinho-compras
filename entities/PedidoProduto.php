<?php namespace APP\Entities;

use APP\Entities\Base\EntitieBase;
use DateTime;

  class PedidoProduto extends EntitieBase
  {
    public int $PedidoID;
    public int $ProdutoID;
    public int $Quantidade;
    public float $Valor;
    public DateTime $DtInclusao;

    public function __construct(
      int $pedidoID,
      int $produtoID,
      int $quantidade,
      float $valor)
    {
      $this->PedidoID = $pedidoID;
      $this->ProdutoID = $produtoID;
      $this->Quantidade = $quantidade;
      $this->Valor = $valor;
      $this->DtInclusao = new DateTime();
    }

    public function validar() : void
    {
      
    }
  }
?>