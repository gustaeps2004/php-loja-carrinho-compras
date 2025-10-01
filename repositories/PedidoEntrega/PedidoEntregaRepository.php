<?php namespace APP\Repositories\PedidoEntrega;

use APP\Entities\PedidoEntrega;
use APP\Repositories\Connections\MySql\IMySqlConnection;

class PedidoEntregaRepository implements IPedidoEntregaRepository
{
  private readonly IMySqlConnection $_mySqlConnection;

  public function __construct(IMySqlConnection $mySqlConnection) 
  {
    $this->_mySqlConnection = $mySqlConnection;
  }

  public function inserir(PedidoEntrega $pedidoEntrega) : void
  {
    $sql = "INSERT INTO pedidoentrega(
              PedidoID,
              Situacao,
              DtInclusao)
            VALUES(
              :pedidoID,
              :situacao,
              :dtInclusao)
            ";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
 
    $stmt->execute([
      ':pedidoID' => $pedidoEntrega->PedidoID,
      ':situacao' => $pedidoEntrega->Situacao,
      ':dtInclusao' => $pedidoEntrega->DtInclusao->format('Y-m-d H:i:s')
    ]);
  }
}