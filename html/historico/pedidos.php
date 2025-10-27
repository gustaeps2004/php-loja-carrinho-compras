<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/sidebar.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/historicoPedidos.css">
  <title>Histórico de pedidos</title>
</head>
<body>
  <header>
		<img src="../../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Histórico de pedidos</h1>

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
		<a id="linkHistoricoPedidos" href="entregas.php">Entregas</a>
		<a id="linkHistorico" href="pedidos.php">Histórico de pedidos</a>
		<a id="TabAdministracao" href="../administracao/administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="../administracao/faleConoscoAdm.php">Contato</a>
	</div>
  
  <div class="content">
		<section>
      <div class="principalProdutos">
        <div class="linhaOpcao">
        
				<?php
				
				$container = require __DIR__.'../../../index.php';
				$controller = $container->get(APP\Controllers\PedidosController::class);
				
				$controller->listarHistorico($_GET["usuarioID"]);
				?>

        </div>
      </div>
    </section>

		<div id="modal" class="modal">
			<div class="modal-content">
				<span class="close-btn" id="closeModalBtn">&times;</span>
				<div class="step" id="step1">
					<h1>Detalhes pedido</h1>
					
					<div id="detalhes-principais">
						<div class="content-step-confirmacao">
							<div class="content-step-confirmacao-produto">
								<p class="content-step-confirmacao-produto-paragrafo">Data pedido: <span id="data-pedido-historico"></span></p>
								<p class="content-step-confirmacao-produto-paragrafo">Valor total: R$ <span id="valor-total-pedido-historico"></span></p>
								<p class="content-step-confirmacao-produto-paragrafo">Forma de pagamento: <span id="metodo-pagamento-pedido-historico"></span></p>
							</div>
						</div>
					</div>

					<div class="modal-buttons">
						<div class="modal-buttons-regress"></div>
						<div class="modal-buttons-progress">
							<button class="next-btn">Próximo</button>
						</div>
					</div>
				</div>

				<div class="step" id="step2">
					<h1>Produtos</h1>

					<div id="detalhes-produtos"></div>

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
					<h1 class="titulo-terceiro-step">Entrega</h1>

					<div id="detalhes-entregas"></div>	

					<div class="modal-buttons-entrega">
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
  </div>

  <footer>Copyright &copy; ADS2025</footer>

  <script type="module" src="../../assets/js/index.js"></script>
	<script type="text/javascript" src="../../assets/js/historicoPedidos.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>