-- MySQL Script generated by MySQL Workbench
-- 12/10/15 21:14:48
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
-- Table `diu`.`Empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Empresa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `cif` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  `web` VARCHAR(45) NULL,
  `imagen` VARCHAR(45) NOT NULL,
  `idResponsable` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cif_UNIQUE` (`cif` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `apellidos` VARCHAR(45) NULL,
  `correo` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NULL,
  `Empresa_id` INT NULL,
  `tipo` VARCHAR(45) NOT NULL DEFAULT 'Usuario',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC),
  INDEX `fk_Usuario_Empresa_idx` (`Empresa_id` ASC),
  CONSTRAINT `fk_Usuario_Empresa`
    FOREIGN KEY (`Empresa_id`)
    REFERENCES `diu`.`Empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Sala` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  `ubicacion` VARCHAR(45) NOT NULL,
  `capacidad` INT NOT NULL,
  `imagen` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Evento` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `fecha` DATETIME NULL,
  `descripcion` TEXT NULL,
  `precio` FLOAT NULL,
  `plazas` INT NULL,
  `Empresa_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_Evento_Empresa1_idx` (`Empresa_id` ASC),
  CONSTRAINT `fk_Evento_Empresa1`
    FOREIGN KEY (`Empresa_id`)
    REFERENCES `diu`.`Empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Usuario_asiste_Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Usuario_asiste_Evento` (
  `Usuario_id` INT NOT NULL,
  `Evento_id` INT NOT NULL,
  PRIMARY KEY (`Usuario_id`, `Evento_id`),
  INDEX `fk_Usuario_has_Evento_Evento1_idx` (`Evento_id` ASC),
  INDEX `fk_Usuario_has_Evento_Usuario1_idx` (`Usuario_id` ASC),
  CONSTRAINT `fk_Usuario_has_Evento_Usuario1`
    FOREIGN KEY (`Usuario_id`)
    REFERENCES `diu`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Evento_Evento1`
    FOREIGN KEY (`Evento_id`)
    REFERENCES `diu`.`Evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Empresa_usa_Sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Empresa_usa_Sala` (
  `Empresa_id` INT NOT NULL,
  `Sala_id` INT NOT NULL,
  PRIMARY KEY (`Empresa_id`, `Sala_id`),
  INDEX `fk_Empresa_has_Sala_Sala1_idx` (`Sala_id` ASC),
  INDEX `fk_Empresa_has_Sala_Empresa1_idx` (`Empresa_id` ASC),
  CONSTRAINT `fk_Empresa_has_Sala_Empresa1`
    FOREIGN KEY (`Empresa_id`)
    REFERENCES `diu`.`Empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empresa_has_Sala_Sala1`
    FOREIGN KEY (`Sala_id`)
    REFERENCES `diu`.`Sala` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Sala_aloja_Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Sala_aloja_Evento` (
  `Evento_id` INT NOT NULL,
  `Sala_id` INT NOT NULL,
  PRIMARY KEY (`Evento_id`, `Sala_id`),
  INDEX `fk_Evento_has_Sala_Sala1_idx` (`Sala_id` ASC),
  INDEX `fk_Evento_has_Sala_Evento1_idx` (`Evento_id` ASC),
  CONSTRAINT `fk_Evento_has_Sala_Evento1`
    FOREIGN KEY (`Evento_id`)
    REFERENCES `diu`.`Evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_has_Sala_Sala1`
    FOREIGN KEY (`Sala_id`)
    REFERENCES `diu`.`Sala` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
