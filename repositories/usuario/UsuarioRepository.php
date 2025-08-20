<?php namespace APP\Repositories\Usuario;

  use APP\Repositories\Connections\MySql\IMySqlConnection;
  use PDO;

  class UsuarioRepository implements IUsuarioRepository
  {
    private readonly IMySqlConnection $_mySqlConnection;

    public function __construct(IMySqlConnection $mySqlConnection) 
    {
      $this->_mySqlConnection = $mySqlConnection;
    }

    public function listar()
    {
      $sql = "SELECT
                u.ID,
                u.Nome,
                u.DocumentoFederal,
                u.Email,
                p.Descricao
              FROM
                Usuario u
              INNER JOIN Permissao p
                ON u.PermissaoID = p.ID";

      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir(
      $nome,
      $email,
      $documentoFederal,
      $permissaoID,
      $senha
    )
    {
      $sql = "INSERT INTO Usuario
              (
                Nome,
                DocumentoFederal,
                Email,
                PermissaoID,
                Senha
              )
              VALUES
              (
                :nome, 
                :documentoFederal, 
                :email, 
                :permissaoID,
                :senha
              )";

      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);

      $stmt->execute([
        ':nome' => $nome,
        ':documentoFederal' => $documentoFederal,
        ':email' => $email,
        ':permissaoID' => $permissaoID,
        ':senha' => $senha
      ]);
    }

    public function obterUsuarioPorLogin($login)
    {
      $sql = "SELECT
                u.ID,
                u.Nome,
                u.DocumentoFederal,
                u.Email,
                p.Descricao,
                u.Senha
              FROM
                Usuario u
              INNER JOIN Permissao p
                ON u.PermissaoID = p.ID
              WHERE
                u.DocumentoFederal = :loginPar
              OR u.Email = :loginPar
              LIMIT 1";

      $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
      $stmt->execute([':loginPar' => $login]);

      return $stmt->fetch(PDO::FETCH_ASSOC);
    }
  }
?>