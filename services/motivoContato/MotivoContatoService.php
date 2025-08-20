<?php
  namespace APP\Services\MotivoContato;

  use APP\Repositories\MotivoContato\IMotivoContatoRepository;

  class MotivoContatoService implements IMotivoContatoService
  {
    private readonly IMotivoContatoRepository $_motivoContatoRepository;

    public function __construct(IMotivoContatoRepository $motivoContatoRepository)
    {
      $this->_motivoContatoRepository = $motivoContatoRepository;
    }

    public function listar()
    {
      return $this->_motivoContatoRepository->listar();
    }
  }
?>