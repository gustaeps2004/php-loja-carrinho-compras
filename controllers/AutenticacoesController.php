<?php namespace APP\Controllers;

  use APP\Controllers\Base\BaseController;
  use APP\Services\Usuario\IUsuarioService;
  use APP\Messaging\Responses\Autenticacao\AutenticacaoResponse;

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
  }
?>