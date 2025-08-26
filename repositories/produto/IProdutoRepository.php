<?php namespace APP\Repositories\Produto;

  use APP\Entities\Produto;
  
  interface IProdutoRepository
  {
    public function listar();
    public function remover($id);
    public function inserir(Produto $produto) : void;
  } 
?>