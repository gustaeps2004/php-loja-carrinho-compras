<?php namespace APP\Messaging\Responses\Base;

  class ResponseBase
  {
    public string $mensagem = "";
    public bool $sucesso = false;

    public function __construct(bool $sucesso, string $mensagem)
    {
      $this->mensagem = $mensagem;
      $this->sucesso = $sucesso;
    }
  }
?>