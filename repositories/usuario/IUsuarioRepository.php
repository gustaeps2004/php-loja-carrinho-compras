<?php namespace APP\Repositories\Usuario;

interface IUsuarioRepository
{
  public function listar();
  public function obterUsuarioPorLogin($login);

  public function inserir(
    $nome,
    $email,
    $documentoFederal,
    $permissaoID,
    $senha
  );

  public function existeEmail(string $email) : bool;
  public function atualizarSenha(int $id, string $senha) : void;
}