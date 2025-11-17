<?php namespace APP\Entities\Base;

abstract class EntitieBase
{
  public int $ID;

  abstract protected function validar() : void;
}