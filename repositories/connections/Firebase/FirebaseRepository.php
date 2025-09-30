<?php namespace APP\Repositories\Connections;
require __DIR__ . '../../../../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Contract\Database;

class FirebaseRepository implements IFirebaseRepository
{
  private string $serviceAccountPath = __DIR__ . '../../../loja-carrinho-compras-firebase-adminsdk.json';
  private string $databaseUri = 'https://loja-carrinho-compras-default-rtdb.firebaseio.com/';
  private ?Database $database = null;

  public function __construct()
  {
    $this->conectar();
  }

  public function inserir(string $key, $obj) : void
  {
    $this->database
      ->getReference($key)
      ->set(json_encode($obj));
  }

  public function obter(string $key) : string
  {
    return $this->database
              ->getReference($key)
              ->getSnapshot()
              ->getValue();
  }

  private function conectar(): void
  {
    $factory = (new Factory)
      ->withServiceAccount($this->serviceAccountPath)
      ->withDatabaseUri($this->databaseUri);

    $this->database = $factory->createDatabase(); 
  }
}
?>