<?php namespace APP\Services\Permissao;

  use APP\Repositories\Permissao\IPermissaoRepository;
  
  class PermissaoService implements IPermissaoService
  {
    private readonly IPermissaoRepository $_permissaoRepository;

    public function __construct(IPermissaoRepository $permissaoRepository)
    {
      $this->_permissaoRepository = $permissaoRepository;
    }

    public function listar()
    {
      return $this->_permissaoRepository->listar();
    }
  }
?>