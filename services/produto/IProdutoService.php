<?php namespace APP\Services\Produto;

  use APP\Messaging\Requests\Produto\ProdutoRequest;

  interface IProdutoService
  {
    /**
    * @return Produto[]
    */
    public function listar() : array;
    public function remover($id);
    public function inserir(ProdutoRequest $request);
  }
?>