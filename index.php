<?php
  require __DIR__.'/vendor/autoload.php';
  
  use DI\ContainerBuilder;
  use function DI\autowire;

  use APP\Controllers\MotivoContatoController;
  use APP\Controllers\ProdutosController;
  use APP\Controllers\PermissoesController;
  use APP\Controllers\UsuariosController;
  use APP\Controllers\AutenticacoesController;
  use APP\Controllers\CategoriasController;

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
  use APP\Services\Categoria\ICategoriaService;
  use APP\Services\Categoria\CategoriaService;
  use APP\Services\Pedido\PedidoService;
  use APP\Services\Pedido\IPedidoService;
  use APP\Services\CarrinhoCompra\CarrinhoCompraService;
  use APP\Services\CarrinhoCompra\ICarrinhoCompraService;

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
  use APP\Repositories\Categoria\CategoriaRepository;
  use APP\Repositories\Categoria\ICategoriaRepository;
  use APP\Repositories\Pedido\IPedidoRepository;
  use APP\Repositories\Pedido\PedidoRepository;
  use APP\Repositories\CarrinhoCompra\ICarrinhoCompraRepository;
  use APP\Repositories\CarrinhoCompra\CarrinhoCompraRepository;
  
  use APP\Repositories\Connections\MySql\IMySqlConnection;
  use APP\Repositories\Connections\MySql\MySqlConnection;

  use APP\Assets\Extensions\StringFormats;
  use APP\Repositories\Connections\FirebaseRepository;
  use APP\Repositories\Connections\IFirebaseRepository;
  use APP\Socket\Connection\WebSocketConnection;
  use APP\Socket\PedidoEntregaSocket;

  $containerBuilder = new ContainerBuilder();
  
  $containerBuilder->addDefinitions([
    MotivoContatoController::class => autowire(),
    ProdutosController::class => autowire(),
    PermissoesController::class => autowire(),
    UsuariosController::class => autowire(),
    AutenticacoesController::class => autowire(),
    CategoriasController::class => autowire(),
    
    StringFormats::class => autowire(),

    IMotivoContatoService::class => autowire(MotivoContatoService::class),
    IProdutoService::class => autowire(ProdutoService::class),
    IFaleConoscoService::class => autowire(FaleConoscoService::class),
    IPermissaoService::class => autowire(PermissaoService::class),
    IUsuarioService::class => autowire(UsuarioService::class),
    ICategoriaService::class => autowire(CategoriaService::class),
    IPedidoService::class => autowire(PedidoService::class),
    ICarrinhoCompraService::class => autowire(CarrinhoCompraService::class),

    IMotivoContatoRepository::class => autowire(MotivoContatoRepository::class),
    IProdutoRepository::class => autowire(ProdutoRepository::class),
    IFaleConoscoRepository::class => autowire(FaleConoscoRepository::class),
    IPermissaoRepository::class => autowire(PermissaoRepository::class),
    IUsuarioRepository::class => autowire(UsuarioRepository::class),
    ICategoriaRepository::class => autowire(CategoriaRepository::class),
    IPedidoRepository::class => autowire(PedidoRepository::class),
    ICarrinhoCompraRepository::class => autowire(CarrinhoCompraRepository::class),

    IMySqlConnection::class => autowire(MySqlConnection::class),
    IFirebaseRepository::class => autowire(FirebaseRepository::class),

    PedidoEntregaSocket::class => autowire(PedidoEntregaSocket::class),
    WebSocketConnection::class => autowire(WebSocketConnection::class)
  ]);

  return $containerBuilder->build();
?>