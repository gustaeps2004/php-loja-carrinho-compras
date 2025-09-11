<?php namespace APP\Entities;

use APP\Assets\Enums\SituacaoPedido;
use APP\Entities\Base\EntitieBase;
use DateTime;

  class Pedido extends EntitieBase
  {
    public DateTime $DtInclusao;
    public int $Situacao;
    public int $UsuarioID;
    public ?float $ValorTotal;
    public ?int $FormaPagamento;

    public function __construct(int $usuarioID)
    {
      $this->DtInclusao = new DateTime();
      $this->Situacao = SituacaoPedido::Ativo->value;
      $this->UsuarioID = $usuarioID;
    }

    public function validar() : void
    {
      
    }
  }
?>
