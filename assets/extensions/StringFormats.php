<?php namespace APP\Assets\Extensions;

  class StringFormats {
    public function FormatarDocumento($documento) {
      return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $documento);
    }

    public function FormatarTelefone($telefone) {
      $telefone = preg_replace('/\D/', '', $telefone);
      return preg_replace('/(\d{2})(\d{1})(\d{4})(\d{4})/', '($1) $2 $3-$4', $telefone);
    }

    public function RemoverCaracteresEspeciais($texto) {
      if ($texto == '')
        return '';
  
        return preg_replace('/[^a-zA-Z0-9]/', '', $texto);
    }
  }
?>