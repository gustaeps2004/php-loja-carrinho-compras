<?php namespace APP\Messaging\RawQueryResult\Pedido;

  use APP\Assets\Enums\SituacaoPedido;
  use DateTime;

  class PedidoAtivoUsuarioRawQueryResult
  {
    public int $ID;
    public DateTime $DtInclusao;
    public SituacaoPedido $Situacao;
    public int $UsuarioID;
  }
?>