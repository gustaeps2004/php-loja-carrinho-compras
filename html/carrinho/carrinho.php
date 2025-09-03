<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/style/carrinho.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/sidebar.css">
	<script type="text/javascript" src="../../assets/js/carrinho.js" defer></script>
	<script type="text/javascript" src="../../assets/js/index.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Carrinho</title>
</head>
<body onload="ValidarToken(false)">
  <header>
		<img src="../../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Fechar Pedido</h1>

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

	<div class="hover-area"></div>
	<div class="sidebar">
		<a href="../inicio.php">Início</a>
		<a href="../produtos.php">Geladeiras & freezers</a>
		<a href="../faleConosco.php">Fale conosco</a>
		<a id="TabAdministracao" href="administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="faleConoscoAdm.php">Contato</a>
	</div>

	<div class="content">
		<section>
		<div class="principalProdutos">
				<div class="linhaOpcao">
					<?php								
						$container = require __DIR__.'../../../index.php';
						$controller = $container->get(APP\Controllers\CarrinhoCompraController::class);
						$controller->listar();
					?>
				</div>
			</div>	  
		</section>
	</div>
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>