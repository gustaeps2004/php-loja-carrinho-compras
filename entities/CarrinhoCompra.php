<?php namespace APP\Entities;

use APP\Entities\Base\EntitieBase;
use DateTime;

final class CarrinhoCompra extends EntitieBase
{
  public DateTime $DtInclusao;
  public DateTime $DtSituacao;
  public int $QuantidadeItem;
  public int $PedidoID;
  public int $ProdutoID;
  public ?bool $Selecionado;

  public function __construct(
    int $quantidadeItem,
    int $pedidoID,
    int $produtoID)
  {
    $this->DtInclusao = new DateTime();
    $this->DtSituacao = new DateTime();
    $this->QuantidadeItem = $quantidadeItem;
    $this->PedidoID = $pedidoID;
    $this->ProdutoID = $produtoID;
    $this->Selecionado = false;
  }

  public function validar() : void
  {
    
  }
}