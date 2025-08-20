<?php namespace APP\Repositories\Produto;
  
  interface IProdutoRepository
  {
    public function listar();
    public function remover($id);
  } 
?>