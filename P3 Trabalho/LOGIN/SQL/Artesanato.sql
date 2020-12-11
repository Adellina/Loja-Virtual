CREATE TABLE `artesanato`.`usuarios` 
( `id_usuario` INT NULL DEFAULT NULL AUTO_INCREMENT ,
 `nome` VARCHAR(100) NULL DEFAULT NULL , 
 `telefone` VARCHAR(100) NULL DEFAULT NULL , 
 `email` VARCHAR(100) NULL DEFAULT NULL , 
 `senha` VARCHAR(35) NULL DEFAULT NULL ,
   PRIMARY KEY (`id_usuario`)) ENGINE = MyISAM;


   CREATE TABLE `artesanato`.`comentarios` 
( `id_comentario` INT NULL DEFAULT NULL AUTO_INCREMENT ,
 `comentario` VARCHAR(400) NULL DEFAULT NULL , 
 `dia` DATE NULL DEFAULT NULL , 
 `hora` VARCHAR(100) NULL DEFAULT NULL , 
 `pk_id_usuario` int,
 FOREIGN KEY(pk_id_usuario) REFERENCES usuarios(id_usuario),
  PRIMARY KEY (`id_comentario`)) ENGINE = MyISAM;


  INSERT INTO `comentarios` (comentario, dia,hora,pk_id_usuario) VALUES 
  ('muito bom! gostei', '2020-12-07', '20:38' , 2),
  ('lega! gostei', '2020-12-08', '20:30' , 3),
  ('não gostei! ', '2020-12-09', '20:34' , 1),
  ('rasoavel! gostei', '2020-12-10', '20:48' , 2),
  ('execelente! gostei', '2020-12-05', '20:28' , 2);


  CREATE TABLE `produtos` 
( `id_produto` INT NULL DEFAULT NULL AUTO_INCREMENT ,
 `nome_produto` VARCHAR(100) NULL DEFAULT NULL , 
 `descricao` VARCHAR(100) NULL DEFAULT NULL , 
   PRIMARY KEY (`id_produto`)) ENGINE = MyISAM;


