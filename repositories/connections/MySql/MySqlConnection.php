<?php
  namespace APP\Repositories\Connections\MySql;

  class MySqlConnection implements IMySqlConnection
  {
    private string $host = "localhost";
    private int $port = 3306;
    private string $db   = "Loja";
    private string $user = "root";
    private string $pass = "";

    private $pdo;

    public function conectar() 
    {
      try
      {
        $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db}";
        $this->pdo = new \PDO($dsn, $this->user, $this->pass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this->pdo;
      } catch (\PDOException $ex) 
      {
        die("Erro na conexão: " . $ex->getMessage());
      }
    }
  }
?>