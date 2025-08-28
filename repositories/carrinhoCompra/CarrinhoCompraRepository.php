<?php namespace APP\Repositories\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraExistenteRawQueryResult;
use APP\Repositories\Connections\MySql\IMySqlConnection;

class CarrinhoCompraRepository implements ICarrinhoCompraRepository
{
  private readonly IMySqlConnection $_mySqlConnection;

  public function __construct(IMySqlConnection $mySqlConnection) 
  {
    $this->_mySqlConnection = $mySqlConnection;
  }

  public function inserir(CarrinhoCompra $carrinhoCompra) : void
  {
    $sql = "INSERT INT CarrinhoCompra(
              DtInclusao,
              QuantidadeItem,
              PedidoID,
              ProdutoID
            )
            VALUES(
              :dtInclusao,
              :quantidadeItem,
              :pedidoID,
              :produtoID
            )";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':dtInclusao' => $carrinhoCompra->DtInclusao,
      ':quantidadeItem' => $carrinhoCompra->QuantidadeItem,
      ':pedidoID' => $carrinhoCompra->PedidoID,
      ':produtoID' => $carrinhoCompra->ProdutoID
    ]);
  }

  public function obter(int $pedidoID, int $produtoID) : CarrinhoCompraExistenteRawQueryResult
  {
    $sql = "SELECT
              ID,
              QuantidadeItem
            FROM
              CarrinhoCompra
            WHERE
              PedidoID = :pedidoID
            AND ProdutoID = :produtoID
            LIMIT 1";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':pedidoID' => $pedidoID,
      ':produtoID' => $produtoID
    ]);

    return $stmt->fetchObject(CarrinhoCompra::class);
  }

  public function atualizarQuantidadeItem($id, $quantidadeNova) : void
  {
    $sql = "UPDATE CarrinhoCompra 
            SET QuantidadeItem = :quantidadeNova
            WHERE ID = :id
            LIMIT 1";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':quantidadeNova' => $quantidadeNova
    ]);
  }
}
?>