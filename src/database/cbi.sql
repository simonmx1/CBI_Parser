-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2019 at 05:32 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbi_movements`
--

-- --------------------------------------------------------

--
-- Table structure for table `cbi`
--

CREATE TABLE `cbi` (
  `cbi_id` int(11) NOT NULL,
  `cbi_doc` longblob,
  `cbi_date` date NOT NULL,
  `cbi_type` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `movimenti_completi`
--

CREATE TABLE `movimenti_completi` (
  `mc_id` int(11) NOT NULL,
  `mc_banca` varchar(50) DEFAULT NULL,
  `mc_data_valuta` date NOT NULL,
  `mc_data_contabile` date NOT NULL,
  `mc_segno` varchar(1) NOT NULL DEFAULT 'C',
  `mc_importo` decimal(14,2) NOT NULL DEFAULT '0.00',
  `mc_riferimento_banca` varchar(16) NOT NULL,
  `mc_tipo_riferimento_cliente` varchar(9) DEFAULT NULL,
  `mc_descrizione_movimento` text,
  `mc_codice_fiscale_ordinante` varchar(16) DEFAULT NULL,
  `mc_cliente_ordinante` varchar(110) DEFAULT NULL,
  `mc_localita` varchar(40) DEFAULT NULL,
  `mc_indirizzo_ordinante` varchar(50) DEFAULT NULL,
  `mc_IBAN_ordinante` varchar(34) DEFAULT NULL,
  `mc_estero` tinyint(1) DEFAULT NULL,
  `mc_completato` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='movimenti bancari con tutte le informazioni necessarie';

-- --------------------------------------------------------

--
-- Table structure for table `pagamenti_SCT`
--

CREATE TABLE `pagamenti_SCT` (
  `p_id` int(11) NOT NULL,
  `p_IBAN_deb` varchar(27) NOT NULL,
  `p_IBAN_cre` varchar(27) NOT NULL,
  `p_importo` decimal(15,2) NOT NULL,
  `p_data_creazione` datetime DEFAULT NULL,
  `p_data_esecuzione` date DEFAULT NULL,
  `p_codiceCUC` varchar(8) NOT NULL,
  `p_nome_azienda_deb` varchar(40) DEFAULT NULL,
  `p_nome_azienda_cre` varchar(40) DEFAULT NULL,
  `p_codifica_fiscale_deb` varchar(11) NOT NULL,
  `p_codifica_fiscale_cre` varchar(11) NOT NULL,
  `p_messaggio` varchar(50) DEFAULT NULL,
  `p_dist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_coda`
--

CREATE TABLE `record_coda` (
  `rc_id` int(11) NOT NULL,
  `rc_record` tinyblob,
  `rc_date` date NOT NULL,
  `rc_cbi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_liquidita_future`
--

CREATE TABLE `record_liquidita_future` (
  `rlf_id` int(11) NOT NULL,
  `rlf_record` tinyblob,
  `rlf_date` date NOT NULL,
  `rlf_cbi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_movement`
--

CREATE TABLE `record_movement` (
  `rm_id` int(11) NOT NULL,
  `rm_record` tinyblob,
  `rm_date` date NOT NULL,
  `rm_cbi` int(11) NOT NULL,
  `rm_transferred` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_movement_info`
--

CREATE TABLE `record_movement_info` (
  `rmi_id` int(11) NOT NULL,
  `rmi_record` tinyblob,
  `rmi_date` date NOT NULL,
  `rmi_cbi` int(11) NOT NULL,
  `rmi_movement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_saldo_finale`
--

CREATE TABLE `record_saldo_finale` (
  `rsf_id` int(11) NOT NULL,
  `rsf_record` tinyblob,
  `rsf_date` date NOT NULL,
  `rsf_cbi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_saldo_iniziale`
--

CREATE TABLE `record_saldo_iniziale` (
  `rsi_id` int(11) NOT NULL,
  `rsi_record` tinyblob,
  `rsi_date` date NOT NULL,
  `rsi_cbi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `record_testa`
--

CREATE TABLE `record_testa` (
  `rt_id` int(11) NOT NULL,
  `rt_record` tinyblob,
  `rt_date` date NOT NULL,
  `rt_cbi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cbi`
--
ALTER TABLE `cbi`
  ADD PRIMARY KEY (`cbi_id`);

--
-- Indexes for table `movimenti_completi`
--
ALTER TABLE `movimenti_completi`
  ADD PRIMARY KEY (`mc_id`);

--
-- Indexes for table `pagamenti_SCT`
--
ALTER TABLE `pagamenti_SCT`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `record_coda`
--
ALTER TABLE `record_coda`
  ADD PRIMARY KEY (`rc_id`),
  ADD KEY `cbi_r_coda` (`rc_cbi`);

--
-- Indexes for table `record_liquidita_future`
--
ALTER TABLE `record_liquidita_future`
  ADD PRIMARY KEY (`rlf_id`),
  ADD KEY `rlf_cbi_cbi` (`rlf_cbi`);

--
-- Indexes for table `record_movement`
--
ALTER TABLE `record_movement`
  ADD PRIMARY KEY (`rm_id`),
  ADD KEY `cbi_r_mov` (`rm_cbi`);

--
-- Indexes for table `record_movement_info`
--
ALTER TABLE `record_movement_info`
  ADD PRIMARY KEY (`rmi_id`),
  ADD KEY `cbi_r_mov_inf` (`rmi_cbi`),
  ADD KEY `r_mov_mov_inf` (`rmi_movement`);

--
-- Indexes for table `record_saldo_finale`
--
ALTER TABLE `record_saldo_finale`
  ADD PRIMARY KEY (`rsf_id`),
  ADD KEY `cbi_saldo_f` (`rsf_cbi`) USING BTREE;

--
-- Indexes for table `record_saldo_iniziale`
--
ALTER TABLE `record_saldo_iniziale`
  ADD PRIMARY KEY (`rsi_id`),
  ADD KEY `cbi_saldo_i` (`rsi_cbi`);

--
-- Indexes for table `record_testa`
--
ALTER TABLE `record_testa`
  ADD PRIMARY KEY (`rt_id`),
  ADD KEY `cbi_r_test` (`rt_cbi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cbi`
--
ALTER TABLE `cbi`
  MODIFY `cbi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movimenti_completi`
--
ALTER TABLE `movimenti_completi`
  MODIFY `mc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pagamenti_SCT`
--
ALTER TABLE `pagamenti_SCT`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_coda`
--
ALTER TABLE `record_coda`
  MODIFY `rc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_liquidita_future`
--
ALTER TABLE `record_liquidita_future`
  MODIFY `rlf_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_movement`
--
ALTER TABLE `record_movement`
  MODIFY `rm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_movement_info`
--
ALTER TABLE `record_movement_info`
  MODIFY `rmi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_saldo_finale`
--
ALTER TABLE `record_saldo_finale`
  MODIFY `rsf_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_saldo_iniziale`
--
ALTER TABLE `record_saldo_iniziale`
  MODIFY `rsi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_testa`
--
ALTER TABLE `record_testa`
  MODIFY `rt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `record_coda`
--
ALTER TABLE `record_coda`
  ADD CONSTRAINT `cbi_r_coda` FOREIGN KEY (`rc_cbi`) REFERENCES `cbi` (`cbi_id`) ON DELETE CASCADE;

--
-- Constraints for table `record_liquidita_future`
--
ALTER TABLE `record_liquidita_future`
  ADD CONSTRAINT `rlf_cbi_cbi` FOREIGN KEY (`rlf_cbi`) REFERENCES `cbi` (`cbi_id`) ON DELETE CASCADE;

--
-- Constraints for table `record_movement`
--
ALTER TABLE `record_movement`
  ADD CONSTRAINT `cbi_r_mov` FOREIGN KEY (`rm_cbi`) REFERENCES `cbi` (`cbi_id`) ON DELETE CASCADE;

--
-- Constraints for table `record_movement_info`
--
ALTER TABLE `record_movement_info`
  ADD CONSTRAINT `cbi_r_mov_inf` FOREIGN KEY (`rmi_cbi`) REFERENCES `cbi` (`cbi_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `r_mov_mov_inf` FOREIGN KEY (`rmi_movement`) REFERENCES `record_movement` (`rm_id`) ON DELETE CASCADE;

--
-- Constraints for table `record_saldo_finale`
--
ALTER TABLE `record_saldo_finale`
  ADD CONSTRAINT `cbi_saldo_f` FOREIGN KEY (`rsf_cbi`) REFERENCES `cbi` (`cbi_id`) ON DELETE CASCADE;

--
-- Constraints for table `record_saldo_iniziale`
--
ALTER TABLE `record_saldo_iniziale`
  ADD CONSTRAINT `cbi_saldo_i` FOREIGN KEY (`rsi_cbi`) REFERENCES `cbi` (`cbi_id`) ON DELETE CASCADE;

--
-- Constraints for table `record_testa`
--
ALTER TABLE `record_testa`
  ADD CONSTRAINT `cbi_r_test` FOREIGN KEY (`rt_cbi`) REFERENCES `cbi` (`cbi_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
