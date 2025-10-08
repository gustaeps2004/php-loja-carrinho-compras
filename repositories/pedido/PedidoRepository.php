<?php namespace APP\repositories\Pedido;

use APP\Assets\Enums\SituacaoEntrega;
use APP\Assets\Enums\SituacaoPedido;
use APP\Entities\Pedido;
use APP\Entities\PedidoProduto;
use APP\Messaging\RawQueryResult\Pedido\PedidoAtivoUsuarioRawQueryResult;
use APP\Messaging\RawQueryResult\Pedido\EntregaHistoricoRawQueryResult;
use APP\Repositories\Connections\MySql\IMySqlConnection;
use PDO;

class PedidoRepository implements IPedidoRepository
{
  private readonly IMySqlConnection $_mySqlConnection;

  public function __construct(IMySqlConnection $mySqlConnection) 
  {
    $this->_mySqlConnection = $mySqlConnection;
  }

  public function obterAtivoPorUsuario($usuarioID) : ?PedidoAtivoUsuarioRawQueryResult
  {
    $sql = "SELECT
              ID,
              Situacao,
              DtInclusao,
              UsuarioID
            FROM
              Pedido
            WHERE
              UsuarioID = :usuarioID
            AND Situacao = :situacao";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':usuarioID' => $usuarioID,
      ':situacao' => SituacaoPedido::Ativo->value
    ]);

    return $stmt->fetchObject(PedidoAtivoUsuarioRawQueryResult::class) ?: null;
  }

  public function inserir(Pedido $pedido) : void
  {
    $sql = "INSERT INTO Pedido(
              Situacao,
              DtInclusao,
              UsuarioID
            )
            VALUES(
              :situacao,
              :dtInclusao,
              :usuarioID
            )";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':situacao' => $pedido->Situacao,
      ':dtInclusao' => $pedido->DtInclusao->modify('-5 hours')->format('Y-m-d H:i:s'),
      ':usuarioID' => $pedido->UsuarioID
    ]);
  }

  public function inserirPedidoProduto(PedidoProduto $pedidoProduto) : void
  {
    $sql = "INSERT INTO PedidoProduto(
              PedidoID,
              ProdutoID,
              Quantidade,
              Valor,
              DtInclusao)
            VALUES(
              :pedidoID,
              :produtoID,
              :quantidade,
              :valor,
              :dtInclusao)";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':pedidoID' => $pedidoProduto->PedidoID,
      ':produtoID' => $pedidoProduto->ProdutoID,
      ':quantidade' => $pedidoProduto->Quantidade,
      ':valor' => $pedidoProduto->Valor,
      ':dtInclusao' => $pedidoProduto->DtInclusao->modify('-5 hours')->format('Y-m-d H:i:s'),
    ]);
  }

  public function finalizar(int $id, float $valorTotal, int $formaPagamento) : void
  {
    $sql = "UPDATE Pedido
            SET ValorTotal = :valorTotal,
              FormaPagamento = :formaPagamento,
              Situacao = :situacao
            WHERE
              ID = :id";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
      ':valorTotal' => $valorTotal,
      ':formaPagamento' => $formaPagamento,
      ':situacao' => SituacaoPedido::Finalizado->value,
      ':id' => $id
    ]);
  }

  public function cancelar(int $id) : void
  {
    $sql = "UPDATE Pedido
            SET Situacao = :situacao
            WHERE
              ID = :id";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);
    $stmt->execute([
    ':situacao' => SituacaoPedido::Cancelado->value,
    ':id' => $id
    ]);
  }

  public function listarEntregas(int $usuarioID) : array
  {
    $sql = "SELECT
              p.ID,
              IFNULL((
                SELECT pe.Situacao 
                FROM PedidoEntrega pe 
                WHERE pe.PedidoID = p.ID 
                ORDER BY pe.ID DESC 
                LIMIT 1
              ), :situacaoPedidoEntregue) AS SituacaoEntrega,
              (
                SELECT pe.DtInclusao 
                FROM PedidoEntrega pe 
                WHERE pe.PedidoID = p.ID 
                ORDER BY pe.ID DESC 
                LIMIT 1
              ) AS DtAtualizacaoEntrega
            FROM
              Pedido p
            WHERE
              p.UsuarioID = :usuarioID
            AND p.Situacao != :situacao
            AND IFNULL((
                SELECT pe.Situacao 
                FROM PedidoEntrega pe 
                WHERE pe.PedidoID = p.ID 
                ORDER BY pe.ID DESC 
                LIMIT 1
              ), :situacaoPedidoEntregue) <> :situacaoPedidoEntregue
            ORDER BY p.ID DESC";

    $stmt = $this->_mySqlConnection->conectar()->prepare($sql);

    $stmt->execute([
    ':usuarioID' => $usuarioID,
    ':situacao' => SituacaoPedido::Ativo->value,
    ':situacaoPedidoEntregue' => SituacaoEntrega::Entregue->value
    ]);

    return $stmt->fetchAll(PDO::FETCH_CLASS, EntregaHistoricoRawQueryResult::class) ?: [];
  }

  public function listarHistorico(int $usuarioID) : array 
  {
    $sql = "SELECT
              p.ID,
              p.Situacao,
              p.DtInclusao,
              IFNULL((
                SELECT
                  pes.Situacao
                FROM
                  PedidoEntrega pes
                WHERE
                  pes.PedidoID = p.ID
                ORDER BY pes.ID DESC
                LIMIT 1
              ), null) SituacaoEntrega,
              IFNULL((
                SELECT
                  ped.DtInclusao
                FROM
                  PedidoEntrega ped
                WHERE
                  ped.PedidoID = p.ID
                ORDER BY ped.ID DESC
                LIMIT 1
              ), null) DtInclusaoEntrega
            FROM
              Pedido p
            WHERE
              p.UsuarioID = :usuarioID
            AND p.Situacao != :situacao";

  $stmt = $this->_mySqlConnection->conectar()->prepare($sql);

  $stmt->execute([
    ':usuarioID' => $usuarioID,
    ':situacao' => SituacaoPedido::Ativo->value
  ]);

  return $stmt->fetchAll(PDO::FETCH_CLASS, EntregaHistoricoRawQueryResult::class) ?: [];
  }
}