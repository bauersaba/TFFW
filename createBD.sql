CREATE TABLE usuario_dadosPessoais (
    id int not null auto_increment,
    nomeUsuario varchar(50),
    senha varchar (50),
    nome varchar(50),
    sobrenome varchar(50),
    telefone varchar(20),
    celular varchar(20),
    cpf int,
    PRIMARY KEY (id)
);

CREATE TABLE endereco (
	idCep int primary key auto_increment,
    cep int,
    rua varchar(50),
    numero int,
    bairro varchar(50),
    cidade varchar(30)
);

CREATE TABLE produto (
    codProduto int PRIMARY KEY,
    nomeProduto varchar(50),
    saldo int,
    valorUnitario double
);

CREATE TABLE pedido (
    idPedido int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    itensPedido varchar(50),
    valorPedido double,
    quantidadeProduto double
);

CREATE TABLE contem (
    fk_usuario_dadosPessoais_id int,
    fk_endereco_idCep int
);

CREATE TABLE itensPedido (
    fk_pedido_idPedido int,
    fk_produto_codProduto int
);

CREATE TABLE fazPedido (
    fk_usuario_dadosPessoais_id int,
    fk_pedido_idPedido int
);
 
ALTER TABLE contem ADD CONSTRAINT FK_contem_1
    FOREIGN KEY (fk_usuario_dadosPessoais_id)
    REFERENCES usuario_dadosPessoais (id)
    ON DELETE RESTRICT;
 
ALTER TABLE contem ADD CONSTRAINT FK_contem_2
    FOREIGN KEY (fk_endereco_idCep)
    REFERENCES endereco (idCep)
    ON DELETE RESTRICT;
 
ALTER TABLE itensPedido ADD CONSTRAINT FK_itensPedido_1
    FOREIGN KEY (fk_pedido_idPedido)
    REFERENCES pedido (idPedido)
    ON DELETE SET NULL;
 
ALTER TABLE itensPedido ADD CONSTRAINT FK_itensPedido_2
    FOREIGN KEY (fk_produto_codProduto)
    REFERENCES produto (codProduto)
    ON DELETE SET NULL;
 
ALTER TABLE fazPedido ADD CONSTRAINT FK_fazPedido_1
    FOREIGN KEY (fk_usuario_dadosPessoais_id)
    REFERENCES usuario_dadosPessoais (id)
    ON DELETE SET NULL;
 
ALTER TABLE fazPedido ADD CONSTRAINT FK_fazPedido_2
    FOREIGN KEY (fk_pedido_idPedido)
    REFERENCES pedido (idPedido)
    ON DELETE SET NULL;