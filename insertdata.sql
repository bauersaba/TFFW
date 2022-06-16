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




