<?php namespace APP\Requests\Produto;

  use Exception;

  class ProdutoRequest
  {
    public string $descricao = "";
    public string $titulo = "";
    public string $tempArquivo = "";
    public string $nomeArquivo = "";
    public int $categoriaID = 0;

    public function __construct(
      string $descricao,
      string $titulo,
      string $tempArquivo,
      string $nomeArquivo,
      int $categoriaID)
    {
      $this->descricao = $descricao;
      $this->titulo = $titulo;
      $this->tempArquivo = $tempArquivo;
      $this->nomeArquivo = $nomeArquivo;
      $this->categoriaID = $categoriaID;
    }

    public function validar()
    {
      if ($this->categoriaID == 0)
        throw new Exception("A categoria do produto deve ser informada.");
      
      if ($this->titulo === null || $this->titulo === '')
        throw new Exception("O título do produto deve ser informado.");

      if ($this->descricao === null || $this->descricao === '')
        throw new Exception("A descrição do produto deve ser informada.");

      if ($this->tempArquivo === null || $this->tempArquivo === '' || $this->nomeArquivo === null || $this->nomeArquivo === '')
        throw new Exception("Não foi possível identificar as informações da imagem.");
    }
  }
?>