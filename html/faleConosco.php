
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prática 1 HTML e CSS</title>
	<link rel="stylesheet" type="text/css" href="../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../assets/style/sidebar.css">
	<script type="text/javascript" src="../assets/js/index.js" defer></script>
	<script type="text/javascript" src="../assets/js/carrinho.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body onload="ValidarToken(false)">
	<header>
		<img src="../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Fale Conosco</h1>

		<div class="perfil-info">
			<div class="carrinho-compras">
				<button onclick="abrirCarrinho('./carrinho/carrinho.php')" class="btn-carrinho">Carrinho de compras</button>
			</div>

			<div class="info-texto">
				<p>Informações de perfil</p>
				<p><b>Nome:</b> <span id="nomeUsuario"></span></p>
				<p><b>Permissão:</b> <span id="permissaoUsuario"></span></p>
				<br />
				<a href="./login/login.php">Log out</a>
			</div>
		</div>
	</header>

  <div class="hover-area"></div>
	<div class="sidebar">
	<a href="inicio.php">Início</a>
		<a href="produtos.php">Geladeiras & freezers</a>
		<a href="faleConosco.php">Fale conosco</a>
		<a id="TabAdministracao" href="administracao/administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="administracao/faleConoscoAdm.php">Contato</a>
	</div>

	<div class="content">
		<section>
			<h2>Fale conosco!</h2>
			<p>Entre em nosso grupo de WhatsApp!</p>
				<form action="../assets/functions/processaFormFaleConosco.php" id="formFaleConosco" name="frmfaleconosco" method="POST">

					<fieldset class="faleConosco">
						<legend>Dados pessoais:</legend>
						<label for = "nome">Nome:</label>
						<input type="text" name="txtnome" id="nome">
						<br>
						<span id="erroNome"></span>
						<br>

						<label for="fone">Telefone:</label>
						<input required type = "text" name="txtfone" id="fone">

						<label for="documento">Documento federal:</label>
						<input required maxlength="11" type="text" name="txtdocumento" id="documento" onkeyup="FormatarDocumento()">
						<br>
						<span id="erroCpf"></span>
						<br>

						<label for="email">E-mail</label>
						<input type="email" name="txtemail" id="email">
						<br>
						<span id="erroEmail"></span>
						<br>
					</fieldset>
					<fieldset class="faleConosco">
						<legend>Motivo do contato:</legend>
						<label for="motivo">Motivo:</label>
						<select name="selmotivo" id="motivo">
							<option value="">Escolha</option>
							
							<?php								
								$container = require __DIR__.'/../index.php';
								$controller = $container->get(APP\Controllers\MotivoContatoController::class);
								$controller->listar();
							?>

						</select>
						<label for="comentario">Comentário</label>
						<textarea name="txacomentario" id="comentario"></textarea>
						<br>
						<span id="erroComentario"></span>
						<br>
						<button type="reset">Limpar</button><button type="submit">Enviar</button>
					</fieldset>
				</form>     
		</section>
	</div>
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>