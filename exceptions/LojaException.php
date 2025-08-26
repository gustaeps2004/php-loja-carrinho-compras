<?php namespace APP\Exceptions;

  use Exception;

  class LojaException extends Exception
  {
    public function __construct(string $mensgaem)
    {
      parent::__construct($mensgaem);
    }
  }
?>