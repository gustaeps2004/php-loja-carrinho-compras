<?php namespace APP\Entities;

use APP\Entities\Base\EntitieBase;
use DateTime;

  class PedidoProduto extends EntitieBase
  {
    public int $PedidoID;
    public int $ProdutoID;
    public float $Quantidade;
    public DateTime $DtInclusao;

    public function validar() : void
    {
      
    }
  }
?>