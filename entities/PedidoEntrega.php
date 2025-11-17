<?php namespace APP\Entities;

use APP\Entities\Base\EntitieBase;
use DateTime;

date_default_timezone_set("America/Sao_Paulo");
final class PedidoEntrega extends EntitieBase
{
  public int $PedidoID;
  public int $Situacao;
  public DateTime $DtInclusao;

  public function __construct(int $pedidoID, int $situacao)
  {
    $this->PedidoID = $pedidoID;
    $this->Situacao = $situacao;
    $this->DtInclusao = New DateTime(date('Y-m-d H:i:s'));
  }
 
  public function validar() : void
  {

  }
}
