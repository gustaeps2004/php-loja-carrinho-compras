<?php namespace APP\Repositories\Connections;

interface IFirebaseRepository
{
  function inserir(string $key, $obj) : void;
  function obter(string $key) : string;
}
?>