<?php namespace APP\Repositories\Categoria;

  use APP\Repositories\Connections\MySql\IMySqlConnection;
  use PDO;

  class CategoriaRepository implements ICategoriaRepository
  {
    private readonly IMySqlConnection $_mySqlConnection;

    public function __construct(IMySqlConnection $mySqlConnection) 
    {
      $this->_mySqlConnection = $mySqlConnection;
    }

    public function listar() : array
    {
      $sql = "SELECT ID, Descricao FROM Categoria";
      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
?>