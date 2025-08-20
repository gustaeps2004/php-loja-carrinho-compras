<?php namespace APP\Repositories\MotivoContato;
  
  use APP\Repositories\Connections\MySql\IMySqlConnection;
  use PDO;

  class MotivoContatoRepository implements IMotivoContatoRepository
  {
    private readonly IMySqlConnection $_mySqlConnection;

    public function __construct(IMySqlConnection $mySqlConnection) 
    {
      $this->_mySqlConnection = $mySqlConnection;
    }

    public function listar() 
    { 
      $sql = "SELECT ID, Mensagem FROM MotivoContato";
      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  }
?>