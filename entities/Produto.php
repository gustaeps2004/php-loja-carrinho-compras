<?php namespace APP\Entities;

use APP\Entities\Base\EntitieBase;
use APP\Messaging\Requests\Produto\ProdutoRequest;

final class Produto extends EntitieBase
{
  public string $Titulo;
  public string $Descricao;
  public string $CaminhoImagem;
  public int $CategoriaID;
  public float $Valor;

  public function __construct(ProdutoRequest $produtorequest, string $caminhoImagem)
  {
    $this->Titulo = $produtorequest->titulo;
    $this->Descricao = $produtorequest->descricao;
    $this->CaminhoImagem = $caminhoImagem;
    $this->CategoriaID = $produtorequest->categoriaID;
    $this->Valor = $produtorequest->valor;
  }

  public function validar() : void
  {
    
  }
}