<?php namespace APP\Assets\Extensions;

  class StringExtensions
  {
    public static function isNullOrWhiteSpace(?string $str): bool
    {
      return is_null($str) || trim($str) === '';
    }
  }
?>