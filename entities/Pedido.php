<?php namespace APP\Entities;

use APP\Assets\Enums\SituacaoPedido;
use APP\Entities\Base\EntitieBase;
  use DateTime;

  class Pedido extends EntitieBase
  {
    public DateTime $DtInclusao;
    public SituacaoPedido $Situacao;
    public int $UsuarioID;

    public function __construct(int $usuarioID)
    {
      $this->DtInclusao = new DateTime();
      $this->Situacao = SituacaoPedido::Ativo;
      $this->UsuarioID = $usuarioID;
    }

    public function validar() : void
    {
      
    }
  }
?>
