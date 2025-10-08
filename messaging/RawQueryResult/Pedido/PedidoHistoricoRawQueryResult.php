<?php namespace APP\Messaging\RawQueryResult\Pedido;

class PedidoHistoricoRawQueryResult
{
  public int $ID;
  public int $Situacao;
  public ?int $SituacaoEntrega;
  public ?string $DtInclusaoEntrega;
  public string $DtInclusao;
}