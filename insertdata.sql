INSERT INTO usuario_dadosPessoais(nomeUsuario,senha,nome,sobrenome,telefone,celular,cpf)
VALUES ('mbauer','123456','Marcelo Bauer','Sabaraense','1932222322','19994443222',25458796);

INSERT INTO usuario_dadosPessoais(nomeUsuario,senha,nome,sobrenome,telefone,celular,cpf)
VALUES ('elima','123456','Edson','Lima','1945923422','1992131133',12345687);

INSERT INTO usuario_dadosPessoais(nomeUsuario,senha,nome,sobrenome,telefone,celular,cpf)
VALUES ('aholanda','123456','Alciomar','Holanda','1922224544','19955554321',12345678);

INSERT INTO usuario_dadosPessoais(nomeUsuario,senha,nome,sobrenome,telefone,celular,cpf)
VALUES ('super','123456','Administrador','Sistema','1999999999','1911111111',11111111);

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
							 13186190,'Gessy Vieira', 75, 'Novo Cambui','Hortolandia');




