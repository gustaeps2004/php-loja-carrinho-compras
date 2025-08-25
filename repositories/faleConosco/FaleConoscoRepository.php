<?php namespace APP\Repositories\FaleConosco;
  
  use APP\Repositories\Connections\MySql\IMySqlConnection;
  use PDO;

  class FaleConoscoRepository implements IFaleConoscoRepository
  {
    private readonly IMySqlConnection $_mySqlConnection;

    public function __construct(IMySqlConnection $mySqlConnection) 
    {
      $this->_mySqlConnection = $mySqlConnection;
    }

    public function inserir(
      $nome,
      $email,
      $telefone,
      $documentoFederal,
      $motivoContatoID,
      $comentario)
    {
      $sql = "INSERT INTO FaleConosco
              (
                Nome, 
                DocumentoFederal, 
                Telefone, 
                Email, 
                MotivoContatoID, 
                Comentario
              )
              VALUES 
              (
                :nome, 
                :documentoFederal, 
                :telefone, 
                :email, 
                :motivoContatoID, 
                :comentario
              )";

      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);

      $stmt->execute([
        ':nome' => $nome,
        ':documentoFederal' => $documentoFederal,
        ':telefone' => $telefone,
        ':email' => $email,
        ':motivoContatoID' => $motivoContatoID,
        ':comentario' => $comentario
      ]);
    }

    public function listar() : array
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
  }
?>