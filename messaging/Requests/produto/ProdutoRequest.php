<?php namespace APP\Messaging\Requests\Produto;

  use APP\Assets\Extensions\StringExtensions;
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
      
      if (StringExtensions::isNullOrWhiteSpace($this->titulo))  
        throw new Exception("O título do produto deve ser informado.");

      if (StringExtensions::isNullOrWhiteSpace($this->descricao)) 
        throw new Exception("A descrição do produto deve ser informada.");

      if (StringExtensions::isNullOrWhiteSpace($this->tempArquivo) || StringExtensions::isNullOrWhiteSpace($this->nomeArquivo)) 
        throw new Exception("Não foi possível identificar as informações da imagem.");
    }
  }
?>