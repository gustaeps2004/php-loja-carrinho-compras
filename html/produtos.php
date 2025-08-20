<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prática 1 HTML e CSS</title>
	<link rel="stylesheet" type="text/css" href="../assets/style/site.css">
	<script type="text/javascript" src="../assets/js/index.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body onload="ValidarToken(false)">
	<header>
		<img src="../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Geladeiras e Freezers</h1>

		<div class="perfil-info">
			<p>Informações de perfil</p>
			<p><b>Nome: </b><span id="nomeUsuario"></span></p>
			<p><b>Permissão: </b><span id="permissaoUsuario"></span></p>
			
			<a href="./login/login.php">Log out</a>
  	</div>
	</header>
	<nav>
		<a href="inicio.php"><div class="opcao">Início</div></a>
		<a href="produtos.php"><div class="opcao">Geladeiras e Freezers</div></a>
		<a href="faleConosco.php"><div class="opcao">Fale conosco</div></a>
		<a id="TabAdministracao" href="administracao/administracao.php"><div class="opcao">Administração</div></a>
	</nav> 
	<section>
		<form action="../assets/functions/removeRecursoListaFaleConosco.php" id="formListaFaleConosco" name="formListaFaleConosco" method="POST">
			<h2>Conheça nossos produtos!!!</h2>
			<table class="tabelaProdutos">
				<thead>
					<tr>
						<th  colspan="7" class="tituloTabela">Filmes</th>
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
						$container = require __DIR__.'/../index.php';
						$controller = $container->get(APP\Controllers\ProdutosController::class);
						$controller->listar();
					?>
				</tbody>
			</table>
		</form>   
	</section>
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>