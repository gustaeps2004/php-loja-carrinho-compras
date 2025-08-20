<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/style/login.css">
	<script type="text/javascript" src="../../assets/js/index.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Login</title>
</head>
<body onload="RemoverToken()">
  <div class="modalPrincipal">
    <h2>Faça o seu login!!</h2>

    <?php if (isset($_GET['erro']) && $_GET['erro'] == 1): ?>
      <div style="color: red; font-weight: bold;">
        Usuário ou senha inválidos!
      </div>
      <br>
    <?php endif; ?>

    <form action="../../assets/functions/processaFormLogin.php"  id="formLogin" name="frmLogin" method="POST">

      <fieldset class="loginAutenticacao">
        <label for = "login">Usuário:</label>
        <input require type="text" name="txtlogin" id="login">
        <br>

        <label for = "senha">Senha:</label>
        <input require type="password" name="txtsenha" id="senha">
        <br>
        <br>
        <br>
        <button type="submit">Entrar</button>
      </fieldset>
    </form>

  </div>
</body>
</html>