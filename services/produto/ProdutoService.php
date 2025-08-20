<?php namespace APP\Services\Produto;

  use APP\Repositories\Produto\IProdutoRepository;

  class ProdutoService implements IProdutoService
  {
    private readonly IProdutoRepository $_produtoRepository;

    public function __construct(IProdutoRepository $produtoRepository)
    {
      $this->_produtoRepository = $produtoRepository;
    }

    public function listar()
    {
      return $this->_produtoRepository->listar();
    }

    public function remover($id)
    {
      $this->_produtoRepository->remover($id);
    }
  }
?>