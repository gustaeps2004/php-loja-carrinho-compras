<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../assets/style/carrinho.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/sidebar.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/modalFinalizar.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/popUp.css">
	<script type="module" src="../../assets/js/modalFinalizar.js"></script>
	<script type="module" src="../../assets/js/carrinho.js"></script>
	<script type="module" src="../../assets/js/index.js"></script>
	<script type="module" src="../../assets/js/popUp.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Histórico pedido</title>
</head>
<body>
  <header>
    <img src="../../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Histórico Pedidos</h1>

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
		<div><a href="../inicio.php">Início</a></div>
		<a href="../produtos.php">Geladeiras & freezers</a>
		<a href="../faleConosco.php">Fale conosco</a>
		<a id="TabAdministracao" href="../administracao/administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="../administracao/faleConoscoAdm.php">Contato</a>
	</div>
</body>
</html>