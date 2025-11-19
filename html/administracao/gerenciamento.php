<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/sidebar.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/gerenciamento.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Gerenciamento</title>
</head>
<body>
  <header>
		<img src="../../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Gerenciamento</h1>

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
		<a id="linkHistoricoPedidos" href="../historico/entregas.php">Entregas</a>
		<a id="linkHistorico" href="../historico/pedidos.php">Histórico de pedidos</a>
		<a id="TabAdministracao" href="administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="faleConoscoAdm.php">Contato</a>
		<a id="TabGerenciamento" href="gerenciamento.php">Gerenciamento</a>
	</div>

  <div class="content">
    <section>
			<div class="content-valores-anuais">
				<div style="width: 500px;">
					<canvas id="totalAnual"></canvas>
				</div>  
				<div style="width: 500px;">
					<canvas id="totalMensal"></canvas>
				</div>
			</div>
			<br>
			<div class="content-valores-anuais">
				<div style="width: 500px;">
					<canvas id="projecaoAnual"></canvas>
				</div>  
				<div style="width: 500px;">
					<canvas id="projecaoMensal"></canvas>
				</div>
			</div>
    </section>
  </div>

  <script type="module" src="../../assets/js/index.js"></script>
  <script type="module" src="../../assets/js/gerenciamento.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>