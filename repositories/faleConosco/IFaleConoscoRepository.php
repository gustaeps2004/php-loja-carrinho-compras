<?php namespace APP\Repositories\FaleConosco;
  
  interface IFaleConoscoRepository
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