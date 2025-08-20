<?php namespace APP\Services\Usuario;

  use APP\Responses\Autenticacao\AutenticacaoResponse; 

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
  }
?>