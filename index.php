<?php
  require __DIR__.'/vendor/autoload.php';
  
  use DI\ContainerBuilder;
  use function DI\autowire;

  use APP\Controllers\MotivoContatoController;
  use APP\Controllers\ProdutosController;
  use APP\Controllers\PermissoesController;
  use APP\Controllers\UsuariosController;
  use APP\Controllers\AutenticacoesController;


  use APP\Services\MotivoContato\IMotivoContatoService;
  use APP\Services\MotivoContato\MotivoContatoService;
  use APP\Services\Produto\ProdutoService;
  use APP\Services\Produto\IProdutoService;
  use APP\Services\FaleConosco\IFaleConoscoService;
  use APP\Services\FaleConosco\FaleConoscoService;
  use APP\Services\Permissao\PermissaoService;
  use APP\Services\Permissao\IPermissaoService;
  use APP\Services\Usuario\UsuarioService;
  use APP\Services\Usuario\IUsuarioService;

  use APP\Repositories\MotivoContato\IMotivoContatoRepository;
  use APP\Repositories\MotivoContato\MotivoContatoRepository;
  use APP\Repositories\Produto\ProdutoRepository;
  use APP\Repositories\Produto\IProdutoRepository;
  use APP\Repositories\FaleConosco\IFaleConoscoRepository;
  use APP\Repositories\FaleConosco\FaleConoscoRepository;
  use APP\Repositories\Permissao\IPermissaoRepository;
  use APP\Repositories\Permissao\PermissaoRepository;
  use APP\Repositories\Usuario\UsuarioRepository;
  use APP\Repositories\Usuario\IUsuarioRepository;
  
  use APP\Repositories\Connections\MySql\IMySqlConnection;
  use APP\Repositories\Connections\MySql\MySqlConnection;

  use APP\Assets\Extensions\StringFormats;
  
  $containerBuilder = new ContainerBuilder();
  
  $containerBuilder->addDefinitions([
    MotivoContatoController::class => autowire(),
    ProdutosController::class => autowire(),
    PermissoesController::class => autowire(),
    UsuariosController::class => autowire(),
    AutenticacoesController::class => autowire(),
    
    StringFormats::class => autowire(),

    IMotivoContatoService::class => autowire(MotivoContatoService::class),
    IProdutoService::class => autowire(ProdutoService::class),
    IFaleConoscoService::class => autowire(FaleConoscoService::class),
    IPermissaoService::class => autowire(PermissaoService::class),
    IUsuarioService::class => autowire(UsuarioService::class),

    IMotivoContatoRepository::class => autowire(MotivoContatoRepository::class),
    IProdutoRepository::class => autowire(ProdutoRepository::class),
    IFaleConoscoRepository::class => autowire(FaleConoscoRepository::class),
    IPermissaoRepository::class => autowire(PermissaoRepository::class),
    IUsuarioRepository::class => autowire(UsuarioRepository::class),

    IMySqlConnection::class => autowire(MySqlConnection::class)
  ]);

  return $containerBuilder->build();
?>