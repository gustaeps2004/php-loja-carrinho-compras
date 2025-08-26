<?php namespace APP\Controllers;

  use APP\Services\Produto\IProdutoService;
  use APP\Messaging\Requests\Produto\ProdutoRequest;
  use APP\Messaging\Responses\Base\ResponseBase;
  use APP\Exceptions\LojaException;
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
      catch (LojaException $ex)
      {
        return new ResponseBase(false, $ex->getMessage());
      }
      catch (Exception $ex)
      {
        return new ResponseBase(false, "Ocorreu um erro na requisição.");
      }
    }
  }
?>