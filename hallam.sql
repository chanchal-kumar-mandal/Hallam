-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2017 at 08:14 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hallam`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `individual_id`, `company_id`, `address`, `description`) VALUES
(3, 2, NULL, 'sq', 'ssasa'),
(4, 3, NULL, 'sq', 'ssasa'),
(5, 4, NULL, 'cdsdas', 'dsdc'),
(6, 5, NULL, 'teha', 'bgfgd'),
(7, 6, NULL, 'fbjbhjbhfvd', 'Permanent'),
(8, 7, NULL, 'bfd', 'rb'),
(9, 8, NULL, 'bfd', 'rb'),
(10, 9, NULL, 'bfd', 'rb'),
(11, 10, NULL, 'bfd', 'rb'),
(12, 16, NULL, 'bfd', 'rb'),
(13, 17, NULL, 'bfd', 'rb'),
(14, 18, NULL, 'VSD', 'dcsv'),
(15, 19, NULL, 'efa', 'sdf'),
(16, 20, NULL, 'Kolkata', 'Home'),
(26, 30, NULL, 'kolkata', 'Office1'),
(27, 31, NULL, 'cvxvx', 'vxvx'),
(28, 32, NULL, ' vvbb', '');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `client_id` varchar(200) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `registration_number` bigint(10) NOT NULL,
  `registration_date` date NOT NULL,
  `authentication_code` varchar(8) NOT NULL,
  `trade_description` varchar(250) NOT NULL,
  `registered_address` varchar(250) NOT NULL,
  `utr` bigint(10) NOT NULL,
  `year_end` date NOT NULL,
  `directors` varchar(200) NOT NULL,
  `no_of_shares` int(11) NOT NULL,
  `aggregate_nominal_value` int(11) NOT NULL,
  `share_class` varchar(100) NOT NULL,
  `shares_issued` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `amount_unpaid` int(11) NOT NULL,
  `total_aggregate_value` int(11) NOT NULL,
  `paye_office_code` varchar(8) NOT NULL,
  `paye_reference` varchar(100) NOT NULL,
  `vat_registered` enum('Yes','No') NOT NULL,
  `main_contact` int(11) NOT NULL,
  `reference` enum('HJ','MSI') NOT NULL,
  `annual_return_date` date NOT NULL,
  `accountancy_fee` int(8) NOT NULL,
  `registered_office_charge` enum('Yes','No') NOT NULL,
  `registered_office_charge_fee` int(8) NOT NULL,
  `payroll_charge` enum('Yes','No') NOT NULL,
  `payroll_charge_fee` int(8) NOT NULL,
  `payroll_required` enum('Yes','No') NOT NULL DEFAULT 'No',
  `no_of_shareholder` int(4) NOT NULL,
  `no_of_note` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `client_id`, `company_name`, `registration_number`, `registration_date`, `authentication_code`, `trade_description`, `registered_address`, `utr`, `year_end`, `directors`, `no_of_shares`, `aggregate_nominal_value`, `share_class`, `shares_issued`, `amount_paid`, `amount_unpaid`, `total_aggregate_value`, `paye_office_code`, `paye_reference`, `vat_registered`, `main_contact`, `reference`, `annual_return_date`, `accountancy_fee`, `registered_office_charge`, `registered_office_charge_fee`, `payroll_charge`, `payroll_charge_fee`, `payroll_required`, `no_of_shareholder`, `no_of_note`) VALUES
(1, '22', 'ABC Pvt Ltd', 2290384, '2015-01-01', '187FVHJH', 'This is company description.', 'Studio 103\r\nThe Business Centre\r\n61 Wellfield Road\r\nRoath\r\nCardiff\r\n', 59685469586, '2014-09-30', '', 14, 15, 'This is a share class', 55, 50000, 20000, 125000, 'LINK654', 'Linkedin', 'Yes', 1, 'MSI', '2016-08-10', 550, 'Yes', 500, 'Yes', 300, 'Yes', 2, 2),
(2, '23', 'MNC Ltd', 458965646, '2016-11-17', '54544', 'This is trade description', 'kolkata', 546464, '2016-02-29', '', 0, 0, '', 0, 0, 0, 0, '', '', 'Yes', 1, 'MSI', '2016-11-08', 62161, 'Yes', 146354, 'Yes', 151, 'No', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies_account_submission_years`
--

CREATE TABLE `companies_account_submission_years` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `account_submitted_to_hmrc_years` text NOT NULL,
  `account_submitted_to_companies_house_years` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies_account_submission_years`
--

INSERT INTO `companies_account_submission_years` (`id`, `company_id`, `account_submitted_to_hmrc_years`, `account_submitted_to_companies_house_years`) VALUES
(1, 1, '30-09-2014', '30-09-2015');

-- --------------------------------------------------------

--
-- Table structure for table `companies_directors`
--

CREATE TABLE `companies_directors` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `individual_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies_directors`
--

INSERT INTO `companies_directors` (`id`, `company_id`, `individual_id`) VALUES
(79, 2, 1),
(95, 1, 1),
(96, 1, 20),
(98, 1, 32);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'Afghanistan'),
(2, 'Australia'),
(3, 'Belgium'),
(4, 'Brazil'),
(5, 'Canada'),
(6, 'China'),
(7, 'Colombia'),
(8, 'Denmark'),
(9, 'Egypt'),
(10, 'France'),
(11, 'Greece'),
(12, 'India'),
(13, 'Italy'),
(14, 'Japan'),
(15, 'Kenya'),
(16, 'Malaysia'),
(17, 'Myanmar'),
(18, 'Nepal'),
(19, 'New Zealand'),
(20, 'Oman'),
(21, 'Pakistan'),
(22, 'Portugal'),
(23, 'Qatar'),
(24, 'Russia'),
(25, 'Singapore'),
(26, 'South Africa'),
(27, 'South Korea'),
(28, 'Spain'),
(29, 'Sri Lanka'),
(30, 'Switzerland'),
(31, 'Thailand'),
(32, 'Turkey'),
(33, 'Uganda'),
(34, 'Ukraine'),
(35, 'United Arab Emirates (UAE)'),
(36, 'United Kingdom (UK)'),
(37, 'United States of America (USA)'),
(38, 'Uruguay'),
(39, 'Uzbekistan'),
(40, 'Vatican City (Holy See)'),
(41, 'Venezuela'),
(42, 'Vietnam'),
(43, 'Yemen'),
(44, 'Zambia'),
(45, 'Zimbabwe'),
(46, 'England');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `individual_id`, `company_id`, `email`, `description`) VALUES
(1, 1, NULL, 'john1@gmail.com', ''),
(2, 1, NULL, 'john2@yahoo.com', ''),
(3, 2, NULL, 'jack@gmail.com', ''),
(4, 3, NULL, 'jack@gmail.com', ''),
(5, 4, NULL, 'first@yhoo.com', ''),
(6, 5, NULL, 'first@gmail.com', ''),
(7, 6, NULL, 'jack@gmail.com', ''),
(8, 7, NULL, 'first@yhoo.com', ''),
(9, 8, NULL, 'first@yhoo.com', ''),
(10, 9, NULL, 'first@yhoo.com', ''),
(11, 10, NULL, 'first@yhoo.com', ''),
(12, 16, NULL, 'first@yhoo.com', ''),
(13, 17, NULL, 'first@yhoo.com', ''),
(14, 18, NULL, 'jack@gmail.com', ''),
(15, 19, NULL, 'first@yhoo.com', ''),
(16, 20, NULL, 'jack@gmail.com', ''),
(26, 30, NULL, '', ''),
(27, 31, NULL, 'jack@gmail.com', ''),
(28, 32, NULL, 'jack@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `emails_sent_to_clients`
--

CREATE TABLE `emails_sent_to_clients` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  `purpose` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emails_sent_to_clients`
--

INSERT INTO `emails_sent_to_clients` (`id`, `individual_id`, `company_id`, `subject`, `message`, `datetime`, `status`, `purpose`) VALUES
(1, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : January 2014 . Thank you very much John Doe.', '2016-11-01 07:58:39', '0', 'Individual VAT Submitted'),
(2, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : April 2014 . Thank you very much John Doe.', '2016-11-01 07:58:40', '0', 'Individual VAT Submitted'),
(3, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : October 2014 . Thank you very much John Doe.', '2016-11-01 07:58:41', '0', 'Individual VAT Submitted'),
(4, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : July 2014 . Thank you very much John Doe.', '2016-11-01 07:59:03', '0', 'Individual VAT Submitted'),
(5, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : February 2014 . Thank you very much John Doe.', '2016-11-01 08:05:05', '0', 'Individual VAT Submitted'),
(6, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : May 2014 . Thank you very much John Doe.', '2016-11-01 08:05:06', '0', 'Individual VAT Submitted'),
(7, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : August 2014 . Thank you very much John Doe.', '2016-11-01 08:05:07', '0', 'Individual VAT Submitted'),
(8, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : February 2014 . Thank you very much John Doe.', '2016-11-01 08:05:44', '0', 'Individual VAT Submitted'),
(9, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : May 2014 . Thank you very much John Doe.', '2016-11-01 08:05:45', '0', 'Individual VAT Submitted'),
(10, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : August 2014 . Thank you very much John Doe.', '2016-11-01 08:05:46', '0', 'Individual VAT Submitted'),
(11, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : February 2014 . Thank you very much John Doe.', '2016-11-01 08:07:48', '0', 'Individual VAT Submitted'),
(12, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : May 2014 . Thank you very much John Doe.', '2016-11-01 08:07:50', '0', 'Individual VAT Submitted'),
(13, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : August 2014 . Thank you very much John Doe.', '2016-11-01 08:07:51', '0', 'Individual VAT Submitted'),
(14, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : February 2014 . Thank you very much John Doe.', '2016-11-01 08:17:42', '0', 'Individual VAT Submitted'),
(15, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : May 2014 . Thank you very much John Doe.', '2016-11-01 08:17:43', '0', 'Individual VAT Submitted'),
(16, 1, NULL, 'VAT SUBMISSION', 'Dear John, \r\n \r\n \r\n VAT is submitted for quarter month : August 2014 . Thank you very much John Doe.', '2016-11-01 08:17:44', '0', 'Individual VAT Submitted'),
(17, NULL, 1, 'VAT SUBMISSION', 'Dear ABC Pvt Ltd, \r\n \r\n \r\n VAT is submitted for quarter month : August 2014 . Thank you very much ABC Pvt Ltd.', '2016-11-01 09:21:39', '0', 'Company VAT Submitted'),
(18, NULL, 1, 'VAT SUBMISSION', 'Dear ABC Pvt Ltd, \r\n \r\n \r\n VAT is submitted for quarter month : November 2014 . Thank you very much ABC Pvt Ltd.', '2016-11-01 09:21:40', '0', 'Company VAT Submitted');

-- --------------------------------------------------------

--
-- Table structure for table `individuals`
--

CREATE TABLE `individuals` (
  `id` int(11) NOT NULL,
  `client_id` varchar(200) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `maiden_name` varchar(100) NOT NULL,
  `address1` text NOT NULL,
  `no_of_address` int(4) NOT NULL,
  `postcode` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL,
  `uk_address` text NOT NULL,
  `uk_address_description` varchar(200) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `no_of_telephone` int(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_of_email` int(4) NOT NULL,
  `company_director_of` int(11) DEFAULT NULL,
  `national_insurance` varchar(200) NOT NULL,
  `dob` date DEFAULT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `nationality` varchar(100) NOT NULL,
  `passport_no` varchar(100) NOT NULL,
  `marital_status` enum('Single','Married','Cohabiting','Divorced','Widowed','Separated','Not disclosed') NOT NULL DEFAULT 'Not disclosed',
  `date_of_marriage` date DEFAULT NULL,
  `place_of_marriage` varchar(100) NOT NULL,
  `active` enum('Yes','No') NOT NULL,
  `on_stop` enum('Yes','No') NOT NULL,
  `engagement_start_date` date DEFAULT NULL,
  `engagement_end_date` date DEFAULT NULL,
  `p_firstname` varchar(100) NOT NULL,
  `p_surname` varchar(100) NOT NULL,
  `p_maiden_name` varchar(100) NOT NULL,
  `p_address` text NOT NULL,
  `p_postcode` varchar(100) NOT NULL,
  `p_country_id` int(11) NOT NULL,
  `p_telephone` varchar(100) NOT NULL,
  `p_email` varchar(100) NOT NULL,
  `p_dob` date DEFAULT NULL,
  `p_place_of_birth` varchar(100) NOT NULL,
  `p_date_of_death` date DEFAULT NULL,
  `p_nationality` varchar(100) NOT NULL,
  `p_passport_no` varchar(100) NOT NULL,
  `first_tax_year_due` varchar(10) NOT NULL,
  `requires_tax_return` enum('Yes','No') NOT NULL DEFAULT 'No',
  `utr` bigint(10) DEFAULT NULL,
  `vat_registered` enum('Yes','No') NOT NULL DEFAULT 'No',
  `business_commencement_date` date DEFAULT NULL,
  `other_paid_employment` enum('Yes','No') NOT NULL DEFAULT 'No',
  `first_year_p45_p60` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `subsequent_years_p45_p60` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `fee` int(11) NOT NULL,
  `fee_type` enum('Monthly','Annual') NOT NULL,
  `reference` varchar(150) NOT NULL,
  `uk_sixtyfour_eight_to_hmrc` enum('Yes','No') NOT NULL DEFAULT 'No',
  `uk_sixtyfour_eight_to_hmrc_date` date NOT NULL,
  `payroll_required` enum('Yes','No') NOT NULL DEFAULT 'No',
  `paye_office_code` varchar(8) NOT NULL,
  `paye_reference` varchar(100) NOT NULL,
  `social_security_no` varchar(100) NOT NULL,
  `siret_number` varchar(100) NOT NULL,
  `business_regime` varchar(100) NOT NULL,
  `f_business_commencement_date` date DEFAULT NULL,
  `f_business_end_date` date DEFAULT NULL,
  `f_first_tax_year_due` varchar(10) NOT NULL,
  `f_fee` int(11) NOT NULL,
  `f_prvious_address` text NOT NULL,
  `fiscal_no_first` varchar(50) NOT NULL,
  `fiscal_no_second` varchar(50) NOT NULL,
  `fip_no` varchar(50) NOT NULL,
  `fd5` enum('Yes','No') NOT NULL DEFAULT 'No',
  `p85` enum('Yes','No') NOT NULL DEFAULT 'No',
  `nrl1` enum('Yes','No') NOT NULL DEFAULT 'No',
  `s1` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sixtyfour_eight_to_hmrc` enum('Yes','No') NOT NULL DEFAULT 'No',
  `fd5_date` date NOT NULL,
  `p85_date` date NOT NULL,
  `nrl1_date` date NOT NULL,
  `s1_date` date NOT NULL,
  `sixtyfour_eight_to_hmrc_date` date NOT NULL,
  `teledeclarant_number` varchar(250) NOT NULL,
  `service_impots_particulier_password` varchar(250) NOT NULL,
  `cdi_address` text NOT NULL,
  `no_of_note` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `individuals`
--

INSERT INTO `individuals` (`id`, `client_id`, `firstname`, `surname`, `maiden_name`, `address1`, `no_of_address`, `postcode`, `country_id`, `uk_address`, `uk_address_description`, `telephone`, `no_of_telephone`, `email`, `no_of_email`, `company_director_of`, `national_insurance`, `dob`, `place_of_birth`, `date_of_death`, `nationality`, `passport_no`, `marital_status`, `date_of_marriage`, `place_of_marriage`, `active`, `on_stop`, `engagement_start_date`, `engagement_end_date`, `p_firstname`, `p_surname`, `p_maiden_name`, `p_address`, `p_postcode`, `p_country_id`, `p_telephone`, `p_email`, `p_dob`, `p_place_of_birth`, `p_date_of_death`, `p_nationality`, `p_passport_no`, `first_tax_year_due`, `requires_tax_return`, `utr`, `vat_registered`, `business_commencement_date`, `other_paid_employment`, `first_year_p45_p60`, `subsequent_years_p45_p60`, `fee`, `fee_type`, `reference`, `uk_sixtyfour_eight_to_hmrc`, `uk_sixtyfour_eight_to_hmrc_date`, `payroll_required`, `paye_office_code`, `paye_reference`, `social_security_no`, `siret_number`, `business_regime`, `f_business_commencement_date`, `f_business_end_date`, `f_first_tax_year_due`, `f_fee`, `f_prvious_address`, `fiscal_no_first`, `fiscal_no_second`, `fip_no`, `fd5`, `p85`, `nrl1`, `s1`, `sixtyfour_eight_to_hmrc`, `fd5_date`, `p85_date`, `nrl1_date`, `s1_date`, `sixtyfour_eight_to_hmrc_date`, `teledeclarant_number`, `service_impots_particulier_password`, `cdi_address`, `no_of_note`) VALUES
(1, '88', 'John', 'Doe', 'Pitt', '', 0, 'B3 2EW', 46, 'Box 777\r\n91 Western Road\r\nBrighton\r\nEast Sussex\r\nEngland\r\nBN1 2NW\r\n', 'Before 2010', '', 2, '', 2, NULL, 'QQ123456C ', '1990-02-15', 'London', '1970-01-01', 'English', 'A12 34567', 'Married', '2016-02-14', 'London', 'Yes', 'No', '2014-06-01', '1970-01-01', 'Amy', 'Jackson', 'Jolie', 'Unit 14\r\n3 Edgar Buildings\r\nGeorge Street\r\nBath\r\nEngland\r\nBA1 2FJ\r\n', 'BA1 2FJ ', 46, '+44 20 7123 4567', 'amy1@yahoo.com', '1991-10-04', 'London', '1970-01-01', 'British', '0262112058', '2011/12', 'No', 89522247074, 'Yes', '2015-07-21', 'Yes', 'Yes', 'Yes', 1500, 'Monthly', 'MSI', 'No', '0000-00-00', 'No', '', '', '535-40-8522', '123 456 789 00123', 'The regime in this office is hard work and more hard work.', '2016-06-07', '1970-01-01', '2013/14', 750, 'Room 67\r\n14 Tottenham Court Road\r\nLondon\r\nEngland\r\nW1T 1JY', 'MRTMTT25D09F205Z ', 'MLLSNT82P65Z404U ', '48456', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '25 Tottenham Court Road\r\nLondon\r\nEngland\r\nT1K 3JY', 3),
(20, '56', 'Raveer', 'Kapoor', 'Ranvijay', '', 1, '96546', 2, 'xcdc', 'faas', '', 1, '', 1, NULL, '', '2016-10-11', '', '2016-10-20', '', '', 'Single', '0000-00-00', '', 'Yes', 'No', '2016-10-05', '0000-00-00', '', '', '', '', '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '', 'No', 0, 'No', '0000-00-00', 'No', 'Yes', 'Yes', 0, 'Monthly', 'HJ', 'No', '0000-00-00', 'No', '', '', '', '', '', '0000-00-00', '0000-00-00', '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', 2),
(30, '222', 'Jacky', 'Bhagnani', 'Jack', '', 1, '7000101', 15, '', '', '', 1, '', 1, NULL, '', '2016-10-11', '', '0000-00-00', '', '6964jghj', 'Married', '2016-11-08', '', 'Yes', 'No', '0000-00-00', '0000-00-00', '', '', '', '', '', 0, '', '', '0000-00-00', '', '0000-00-00', '', '', '2013', 'No', 0, 'No', '0000-00-00', 'No', 'Yes', 'Yes', 0, 'Monthly', 'HJ', 'Yes', '2016-11-07', 'No', '', '', '', '', '', '0000-00-00', '0000-00-00', '2010', 0, '', '', '', '', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '2016-11-02', '2016-11-03', '2016-11-04', '2016-11-05', '2016-11-06', 'dfs', 'fvfvfvfvfvfvfvfv', '', 2),
(31, 'vcxxcv', 'cx', 'cvxcxcx', 'cxcv', '', 1, '', 17, '', '', '', 1, '', 1, NULL, '', '2016-11-02', 'Mumbai', '0000-00-00', 'Indian', '6964jghj', 'Married', '2016-11-14', 'Mumbai', 'Yes', 'Yes', '0000-00-00', '0000-00-00', '', 'cvxcxcx', '', 'cvxvx', '', 17, '99999999', 'jack@gmail.com', '0000-00-00', '', '0000-00-00', '', '', '', 'No', 0, 'No', '0000-00-00', 'No', 'Yes', 'Yes', 0, 'Monthly', 'HJ', 'No', '0000-00-00', 'No', '', '', '', '', '', '0000-00-00', '0000-00-00', '', 0, '', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', 1),
(32, '333', 'Jacky', 'Bhagnani', 'Jack', '', 1, '', 13, '', '', '', 1, '', 1, NULL, '', '2003-01-22', 'Mumbai', '0000-00-00', 'Indian', '6964jghj', 'Cohabiting', '2016-11-15', 'Mumbai', 'No', 'No', '0000-00-00', '0000-00-00', '', 'Bhagnani', '', ' vvbb', '', 13, '5765635', 'jack@gmail.com', '0000-00-00', '', '0000-00-00', '', '', '', 'No', 0, 'No', '0000-00-00', 'No', 'Yes', 'Yes', 0, 'Monthly', 'HJ', 'No', '0000-00-00', 'No', '', '', '', '', '', '0000-00-00', '0000-00-00', '', 0, '', '', '', '', 'No', 'No', 'No', 'No', 'No', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `individuals_tax_return_years`
--

CREATE TABLE `individuals_tax_return_years` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) NOT NULL,
  `tax_return_years` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `individuals_tax_return_years`
--

INSERT INTO `individuals_tax_return_years` (`id`, `individual_id`, `tax_return_years`) VALUES
(6, 30, '2013,2015,2014');

-- --------------------------------------------------------

--
-- Table structure for table `individuals_tax_return_years_french`
--

CREATE TABLE `individuals_tax_return_years_french` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) NOT NULL,
  `tax_return_years` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `individuals_tax_return_years_french`
--

INSERT INTO `individuals_tax_return_years_french` (`id`, `individual_id`, `tax_return_years`) VALUES
(4, 30, '2010,2013,2015,2011');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `note_title` varchar(250) NOT NULL,
  `note` text NOT NULL,
  `note_creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `individual_id`, `company_id`, `note_title`, `note`, `note_creation_date`) VALUES
(1, 1, NULL, '', 'This is 1st note.   \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis tellus ac eleifend egestas. Curabitur ac neque at diam placerat aliquet. Nulla sit amet lacus eget dolor fermentum eleifend quis nec lorem. Proin scelerisque, nibh a lobortis vehicula, dolor diam pretium orci, eu malesuada arcu justo non massa. Vivamus vel elementum ante. Aliquam erat volutpat. Aliquam tempus commodo commodo.\r\n                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '2016-10-18'),
(2, 1, NULL, '', 'This is 2nd note.\r\nMauris ultrices, risus sed convallis aliquam, purus purus tempus nisl, a finibus ex est a nulla. In lobortis volutpat eros in congue. Duis fermentum, enim id euismod feugiat, ipsum enim pellentesque leo, in rutrum orci felis ac ipsum. Aliquam odio nibh, facilisis sit amet dui dapibus, mollis tincidunt sem. In bibendum magna metus, non vestibulum velit sagittis laoreet. Aenean eget vestibulum augue, sit amet vehicula nulla. Cras mollis at dolor ut venenatis. In eu justo elit. Suspendisse laoreet tortor accumsan vehicula mollis. Aenean ac commodo nulla.   \r\n                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '2016-10-18'),
(3, 1, NULL, '', 'This is 3rd note.   \r\nProin posuere arcu libero, aliquet maximus metus ornare at. Aenean non convallis nibh, et tristique nibh. Morbi sit amet neque risus. Vestibulum turpis lectus, egestas eget laoreet vitae, pharetra id diam. Morbi a rutrum purus. Maecenas condimentum tempus fringilla. Morbi in orci fermentum, vestibulum libero id, commodo eros.\r\n                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '2016-10-18'),
(4, 20, NULL, '', 'This is 1st note.   \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis tellus ac eleifend egestas. Curabitur ac neque at diam placerat aliquet. Nulla sit amet lacus eget dolor fermentum eleifend quis nec lorem. Proin scelerisque, nibh a lobortis vehicula, dolor diam pretium orci, eu malesuada arcu justo non massa. Vivamus vel elementum ante. Aliquam erat volutpat. Aliquam tempus commodo commodo.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', '2016-10-19'),
(7, 20, NULL, '', 'This is 2nd note.   \r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis tellus ac eleifend egestas. Curabitur ac neque at diam placerat aliquet. Nulla sit amet lacus eget dolor fermentum eleifend quis nec lorem. Proin scelerisque, nibh a lobortis vehicula, dolor diam pretium orci, eu malesuada arcu justo non massa. Vivamus vel elementum ante. Aliquam erat volutpat. Aliquam tempus commodo commodo.                                                                                                                                                                                                                                                                                                                                                    ', '2016-10-19'),
(18, 30, NULL, 'ABC', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis tellus ac eleifend egestas. Curabitur ac neque at diam placerat aliquet. Nulla sit amet lacus eget dolor fermentum eleifend quis nec lorem. Proin scelerisque, nibh a lobortis vehicula, dolor diam pretium orci, eu malesuada arcu justo non massa. Vivamus vel elementum ante. Aliquam erat volutpat. Aliquam tempus commodo commodo.\r\n                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ', '2016-10-24'),
(19, NULL, 2, '', '', '2016-11-01'),
(20, 31, NULL, '', '', '2016-11-02'),
(21, 32, NULL, '', '   dffdf\r\ndfsfddcf                                                                                                                                                                                                                                                                                                                                                 ', '2016-11-02'),
(22, NULL, 1, 'ABCD', 'xc vbdfgtdg                                                                                                                                        ', '2016-11-02'),
(23, NULL, 1, 'XYZ', 'FGFKHGJG', '2016-11-02'),
(24, 30, NULL, 'MNC ', 'hgsdug hfihinkjfbklbvkb                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          ', '2016-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `shareholders`
--

CREATE TABLE `shareholders` (
  `id` int(11) NOT NULL,
  `shareholder_name` varchar(200) NOT NULL,
  `shares_held` int(11) NOT NULL,
  `shares_disposed_date` date NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shareholders`
--

INSERT INTO `shareholders` (`id`, `shareholder_name`, `shares_held`, `shares_disposed_date`, `company_id`) VALUES
(1, 'Johny Dipp', 12, '2016-10-05', 1),
(2, 'Will Smith', 15, '2016-10-12', 1),
(3, '', 0, '2016-11-01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `task_title` varchar(250) NOT NULL,
  `task` text NOT NULL,
  `task_action_date` date NOT NULL,
  `allocated_staff` varchar(200) NOT NULL,
  `task_creation_date` date NOT NULL,
  `is_task_completed` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `individual_id`, `company_id`, `task_title`, `task`, `task_action_date`, `allocated_staff`, `task_creation_date`, `is_task_completed`) VALUES
(1, 1, NULL, 'SFG Task', 'This is  a task\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis tellus ac eleifend egestas. Curabitur ac neque at diam placerat aliquet. Nulla sit amet lacus eget dolor fermentum eleifend quis nec lorem. Proin scelerisque, nibh a lobortis vehicula, dolor diam pretium orci, eu malesuada arcu justo non massa. Vivamus vel elementum ante. Aliquam erat volutpat. Aliquam tempus commodo commodo.\r\n                                                                                                                                        ', '2016-10-17', 'Mrinal Sen', '2016-10-18', 'Yes'),
(2, NULL, 1, 'XYZ Task', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mollis tellus ac eleifend egestas. Curabitur ac neque at diam placerat aliquet. Nulla sit amet lacus eget dolor fermentum eleifend quis nec lorem. Proin scelerisque, nibh a lobortis vehicula, dolor diam pretium orci, eu malesuada arcu justo non massa. Vivamus vel elementum ante. Aliquam erat volutpat. Aliquam tempus commodo commodo.\r\n                                                                                                                                        ', '2016-10-11', 'Amal Sen', '2016-10-18', 'No'),
(3, 30, NULL, 'MNO Task', 'This is  a individual task.', '2016-11-09', 'Mrinal Sen', '2016-11-01', 'No'),
(4, 30, NULL, 'ABC Task', 'This is the task.', '2016-11-02', 'Mrinal Sen', '2016-11-01', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `telephones`
--

CREATE TABLE `telephones` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `telephones`
--

INSERT INTO `telephones` (`id`, `individual_id`, `company_id`, `telephone`, `description`) VALUES
(1, 1, NULL, '+44 20 7123 4567', 'Office'),
(2, 1, NULL, '+44 20 7123 4545', 'Home'),
(3, 2, NULL, '999999', 'Office'),
(4, 3, NULL, '999999', 'Office'),
(5, 4, NULL, '9845179', 'Home'),
(6, 5, NULL, '99999999', 'Office'),
(7, 6, NULL, '99999999', 'Office'),
(8, 7, NULL, 'f23344', 'rer'),
(9, 8, NULL, 'f23344', 'rer'),
(10, 9, NULL, 'f23344', 'rer'),
(11, 10, NULL, 'f23344', 'rer'),
(12, 16, NULL, 'f23344', 'rer'),
(13, 17, NULL, 'f23344', 'rer'),
(14, 18, NULL, '79876', 'sdvdsv'),
(15, 19, NULL, '79876', 'ERER'),
(16, 20, NULL, '123456', 'Office'),
(26, 30, NULL, '', ''),
(27, 31, NULL, '99999999', 'Office'),
(28, 32, NULL, '5765635', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `surname`, `email`, `username`, `password`) VALUES
(1, 'Hallam', 'Jones', 'enquiry@hallamjones.co.uk', 'test', '32250170a0dca92d53ec9624f336ca24');

-- --------------------------------------------------------

--
-- Table structure for table `vats`
--

CREATE TABLE `vats` (
  `id` int(11) NOT NULL,
  `individual_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `vat_number` varchar(12) NOT NULL,
  `vat_registered_date` date NOT NULL,
  `vat_flat_rate` enum('Yes','No') NOT NULL,
  `flat_rate_first_year` int(3) NOT NULL,
  `flat_rate_after_first_year` int(3) NOT NULL,
  `flat_rate_description` text NOT NULL,
  `vat_return_quarter` enum('Jan/April/July/Oct','Feb/May/Aug/Nov','March/June/Sep/Dec') NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vats`
--

INSERT INTO `vats` (`id`, `individual_id`, `company_id`, `vat_number`, `vat_registered_date`, `vat_flat_rate`, `flat_rate_first_year`, `flat_rate_after_first_year`, `flat_rate_description`, `vat_return_quarter`, `notes`) VALUES
(2, NULL, 1, 'RFGFG525658', '2014-07-08', 'Yes', 12, 10, 'This is vat rate description*/*-+\r\n\r\n++', 'Feb/May/Aug/Nov', 'This is a company vat note.');

-- --------------------------------------------------------

--
-- Table structure for table `vats_submission_quarters_years_and_quarters_due`
--

CREATE TABLE `vats_submission_quarters_years_and_quarters_due` (
  `id` int(11) NOT NULL,
  `vat_id` int(11) NOT NULL,
  `individual_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `quarter_year` varchar(10) NOT NULL,
  `quarter_due` int(11) DEFAULT NULL,
  `is_submitted_to_hmrc` enum('Yes','No') DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vats_submission_quarters_years_and_quarters_due`
--

INSERT INTO `vats_submission_quarters_years_and_quarters_due` (`id`, `vat_id`, `individual_id`, `company_id`, `quarter_year`, `quarter_due`, `is_submitted_to_hmrc`) VALUES
(2, 2, NULL, 1, '11-2014', NULL, 'Yes'),
(3, 2, NULL, 1, '02-2015', NULL, 'No'),
(4, 2, NULL, 1, '05-2015', NULL, 'No'),
(5, 2, NULL, 1, '08-2015', NULL, 'No'),
(6, 2, NULL, 1, '11-2015', NULL, 'No'),
(7, 2, NULL, 1, '02-2016', NULL, 'No'),
(8, 2, NULL, 1, '05-2016', NULL, 'No'),
(9, 2, NULL, 1, '08-2016', NULL, 'No'),
(37, 2, NULL, 1, '08-2014', NULL, 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company_name` (`company_name`),
  ADD UNIQUE KEY `registration_number` (`registration_number`),
  ADD UNIQUE KEY `client_id` (`client_id`);

--
-- Indexes for table `companies_account_submission_years`
--
ALTER TABLE `companies_account_submission_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies_directors`
--
ALTER TABLE `companies_directors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails_sent_to_clients`
--
ALTER TABLE `emails_sent_to_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individuals`
--
ALTER TABLE `individuals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_id` (`client_id`);

--
-- Indexes for table `individuals_tax_return_years`
--
ALTER TABLE `individuals_tax_return_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individuals_tax_return_years_french`
--
ALTER TABLE `individuals_tax_return_years_french`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shareholders`
--
ALTER TABLE `shareholders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telephones`
--
ALTER TABLE `telephones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vats`
--
ALTER TABLE `vats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vat_number` (`vat_number`);

--
-- Indexes for table `vats_submission_quarters_years_and_quarters_due`
--
ALTER TABLE `vats_submission_quarters_years_and_quarters_due`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companies_account_submission_years`
--
ALTER TABLE `companies_account_submission_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companies_directors`
--
ALTER TABLE `companies_directors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `emails_sent_to_clients`
--
ALTER TABLE `emails_sent_to_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `individuals`
--
ALTER TABLE `individuals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `individuals_tax_return_years`
--
ALTER TABLE `individuals_tax_return_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `individuals_tax_return_years_french`
--
ALTER TABLE `individuals_tax_return_years_french`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `shareholders`
--
ALTER TABLE `shareholders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `telephones`
--
ALTER TABLE `telephones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vats`
--
ALTER TABLE `vats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vats_submission_quarters_years_and_quarters_due`
--
ALTER TABLE `vats_submission_quarters_years_and_quarters_due`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
