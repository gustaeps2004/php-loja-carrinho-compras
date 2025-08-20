<?php namespace APP\Repositories\Permissao;
  
  use APP\Repositories\Connections\MySql\IMySqlConnection;
  use PDO;
  
  class PermissaoRepository implements IPermissaoRepository
  {
    private readonly IMySqlConnection $_mySqlConnection;

    public function __construct(IMySqlConnection $mySqlConnection) 
    {
      $this->_mySqlConnection = $mySqlConnection;
    }

    public function listar()
    {
      $sql = "SELECT
                ID,
                  Descricao
              FROM
                Permissao";

      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
?>