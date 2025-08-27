<?php namespace APP\Controllers;

  use APP\Controllers\Base\BaseController;
  use APP\Services\Categoria\ICategoriaService;

  class CategoriasController extends BaseController
  {
    public readonly ICategoriaService $_categoriaService;

    public function __construct(ICategoriaService $categoriaService)
    {
      $this->_categoriaService = $categoriaService;
    }

    public function listar()
    {
      $categorias = $this->_categoriaService->listar();

      if (empty($categorias))
        return;

      foreach ($categorias as $categoria)
        echo "<option value='{$categoria['ID']}'>{$categoria['Descricao']}</option>";
      
    }
  }
?>