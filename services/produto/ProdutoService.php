<?php namespace APP\Services\Produto;

  use APP\Entities\Produto;
  use APP\Repositories\Produto\IProdutoRepository;
  use APP\Messaging\Requests\Produto\ProdutoRequest;
  use APP\Exceptions\LojaException;

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

      $caminhoImagem = $this->inserirImagem($request->tempArquivo, $request->nomeArquivo);

      $produto = new Produto($request, $caminhoImagem);
      $this->_produtoRepository->inserir($produto);
    }

    private function inserirImagem(string $tempArquivo, string $nomeArquivo)
    {
      $diretorioDestino = "../../imgsCadastro/";

      if (!is_dir($diretorioDestino))
        mkdir($diretorioDestino, 0777, true);

      if (!move_uploaded_file($tempArquivo, $diretorioDestino . $nomeArquivo)) 
        throw new LojaException("Não foi possível inserir a imagem da produto.");

      return str_replace("../", "", $diretorioDestino).$nomeArquivo;
    }
  }
?>