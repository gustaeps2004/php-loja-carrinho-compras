<?php namespace APP\Services\Produto;

  interface IProdutoService
  {
    public function listar();
    public function remover($id);
  }
?>