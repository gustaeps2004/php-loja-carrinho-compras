<?php namespace APP\Services\FaleConosco;
  
  use APP\Repositories\FaleConosco\IFaleConoscoRepository;

  class FaleConoscoService implements IFaleConoscoService
  {
    private readonly IFaleConoscoRepository $_faleConoscoRepository;

    public function __construct(IFaleConoscoRepository $faleConoscoRepository)
    {
      $this->_faleConoscoRepository = $faleConoscoRepository;
    }

    public function inserir(
      $nome,
      $email,
      $telefone,
      $documentoFederal,
      $motivoContatoID,
      $comentario)
    {
      $this->_faleConoscoRepository->inserir($nome,
        $email,
        $telefone,
        $documentoFederal,
        $motivoContatoID,
        $comentario);
    }
  }
?>