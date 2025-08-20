<?php namespace APP\Services\FaleConosco;
  
  interface IFaleConoscoService
  {
    public function inserir(
      $nome,
      $email,
      $telefone,
      $documentoFederal,
      $motivoContatoID,
      $comentario);
  }
?>