<?php namespace APP\Services\Usuario;

use APP\Repositories\Usuario\IUsuarioRepository;
use APP\Messaging\Responses\Autenticacao\AutenticacaoResponse;
use APP\Messaging\Responses\Autenticacao\EnvioEmailRecuperacaoSenha;
use APP\Services\EnvioEmail\EnvioEmailService;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UsuarioService implements IUsuarioService
{
  private readonly IUsuarioRepository $_usuarioRepository;
  private readonly EnvioEmailService $_envioEmailService;

  public function __construct(
    IUsuarioRepository $usuarioRepository,
    EnvioEmailService $envioEmailService)
  {
    $this->_usuarioRepository = $usuarioRepository;
    $this->_envioEmailService = $envioEmailService;
  }

  public function listar()
  {
    return $this->_usuarioRepository->listar();
  }

  public function inserir(
    $nome,
    $email,
    $documentoFederal,
    $permissaoID,
    $senha
  )
  {
    $this->_usuarioRepository->inserir(
      $nome,
      $email,
      $documentoFederal,
      $permissaoID,
      base64_encode($senha));
  }

  public function validarAcesso($login, $senha) : AutenticacaoResponse
  {
    $usuarioRawQuery = $this->_usuarioRepository->obterUsuarioPorLogin($login);

    $response = new AutenticacaoResponse();

    if ($usuarioRawQuery == null || $usuarioRawQuery['Senha'] != base64_encode($senha))
    {
      $response->atualizarErro("Login ou senha inválidos.");
      return $response;
    }

    $token = $this->gerarToken($usuarioRawQuery);
    $response->atualizarSucesso($token);
    
    return $response;
  }

  private function gerarToken($usuarioRawQuery, int $expireIn = 3600) : string
  {
    $key = 'fe64639d-3b73-4591-b0ab-4fc9e0ed4b4a';

    $payload = [
        'iss' => 'loja_autenticada_server', 
        'aud' => $usuarioRawQuery['Email'],
        'iat' => time(),
        'exp' => time() + $expireIn, 
        'data' => [
            'id' => $usuarioRawQuery['ID'],
            'nome' => $usuarioRawQuery['Nome'],
            'documentoFederal' => $usuarioRawQuery['DocumentoFederal'],
            'permissao' => $usuarioRawQuery['Descricao']
        ]
    ];

    return JWT::encode($payload, $key, 'HS256');
  }

  private function tokenInvalido(string $token) : bool
  {
    try
    {
      $key = 'fe64639d-3b73-4591-b0ab-4fc9e0ed4b4a';
      $issuerEsperado = 'loja_autenticada_server';

      $decoded = JWT::decode($token, new Key($key, 'HS256'));

      return $decoded->iss !== $issuerEsperado;
    }
    catch (Exception $ex)
    {
      return true;
    }
  }

  public function enviarEmailRecuperacaoSenha(string $email) : EnvioEmailRecuperacaoSenha
  {
    if (!$this->_usuarioRepository->existeEmail($email))
      return new EnvioEmailRecuperacaoSenha(
        "Erro ao enviar o email de recuperação de senha.",
        404
      );

    $usuarioRawQuery = $this->_usuarioRepository->obterUsuarioPorLogin($email);
    $token = $this->gerarToken($usuarioRawQuery, 900);
    
    $this->_envioEmailService->enviar(
      $email,
      "Alterar Senha",
      'Entre neste link para recuperar sua senha <a href="http://localhost:8080/php-loja-carrinho-compras/html/login/recuperar.php?token='.$token.'&id='.$usuarioRawQuery['ID'].'&email='.$email.'">Clique aqui</a>'
    );

    return new EnvioEmailRecuperacaoSenha(
      "Sucesso no envio do email.", 
      200
    );
  }

  public  function alterarSenha(
    string $token,
    string $senha,
    string $confirmacaoSenha,
    int $id
  ) : void
  {
    if ($confirmacaoSenha != $senha || $this->tokenInvalido($token))
      return;
      
    $this->_usuarioRepository->atualizarSenha(
      $id, 
      base64_encode($senha)
    );
  }
}