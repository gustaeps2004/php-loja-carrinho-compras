<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/style/login.css">
  <title>Login</title>
</head>
<body>
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
        <div class="field">
            <input id="login" type="text" placeholder=" " required name="txtlogin">
            <label for="login">Usuário</label>
        </div>
        <div class="field">
            <input id="senha" type="password" placeholder=" " required name="txtsenha">
            <label for="senha">Senha</label>
        </div>
        <div class="modal-login-campos">
          <button type="submit">Entrar</button>
          <a onclick="enviarEmail()" id="esqueceu-senha">Esqueceu sua senha?</a>
        </div>
      </fieldset>
    </form>
  </div>
  <script type="module" src="../../assets/js/index.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="../../assets/js/login.js"></script>
</body>
</html>