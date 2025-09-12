<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/style/carrinho.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/sidebar.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/modalFinalizar.css">
	<script type="text/javascript" src="../../assets/js/carrinho.js" defer></script>
	<script type="text/javascript" src="../../assets/js/index.js" defer></script>
	<script type="text/javascript" src="../../assets/js/modalFinalizar.js" defer></script>
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
		<a id="TabAdministracao" href="../administracao/administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="../administracao/faleConoscoAdm.php">Contato</a>
	</div>

	<div class="content">
		<section>
			<div class="opcoes-finalizacao-carrinho">
				<button id="openModalForm">Finalizar</button>
				<p><b>Valor total: R$ <span id="valorTotalCarrinho"></b> </span></p>
			</div>

			<div class="principalProdutos">
				<div class="linhaOpcao">
					<?php								
						$container = require __DIR__.'../../../index.php';
						$controller = $container->get(APP\Controllers\CarrinhoCompraController::class);
						
						$controller->listar($_GET["usuarioID"]);
					?>
				</div>
			</div>

			<div id="modal" class="modal">
				<div class="modal-content">
					<span class="close-btn" id="closeModalBtn">&times;</span>

					<div class="step" id="step1">
						<h1>Confirmar produtos</h1>
						<P>CONTEÚDO 1</P>

						<div class="modal-buttons">
							<div class="modal-buttons-regress"></div>
							<div class="modal-buttons-progress">
								<button class="next-btn">Próximo</button>
							</div>
						</div>
					</div>

					<div class="step" id="step2">
						<h1>Confirmar endereço</h1>
						<P>CONTEÚDO 2</P>

						<div class="modal-buttons">
							<div class="modal-buttons-regress">
								<button class="prev-btn">Voltar</button>
							</div>
							<div class="modal-buttons-progress">
								<button class="next-btn">Próximo</button>
							</div>
						</div>
					</div>

					<div class="step" id="step3">
						<h1>Métodos de pagamento</h1>
						<P>CONTEÚDO 3</P>

						<div class="modal-buttons">
							<div class="modal-buttons-regress">
								<button class="prev-btn">Voltar</button>
							</div>
							<div class="modal-buttons-progress">
								<button class="next-btn">Concluir</button>
							</div>
						</div>
					</div>

					<div class="step" id="step4">
						<h1>Pagamento finalizado</h1>
						<P>CONTEÚDO 4</P>

						<div class="modal-buttons">
							<div class="modal-buttons-regress">
								<button class="prev-btn">Voltar</button>
							</div>
							<div class="modal-buttons-progress">
							<button class="finish-btn">Fechar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>