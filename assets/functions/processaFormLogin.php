<?php
  $container = require __DIR__.'/../../index.php';
  
  use APP\Controllers\AutenticacoesController;

  if ($_SERVER["REQUEST_METHOD"] != "POST")
    return;

  $autenticacoesController = $container->get(AutenticacoesController::class);

  $login = $_POST['txtlogin']; 
  $senha = $_POST['txtsenha'];

  $responseLogin = $autenticacoesController->validarAcesso($login, $senha);

  if (!$responseLogin->sucesso)
  {
    header("Location: ../../html/login/login.php?erro=1");
    exit;
  }

  echo "<script>
          localStorage.setItem('auth', '".json_encode($responseLogin)."');
          window.location.href = '../../html/inicio.php';
        </script>";
  exit;       
?>