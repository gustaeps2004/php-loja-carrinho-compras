<?php namespace APP\Repositories\PedidoEntrega;

use APP\Entities\PedidoEntrega;
use APP\Messaging\RawQueryResult\PedidoEntrega\PedidoEntregaRawQueryResult;
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

  public function obterPorPedidoID(int $pedidoID) : PedidoEntregaRawQueryResult
  {
    $sql = "SELECT
              PedidoID,
              Situacao
            FROM
              PedidoEntrega
            WHERE PedidoID = :pedidoID
            ORDER BY ID DESC
            LIMIT 1";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([':pedidoID' => $pedidoID]);

    return $stmt->fetchObject(PedidoEntregaRawQueryResult::class);
  }
}