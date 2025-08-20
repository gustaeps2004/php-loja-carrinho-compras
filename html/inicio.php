<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Prática 1 HTML e CSS</title>
	<script type="text/javascript" src="../assets/js/index.js" defer></script>
	<link rel="stylesheet" type="text/css" href="../assets/style/site.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body onload="ValidarToken(false)">
	<header>
		<img src="../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Geladeiras & Outros - PRINCIPAL</h1>

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
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>