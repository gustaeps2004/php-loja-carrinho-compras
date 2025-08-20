<?php namespace APP\Controllers;

  use APP\Services\Usuario\IUsuarioService;
  use APP\Responses\Autenticacao\AutenticacaoResponse;

  class AutenticacoesController
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
  }
?>