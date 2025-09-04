<?php namespace APP\Repositories\CarrinhoCompra;

use APP\Entities\CarrinhoCompra;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraExistenteRawQueryResult;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraQtdItemRawQueryResult;
use APP\Messaging\RawQueryResult\CarrinhoCompra\CarrinhoCompraRawQueryResult;
use APP\Repositories\Connections\MySql\IMySqlConnection;
use DateTime;
use PDO;

class CarrinhoCompraRepository implements ICarrinhoCompraRepository
{
  private readonly IMySqlConnection $_mySqlConnection;

  public function __construct(IMySqlConnection $mySqlConnection) 
  {
    $this->_mySqlConnection = $mySqlConnection;
  }

  public function inserir(CarrinhoCompra $carrinhoCompra) : void
  {
    $sql = "INSERT INTO CarrinhoCompra(
              DtInclusao,
              QuantidadeItem,
              PedidoID,
              ProdutoID,
              DtSituacao
            )
            VALUES(
              :dtInclusao,
              :quantidadeItem,
              :pedidoID,
              :produtoID,
              :dtSituacao
            )";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':dtInclusao' => $carrinhoCompra->DtInclusao->modify('-5 hours')->format('Y-m-d H:i:s'),
      ':quantidadeItem' => $carrinhoCompra->QuantidadeItem,
      ':pedidoID' => $carrinhoCompra->PedidoID,
      ':produtoID' => $carrinhoCompra->ProdutoID,
      ':dtSituacao' => $carrinhoCompra->DtSituacao->modify('-5 hours')->format('Y-m-d H:i:s')
    ]);
  }

  public function obter(int $pedidoID, int $produtoID) : ?CarrinhoCompraExistenteRawQueryResult
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

    return $stmt->fetchObject(CarrinhoCompraExistenteRawQueryResult::class) ?: null;
  }

  public function atualizarQuantidadeItem(int $id, int $quantidadeNova) : void
  {
    $dtSituacao = new DateTime();

    $sql = "UPDATE CarrinhoCompra 
            SET QuantidadeItem = :quantidadeNova,
                DtSituacao = :dtSituacao
            WHERE ID = :id
            LIMIT 1";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':quantidadeNova' => $quantidadeNova,
      ':dtSituacao' => $dtSituacao->modify('-5 hours')->format('Y-m-d H:i:s')
    ]);
  }

  public function listar(int $usuarioID) : array
  {
    $sql = "SELECT
              cc.ID,
              cc.DtInclusao,
              cc.DtSituacao,
              cc.QuantidadeItem,
              p.Titulo,
              p.Descricao DescricaoProduto,
              p.CaminhoImagem,
              c.Descricao Categoria,
              p.Valor
            FROM
              CarrinhoCompra cc
            INNER JOIN Produto p
              ON cc.ProdutoID = p.ID
            INNER JOIN Categoria c
              ON p.CategoriaID = c.ID
            INNER JOIN Pedido pd
              ON cc.PedidoID = pd.ID
            WHERE
              pd.UsuarioID = :usuarioID";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':usuarioID' => $usuarioID
    ]);

    return $stmt->fetchAll(PDO::FETCH_CLASS, CarrinhoCompraRawQueryResult::class) ?: [];
  }

  public function remover(int $id) : void
  {
    $sql = "DELETE FROM CarrinhoCompra
            WHERE ID = :id";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([':id' => $id]);
  }

  public function obterQtdItemPorId(int $id) : ?CarrinhoCompraQtdItemRawQueryResult
  {
    $sql = "SELECT
              QuantidadeItem
            FROM
              CarrinhoCompra
            WHERE
              ID = :id";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([':id' => $id]);

    return $stmt->fetchObject(CarrinhoCompraQtdItemRawQueryResult::class) ?: null;
  }
}
?>