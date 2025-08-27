<?php namespace APP\Controllers;

  use APP\Services\FaleConosco\IFaleConoscoService;
  use APP\Assets\Extensions\StringFormats;
  use APP\Controllers\Base\BaseController;

  class FaleConoscoController extends BaseController
  {    
    private readonly IFaleConoscoService $_faleConoscoService;
    private readonly StringFormats $_stringFormats;

    public function __construct(IFaleConoscoService $faleConoscoService, StringFormats $stringFormats) {
      $this->_faleConoscoService = $faleConoscoService;
      $this->_stringFormats = $stringFormats;
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

    public function listar() {
      $faleConoscoLista = $this->_faleConoscoService->listar();

      if (empty($faleConoscoLista))
        return;

      foreach ($faleConoscoLista as $faleConosco) {
        echo "<tr>";

        echo "<td>".$faleConosco["Nome"]."</td>";
        echo "<td>".$this->_stringFormats->FormatarDocumento($faleConosco["DocumentoFederal"])."</td>";
        echo "<td>".$this->_stringFormats->FormatarTelefone($faleConosco["Telefone"])."</td>";
        echo "<td>".$faleConosco["Email"]."</td>";
        echo "<td>".$faleConosco["Mensagem"]."</td>";
        echo "<td>".$faleConosco["Comentario"]."</td>";
        echo "<td>
                <form method='post' action='../../assets/functions/removeRecursoListaFaleConosco.php'>
                  <input type='hidden' name='ID' value='".$faleConosco["ID"]."'>
                  <button type='submit'>Excluir</button>
                </form>
              </td>";
              
        echo "</tr>";
      }
    }
  }
?>