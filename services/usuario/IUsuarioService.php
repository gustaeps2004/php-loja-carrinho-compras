<?php namespace APP\Services\Usuario;

  use APP\Messaging\Responses\Autenticacao\AutenticacaoResponse;
use APP\Messaging\Responses\Autenticacao\EnvioEmailRecuperacaoSenha;

  interface IUsuarioService
  {
    public function listar();
    public function validarAcesso($login, $senha) : AutenticacaoResponse;
    
    public function inserir(
      $nome,
      $email,
      $documentoFederal,
      $permissaoID,
      $senha);

    public function enviarEmailRecuperacaoSenha(string $email) : EnvioEmailRecuperacaoSenha;
    
    public function alterarSenha(
      string $token,
      string $senha,
      string $confirmacaoSenha,
      int $id
    ) : void;
  }
?>