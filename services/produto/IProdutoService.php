<?php namespace APP\Services\Produto;

  use APP\Messaging\Requests\Produto\ProdutoRequest;

  interface IProdutoService
  {
    public function listar();
    public function remover($id);
    public function inserir(ProdutoRequest $request);
  }
?>