<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Geladeiras & Freezers</title>
	<link rel="stylesheet" type="text/css" href="../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../assets/style/sidebar.css">
	<script type="module" src="../assets/js/index.js"></script>
	<script type="text/javascript" src="../assets/js/carrinho.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<header>
		<img src="../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Geladeiras & Freezers</h1>

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
		<a id="linkHistoricoPedidos" href="historico/entregas.php">Entregas</a>
		<a id="linkHistorico" href="historico/pedidos.php">Histórico de pedidos</a>
		<a id="TabAdministracao" href="administracao/administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="administracao/faleConoscoAdm.php">Contato</a>
		<a id="TabGerenciamento" href="administracao/gerenciamento.php">Gerenciamento</a>
	</div>

	<div class="content">
		<section>
			<div class="principalProdutos">
				<div class="linhaOpcao">
					<?php								
						$container = require __DIR__.'/../index.php';
						$controller = $container->get(APP\Controllers\ProdutosController::class);
						$controller->listar();
					?>
				</div>
			</div>	  
		</section>
	</div>
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>