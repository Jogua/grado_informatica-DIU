-- MySQL Script generated by MySQL Workbench
-- 12/13/15 22:56:28
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema diu
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema diu
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `diu` DEFAULT CHARACTER SET utf8 ;
USE `diu` ;

-- -----------------------------------------------------
-- Table `diu`.`empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`empresa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `cif` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NULL,
  `web` VARCHAR(45) NULL,
  `imagen` VARCHAR(45) NOT NULL,
  `idResponsable` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cif_UNIQUE` (`cif` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellidos` VARCHAR(45) NULL,
  `correo` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NULL,
  `idEmpresa` INT NULL,
  `tipo` VARCHAR(45) NOT NULL DEFAULT 'Usuario',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC),
  INDEX `fk_Usuario_Empresa_idx` (`idEmpresa` ASC),
  CONSTRAINT `fk_Usuario_Empresa`
    FOREIGN KEY (`idEmpresa`)
    REFERENCES `diu`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`sala` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `ubicacion` VARCHAR(45) NOT NULL,
  `capacidad` INT NOT NULL,
  `imagen` VARCHAR(45) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`evento` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `fecha` DATETIME NULL,
  `descripcion` TEXT NULL,
  `precio` FLOAT NULL,
  `plazas` INT NULL,
  `idEmpresa` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_Evento_Empresa1_idx` (`idEmpresa` ASC),
  CONSTRAINT `fk_Evento_Empresa1`
    FOREIGN KEY (`idEmpresa`)
    REFERENCES `diu`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`usuario_asiste_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`usuario_asiste_evento` (
  `idUsuario` INT NOT NULL,
  `idEvento` INT NOT NULL,
  PRIMARY KEY (`idUsuario`, `idEvento`),
  INDEX `fk_Usuario_has_Evento_Evento1_idx` (`idEvento` ASC),
  INDEX `fk_Usuario_has_Evento_Usuario1_idx` (`idUsuario` ASC),
  CONSTRAINT `fk_Usuario_has_Evento_Usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `diu`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Evento_Evento1`
    FOREIGN KEY (`idEvento`)
    REFERENCES `diu`.`evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`empresa_usa_sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`empresa_usa_sala` (
  `idEmpresa` INT NOT NULL,
  `idSala` INT NOT NULL,
  PRIMARY KEY (`idEmpresa`, `idSala`),
  INDEX `fk_Empresa_has_Sala_Sala1_idx` (`idSala` ASC),
  INDEX `fk_Empresa_has_Sala_Empresa1_idx` (`idEmpresa` ASC),
  CONSTRAINT `fk_Empresa_has_Sala_Empresa1`
    FOREIGN KEY (`idEmpresa`)
    REFERENCES `diu`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empresa_has_Sala_Sala1`
    FOREIGN KEY (`idSala`)
    REFERENCES `diu`.`sala` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`sala_aloja_evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`sala_aloja_evento` (
  `idEvento` INT NOT NULL,
  `idSala` INT NOT NULL,
  PRIMARY KEY (`idEvento`, `idSala`),
  INDEX `fk_Evento_has_Sala_Sala1_idx` (`idSala` ASC),
  INDEX `fk_Evento_has_Sala_Evento1_idx` (`idEvento` ASC),
  CONSTRAINT `fk_Evento_has_Sala_Evento1`
    FOREIGN KEY (`idEvento`)
    REFERENCES `diu`.`evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_has_Sala_Sala1`
    FOREIGN KEY (`idSala`)
    REFERENCES `diu`.`sala` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
