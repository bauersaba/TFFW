DELIMITER //

CREATE PROCEDURE `cadastroUsuarioCompleto` (usuario varchar(50),
											senha varchar(50),
											nome varchar(50),
                                            sobrenome varchar(50),
                                            telefone varchar (20),
                                            celular varchar(20),
                                            cpf int,
                                            cep int,
                                            rua varchar(50),
                                            numero int,
                                            bairro varchar(50),
                                            cidade varchar(30))
BEGIN
    INSERT INTO usuario_dadosPessoais(nomeUsuario,senha,nome,sobrenome,telefone,celular,cpf)
    VALUES (usuario,senha,nome,sobrenome,telefone,celular,cpf);

    SELECT last_insert_id() INTO @idUser;

    INSERT INTO endereco(CEP,rua,numero,bairro,cidade)
    VALUES (cep,rua,numero,bairro,cidade);

    SELECT last_insert_id() INTO @idCep;

    INSERT INTO contem(fk_usuario_dadosPessoais_id,fk_endereco_idCep)
    VALUES (@idUser,@idCep);
END //
DELIMITER ;

CAll cadastroUsuarioCompleto('super', '123456', 'Administrador', 'Sistema', '1932221212', '19995344322', 22222222,
							 13186190,'Rua Pastor Hugo ', 75, 'Pq Hortolandia','Hortolandia');


CAll cadastroUsuarioCompleto('elima', '123456', 'Edson', 'Lima', '1933334521', '19987314533', 45632178,
							 13003405,'Rua da oliveiras', 45, 'Matão','Campinas');
                             
INSERT INTO tffw.produto(codProduto,nomeProduto,saldo,valorUnitario)
VALUES (04,'TV LG 85" SmartTV QLED', 2, 12450.77);


DELIMITER //
CREATE PROCEDURE `registroPedido`(idUsuario int,
								   codigoProduto int,
								   itemPedido varchar(50),
                                   qtdProduto int,
                                   valortotal double)
BEGIN
	declare quantidade int;
    set quantidade = qtdProduto;
    IF quantidade >= produto.saldo THEN
		INSERT INTO pedido(codProduto,itensPedido,quantidadeProduto,valorPedido)
		VALUES(codigoProduto,itemPedido,qtdProduto,valortotal);
		SELECT last_insert_id() INTO @idPedido;
		INSERT INTO itensPedido(fk_pedido_idPedido,fk_produto_codProduto)
		VALUES(@idPedido,codProduto);
		INSERT INTO fazpedido(fk_usuario_dadosPessoais_id,fk_pedido_idPedido)
		VALUES(idUsuario,@idPedido);
        UPDATE produto SET saldo = saldo - qtdProduto where codProduto = codigoProduto;
	END IF;
END 
DELIMITER //





