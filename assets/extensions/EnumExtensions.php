<?php namespace APP\Assets\Extensions;

class EnumExtensions
{
  public static function obterDescricaoSituacaoEntrega(int $situacao) : string
  {
    return match ($situacao) {
      1 => "Pedido separado",
      2 => "Com a transportadora",
      3 => "Em trânsito",
      4 => "Em rota de entrega",
      5 => "Entregue",
      default => "Situação não encontrada",
    };
  }
}