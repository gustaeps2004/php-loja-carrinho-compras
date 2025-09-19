<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/style/carrinho.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/sidebar.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/modalFinalizar.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/popUp.css">
	<script type="module" src="../../assets/js/modalFinalizar.js"></script>
	<script type="text/javascript" src="../../assets/js/carrinho.js" defer></script>
	<script type="module" src="../../assets/js/index.js"></script>
	<script type="module" src="../../assets/js/popUp.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Carrinho</title>
</head>
<body>
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
				<button id="openModalForm" class="carrinho-btn-finalizar">Finalizar</button>
				<p><b>Valor total: R$ <span id="valorTotalCarrinho"></b> </span></p>

				<button id="cancelar-carrinho" class="carrinho-btn-cancelar">Cancelar</button>
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
						
						<?php
							$container = require __DIR__.'../../../index.php';
							$controller = $container->get(APP\Controllers\CarrinhoCompraController::class);
							
							$controller->listarSelecionados($_GET["usuarioID"]);							
						?>

						<div class="modal-buttons">
							<div class="modal-buttons-regress"></div>
							<div class="modal-buttons-progress">
								<button class="next-btn">Próximo</button>
							</div>
						</div>
					</div>

					<div class="step" id="step2">
						<h1>Confirmar endereço</h1>
						
						<div class="content-step">
							<div class="content-step-inputs">
								<div class="field">
									<input id="cep" type="text" placeholder=" " required>
									<label for="cep">CEP</label>
								</div>
								<div class="field">
									<input id="logradouro" type="text" placeholder=" " required>
									<label for="logradouro">Logradouro</label>
								</div>
								<div class="field">
									<input id="numero" type="text" placeholder=" " required>
									<label for="numero">Número</label>
								</div>
								<div class="field">
									<input id="complemento" type="text" placeholder=" " required>
									<label for="complemento">Complemento</label>
								</div>
								<div class="field">
									<input id="cidade" type="text" placeholder=" " required>
									<label for="cidade">Cidade</label>
								</div>
								<div class="field">
									<input id="estado" type="text" placeholder=" " required>
									<label for="estado">Estado</label>
								</div>
							</div>
						</div>
						<br>
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

						<div class="content-step-metodo">
							<div class="content-step-metodo-pagamento">
								<p>Selecione um método de paramento:</p>
								<select name="selmetodopagamento" id="metodo-pagamento">
									<option value="">Escolha</option>
									<option value="1">Débito</option>
									<option value="2">Crédito</option>
									<option value="3">Pix</option>
								</select>
							</div>
						</div>

						<div class="modal-buttons">
							<div class="modal-buttons-regress">
								<button class="prev-btn">Voltar</button>
							</div>
							<div class="modal-buttons-progress">
								<button class="finish-btn">Concluir</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div id="popup" class="popup">
		<div class="popup-content">
			<span id="fecharPopup" class="fechar">&times;</span>
			<p id="mensagem-pop-up"></p>
		</div>
	</div>

	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>