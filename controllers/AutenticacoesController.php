<?php namespace APP\Controllers;

use APP\Controllers\Base\BaseController;
use APP\Services\Usuario\IUsuarioService;
use APP\Messaging\Responses\Autenticacao\AutenticacaoResponse;
use APP\Messaging\Responses\Autenticacao\EnvioEmailRecuperacaoSenha;

class AutenticacoesController extends BaseController
{
  private readonly IUsuarioService $_usuarioService;

  public function __construct(IUsuarioService $usuarioService)
  {
    $this->_usuarioService = $usuarioService;
  }

  public function validarAcesso($login, $senha) : AutenticacaoResponse
  {
    return $this->_usuarioService->validarAcesso($login, $senha);
  }

  public function enviarEmailRecuperacaoSenha(string $email) : EnvioEmailRecuperacaoSenha
  {
    return $this->_usuarioService->enviarEmailRecuperacaoSenha($email);
  }

  public function alterarSenhas(
    string $token,
    string $senha,
    string $confirmacaoSenha,
    int $id
  ) : void
  {
    $this->_usuarioService->alterarSenha(
      $token, 
      $senha, 
      $confirmacaoSenha, 
      $id
    );
  }
}