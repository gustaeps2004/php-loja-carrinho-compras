<?php namespace APP\Messaging\Requests\Entrega;

use APP\Assets\Enums\SituacaoEntrega;
date_default_timezone_set("America/Sao_Paulo");

class EntregaRequest
{
  public int $SituacaoEntrega;
  public string $DtSituacao;

  public function __construct()
  {
    $this->SituacaoEntrega = SituacaoEntrega::PedidoSeparado->value;
    $this->DtSituacao = date("d/m/Y H:i:s");
  }
}