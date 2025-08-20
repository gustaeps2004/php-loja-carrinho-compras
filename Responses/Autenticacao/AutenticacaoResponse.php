<?php namespace APP\Responses\Autenticacao;

  class AutenticacaoResponse
  {
    public string $token = '';
    public bool $sucesso = false;
    public string $mensagem = '';

    public function atualizarErro($mensagem) : void
    {
      $this->mensagem = $mensagem;
      $this->sucesso = false;
    }

    public function atualizarSucesso($token) : void
    {
      $this->token = $token;
      $this->sucesso = true;
      $this->mensagem = "Sucesso ao efetuar login.";
    }
  }
?>