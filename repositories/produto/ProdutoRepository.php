<?php namespace APP\Repositories\Produto;
  
  use APP\Repositories\Connections\MySql\IMySqlConnection;
  use PDO;

  class ProdutoRepository implements IProdutoRepository
  {
    private readonly IMySqlConnection $_mySqlConnection;

    public function __construct(IMySqlConnection $mySqlConnection) 
    {
      $this->_mySqlConnection = $mySqlConnection;
    }

    public function listar()
    {
      $sql = "SELECT
            fc.ID,
            fc.Nome,
            fc.DocumentoFederal,
            fc.Telefone,
            fc.Email,
            mc.Mensagem,
            fc.Comentario
          FROM
            FaleConosco fc
          LEFT JOIN MotivoContato mc
            ON fc.MotivoContatoID = mc.ID";

      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function remover($id)
    {
      $sql = "DELETE FROM FaleConosco WHERE ID = :id";

      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
      $stmt->execute([':id' => $id]);
    }
  }
?>