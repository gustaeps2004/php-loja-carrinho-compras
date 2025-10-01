<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/sidebar.css">
	<script type="module" src="../../assets/js/index.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Histórico de pedidos</title>
</head>
<body>
  <header>
		<img src="../../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Histórico de Pedidos</h1>

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
		<a id="linkHistoricoPedidos" href="pedidos.php">Histórico de pedidos</a>
		<a id="TabAdministracao" href="../administracao/administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="../administracao/faleConoscoAdm.php">Contato</a>
	</div>

  <div class="content">
    <div class="principalProdutos">
      <div class="linhaOpcao">
        <div class="opcao-historico-pedido">
					<div  class="opcao-historico-pedido-box-text">
						<p><b>Data da compra:</b> 18/08/2004 18:08:08</p>
						<p><b>Situação:</b> Em andamento</p>
					</div>
          <div class="opcao-historico-pedido-box-botao">
            <button>Acompanhar entrega</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer>Copyright &copy; ADS2025</footer>
</body>
</html>