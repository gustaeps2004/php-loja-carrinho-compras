<?php namespace APP\Assets\Extensions;

class StringExtensions
{
  public static function isNullOrWhiteSpace(?string $str) : bool
  {
    return is_null($str) || trim($str) === '';
  }

  public static function obterMes($mes) : string
  {
    switch ($mes)
    {
      case 1:  return 'Janeiro';
      case 2:  return 'Fevereiro';
      case 3:  return 'Março';
      case 4:  return 'Abril';
      case 5:  return 'Maio';
      case 6:  return 'Junho';
      case 7:  return 'Julho';
      case 8:  return 'Agosto';
      case 9:  return 'Setembro';
      case 10: return 'Outubro';
      case 11: return 'Novembro';
      case 12: return 'Dezembro';
      default: return $mes;
    }
  }

  public static function obterNumeroMes(string $mes) : string
{
    switch (mb_strtolower($mes)) {
        case 'janeiro':   return '1';
        case 'fevereiro': return '2';
        case 'março':     return '3';
        case 'marco':     return '3';
        case 'abril':     return '4';
        case 'maio':      return '5';
        case 'junho':     return '6';
        case 'julho':     return '7';
        case 'agosto':    return '8';
        case 'setembro':  return '9';
        case 'outubro':   return '10';
        case 'novembro':  return '11';
        case 'dezembro':  return '12';
        default:          return $mes;
    }
}
}
