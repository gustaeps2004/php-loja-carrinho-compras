<?php namespace APP\Services\Categoria;

  use APP\Repositories\Categoria\ICategoriaRepository;
  
  class CategoriaService implements ICategoriaService
  {
    public readonly ICategoriaRepository $_categoriaRepository;

    public function __construct(ICategoriaRepository $categoriaRepository)
    {
      $this->_categoriaRepository = $categoriaRepository;
    }

    public function listar() : array
    {
      return  $this->_categoriaRepository->listar();
    }
  }
?>