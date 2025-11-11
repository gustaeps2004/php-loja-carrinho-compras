<?php namespace APP\Messaging\Responses\Autenticacao;

class EnvioEmailRecuperacaoSenha
{
  public string $Mensagem = "";
  public int $CodigoRetorno = 0;

  public function __construct(string $mensagem, int $codigoRetorno)
  {
    $this->Mensagem = $mensagem;
    $this->CodigoRetorno = $codigoRetorno;
  }
}