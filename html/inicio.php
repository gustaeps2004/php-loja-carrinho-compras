<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Início</title>
	<script type="module" src="../assets/js/index.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../assets/style/sidebar.css">
	<script type="text/javascript" src="../assets/js/carrinho.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<header>
		<img src="../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Seja Bem-Vindo</h1>

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
		<a id="linkHistoricoPedidos" href="historico/pedidos.php">Histórico de pedidos</a>
		<a id="TabAdministracao" href="administracao/administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="administracao/faleConoscoAdm.php">Contato</a>
	</div>

	<div class="content">
		<section>
			<div id="topo">
				<img src="../assets/imgs/geladeira1.png" alt="Imagem de uma geladeira" title="Imagem da geladeira" class="geladeira esquerda"> 
				<div id="titulos">
					<h2>Bem vindo ao site da<br>Coldigo Geladeiras!</h2>
					<h3>A maior loja de geladeiras da região</h3>
				</div> 
				<img src="../assets/imgs/geladeira2.png" alt="Imagem de outra geladeira" title="Imagem de outra geladeira" class="geladeira direita">
			</div>
				<p>
						Coldigo Geladeiras é a maior de revenda de geladeiras, refrigeradores, freezers e afins da região.
						Desde 2007 gelando e congelando para seu prazer.      
				</p>
				<p>
						Sua geladeira estragou? Estragou? Está precisando de uma maior? Quer mais conforto e praticidade? Já pensou
						em fazer um consórcio de geladeira? Venha nos fazer uma visita ou entre em contato para mais informações;
				</p>
		</section>
	</div>
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>