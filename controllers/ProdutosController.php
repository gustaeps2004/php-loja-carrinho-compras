<?php namespace APP\Controllers;

  use APP\Services\Produto\IProdutoService;

  class ProdutosController 
  {
    private readonly IProdutoService $_produtoService;

    public function __construct(IProdutoService $produtoService){
      $this->_produtoService = $produtoService;
    }

    public function remover($id) {
      $this->_produtoService->remover($id);
    }
  }
?>