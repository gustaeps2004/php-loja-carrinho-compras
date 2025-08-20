<?php namespace APP\Controllers;

  use APP\Assets\Extensions\StringFormats;
  use APP\Services\Usuario\IUsuarioService;

  class UsuariosController
  {
    private readonly IUsuarioService $_usuarioService;
    private readonly StringFormats $_stringFormats;

    public function __construct(
      IUsuarioService $usuarioService,
      StringFormats $stringFormats)
    {
      $this->_usuarioService = $usuarioService;
      $this->_stringFormats = $stringFormats;
    }

    public function listar()
    {
      $usuarios = $this->_usuarioService->listar();
      
      if (empty($usuarios))
        return;

      foreach ($usuarios as $usuario) {
        echo "<tr>";

        echo "<td>".$usuario["Nome"]."</td>";
        echo "<td>".$this->_stringFormats->FormatarDocumento($usuario["DocumentoFederal"])."</td>";
        echo "<td>".$usuario["Email"]."</td>";
        echo "<td>".$usuario["Descricao"]."</td>";
              
        echo "</tr>";
      }
    }

    public function inserir(
      $nome,
      $email,
      $documentoFederal,
      $permissaoID,
      $senha
    )
    {
      $this->_usuarioService->inserir(
        $nome,
        $email,
        $documentoFederal,
        $permissaoID,
        $senha
      );
    }
  }
?>