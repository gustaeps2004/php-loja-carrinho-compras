<?php namespace APP\Controllers;

  use APP\Services\Produto\IProdutoService;
  use APP\Assets\Extensions\StringFormats;

  class ProdutosController 
  {
    private readonly IProdutoService $_produtoService;
    private readonly StringFormats $_stringFormats;

    public function __construct(IProdutoService $produtoService, StringFormats $stringFormats){
      $this->_produtoService = $produtoService;
      $this->_stringFormats = $stringFormats;
    }

    public function remover($id) {
      $this->_produtoService->remover($id);
    }

    public function listar() {
      $produtos = $this->_produtoService->listar();

      if (empty($produtos))
        return;

      foreach ($produtos as $produto) {
        echo "<tr>";

        echo "<td>".$produto["Nome"]."</td>";
        echo "<td>".$this->_stringFormats->FormatarDocumento($produto["DocumentoFederal"])."</td>";
        echo "<td>".$this->_stringFormats->FormatarTelefone($produto["Telefone"])."</td>";
        echo "<td>".$produto["Email"]."</td>";
        echo "<td>".$produto["Mensagem"]."</td>";
        echo "<td>".$produto["Comentario"]."</td>";
        echo "<td>
                <form method='post' action='../assets/functions/removeRecursoListaFaleConosco.php'>
                  <input type='hidden' name='ID' value='".$produto["ID"]."'>
                  <button type='submit'>Excluir</button>
                </form>
              </td>";
              
        echo "</tr>";
      }
    }
  }
?>