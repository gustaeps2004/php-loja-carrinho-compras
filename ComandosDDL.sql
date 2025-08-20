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












