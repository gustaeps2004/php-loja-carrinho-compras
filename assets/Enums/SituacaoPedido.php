<?php namespace APP\Assets\Enums;
  
  enum SituacaoPedido : int
  {
    case Ativo = 1;
    case Cancelado = 2;
    case Finalizado = 3;
  }
?>