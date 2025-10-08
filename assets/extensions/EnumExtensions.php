<?php namespace APP\Assets\Extensions;

class EnumExtensions
{
  public static function obterDescricaoSituacaoEntrega(?int $situacao) : string
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

  public static function obterDescricaoSituacaoPedido(?int $situacao) : string
  {
    return match ($situacao) {
      1 => "Ativo",
      2 => "Cancelado",
      3 => "Finalizado",
      default => "Situação não encontrada",
    };
  }
}