<?php namespace APP\repositories\Pedido;

use APP\Assets\Enums\SituacaoPedido;
use APP\Entities\Pedido;
use APP\Messaging\RawQueryResult\Pedido\PedidoAtivoUsuarioRawQueryResult;
use APP\Repositories\Connections\MySql\IMySqlConnection;

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
}
?>