create database loja;

use loja;
create table MotivoContato(
	ID INT NOT NULL auto_increment,
    Mensagem varchar(25),
    
    primary key (ID)
);

insert into MotivoContato(Mensagem)
values ("Reclamação"), ("Sugestão"), ("Informação sobre produto");

use loja;
create table FaleConosco(
	ID INT NOT NULL auto_increment,
    Nome varchar(100) NOT NULL,
    DocumentoFederal varchar(14) NOT NULL,
    Telefone varchar(13),
    Email varchar(100) NOT NULL,
    MotivoContatoID int null,
    Comentario varchar(150) null,
    
    primary key (ID),
	FOREIGN KEY (MotivoContatoID) REFERENCES MotivoContato(ID)
);

use loja;
create table Permissao(
	ID INT NOT NULL auto_increment,
    Descricao varchar(100),
    
    primary key (ID)
);

insert into Permissao(Descricao)
values ('Administrador'),('Visualização');

use loja;
create table Usuario(
	ID INT NOT NULL auto_increment,
    Nome varchar(100) NOT NULL,
    DocumentoFederal varchar(14) NOT NULL,
    Email varchar(100) NOT NULL,
    PermissaoID int not null,
    
    primary key (ID),
    FOREIGN KEY (PermissaoID) REFERENCES Permissao(ID)
);

use loja;
create table Categoria(
	ID INT NOT NULL auto_increment,
    Descricao varchar(50) NOT NULL,
    
    PRIMARY KEY (ID)
);

insert into Categoria(Descricao)
values ('Geladeira'), ('Freezer');


use loja;
create table Produto(
	ID INT NOT NULL auto_increment,
	Titulo varchar(30) NOT NULL UNIQUE,
    Descricao varchar(60) NOT NULL,
    CaminhoImagem varchar(100),
    CategoriaID INT NOT NULL,
    
    PRIMARY KEY(ID),
    FOREIGN KEY (CategoriaID) REFERENCES Categoria(ID)    
);

use loja;
create table Pedido(
	ID INT NOT NULL auto_increment,
    Situacao TINYINT NOT NULL, /* 1 -> Ativo, 2 -> Cacelado, 3 -> Finalizado */
    DtInclucao DATETIME NOT NULL,
    UsuarioID INT NOT NULL,
	
    PRIMARY KEY(ID),
    FOREIGN KEY (UsuarioID) REFERENCES Usuario(ID) 
);

use loja;
create table CarrinhoCompra(
	ID INT NOT NULL auto_increment,
	DtInclusao DATETIME NOT NULL,
    QuantidadeItem INT NOT NULL,
    PedidoID INT NOT NULL,
    ProdutoID INT NOT NULL,
    
    PRIMARY KEY(ID),
    FOREIGN KEY (PedidoID) REFERENCES Pedido(ID),
    FOREIGN KEY (ProdutoID) REFERENCES Produto(ID)
);






