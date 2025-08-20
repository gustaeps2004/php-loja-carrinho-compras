<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<script type="text/javascript" src="../../assets/js/index.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Fale Conosco Adm</title>
</head>
<body onload="ValidarToken(true)">
  <header>
		<img src="../../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Fale Conosco Adm</h1>

		<div class="perfil-info">
			<p>Informações de perfil</p>
			<p><b>Nome: </b><span id="nomeUsuario"></span></p>
			<p><b>Permissão: </b><span id="permissaoUsuario"></span></p>
			
			<a href="..	/login/login.php">Log out</a>
  	</div>
	</header>
	<nav>
		<a href="../inicio.php"><div class="opcao">Início</div></a>
		<a href="../produtos.php"><div class="opcao">Geladeiras & freezers</div></a>
		<a href="../faleConosco.php"><div class="opcao">Fale conosco</div></a>
		<a id="TabAdministracao" href="administracao.php"><div class="opcao">Administração</div></a>
		<a id="TabFaleConoscoAdm" href="faleConoscoAdm.php"><div class="opcao">Fale conosco adm</div></a>
	</nav> 
</body>
</html>