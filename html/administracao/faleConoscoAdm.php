<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<script type="text/javascript" src="../../assets/js/index.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Contato</title>
</head>
<body onload="ValidarToken(true)">
  <header>
		<img src="../../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Contato</h1>

		<div class="perfil-info">
			<div class="info-texto">
				<p>Informações de perfil</p>
				<p><b>Nome:</b> <span id="nomeUsuario"></span></p>
				<p><b>Permissão:</b> <span id="permissaoUsuario"></span></p>
				<br />
				<a href="../login/login.php">Log out</a>
			</div>
  	</div>
	</header>
	<nav>
		<a href="../inicio.php"><div class="opcao">Início</div></a>
		<a href="../produtos.php"><div class="opcao">Geladeiras & freezers</div></a>
		<a href="../faleConosco.php"><div class="opcao">Fale conosco</div></a>
		<a id="TabAdministracao" href="administracao.php"><div class="opcao">Administração</div></a>
		<a id="TabFaleConoscoAdm" href="faleConoscoAdm.php"><div class="opcao">Contato</div></a>
	</nav>
	<section>
		<form action="" id="formListaFaleConosco" name="formListaFaleConosco" method="POST">
			<h2>Entrar em contato!</h2>
			<table class="tabelaProdutos">
				<thead>
					<tr>
						<th  colspan="7" class="tituloTabela">Sujestões dos usuários</th>
					</tr>
					<tr>
						<th>Nome</th>
						<th>Documento federal</th>
						<th>Telefone</th>
						<th>E-mail</th>
						<th>Motivo contato</th>
						<th>Comentário</th>
						<th>Remover</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$container = require __DIR__.'/../../index.php';
						$controller = $container->get(APP\Controllers\FaleConoscoController::class);
						$controller->listar();
					?>
				</tbody>
			</table>
		</form>   
	</section>
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>