SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `RH` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

USE `RH`;

CREATE  TABLE IF NOT EXISTS `RH`.`PESSOA` (
  `ID_PESSOA` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Id:' ,
  `NOME` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Name:' ,
  `CPF` VARCHAR(11) NULL DEFAULT NULL COMMENT 'Cpf:' ,
  `DATANASC` DATE NULL DEFAULT NULL COMMENT 'Data Nasc.:' ,
  `ATIVO` CHAR(1) NULL DEFAULT 'S' COMMENT 'Ativo:' ,
  PRIMARY KEY (`ID_PESSOA`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `RH`.`PROFISSAO` (
  `ID_PROFISSAO` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Id:' ,
  `DESCRICAO` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL COMMENT 'Descrição:' ,
  `ATIVO` CHAR(1) NULL DEFAULT 'S' ,
  PRIMARY KEY (`ID_PROFISSAO`) ,
  UNIQUE INDEX `DESCRICAO_UNIQUE` (`DESCRICAO` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `RH`.`VAGA` (
  `ID_VAGA` INT(11) NOT NULL AUTO_INCREMENT ,
  `DESCRICAO` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Desrição:' ,
  `DATAINICIO` DATE NULL DEFAULT NULL COMMENT 'Data ini.:' ,
  `DATAFIM` DATE NULL DEFAULT NULL COMMENT 'Data Fim:' ,
  `SALARIO` DECIMAL(10,0) NULL DEFAULT NULL COMMENT 'Salário:' ,
  `SITUACAO` CHAR(1) NULL DEFAULT NULL COMMENT 'Situação:' ,
  `COD_SETOR` INT(11) NOT NULL COMMENT 'Setor:' ,
  `COD_PROFISSAO` INT(11) NOT NULL COMMENT 'Profissão:' ,
  `ATIVO` CHAR(1) NULL DEFAULT 'S' ,
  PRIMARY KEY (`ID_VAGA`) ,
  INDEX `fk_VAGA_SETOR1` (`COD_SETOR` ASC) ,
  INDEX `fk_VAGA_PROFISSAO1` (`COD_PROFISSAO` ASC) ,
  CONSTRAINT `fk_VAGA_SETOR1`
    FOREIGN KEY (`COD_SETOR` )
    REFERENCES `RH`.`SETOR` (`ID_SETOR` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VAGA_PROFISSAO1`
    FOREIGN KEY (`COD_PROFISSAO` )
    REFERENCES `RH`.`PROFISSAO` (`ID_PROFISSAO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `RH`.`CANDIDATO` (
  `ID_CANDIDATO` INT(11) NOT NULL AUTO_INCREMENT ,
  `COD_PESSOA` INT(11) NOT NULL ,
  `COD_VAGA` INT(11) NOT NULL ,
  `RESULTADO` VARCHAR(45) NULL DEFAULT NULL ,
  `ATIVO` CHAR(1) NULL DEFAULT 'S' ,
  PRIMARY KEY (`ID_CANDIDATO`) ,
  INDEX `fk_CANDIDATOS_PESSOA` (`COD_PESSOA` ASC) ,
  INDEX `fk_CANDIDATO_VAGA1` (`COD_VAGA` ASC) ,
  CONSTRAINT `fk_CANDIDATOS_PESSOA`
    FOREIGN KEY (`COD_PESSOA` )
    REFERENCES `RH`.`PESSOA` (`ID_PESSOA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CANDIDATO_VAGA1`
    FOREIGN KEY (`COD_VAGA` )
    REFERENCES `RH`.`VAGA` (`ID_VAGA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `RH`.`SETOR` (
  `ID_SETOR` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Id:' ,
  `DESCRICAO` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Descrição:' ,
  `DEPARTAMENTO` VARCHAR(45) NULL DEFAULT NULL COMMENT 'Depto:' ,
  `ATIVO` CHAR(1) NULL DEFAULT 'S' ,
  PRIMARY KEY (`ID_SETOR`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `RH`.`USUARIO` (
  `ID_USUARIO` INT(11) NOT NULL AUTO_INCREMENT ,
  `NOME` VARCHAR(45) NOT NULL COMMENT 'Nome:' ,
  `USUARIO` VARCHAR(45) NOT NULL COMMENT 'Login:' ,
  `SENHA` VARCHAR(45) NOT NULL COMMENT 'Senha:' ,
  `ATIVO` CHAR(1) NULL DEFAULT 'S' ,
  PRIMARY KEY (`ID_USUARIO`) ,
  UNIQUE INDEX `USUARIO_UNIQUE` (`USUARIO` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;