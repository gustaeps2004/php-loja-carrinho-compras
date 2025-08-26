<?php namespace APP\Controllers;

  use APP\Services\Produto\IProdutoService;
  use APP\Requests\Produto\ProdutoRequest;
  use APP\Responses\Base\ResponseBase;
  use Exception;

  class ProdutosController 
  {
    private readonly IProdutoService $_produtoService;

    public function __construct(IProdutoService $produtoService){
      $this->_produtoService = $produtoService;
    }

    public function remover($id) {
      $this->_produtoService->remover($id);
    }

    public function inserir(ProdutoRequest $request) : ResponseBase
    {
      try
      {
        $this->_produtoService->inserir($request);

        return new ResponseBase(true, "Requisição realizada com sucesso.");
      }
      catch (Exception $ex)
      {
        return new ResponseBase(false, $ex->getMessage());
      }
    }
  }
?>