<?php
  namespace APP\Controllers;
  use APP\Services\MotivoContato\IMotivoContatoService;

  class MotivoContatoController
  {
    private readonly IMotivoContatoService $_motivoContatoService;

    public function __construct(IMotivoContatoService $motivoContatoService)
    {
      $this->_motivoContatoService = $motivoContatoService;
    }

    public function listar()
    {
      $motivos = $this->_motivoContatoService->listar();

      if (empty($motivos))
        return;


      foreach ($motivos as $motivo) {
        echo "<option value='{$motivo['ID']}'>{$motivo['Mensagem']}</option>";
      }
    }
  }
?>