<?php namespace APP\Services\Usuario;

  use APP\Repositories\Usuario\IUsuarioRepository;
  use APP\Responses\Autenticacao\AutenticacaoResponse;
  use Firebase\JWT\JWT;
  use Firebase\JWT\Key;

  class UsuarioService implements IUsuarioService
  {
    private readonly IUsuarioRepository $_usuarioRepository;

    public function __construct(IUsuarioRepository $usuarioRepository)
    {
      $this->_usuarioRepository = $usuarioRepository;
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

    private function gerarToken($usuarioRawQuery) : string
    {
      $key = 'fe64639d-3b73-4591-b0ab-4fc9e0ed4b4a';

      $payload = [
          'iss' => 'loja_autenticada_server', 
          'aud' => $usuarioRawQuery['Email'],
          'iat' => time(),
          'exp' => time() + 3600, 
          'data' => [
              'id' => $usuarioRawQuery['ID'],
              'nome' => $usuarioRawQuery['Nome'],
              'documentoFederal' => $usuarioRawQuery['DocumentoFederal'],
              'permissao' => $usuarioRawQuery['Descricao']
          ]
      ];

      return JWT::encode($payload, $key, 'HS256');
    }
  }
?>