<?php namespace APP\Controllers;

  use APP\Services\FaleConosco\IFaleConoscoService;

  class FaleConoscoController {
    
    private readonly IFaleConoscoService $_faleConoscoService;

    public function __construct(IFaleConoscoService $faleConoscoService) {
      $this->_faleConoscoService = $faleConoscoService;
    }

    public function inserir(
      $nome,
      $email,
      $telefone,
      $documentoFederal,
      $idMotivo,
      $comentario) 
    {
      $this->_faleConoscoService->inserir(
        $nome,
        $email,
        $telefone,
        $documentoFederal,
        $idMotivo,
        $comentario);
    }
  }
?>