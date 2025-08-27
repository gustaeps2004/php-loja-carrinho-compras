<?php namespace APP\Controllers;

  use APP\Controllers\Base\BaseController;
  use APP\Services\Permissao\IPermissaoService;

  class PermissoesController extends BaseController
  {
    private readonly IPermissaoService $_permissaoService;

    public function __construct(IPermissaoService $permissaoService)
    {
      $this->_permissaoService = $permissaoService;
    }

    public function listar()
    {
      $permissoes = $this->_permissaoService->listar();

      if (empty($permissoes))
        return;

      foreach ($permissoes as $permissao) {
        echo "<option value='{$permissao['ID']}'>{$permissao['Descricao']}</option>";
      }
    }
  }
?>