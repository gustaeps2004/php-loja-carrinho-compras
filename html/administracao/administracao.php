<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/style/site.css">
	<link rel="stylesheet" type="text/css" href="../../assets/style/sidebar.css">
	<script type="text/javascript" src="../../assets/js/index.js" defer></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<title>Administração</title>
</head>
<body onload="ValidarToken(true)">
  <header>
		<img src="../../assets/imgs/logo.png" alt="Logo da página" title="Logo da página">
		<h1>Administração</h1>

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
		<a id="TabAdministracao" href="administracao.php">Administração</a>
		<a id="TabFaleConoscoAdm" href="faleConoscoAdm.php">Contato</a>
	</div>

	<div class="content">
		<section>
			<div class="principalAdm">
				<div class="admTabela">
				<h2>Usuários</h2>
					<table class="tabelaFuncionarios">
						<thead>
							<tr>
								<th  colspan="4" class="tituloTabela">Usuários</th>
							</tr>
							<tr>
								<th>Nome</th>
								<th>Documento federal</th>
								<th>E-mail</th>
								<th>Permissão</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$container = require __DIR__.'../../../index.php';

								$controller = $container->get(APP\Controllers\UsuariosController::class);
								$controller->listar();
							?>
						</tbody>
					</table>
				</div>

				<div class="admFormulario">
					<h2>Cadastro usuário</h2>
					<form action="../../assets/functions/processaFormCadastroUsuario.php" id="formCadastroUsuario" name="frmCadastroUsuario" method="POST">
						<fieldset class="cadastroUsuario">
							<legend>Dados pessoais</legend>
							<label for = "nome">Nome:</label>
							<input require type="text" name="txtnome" id="nome">
							<br>
							<span id="erroNome"></span>

							<label for="documento">Documento federal:</label>
							<input required maxlength="11" type="text" name="txtdocumento" id="documento" onkeyup="FormatarDocumento()">
							<br>
							<span id="erroCpf"></span>

							<label for="email">E-mail</label>
							<input require type="email" name="txtemail" id="email">
							<br>
							<span id="erroEmail"></span>

							<label for = "nome">Senha:</label>
							<input require type="password" name="txtsenha" id="senha">
							<br>

							<label for="permissao">Permissão:</label>
							<select require name="selPermissao" id="permissao">
								<option value="">Escolha</option>
								
								<?php								
									$container = require __DIR__.'../../../index.php';
									
									$controller = $container->get(APP\Controllers\PermissoesController::class);
									$controller->listar();
								?>

							</select>
							<br>
							<br>
							<button type="reset">Limpar</button><button type="submit">Enviar</button>
						</fieldset>
					</form>
				</div>

				<div class="admFormulario">
					<h2>Cadastro produto</h2>
					<form action="../../assets/functions/processaFormCadastroProduto.php" enctype="multipart/form-data" id="formCadastroProduto" name="frmCadastroProduto" method="POST">
						<fieldset class="cadastroProduto">
							<legend>Dados do produto</legend>
							
							<label for="categoria">Categoria:</label>
							<select require name="selCategoria" id="categoria">
								<option value="0">Escolha</option>
								<?php								
									$container = require __DIR__.'../../../index.php';
									
									$controller = $container->get(APP\Controllers\CategoriasController::class);
									$controller->listar();
								?>
							</select>

							<label for = "titulo">Título:</label>
							<input require type="text" name="txttitulo" id="titulo">

							<label for="descricao">Descrição:</label>
							<input required type="text" name="txtdescricao" id="descricao">

							<label for="imagem">Imagem:</label>
							<input type="file" name="arquivo" id="arquivo">

							<br>
							<br>

							<button type="reset">Limpar</button><button type="submit">Enviar</button>
						</fieldset>
					</form>
				</div>
			</div>
		</section>
	</div>

	<footer>Copyright &copy; ADS2025</footer>
</body>
</html>