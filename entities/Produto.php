<?php namespace APP\Entities;

  use APP\Entities\Base\EntitieBase;
  use APP\Messaging\Requests\Produto\ProdutoRequest;

  class Produto extends EntitieBase
  {
    public string $Titulo;
    public string $Descricao;
    public string $CaminhoImagem;
    public int $CategoriaID;

    public function __construct(ProdutoRequest $produtorequest, string $caminhoImagem)
    {
      $this->Titulo = $produtorequest->titulo;
      $this->Descricao = $produtorequest->descricao;
      $this->CaminhoImagem = $caminhoImagem;
      $this->CategoriaID = $produtorequest->categoriaID;
    }
  }
?>