<?php namespace APP\Assets\Enums;

enum SituacaoEntrega : int
{
  case PedidoSeparado = 1;
  case ComTransportadora = 2;
  case EmTransito = 3;
  case RotaEntrega = 4;
  case Entregue = 5;
}