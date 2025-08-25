<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Geladeiras & Freezers</title>
	<link rel="stylesheet" type="text/css" href="../assets/style/site.css">
	<script type="text/javascript" src="../assets/js/index.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body onload="ValidarToken(false)">
	<header>
		<img src="../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Geladeiras & Freezers</h1>

		<div class="perfil-info">
			<p>Informações de perfil</p>
			<p><b>Nome: </b><span id="nomeUsuario"></span></p>
			<p><b>Permissão: </b><span id="permissaoUsuario"></span></p>
			<br>
			<a href="./login/login.php">Log out</a>
  	</div>
	</header>
	<nav>
		<a href="inicio.php"><div class="opcao">Início</div></a>
		<a href="produtos.php"><div class="opcao">Geladeiras & freezers</div></a>
		<a href="faleConosco.php"><div class="opcao">Fale conosco</div></a>
		<a id="TabAdministracao" href="administracao/administracao.php"><div class="opcao">Administração</div></a>
		<a id="TabFaleConoscoAdm" href="administracao/faleConoscoAdm.php"><div class="opcao">Contato</div></a>
	</nav> 
	<section>
		<div class="principalProdutos">
			<div class="linhaOpcao">
				<div class="opcoes">
					<p><span>GELADEIRA 4 PORTA</span></p>
					<img src="../assets/imgs/geladeira1.png" alt="GELADEIRA 4 PORTA" title="GELADEIRA 4 PORTA">
					<form action="" id="formEnviaParaCarrinho" name="frmEnviaParaCarrinho" method="POST">
						<input class="inpProduto" type="number" name="txtidProduto" id="idProduto" value="1">
						<button class="btnAddCarrinho">Adicionar ao carrinho</button>
					</form>
				</div>
			</div>
		</div>	  
	</section>
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>