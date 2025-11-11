<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/style/login.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/popUp.css">
	<script type="text/javascript" src="../../assets/js/recuperar.js" defer></script>
  <title>Recuperar senha</title>
</head>
<body>
  <div class="modalPrincipal">
    <h2>Altere a sua senha!</h2>

    <form action="../../assets/functions/processarFormAlterarSenha.php"  id="formLogin" name="frmLogin" method="POST" onsubmit="return compararSenhas()">
      <fieldset class="loginAutenticacao">
        <div class="field">
          <input id="login" type="text" placeholder=" " required name="txtlogin" disabled>
          <label for="login">Usuário</label>
        </div>
        <div class="field">
          <input id="senha" type="password" placeholder=" " required name="txtsenha">
          <label for="senha">Senha</label>
        </div>
        <div class="field">
          <input id="confirmacaoSenha" type="password" placeholder=" " required name="txtconfirmacaoSenha">
          <label for="confirmacaoSenha">Confirmação senha</label>
        </div>
        <div class="modal-login-campos">
          <button type="submit">Confirmar alteração</button>
        </div>
        <div style="display: none">
        <input id="token" name="txttoken">
        <input id="idUsuario" name="txtidUsuario">
        </div>
      </fieldset>
    </form>
  </div>
  <div id="popup" class="popup">
		<div class="popup-content">
			<span id="fecharPopup" class="fechar">&times;</span>
			<p id="mensagem-pop-up"></p>
		</div>
	</div>
</body>
</html>