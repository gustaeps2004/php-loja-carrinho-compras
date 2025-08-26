<?php namespace APP\Services\Produto;

  use APP\Repositories\Produto\IProdutoRepository;
  use APP\Requests\Produto\ProdutoRequest;
use Exception;

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

    public function inserir(ProdutoRequest $request)
    {
      $request->validar();

      $this->inserirImagem($request->tempArquivo, $request->nomeArquivo);

      
    }

    private function inserirImagem(string $tempArquivo, string $nomeArquivo)
    {
      $diretorioDestino = "../../imgsCadastro/";

      if (!is_dir($diretorioDestino))
        mkdir($diretorioDestino, 0777, true);

      if (!move_uploaded_file($tempArquivo, $diretorioDestino . $nomeArquivo)) 
        throw new Exception("Não foi possível inserir a imagem da produto.");
    }
  }
?>