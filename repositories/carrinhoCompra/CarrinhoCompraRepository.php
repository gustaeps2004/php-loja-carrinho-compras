<?php namespace APP\Repositories\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
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
}
?>