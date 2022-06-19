CREATE TABLE usuario (
    id int not null auto_increment,
    usuario varchar(50),
    senha varchar (50),
    PRIMARY KEY (id)
);

CREATE TABLE dados(
	id int not null auto_increment,
    nome varchar(50),
    sobrenome varchar(50),
    telefone varchar(20),
    celular varchar(20),
    cpf int,
    fk_usuario int,
    FOREIGN KEY (fk_usuario)
    REFERENCES usuario (id),
    PRIMARY KEY (id)
    
);
CREATE TABLE endereco (
	id int primary key auto_increment,
    cep int,
    rua varchar(50),
    numero int,
    bairro varchar(50),
    cidade varchar(30)
);

CREATE TABLE produto (
    id int PRIMARY KEY,
    nomeProduto varchar(50),
    qtd int,
    valorUnitario decimal(6,2),
    imagem varchar(60)
);

CREATE TABLE pedido (
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    valorPedido decimal(6,2),
    quantidadeProduto int,
    fk_produto int,
    fk_usuario int,
    FOREIGN KEY (fk_produto)
    REFERENCES produto (id),
    FOREIGN KEY (fk_usuario)
    REFERENCES usuario (id)
);