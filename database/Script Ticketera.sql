-- MySQL Script generated by MySQL Workbench
-- Thu Oct 10 10:13:47 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ticketera
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ticketera
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ticketera` DEFAULT CHARACTER SET utf8 ;
USE `ticketera` ;

-- -----------------------------------------------------
-- Table `ticketera`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`Cliente` (
  `idCliente` INT NOT NULL,
  `cc` BIGINT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`Asiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`Asiento` (
  `fila` VARCHAR(1) NOT NULL,
  `columna` INT NOT NULL,
  `bloque` INT NOT NULL,
  `estado` TINYINT NOT NULL,
  PRIMARY KEY (`fila`, `columna`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`Factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`Factura` (
  `idFactura` INT NOT NULL,
  `precioTotal` VARCHAR(45) NOT NULL,
  `cantidadTotal` VARCHAR(45) NOT NULL,
  `IVA` INT NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`idFactura`),
  INDEX `fk_Factura_Cliente1_idx` (`Cliente_idCliente` ASC),
  CONSTRAINT `fk_Factura_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `ticketera`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`Proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`Proveedor` (
  `idProveedor` INT NOT NULL,
  `nit` BIGINT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `telefono` BIGINT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idProveedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`ciudad` (
  `idciudad` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `imagen` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idciudad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`Categoria` (
  `idCategoria` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `imagen` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`Evento` (
  `idEvento` INT NOT NULL,
  `imagenSitio` VARCHAR(100) NOT NULL,
  `flayer` VARCHAR(100) NOT NULL,
  `logoEvento` VARCHAR(100) NOT NULL,
  `edadMinima` INT(2) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `fechaEvento` DATE NOT NULL,
  `horaEvento` TIME NOT NULL,
  `Proveedor_idProveedor` INT NOT NULL,
  `ciudad_idciudad` INT NOT NULL,
  `Categoria_idCategoria` INT NOT NULL,
  INDEX `fk_Evento_Proveedor1_idx` (`Proveedor_idProveedor` ASC),
  INDEX `fk_Evento_ciudad1_idx` (`ciudad_idciudad` ASC),
  INDEX `fk_Evento_Categoria1_idx` (`Categoria_idCategoria` ASC),
  PRIMARY KEY (`idEvento`),
  CONSTRAINT `fk_Evento_Proveedor1`
    FOREIGN KEY (`Proveedor_idProveedor`)
    REFERENCES `ticketera`.`Proveedor` (`idProveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_ciudad1`
    FOREIGN KEY (`ciudad_idciudad`)
    REFERENCES `ticketera`.`ciudad` (`idciudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_Categoria1`
    FOREIGN KEY (`Categoria_idCategoria`)
    REFERENCES `ticketera`.`Categoria` (`idCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`Zona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`Zona` (
  `idZona` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `color` VARCHAR(16) NOT NULL,
  `Asiento_fila` VARCHAR(1) NOT NULL,
  `Asiento_columna` INT NOT NULL,
  PRIMARY KEY (`idZona`),
  INDEX `fk_Tipo_Asiento1_idx` (`Asiento_fila` ASC, `Asiento_columna` ASC),
  CONSTRAINT `fk_Tipo_Asiento1`
    FOREIGN KEY (`Asiento_fila` , `Asiento_columna`)
    REFERENCES `ticketera`.`Asiento` (`fila` , `columna`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`EventoZona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`EventoZona` (
  `valor` DECIMAL NOT NULL,
  `afoto` INT NOT NULL,
  `Evento_idEvento` INT NOT NULL,
  `Zona_idZona` INT NOT NULL,
  PRIMARY KEY (`Evento_idEvento`, `Zona_idZona`),
  INDEX `fk_EventoZona_Zona1_idx` (`Zona_idZona` ASC),
  CONSTRAINT `fk_EventoZona_Evento1`
    FOREIGN KEY (`Evento_idEvento`)
    REFERENCES `ticketera`.`Evento` (`idEvento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EventoZona_Zona1`
    FOREIGN KEY (`Zona_idZona`)
    REFERENCES `ticketera`.`Zona` (`idZona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketera`.`Ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketera`.`Ticket` (
  `idTicket` INT NOT NULL,
  `valor` DOUBLE NOT NULL,
  `Asiento_fila` VARCHAR(1) NOT NULL,
  `Asiento_columna` INT NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  `Factura_idFactura` INT NOT NULL,
  `EventoZona_Evento_idEvento` INT NOT NULL,
  `EventoZona_Zona_idZona` INT NOT NULL,
  PRIMARY KEY (`idTicket`),
  INDEX `fk_Ticket_Asiento1_idx` (`Asiento_fila` ASC, `Asiento_columna` ASC),
  INDEX `fk_Ticket_Cliente1_idx` (`Cliente_idCliente` ASC),
  INDEX `fk_Ticket_Factura1_idx` (`Factura_idFactura` ASC),
  INDEX `fk_Ticket_EventoZona1_idx` (`EventoZona_Evento_idEvento` ASC, `EventoZona_Zona_idZona` ASC),
  CONSTRAINT `fk_Ticket_Asiento1`
    FOREIGN KEY (`Asiento_fila` , `Asiento_columna`)
    REFERENCES `ticketera`.`Asiento` (`fila` , `columna`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ticket_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `ticketera`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ticket_Factura1`
    FOREIGN KEY (`Factura_idFactura`)
    REFERENCES `ticketera`.`Factura` (`idFactura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ticket_EventoZona1`
    FOREIGN KEY (`EventoZona_Evento_idEvento` , `EventoZona_Zona_idZona`)
    REFERENCES `ticketera`.`EventoZona` (`Evento_idEvento` , `Zona_idZona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;