-- MySQL Script generated by MySQL Workbench
-- Tue Oct  8 15:01:32 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cliente` (
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
-- Table `mydb`.`Tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tipo` (
  `idTipo` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Asiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Asiento` (
  `fila` VARCHAR(1) NOT NULL,
  `columna` INT NOT NULL,
  `valor` DOUBLE NOT NULL,
  `Tipo_idTipo1` INT NOT NULL,
  PRIMARY KEY (`fila`, `columna`),
  INDEX `fk_Asiento_Tipo1_idx` (`Tipo_idTipo1` ASC),
  CONSTRAINT `fk_Asiento_Tipo1`
    FOREIGN KEY (`Tipo_idTipo1`)
    REFERENCES `mydb`.`Tipo` (`idTipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Proveedor` (
  `idProveedor` INT NOT NULL,
  `nit` BIGINT NOT NULL,
  `usuario` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `telefono` BIGINT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idProveedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ciudad` (
  `idciudad` INT NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idciudad`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Evento` (
  `idEvento` INT NOT NULL,
  `aforo` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `fechaEvento` DATE NOT NULL,
  `horaEvento` TIME NOT NULL,
  `Asiento_fila` VARCHAR(1) NOT NULL,
  `Asiento_columna` INT NOT NULL,
  `Asiento_Tipo_idTipo` INT NOT NULL,
  `Proveedor_idProveedor` INT NOT NULL,
  `ciudad_idciudad` INT NOT NULL,
  PRIMARY KEY (`idEvento`),
  INDEX `fk_Evento_Asiento1_idx` (`Asiento_fila` ASC, `Asiento_columna` ASC, `Asiento_Tipo_idTipo` ASC),
  INDEX `fk_Evento_Proveedor1_idx` (`Proveedor_idProveedor` ASC),
  INDEX `fk_Evento_ciudad1_idx` (`ciudad_idciudad` ASC),
  CONSTRAINT `fk_Evento_Asiento1`
    FOREIGN KEY (`Asiento_fila` , `Asiento_columna`)
    REFERENCES `mydb`.`Asiento` (`fila` , `columna`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_Proveedor1`
    FOREIGN KEY (`Proveedor_idProveedor`)
    REFERENCES `mydb`.`Proveedor` (`idProveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_ciudad1`
    FOREIGN KEY (`ciudad_idciudad`)
    REFERENCES `mydb`.`ciudad` (`idciudad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Ticket` (
  `idTicket` INT NOT NULL,
  `valor` DOUBLE NOT NULL,
  `Asiento_fila` VARCHAR(1) NOT NULL,
  `Asiento_columna` INT NOT NULL,
  `Evento_idEvento` INT NOT NULL,
  PRIMARY KEY (`idTicket`),
  INDEX `fk_Ticket_Asiento1_idx` (`Asiento_fila` ASC, `Asiento_columna` ASC),
  INDEX `fk_Ticket_Evento1_idx` (`Evento_idEvento` ASC),
  CONSTRAINT `fk_Ticket_Asiento1`
    FOREIGN KEY (`Asiento_fila` , `Asiento_columna`)
    REFERENCES `mydb`.`Asiento` (`fila` , `columna`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ticket_Evento1`
    FOREIGN KEY (`Evento_idEvento`)
    REFERENCES `mydb`.`Evento` (`idEvento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Factura` (
  `idFactura` INT NOT NULL,
  `precioTotal` VARCHAR(45) NOT NULL,
  `cantidadTotal` VARCHAR(45) NOT NULL,
  `IVA` INT NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`idFactura`),
  INDEX `fk_Factura_Cliente1_idx` (`Cliente_idCliente` ASC),
  CONSTRAINT `fk_Factura_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `mydb`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Carrito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Carrito` (
  `cantidad` INT NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  `Ticket_idTicket` INT NOT NULL,
  PRIMARY KEY (`Cliente_idCliente`, `Ticket_idTicket`),
  INDEX `fk_Carrito_Ticket1_idx` (`Ticket_idTicket` ASC),
  CONSTRAINT `fk_Carrito_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `mydb`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Carrito_Ticket1`
    FOREIGN KEY (`Ticket_idTicket`)
    REFERENCES `mydb`.`Ticket` (`idTicket`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`TicketFactura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`TicketFactura` (
  `precioVenta` DOUBLE NOT NULL,
  `Factura_idFactura` INT NOT NULL,
  `Ticket_idTicket` INT NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`Factura_idFactura`, `Ticket_idTicket`, `Cliente_idCliente`),
  INDEX `fk_TicketFactura_Ticket1_idx` (`Ticket_idTicket` ASC),
  INDEX `fk_TicketFactura_Cliente1_idx` (`Cliente_idCliente` ASC),
  CONSTRAINT `fk_TicketFactura_Factura1`
    FOREIGN KEY (`Factura_idFactura`)
    REFERENCES `mydb`.`Factura` (`idFactura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TicketFactura_Ticket1`
    FOREIGN KEY (`Ticket_idTicket`)
    REFERENCES `mydb`.`Ticket` (`idTicket`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TicketFactura_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `mydb`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
