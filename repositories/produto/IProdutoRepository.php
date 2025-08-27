<?php namespace APP\Repositories\Produto;

  use APP\Entities\Produto;
  
  interface IProdutoRepository
  {
    /**
    * @return Produto[]
    */
    public function listar() : array;
    public function remover($id);
    public function inserir(Produto $produto) : void;
  } 
?>