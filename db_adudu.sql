SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS `db_adudu`;
CREATE DATABASE IF NOT EXISTS `db_adudu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_adudu`;

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE `cart_item` (
  `id_cart` int(16) NOT NULL,
  `user_id` int(16) NOT NULL,
  `sepatu_id` int(16) NOT NULL,
  `qty` int(16) NOT NULL,
  `price` int(16) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cart_item` (`id_cart`, `user_id`, `sepatu_id`, `qty`, `price`, `active`) VALUES
(2, 4, 56, 1, 850000, 0),
(3, 4, 53, 1, 900000, 0),
(4, 4, 52, 1, 1100000, 0),
(6, 4, 56, 1, 850000, 0),
(7, 4, 53, 1, 900000, 0),
(8, 4, 59, 4, 2560000, 0),
(9, 4, 57, 2, 2200000, 0),
(10, 4, 56, 1, 850000, 0),
(11, 4, 59, 4, 2560000, 0),
(12, 4, 59, 4, 2560000, 0),
(13, 5, 59, 1, 2560000, 1),
(14, 4, 59, 4, 2560000, 0),
(15, 4, 55, 1, 2800000, 0),
(16, 4, 60, 2, 1400000, 0),
(17, 4, 56, 1, 850000, 0),
(18, 4, 53, 1, 900000, 0),
(19, 4, 52, 1, 1100000, 0),
(20, 4, 49, 1, 1300000, 0),
(21, 4, 57, 2, 2200000, 0),
(22, 4, 59, 4, 2560000, 0),
(23, 4, 56, 1, 850000, 0),
(24, 4, 55, 1, 2800000, 0),
(25, 4, 60, 2, 1400000, 0),
(26, 4, 59, 4, 2560000, 0),
(27, 4, 59, 4, 2560000, 0),
(28, 4, 60, 2, 1400000, 0),
(30, 4, 59, 4, 2560000, 0),
(31, 4, 52, 1, 1100000, 0),
(32, 4, 51, 2, 800000, 0),
(35, 4, 56, 2, 850000, 0),
(36, 4, 46, 3, 1300000, 0),
(37, 4, 44, 9, 1100000, 0),
(38, 4, 48, 3, 1200000, 0),
(39, 4, 60, 2, 1400000, 0),
(40, 4, 56, 1, 850000, 0),
(41, 4, 56, 1, 850000, 0),
(42, 4, 55, 1, 2800000, 0),
(43, 4, 58, 1, 2700000, 0),
(44, 4, 58, 1, 2700000, 0),
(45, 4, 60, 2, 1400000, 0),
(46, 4, 60, 2, 1400000, 0),
(47, 4, 53, 1, 900000, 0),
(48, 4, 60, 2, 1400000, 0),
(49, 4, 60, 2, 1400000, 0),
(50, 4, 59, 4, 2560000, 0),
(51, 4, 59, 4, 2560000, 0),
(52, 2, 59, 1, 2560000, 0),
(53, 4, 59, 4, 2560000, 0),
(54, 4, 59, 4, 2560000, 0),
(55, 4, 59, 4, 2560000, 0),
(56, 4, 60, 2, 1400000, 0),
(57, 4, 59, 4, 2560000, 0),
(58, 4, 59, 4, 2560000, 0),
(59, 4, 60, 2, 1400000, 0),
(64, 4, 60, 2, 1400000, 1),
(65, 4, 53, 1, 900000, 1);

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id_order_details` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `total` int(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `order_details` (`id_order_details`, `user_id`, `payment_id`, `total`, `status`) VALUES
(1, 4, 1, 5410000, 0),
(2, 4, 2, 3050000, 0),
(3, 4, 3, 2560000, 0),
(4, 4, 4, 2560000, 1),
(5, 4, 5, 2560000, 1),
(6, 4, 6, 2800000, 0),
(7, 4, 7, 1400000, 1),
(8, 4, 8, 850000, 0),
(9, 4, 9, 900000, 0),
(10, 4, 10, 1100000, 0),
(11, 4, 11, 1300000, 0),
(12, 4, 12, 2200000, 0),
(13, 4, 13, 3410000, 1),
(14, 4, 14, 2800000, 1),
(15, 4, 15, 1400000, 1),
(16, 4, 16, 2560000, 1),
(17, 4, 17, 3960000, 1),
(18, 4, 18, 2560000, 0),
(19, 4, 19, 1100000, 0),
(20, 4, 20, 800000, 0),
(21, 4, 21, 20500000, 1),
(22, 4, 22, 850000, 0),
(23, 4, 23, 850000, 1),
(24, 4, 24, 2800000, 1),
(25, 4, 25, 2700000, 1),
(26, 4, 26, 2700000, 1),
(27, 4, 27, 1400000, 1),
(28, 4, 28, 1400000, 1),
(29, 4, 29, 900000, 0),
(30, 4, 30, 1400000, 0),
(31, 4, 31, 3960000, 1),
(32, 2, 32, 2560000, 1),
(33, 4, 33, 2560000, 0),
(34, 4, 34, 2560000, 1),
(35, 4, 35, 2560000, 1),
(36, 4, 36, 5120000, 0),
(37, 4, 37, 14200000, 0),
(38, 4, 38, 7680000, 0),
(39, 4, 39, 4200000, 1);

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id_order_item` int(16) NOT NULL,
  `order_id` int(16) NOT NULL,
  `sepatu_id` int(16) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `order_items` (`id_order_item`, `order_id`, `sepatu_id`, `qty`) VALUES
(1, 1, 56, 1),
(2, 1, 52, 1),
(3, 1, 53, 1),
(4, 1, 59, 1),
(5, 2, 57, 1),
(6, 2, 56, 1),
(7, 3, 59, 1),
(8, 4, 59, 1),
(9, 5, 59, 1),
(10, 6, 55, 1),
(11, 7, 60, 1),
(12, 8, 56, 1),
(13, 9, 53, 1),
(14, 10, 52, 1),
(15, 11, 49, 1),
(16, 12, 57, 1),
(17, 13, 59, 1),
(18, 13, 56, 1),
(19, 14, 55, 1),
(20, 15, 60, 1),
(21, 16, 59, 1),
(22, 17, 59, 1),
(23, 17, 60, 1),
(24, 18, 59, 1),
(25, 19, 52, 1),
(26, 20, 51, 1),
(27, 21, 56, 2),
(28, 21, 46, 3),
(29, 21, 44, 9),
(30, 21, 48, 3),
(31, 21, 60, 1),
(32, 22, 56, 1),
(33, 23, 56, 1),
(34, 24, 55, 1),
(35, 25, 58, 1),
(36, 26, 58, 1),
(37, 27, 60, 1),
(38, 28, 60, 1),
(39, 29, 53, 1),
(40, 30, 60, 1),
(41, 31, 60, 1),
(42, 31, 59, 1),
(43, 32, 59, 1),
(44, 33, 59, 1),
(45, 34, 59, 1),
(46, 35, 59, 1),
(47, 36, 59, 2),
(48, 37, 60, 1),
(49, 37, 59, 5),
(50, 38, 59, 3),
(51, 39, 60, 3);

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `status_code` varchar(3) NOT NULL,
  `status_message` varchar(50) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `order_id` varchar(10) NOT NULL,
  `gross_amount` decimal(20,2) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `transaction_status` varchar(40) NOT NULL,
  `bank` varchar(40) NOT NULL,
  `va_number` varchar(40) NOT NULL,
  `fraud_status` varchar(40) NOT NULL,
  `pdf_url` varchar(200) NOT NULL,
  `finish_redirect_url` varchar(200) NOT NULL,
  `bill_key` varchar(20) NOT NULL,
  `biller_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `payment` (`id`, `status_code`, `status_message`, `transaction_id`, `order_id`, `gross_amount`, `payment_type`, `transaction_time`, `transaction_status`, `bank`, `va_number`, `fraud_status`, `pdf_url`, `finish_redirect_url`, `bill_key`, `biller_code`) VALUES
(1, '407', 'Success, transaction is found', '63659a30-fe06-4c28-87ae-418857ce6e15', '1903503215', '5410000.00', 'bank_transfer', '2021-11-12 22:30:42', 'expire', 'bca', '66703039637', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/f089a767-3034-413c-9c5e-2533d66eec9b/pdf', 'http://example.com?order_id=1903503215&status_code=201&transaction_status=pending', '-', '-'),
(2, '407', 'Success, transaction is found', '004a0aaa-c63a-4fdb-82cf-542850a213fa', '2092435340', '3050000.00', 'bank_transfer', '2021-11-12 22:34:57', 'expire', 'bca', '66703808953', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/77001dac-7a4b-4d8e-8291-b759d210ccdb/pdf', 'http://example.com?order_id=2092435340&status_code=201&transaction_status=pending', '-', '-'),
(3, '407', 'Success, transaction is found', '8ef4d4d1-7a42-476a-bbba-9094238e4864', '1923273917', '2560000.00', 'bank_transfer', '2021-11-12 22:49:32', 'expire', 'bca', '66703812789', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/762aa9ff-182d-45e0-a549-b6b3de3e646e/pdf', 'http://example.com?order_id=1923273917&status_code=201&transaction_status=pending', '-', '-'),
(4, '200', 'Success, transaction is found', '7a72e460-4c6a-47a8-9c94-642694c8b5ae', '1346175814', '2560000.00', 'bank_transfer', '2021-11-12 22:53:22', 'settlement', 'bca', '66703317720', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/90e60a58-bb00-4271-8b5d-cfae13f392d1/pdf', 'http://example.com?order_id=1346175814&status_code=201&transaction_status=pending', '-', '-'),
(5, '200', 'Success, transaction is found', '8687b9bf-2be1-4bbd-866c-efb9c6664c52', '333973575', '2560000.00', 'bank_transfer', '2021-11-13 19:23:08', 'settlement', 'bca', '66703576410', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/05b7d6ce-9452-4adb-bc8d-a3835c8c5c8c/pdf', 'http://example.com?order_id=333973575&status_code=201&transaction_status=pending', '-', '-'),
(6, '407', 'Success, transaction is found', '106b0ed9-356a-463c-9316-0d9542e1acbc', '1088761053', '2800000.00', 'bank_transfer', '2021-11-13 19:26:38', 'expire', 'bca', '66703800221', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/79b5f635-f8ad-4460-b4e4-10066dd2bd79/pdf', 'http://example.com?order_id=1088761053&status_code=201&transaction_status=pending', '-', '-'),
(7, '200', 'Success, transaction is found', 'a7b63f71-5498-4d0a-93d6-d35f9a128121', '719483375', '1400000.00', 'bank_transfer', '2021-11-13 19:27:05', 'settlement', 'bca', '66703135642', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/f89be394-2d3d-402d-a759-ead7281d613e/pdf', 'http://example.com?order_id=719483375&status_code=201&transaction_status=pending', '-', '-'),
(8, '407', 'Success, transaction is found', '9d3e58f1-af24-4453-8a7b-62600602cdde', '930099122', '850000.00', 'bank_transfer', '2021-11-14 12:04:49', 'expire', 'bca', '66703289097', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/858c5f1c-1fd6-454a-9d25-49d4df2f3f38/pdf', 'http://example.com?order_id=930099122&status_code=201&transaction_status=pending', '-', '-'),
(9, '407', 'Success, transaction is found', '582c8556-d9ca-43a1-8645-3c9eec3b91ad', '452836652', '900000.00', 'bank_transfer', '2021-11-14 12:05:42', 'expire', 'bca', '66703493759', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/b9024b33-4fb2-4706-bc60-10f82f025e0e/pdf', 'http://example.com?order_id=452836652&status_code=201&transaction_status=pending', '-', '-'),
(10, '407', 'Success, transaction is found', '68635540-b509-4035-b44e-bb396c65b769', '1219869781', '1100000.00', 'bank_transfer', '2021-11-14 12:06:16', 'expire', 'bca', '66703575156', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/78b86a7f-4983-46fa-a51f-2dd40556ce7a/pdf', 'http://example.com?order_id=1219869781&status_code=201&transaction_status=pending', '-', '-'),
(11, '407', 'Success, transaction is found', '0c0fd072-898b-4fe1-926a-25a1c656f321', '1902836423', '1300000.00', 'bank_transfer', '2021-11-14 12:08:02', 'expire', 'bca', '66703716499', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/2d4089c5-425a-435a-9486-d04afb54828d/pdf', 'http://example.com?order_id=1902836423&status_code=201&transaction_status=pending', '-', '-'),
(12, '407', 'Success, transaction is found', '1f5bb947-d77c-4e01-a965-550fd24d63b9', '2049696859', '2200000.00', 'bank_transfer', '2021-11-14 12:09:20', 'expire', 'bca', '66703499086', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/52ddde4f-5944-4209-a0a9-8c595b05556d/pdf', 'http://example.com?order_id=2049696859&status_code=201&transaction_status=pending', '-', '-'),
(13, '200', 'Success, transaction is found', '7507d810-7d4c-46c2-be11-7b08c61d69f5', '1785201125', '3410000.00', 'bank_transfer', '2021-11-17 18:51:38', 'settlement', 'bca', '66703540429', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/eac4ce47-110b-4b9b-9c1c-04da2d7986e4/pdf', 'http://example.com?order_id=1785201125&status_code=201&transaction_status=pending', '-', '-'),
(14, '200', 'Success, transaction is found', '347b914a-b8f4-474b-b31a-95b19124d89e', '1239563901', '2800000.00', 'bank_transfer', '2021-11-17 18:54:13', 'settlement', 'bca', '66703950630', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/c2d6b127-929c-46df-89e5-17c66f6fed5e/pdf', 'http://example.com?order_id=1239563901&status_code=201&transaction_status=pending', '-', '-'),
(15, '200', 'Success, transaction is found', '5051185d-a97d-40c8-954a-6f5094dcbb16', '1475451747', '1400000.00', 'bank_transfer', '2021-11-17 20:15:36', 'settlement', 'bca', '66703322480', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/c13fad4a-f10f-471e-9551-28032111b9ca/pdf', 'http://example.com?order_id=1475451747&status_code=201&transaction_status=pending', '-', '-'),
(16, '200', 'Success, transaction is found', '1d874ffb-a5db-49ca-bb55-b56029f984b8', '1453721729', '2560000.00', 'bank_transfer', '2021-11-18 13:14:21', 'settlement', 'bca', '66703398685', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/a3ecc4d0-7a1f-4c70-9856-66a7b03674e7/pdf', 'http://example.com?order_id=1453721729&status_code=201&transaction_status=pending', '-', '-'),
(17, '200', 'Success, transaction is found', '1596975d-e581-4285-91cd-f04f4cc3f727', '1621204790', '3960000.00', 'bank_transfer', '2021-11-18 13:18:47', 'settlement', 'bni', '9886670310142452', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/5ec74dd1-cad0-4ffe-9bfc-774124177270/pdf', 'http://example.com?order_id=1621204790&status_code=201&transaction_status=pending', '-', '-'),
(18, '407', 'Success, transaction is found', '5cf7cd13-b59e-43cd-a25a-04a018fd1dbf', '921948891', '2560000.00', 'bank_transfer', '2021-11-18 13:30:53', 'expire', 'bca', '66703465153', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/735ac3a3-29bc-4761-8db4-765d15f5bed7/pdf', 'http://example.com?order_id=921948891&status_code=201&transaction_status=pending', '-', '-'),
(19, '407', 'Success, transaction is found', 'e2f7ecb1-be27-4838-9685-ac5090d7f678', '1156085692', '1100000.00', 'bank_transfer', '2021-11-18 13:31:18', 'expire', 'bri', '667031893034914050', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/1abd41c1-a97b-454b-b184-95f76778e2fd/pdf', 'http://example.com?order_id=1156085692&status_code=201&transaction_status=pending', '-', '-'),
(20, '407', 'Success, transaction is found', '071c6b02-cd0c-4637-b039-eadcd8312b40', '2070804854', '800000.00', 'bank_transfer', '2021-11-18 13:42:30', 'expire', 'bca', '66703647576', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/0074780f-0a1d-4007-9813-2c98e8d6e374/pdf', 'http://example.com?order_id=2070804854&status_code=201&transaction_status=pending', '-', '-'),
(21, '200', 'Success, transaction is found', 'c5baadae-a6ab-4e66-b630-e2c72ce493a7', '304795775', '20500000.00', 'bank_transfer', '2021-11-19 17:07:13', 'settlement', 'bca', '66703961666', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/432e8f78-7942-4c47-a59d-0046a268a857/pdf', 'http://example.com?order_id=304795775&status_code=201&transaction_status=pending', '-', '-'),
(22, '407', 'Success, transaction is found', '0e9cdd5b-b728-4827-8cff-01101cedc27d', '1160376542', '850000.00', 'bank_transfer', '2021-11-19 17:14:35', 'expire', 'bca', '66703083309', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/5f84254d-636d-4155-99a9-fce2caa297c7/pdf', 'http://example.com?order_id=1160376542&status_code=201&transaction_status=pending', '-', '-'),
(23, '200', 'Success, transaction is found', 'ead67cd2-47dd-4155-ab85-c15dafe68eb6', '284666403', '850000.00', 'bank_transfer', '2021-11-19 17:18:19', 'settlement', 'bca', '66703705095', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/667aca27-06b8-4e7d-980e-1acdb44b0032/pdf', 'http://example.com?order_id=284666403&status_code=201&transaction_status=pending', '-', '-'),
(24, '200', 'Success, transaction is found', '9b6b80e5-52f2-4cd5-8862-d2a81a210f3b', '564619248', '2800000.00', 'bank_transfer', '2021-11-19 17:21:05', 'settlement', 'bca', '66703826177', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/3f6e72cd-aa18-4c25-9a16-610f7873bd98/pdf', 'http://example.com?order_id=564619248&status_code=201&transaction_status=pending', '-', '-'),
(25, '200', 'Success, transaction is found', 'e265eb41-12ea-4c3a-9254-fae4be537b7b', '127923537', '2700000.00', 'bank_transfer', '2021-11-19 17:26:33', 'settlement', 'bca', '66703868250', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/232d212a-2f4e-4159-938c-4a22d0dc5a80/pdf', 'http://example.com?order_id=127923537&status_code=201&transaction_status=pending', '-', '-'),
(26, '200', 'Success, transaction is found', 'f8adf9f8-8834-4bed-ba43-b04ec949155d', '831235683', '2700000.00', 'bank_transfer', '2021-11-19 17:33:47', 'settlement', 'bca', '66703656157', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/43e01ca1-cf1f-416c-976b-4320fcf49312/pdf', 'http://example.com?order_id=831235683&status_code=201&transaction_status=pending', '-', '-'),
(27, '200', 'Success, transaction is found', '130463f4-60b1-4037-ab07-33329760252d', '118161170', '1400000.00', 'bank_transfer', '2021-11-19 17:35:33', 'settlement', 'bca', '66703834105', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/bdb9236c-0226-4cb4-b18f-f1c190d6ebbe/pdf', 'http://example.com?order_id=118161170&status_code=201&transaction_status=pending', '-', '-'),
(28, '200', 'Success, transaction is found', 'd0338926-a3e1-4c18-920c-dbfc479f41ac', '795643825', '1400000.00', 'bank_transfer', '2021-11-19 17:47:25', 'settlement', 'bca', '66703464212', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/c500506f-257c-4201-a687-e7685dcf2e5e/pdf', 'http://example.com?order_id=795643825&status_code=201&transaction_status=pending', '-', '-'),
(29, '407', 'Success, transaction is found', 'aa42f259-9c31-47c3-8500-bc53eba978e4', '2144828051', '900000.00', 'bank_transfer', '2021-11-19 17:51:16', 'expire', 'bca', '66703214581', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/71c2e765-2025-4443-a9b0-24bf9e73b4bd/pdf', 'http://example.com?order_id=2144828051&status_code=201&transaction_status=pending', '-', '-'),
(30, '407', 'Success, transaction is found', '9327eae1-a1e8-41e9-9fd9-b7d071a8a88c', '983195929', '1400000.00', 'bank_transfer', '2021-11-19 17:54:24', 'expire', 'bca', '66703135951', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/f62fcdcd-8e31-4668-9f1b-b30632dcdf65/pdf', 'http://example.com?order_id=983195929&status_code=201&transaction_status=pending', '-', '-'),
(31, '200', 'Success, transaction is found', 'f8d22f5e-0f63-40e7-a978-b7bafd972738', '1566469067', '3960000.00', 'bank_transfer', '2021-11-19 17:58:34', 'settlement', 'bca', '66703845457', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/844f787a-dc0c-4f53-95d3-5d12dabb0c46/pdf', 'http://example.com?order_id=1566469067&status_code=201&transaction_status=pending', '-', '-'),
(32, '200', 'Success, transaction is found', '792599d6-a54f-41cd-af46-e324a57b80b1', '1191675522', '2560000.00', 'bank_transfer', '2021-11-19 19:44:01', 'settlement', 'bca', '66703658061', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/8d4f68d4-e013-425a-a6a5-fc1f5133d762/pdf', 'http://example.com?order_id=1191675522&status_code=201&transaction_status=pending', '-', '-'),
(33, '407', 'Success, transaction is found', '1771339e-be59-4651-843f-5337de37335f', '1286353772', '2560000.00', 'bank_transfer', '2021-11-19 20:53:14', 'expire', 'bca', '66703160641', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/e500368f-c61f-4fad-afd1-839962c63dc1/pdf', 'http://example.com?order_id=1286353772&status_code=201&transaction_status=pending', '-', '-'),
(34, '200', 'Success, transaction is found', 'b2cf5f19-5b92-49e3-8410-eb93606c7fae', '31030950', '2560000.00', 'bank_transfer', '2021-11-20 21:22:42', 'settlement', 'bca', '66703122943', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/0c8f6520-ccce-49d0-b9ad-8942ba672737/pdf', 'http://example.com?order_id=31030950&status_code=201&transaction_status=pending', '-', '-'),
(35, '200', 'Success, transaction is found', 'b9ce4266-55c8-47ff-93ab-228796f0f862', '1297081617', '2560000.00', 'bank_transfer', '2021-11-20 21:33:46', 'settlement', 'bca', '66703255237', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/f3e1e7d6-9ec1-4bcb-874c-8be89c6fd13d/pdf', 'http://example.com?order_id=1297081617&status_code=201&transaction_status=pending', '-', '-'),
(36, '407', 'Success, transaction is found', 'cf969304-f900-4bd2-9923-27624d8ee1f3', '255790629', '5120000.00', 'bank_transfer', '2021-11-22 20:02:57', 'expire', 'bca', '66703948736', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/851ee254-601e-4558-a876-290a2352dd27/pdf', 'http://example.com?order_id=255790629&status_code=201&transaction_status=pending', '-', '-'),
(37, '407', 'Success, transaction is found', '0f7083a7-a942-446d-b3f9-677acd0a2079', '389545399', '14200000.00', 'bank_transfer', '2021-11-22 20:16:58', 'expire', 'bca', '66703632741', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/d21e3248-954f-4f4f-b7c8-a733ee2ce328/pdf', 'http://example.com?order_id=389545399&status_code=201&transaction_status=pending', '-', '-'),
(38, '407', 'Success, transaction is found', '5389f0ba-3b31-4b6b-a166-477c31d0214a', '1360254882', '7680000.00', 'bank_transfer', '2021-11-22 20:20:42', 'expire', 'bca', '66703767828', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/b7460983-0ddc-44b8-913f-902564f5ac7d/pdf', 'http://example.com?order_id=1360254882&status_code=201&transaction_status=pending', '-', '-'),
(39, '200', 'Success, transaction is found', '1ed2ed49-8c18-48dd-bf3e-e825d7864a7e', '191768305', '4200000.00', 'bank_transfer', '2021-11-23 10:49:44', 'settlement', 'bca', '66703153200', 'accept', 'https://app.sandbox.midtrans.com/snap/v1/transactions/533f59ed-a740-40cc-8eee-bab80fdc2bd6/pdf', 'http://example.com?order_id=191768305&status_code=201&transaction_status=pending', '-', '-');

DROP TABLE IF EXISTS `sepatu`;
CREATE TABLE `sepatu` (
  `id_sepatu` int(16) NOT NULL,
  `nama_sepatu` varchar(100) NOT NULL,
  `harga_sepatu` int(16) NOT NULL,
  `sub_desc` varchar(5000) NOT NULL,
  `desc_sepatu` varchar(5000) NOT NULL,
  `size_sepatu` int(16) NOT NULL,
  `stock_sepatu` int(16) NOT NULL,
  `link_gambarsepatu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `sepatu` (`id_sepatu`, `nama_sepatu`, `harga_sepatu`, `sub_desc`, `desc_sepatu`, `size_sepatu`, `stock_sepatu`, `link_gambarsepatu`) VALUES
(1, 'ADIDAS ULTRABOOST X LEGO COLORS SHOES (1 PAIR PER CUSTOMER)', 2560000, 'HIGH-PERFORMANCE RUNNING SHOES MADE IN PARTNERSHIP WITH THE LEGO GROUP.', 'Running is your time to play. And if you couldn\'t tell by the pops of colour and LEGO® bricks inspired design, these adidas running shoes created with the LEGO Group are all about play. Play, and comfort. Because nothing needs to get in the way of a good time. A plush Boost midsole takes care of the cushioning, and the Continental™ Better Rubber outsole balances fast moves with steady grounding.', 12, 33, 'list_products/59.jpg'),
(2, 'SEPATU HARDEN VOL. 5 FUTURENATURAL TOKYO', 1400000, 'PRODUK TERKINI DARI ADIDAS BASKETBALL DAN JAMES HARDEN.', 'Harden Vol. 5 dari adidas Basketball memiliki fit dan penguncian revolusioner untuk bergerak bebas dengan maksimal saat berada di lapangan basket, terinspirasi kecepatan dan kemampuan James Harden yang tak tertandingi untuk mengubah arah saat mendribel bola. Teknologi Futurenatural memperkenalkan sistem fit baru dan konstruksi tanpa jahitan untuk menghasilkan kontrol yang optimal. Kombinasi midsole Boost dan keunggulan Lightstrike yang ringan menghasilkan kenyamanan dan stabilitas yang dibutuhkan salah satu pencetak skor paling dinamis dalam pertandingan untuk selalu mendominasi panggung terbesar dunia. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.', 11, 78, 'list_products/60.jpg'),
(3, 'SEPATU FUTSAL PREDATOR FREAK.3 INDOOR', 1200000, 'SEPATU FUTSAL LOW-CUT YANG MEMBANTUMU MENGONTROL PERMAINAN DI LAPANGAN DENGAN PERMUKAAN DATAR.', 'Di luar dinding ini, sulit untuk membuat dirimu terdengar. Namun di lapangan, kamu menjadi pengendali. Bebaskan kepribadian unikmu dengan adidas Predator. Sepatu futsal ini memiliki upper berbahan mesh lembut yang dilengkapi lapisan untuk membantumu mendominasi permainan dengan nyaman. Desain low-cut membuat sepatu ini mudah untuk dipakai dan dilepas. Ekspansi lebar elemen Demonscale dengan proses cetak 3D mencengkeram bola untuk membuatmu tetap fokus.', 11, 30, 'list_products/3.jpg'),
(4, 'SEPATU ULTRABOOST DNA GUARD', 3200000, 'SEPATU RUNNING YANG DILENGKAPI BANTALAN, INSULASI SERTA AKSEN REFLEKTIF.', 'Cuaca mendung berarti suasana jalanan menjadi sedikit lebih tenang. Pakai sepatu running adidas ini dan maksimalkan keunggulanmu. COLD.RDY membuatmu tetap nyaman dengan teknologi insulasi sehingga kamu tetap merasa hangat dalam suhu yang rendah — karena suhu yang menurun tidak berarti mengganggu rutinitasmu. Ketika kamu memacu diri, upper adidas Primeknit yang fleksibel beradaptasi dengan perubahan bentuk kaki dan bantalan Boost membuat kakimu terasa nyaman.', 11, 100, 'list_products/4.jpg'),
(5, 'GAMEMODE TURF BOOTS', 1200000, 'SOFT SYNTHETIC BOOTS IN MAN UTD COLOURS.', 'Every court is a platform. Every cage a stage. Where some players picture hard work, others see opportunity. The choice is yours. Express your beautiful game in adidas Gamemode. These football boots have a HybridTouch upper for a lightweight feel and soft touch. The universal fit and EVA cushioning add comfort. Underneath, a lugged outsole helps you display your skills on artificial turf. Up top, Manchester United\'s colours and badge show you stand with your club.', 12, 43, 'list_products/5.jpg'),
(6, 'SEPATU FUTSAL RAJUT GAMEMODE INDOOR', 1200000, 'SEPATU BERBAHAN TEKSTIL RAJUT YANG LEMBUT DENGAN WARNA ARSENAL.', 'Setiap lapangan menjadi platform. Setiap arena menjadi panggung. Ketika beberapa pemain memperlihatkan kerja keras, yang lain melihat peluang. Pilihan ada di tanganmu. Ekspresikan permainan menawanmu dengan adidas Gamemode. Sepatu futsal ini memiliki upper rajut dari bahan tekstil yang lembut dan elastis untuk membuat sepatu mudah dipakai dan mengunci dengan pas. Fit universal dan bantalan EVA menambah kenyamanan. Di bagian bawah, outsole dari bahan karet dengan daya cengkeram kuat membantumu menunjukkan kemampuan di lapangan dengan permukaan rata. Di bagian atas, warna dan emblem Arsenal menunjukkan dukungan pada klub favoritmu.', 13, 42, 'list_products/6.jpg'),
(7, 'SEPATU ADIDAS 4D FUTURECRAFT', 4000000, 'SEPATU RUNNING DENGAN BANTALAN YANG DIDESAIN SECARA CERMAT UNTUK KENYAMANAN SETIAP HARI.', 'Aktivitas lari menghadirkan fokus yang cermat ke masa kini. Sepatu running adidas ini membawamu tanpa ragu ke masa depan. Midsole adidas 4D yang mutakhir berdasarkan data aktivitas lari selama 17 tahun dan didesain khusus secara digital untuk memadukan kenyamanan dalam setiap langkah. Upper adidas Primeknit memastikan sensasi penguncian yang beradaptasi dengan kaki dalam siklus gerakan langkahmu.', 12, 39, 'list_products/7.jpg'),
(8, 'BARRICADE SHOES', 2200000, 'CONTROL THE COURT IN THESE SUPPORTIVE SHOES.', 'Without control, there are no guarantees on court. So Barricade is back to help you dominate. The intuitive lacing system on these adidas tennis shoes locks you in by pulling down the neoprene tongue to match your foot shape. A Geofit system in the heel fills the remaining gaps to complete the connection. Underneath, a cushioned Bounce midsole and TPU midfoot shank keep every step comfortable and stable. That bold adidas wordmark on the medial side is made from tough RPU to combat wear from foot drag.', 12, 44, 'list_products/8.jpg'),
(9, 'SEPATU BOLA PREDATOR FREAK.3 FIRM GROUND', 1300000, 'SEPATU BOLA MID-CUT YANG MEMBANTUMU MENGONTROL PERTANDINGAN DI LAPANGAN FIRM GROUND.', 'Setiap kali kamu melewati garis putih itu, kamu memasuki dunia baru. Sebuah realitas alternatif di mana kamu melakukan tendangan. Lapangan ada dalam genggamanmu. Bebaskan ide unikmu dengan adidas Predator. Sepatu bola ini memiliki upper berbahan tekstil dengan lapisan untuk membantumu mendominasi permainan dengan nyaman. Desain mid-cut menopang pergelangan kakimu. Ekspansi lebar elemen Demonscale dengan proses cetak 3D mencengkeram bola untuk membuatmu tetap fokus.', 11, 38, 'list_products/9.jpg'),
(10, 'SEPATU ULTRA 4D', 4000000, 'SEPATU RUNNING YANG DIRANCANG UNTUK ATLET DAN OLEH ATLET.', 'Pada debut adidas Ultraboost di tahun 2015, sepatu ini memiliki dampak yang tersebar hingga di luar dunia olahraga lari. Untuk versi sepatu ini, kami menghadirkan desain baru dengan midsole cetak 3D. Konstruksi lebih padat di bagian lattice memberikan topangan yang lebih baik, dan bagian yang terbuka terasa lebih empuk. Sepatu ini tidak hanya terlihat seperti sepatu masa depan. Namun, sensasi dipakainya juga terasa demikian.', 13, 35, 'list_products/10.jpg'),
(11, 'SEPATU FUTSAL TOP SALA', 1000000, 'SEPATU YANG BREATHABLE UNTUK DIPAKAI DI LAPANGAN FUTSAL.', 'Ubah pertahanan menjadi serangan balik dalam sekejap mata. Dioptimalkan untuk futsal bertempo cepat, sepatu futsal adidas ini dilengkapi outsole dari bahan karet yang dibuat untuk gerakan eksplosif di permukaan indoor yang rata. Material kulit sintetis di bagian forefoot mengurangi dampak benturan dan gesekan saat Anda melakukan aksi terbaik Anda. Bahan mesh di bagian quarter membantu kaki tetap merasa sejuk dalam tempo permainan cepat.', 12, 42, 'list_products/11.jpg'),
(12, 'DAME 7 EXTPLY SHOES', 1900000, 'THE LATEST FROM ADIDAS BASKETBALL AND DAMIAN LILLARD.', 'It\'s not easy to be at the top of your game in basketball and hip hop. The Dame 7 EXTPLY shoes from adidas Basketball mixes the love for both of Damian Lillard\'s passions. Each \"track\" of these basketball shoes is studio inspired. Dame never cheats the grind, asserting himself as the best baller to ever grace the booth, period. Introducing: Dame D.O.L.L.A. This product is made with recycled content as part of our ambition to end plastic waste. 20% of pieces used to make the upper are made with minimum 50% recycled content.', 11, 93, 'list_products/12.jpg'),
(13, 'SEPATU SL20.2', 1800000, 'SEPATU SNEAKER RINGAN YANG RESPONSIF UNTUK BERBAGAI AKTIVITAS SEHARIAN.', 'Setiap kali kamu memijakkan kaki di jalanan, bumi pun akan hadir menjadi pijakanmu. Sepatu adidas SL20.2 ini sebagai balas budi kebaikan bumi, karenanya dibuat dari material hasil daur ulang. Mitra latihan yang ideal, sepatu ini menopang setiap langkah dengan upper berbahan mesh fleksibel dan outsole karet dengan traksi tinggi. Lightstrike meningkatkan kenyamanan dengan sensasi super-ringan yang responsif sehingga membantumu melaju dengan cepat dan percaya diri. Produk ini dibuat dengan Primegreen, rangkaian material hasil daur ulang beperforma tinggi. 50% dari upper berbahan konten hasil daur ulang. Tanpa virgin poliester.', 13, 99, 'list_products/13.jpg'),
(14, 'SUPERNOVA SHOES', 1700000, 'RESPONSIVE RUNNING SHOES FOR YOUR DAILY MILES.', 'Squeeze in a few laps before work or sprint across the finish line of your first 10K. When you\'re upping your mileage and tackling new running goals, these adidas Supernova Shoes are your go-to pair. The engineered mesh upper gives you support and ventilation where you need it most. Springy Bounce in the forefoot combines with responsive Boost in the heel to give a smooth, easy ride.', 11, 34, 'list_products/14.jpg'),
(15, 'SEPATU FUTSAL SUPER SALA', 900000, 'SEPATU FUTSAL BREATHABLE UNTUK MENUNJUKKAN KEMAMPUAN FUTSAL.', 'Kecoh penjagaanmu dalam sekejap mata. Dibuat untuk futsal bertempo cepat, sepatu futsal adidas ini dilengkapi outsole dari bahan karet non-marking yang didesain untuk gerakan eksplosif di permukaan indoor yang rata. Material sintetis yang awet di bagian forefoot tahan terhadap benturan dan goresan, sedangkan upper berbahan mesh membuat kaki yang bergerak cepat tetap terasa sejuk.', 13, 32, 'list_products/15.jpg'),
(16, 'SEPATU TRAE YOUNG 1', 1900000, 'PRODUK TERBARU DARI ADIDAS BASKETBALL DAN TRAE YOUNG.', 'Trae Young 1, dari adidas Basketball dan Trae Young, memadukan tampilan tak tertandingi dan style unik Trae dalam permainan dengan kelincahan, pengendalian, dan kenyamanan terbaik. Membuat debut sepatu signature-nya, setiap pilihan warna dalam koleksi ini terlihat mengabadikan pesona dan kepribadian Young yang unik sekaligus menghadirkan teknologi top dalam sepatu basket adidas. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.', 12, 41, 'list_products/16.jpg'),
(17, 'SEPATU ADIZERO ADIOS 6', 2000000, 'SEPATU RUNNING RINGAN UNTUK LATIHAN DAN KEJUARAAN LARI.', 'Lari dengan interval dan tempo di pagi hari yang dingin terbayar sudah. Kamu berhasil sampai ke garis start. Selanjutnya hanya perlu bersiap maju dan menempuh jarak menggunakan sepatu running adidas ini. Upper berbahan mesh sangat ringan sehingga kamu tidak akan merasakannya saat berlari. Bantalan Lightstrike menghasilkan sensasi lari yang responsif dan pas. Produk ini dibuat dengan Primegreen, rangkaian material hasil daur ulang beperforma tinggi. 50% dari upper berbahan konten hasil daur ulang. Tanpa virgin poliester.', 13, 39, 'list_products/17.jpg'),
(18, 'SEPATU GALAXY 5', 700000, 'SEPATU RUNNING YANG RINGAN DENGAN SIRKULASI UDARA YANG LEBIH BAIK.', 'Maksimalkan kualitas sesi lari Anda. Berapa pun jauh Anda berlari, sepatu adidas ini akan membuat setiap langkah Anda terasa nyaman. Beberapa blok lagi. Beberapa putaran lagi. Atau, beberapa kilometer lagi. Anda pasti bisa melakukannya.', 11, 77, 'list_products/18.jpg'),
(19, 'SEPATU ADIZERO BOSTON 10', 2200000, 'BERLARI SETIAP HARI SEPERTI DALAM KOMPETISI.', 'adizero Boston 10 adalah sepatu running serbaguna yang didesain untuk memaksimalkan sesi latihan lari panjangmu sehari-hari. Dibangun melalui warisan dan evolusi desain adizero, adizero Boston 10 menawarkan teknologi canggih bagi pelari, menghadirkan LIGHTSTRIKE PRO yang dikombinasikan dengan busa midsole LIGHTSTRIKE EVA yang tahan lama, ENERGYRODS, dan OUTSOLE KARET CONTINENTAL™ untuk menunjang latihan lari jarak jauh sehari-hari dengan sensasi yang ringan dan tahan lama.', 11, 30, 'list_products/19.jpg'),
(20, 'SEPATU ULTRABOOST UNCAGED LAB', 3200000, 'SEPATU RUNNING BEPERFORMA TINGGI YANG DIDESAIN DENGAN MEMPERHATIKAN KELESTARIAN BUMI.', 'Hampir mustahil untuk berlari setiap hari dan tidak berpikir tentang jalur yang dilalui. Dari taman kota hingga jalur gurun, alam adalah stadion milik pelari. Sepatu Ultraboost Uncaged ini didesain khusus untuk kelestarian planet. Upper adidas Primeknit tanpa jahitan dibuat dari TENCEL™, dengan tali sepatu linen. Outsole fleksibel beradaptasi dengan pendaratan kakimu sekaligus menunjukkan potensi maksimal Boost.', 12, 31, 'list_products/20.jpg'),
(21, 'SEPATU ULTRABOOST 5.0 DNA', 2800000, 'SEPATU RUNNING DENGAN TAMPILAN YANG COCOK DIPAKAI KE MANA PUN.', 'Kenyamanan yang berasal dari aktivitas lari berpadu dengan style kasual pada Sepatu adidas Ultraboost 5.0 DNA ini. Bantalan Boost memberikan pengembalian energi sehingga kamu bisa tampil stylish dan merasa nyaman sepanjang hari. Upper adidas Primeknit yang fleksibel namun suportif.', 11, 53, 'list_products/21.jpg'),
(22, 'SEPATU DONOVAN MITCHELL D.O.N. ISSUE #3 - PREP SCHOOL', 1800000, 'PERSEMBAHAN TERBARU DARI ADIDAS BASKETBALL DAN DONOVAN MITCHELL.', 'Seperti sitkom legendaris era 90-an, Donovan pindah dari kota ke daerah pinggiran untuk mengejar mimpi basketnya. D.O.N. Issue #3: Sepatu Prep School dari adidas Basketball dibuat dalam kolaborasi bersama Bel-Air Athletics. Dilengkapi upper berpola di bagian dalam dan luar yang menyerupai lining dari jaket prep school yang ikonis dari acara tersebut. Dari pusat kota hingga Greenwich, gaya unik Donovan yang diterjemahkan ke segala jenis lapangan.', 11, 51, 'list_products/22.jpg'),
(23, 'SEPATU 4DFWD', 3200000, 'SEPATU RUNNING YANG DIRANCANG OLEH ATLET, UNTUK ATLET AGAR DAPAT BERLARI DENGAN MULUS.', 'Setiap desain stylish dimulai dengan pertanyaan. Untuk adidas 4DFWD, kami bertanya: Bisakah menciptakan sepatu running untuk memudahkan sesi larimu? Kami mempelajari siklus langkah ribuan pelari, lalu menyempurnakan midsole lattice dengan zona yang ditempatkan secara presisi untuk menghasilkan topangan dan penyerapan. Sepatu ini mengembangkan inovasi adidas 4D dengan menambahkan sudut pada persamaan. Dilengkapi juga dengan heel cradle yang mendorong kaki ke depan untuk melangkah dengan lebih mudah.', 12, 42, 'list_products/23.jpg'),
(24, 'SEPATU GOLF ZG21 MOTION RECYCLED POLYESTER', 3200000, 'SEPATU GOLF YANG DIDESAIN AGAR KAMU TETAP PERCAYA DIRI SAAT DI LAPANGAN.', 'Kepercayaan diri dalam ayunanmu menghasilkan kesuksesan di setiap hole. Sepatu golf adidas ini memberikan fondasi yang kuat untuk permainanmu karena midsole Boost dan Lightstrike hybrid yang menghasilkan bantalan yang nyaman dan pengembalian energi. Outsole berbahan TPU Thintech berdesain enam spike memberikan stabilitas dan daya cengkeram untuk menghasilkan pukulan bola yang konsisten. Upper waterproof membuat kaki tetap kering bahkan dalam lingkungan yang basah.', 11, 35, 'list_products/24.jpg'),
(25, 'SEPATU GOLF ZG21 MOTION PRIMEGREEN BOA MID-CUT', 3600000, 'SEPATU GOLF DENGAN FIT PENYESUAIAN MIKRO.', 'Kepercayaan diri dalam ayunanmu menghasilkan kesuksesan di setiap hole. Sepatu golf adidas Primeknit mid-cut ini memberikan fondasi yang solid untuk permainanmu. Paduan midsole Lightstrike and Boost memberikan sensasi berenergi dan ringan dalam setiap langkah. Outsole berbahan TPU Thintech berdesain enam spike memberikan stabilitas dan daya cengkeram untuk menghasilkan pukulan bola yang konsisten. Sistem Fit BOA® memungkinkanmu menyesuaikan fit dengan presisi, dan upper waterproof membuat kakimu tetap kering bahkan dalam kondisi yang lembap.', 13, 54, 'list_products/25.jpg'),
(26, 'SEPATU D ROSE SON OF CHI - GODSPEED', 1600000, 'PRODUK TERBARU DARI ADIDAS BASKETBALL DAN DERRICK ROSE.', 'Terinspirasi kejayaan perjalanan basket Derrick Rose, Sepatu D Rose Son of Chi: Godspeed dari adidas Basketball adalah tentang berkaca ke masa depan. Rona warna biru muda di bagian upper digunakan untuk merepresentasikan ketenangan dan optimisme serupa dengan langit biru yang cerah. Pilihan warna sejuk ini dilengkapi heel counter dengan efek perubahan warna, midsole Bounce yang ringan, dan outsole dengan warna serupa mutiara.', 13, 33, 'list_products/26.jpg'),
(27, 'SEPATU COURT VISION 3', 1500000, 'SEPATU BASKET DENGAN BANTALAN FLEKSIBEL YANG NYAMAN DIPAKAI DALAM SEGALA MACAM PERTANDINGAN.', 'Taklukkan pertahanan lawan dan tunjukkan keunggulan permainan. Apakah kamu bermain di lapangan kayu atau blacktop, sepatu basket adidas ini menjadi perpaduan ideal antara performa dan style. Upper warna-warni pada sepatu ini terlihat menarik, dan midsole Bounce yang ringan menawarkan bantalan responsif dan pijakan yang nyaman saat kamu beraksi dari sisi ke sisi. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.', 13, 43, 'list_products/27.jpg'),
(28, 'SEPATU TENIS ADIZERO UBERSONIC 4', 2000000, 'SEPATU SUPER-RESPONSIF YANG TERASA BEGITU RINGAN SAAT DIPAKAI DI HARD COURT.', 'Waktu menjadi senjata terbaikmu saat berada di lapangan tenis. Dapatkan keunggulan itu dengan sepatu adidas Adizero Ubersonic 4 yang ringan ini. Upper 360 dari bahan mesh rajut yang breathable dan tanpa jahitan ini membuatmu tetap nyaman dan fokus saat bermain dengan intens. Dilengkapi penguat di bagian dalam agar tetap stabil saat digunakan dalam gerakan lintas lapangan yang ekstrem. Di bawahnya, bantalan Lighstrike low-profile memastikanmu selalu siap merespons secara instan.', 11, 31, 'list_products/28.jpg'),
(29, 'ULTRABOOST 20 EXPLORER SHOES', 3200000, 'RESPONSIVE RUNNING SHOES FOR ALL-DAY COMFORT.', 'Even with its innovative design and legendary technology, the vision behind Ultraboost is quite simple — comfort. Lace into these adidas running shoes and find it wherever the day takes you. Boost cushioning fuels every step with energy, and the water-repellent upper keeps you going in cool weather.', 11, 37, 'list_products/29.jpg'),
(30, 'SEPATU BOLA X SPEEDFLOW.4 FLEXIBLE GROUND', 800000, 'SEPATU BOLA RINGAN UNTUK VERSI KECEPATANMU.', 'Dari ide ke sepatu ke bola. Dan kembali lagi. Saat ketajaman pikiran berpadu dengan kecepatan gerakan, kamu menjadi versi tercepat dari dirimu. Temukan ritmemu dan tinggalkan lawanmu. Bermain dengan maksimal menggunakan sepatu bola adidas X ini. Upper berbahan tekstil lembut dengan bahan pelapis membuat langkah terasa nyaman saat kamu beraksi. Di bagian bawah, outsole serbaguna membuatmu dapat bergerak dengan cepat di lapangan firm ground, hard ground, dan lapangan rumput sintetis.', 12, 60, 'list_products/30.jpg'),
(31, 'SEPATU ALPHABOUNCE', 1800000, 'SEPATU RUNNING SERBAGUNA UNTUK KECEPATAN DI SEGALA ARAH.', 'Sensasi kompetitif yang kau cari? Semua ada dalam rutinitas latihanmu. Sepatu running adidas ini membuatmu tetap merasa nyaman dalam sesi olahraga di gym, berlatih, dan sesi lari jarak pendek hingga menengah. Suportif namun fleksibel, sepatu ini memiliki sensasi stabil selama latihan dari sisi ke sisi seperti pemain ski es. Bantalan Bounce terasa elastis di bagian underfoot.', 12, 34, 'list_products/31.jpg'),
(32, 'SEPATU PUREBOOST 21', 2000000, 'SEPATU RUNNING RESPONSIF YANG DIDESAIN UNTUK GERAKAN YANG NATURAL.', 'Rencana latihan hanya sebagus usahamu dalam mengeksekusinya. Sepatu running adidas ini mendukung dedikasimu melalui pengembalian energi Boost yang luar biasa. Upper sepatu ini dibuat dari material hasil daur ulang, sehingga ada lebih dari satu hal positif dalam aktivitas larimu. Produk ini dibuat dengan Primeblue, material hasil daur ulang beperforma tinggi yang dibuat dengan Parley Ocean Plastic. 50% dari upper dibuat dari bahan tekstil, 75% dari bahan tekstilnya dibuat dari benang tenun Primeblue. Tanpa virgin poliester.', 11, 99, 'list_products/32.jpg'),
(33, 'SEPATU DAME 7 EXTPLY: OPPONENT ADVISORY', 1900000, 'DESAIN TERBARU DARI ADIDAS BASKETBALL DAN DAMIAN LILLARD.', 'Sepatu Dame 7 EXTPLY: Opponent Advisory dari adidas Basketball menyampaikan pesan untuk setiap pihak yang beroposisi di lapangan. Sepatu basket ini memadukan midsole Lightstrike super-ringan dan upper berwarna solid dengan motif putih cerah yang mengomunikasikan satu-satunya hal yang ingin ditunjukkan Dame jika kamu mencoba menjaganya: Lawan harus merespons dengan bijak. Jangan bilang dia tidak memperingatkanmu. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.', 13, 49, 'list_products/33.jpg'),
(34, 'SEPATU BOLA X SPEEDFLOW.3 LACELESS FIRM GROUND', 1300000, 'SEPATU BOLA RINGAN UNTUK VERSI KECEPATANMU.', 'Dari ide ke sepatu ke bola. Dan kembali lagi. Saat ketajaman pikiran berpadu dengan kecepatan gerakan, kamu menjadi versi tercepat dari dirimu. Temukan ritmemu dan tinggalkan lawanmu. Upper Speedskin semitransparan pada sepatu bola adidas X ini membuatmu tetap nyaman saat kamu melakukan aksi. Di bagian bawah, outsole berbahan TPU bisa digunakan untuk berakselerasi tinggi di lapangan firm ground. Fit tanpa tali yang pas di kaki membuatmu dapat melakukan kecohan dan kelokan untuk membuatmu selalu unggul.', 12, 32, 'list_products/34.jpg'),
(35, 'BARRICADE TOKYO TENNIS SHOES', 2200000, 'SUPPORTIVE SHOES TO CONTROL THE COURT ON SPORT&#039;S BIGGEST STAGE.', 'Without control, there are no guarantees on court. So Barricade is back to help you dominate. The intuitive lacing system on these adidas tennis shoes locks you in by pulling down the neoprene tongue to match your foot shape. A Geofit system in the heel fills the remaining gaps to complete the connection. Underneath, a cushioned Bounce midsole and TPU midfoot shank keep every step comfortable and stable. That bold adidas wordmark on the medial side is made from tough RPU to combat wear from foot drag.', 13, 31, 'list_products/35.jpg'),
(36, 'SEPATU GOLF SPIKELESS S2G', 1700000, 'SEPATU GOLF DENGAN KENYAMANAN SEHARI-HARI DAN FUNGSI SERBA GUNA DI LUAR LAPANGAN.', 'Bermain di sembilan hole pertama dan nikmati hari yang santai. Sepatu golf adidas ini menghadirkan kenyamanan sepanjang babak dan desain tanpa stud menjadikan serbaguna untuk aktivitas di luar lapangan. Upper dari bahan tekstil yang lembut mengikuti bentuk kaki untuk menghasilkan postur yang suportif. Midsole Bounce membuat sepatu ini terasa empuk dan nyaman dalam aktivitas apa pun.', 12, 82, 'list_products/36.jpg'),
(37, 'SEPATU GOLF S2G', 1800000, 'SEPATU GOLF DENGAN TONJOLAN YANG TERINSPIRASI DESAIN SEPATU SNEAKER YANG NYAMAN.', 'Ketika berada di sembilan atau satu babak penuh, sepatu golf adidas ini memberikan kenyamanan kasual dan traksi dengan tonjolan untuk kombinasi serbaguna. Upper dari bahan kulit menopang postur kaki dengan fit terkunci dan perlindungan waterproof. Dipadukan dengan midsole Bounce, sepatu ini memberikan kenyamanan dalam waktu yang lama dalam aktivitas apa pun. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.', 13, 44, 'list_products/37.jpg'),
(38, 'SEPATU TRAIL RUNNING TERREX SOULSTRIDE', 1400000, 'SEPATU TRAIL RUNNING YANG DIDESAIN UNTUK KENYAMANAN JARAK JAUH DARI JALUR JALANAN HINGGA TRAIL.', 'Maksimalkan jarak larimu dengan sepatu trail running adidas Terrex ini. Midsole yang empuk dan bantalan pillow-like di bagian tumit membuat sepatu ini nyaman digunakan seharian dalam setiap langkah. Lug sol hybrid memungkinkan transisi yang mudah antara jalanan dan jalur trail. Sidewall tinggi yang dilengkapi dengan upper berbahan mesh khusus guna menambahkan stabilitas untuk menghasilkan pijakan mantap ke mana pun kamu berlari.', 12, 54, 'list_products/38.jpg'),
(39, 'SEPATU GOLF SPIKELESS ADICROSS ZX PRIMEBLUE', 2100000, 'SEPATU GOLF SERBAGUNA YANG NYAMAN DIPAKAI DI DALAM DAN DI LUAR LAPANGAN.', 'Hadirkan kenyamanan dan performa dalam permainanmu dengan sepatu golf adidas ini. Midsole Boost memberikan pengembalian energi dari tee pertama hingga putt terakhir. Upper dari bahan tekstil dengan keunggulan waterproof membuat kaki tetap kering bahkan dalam kondisi basah. Outsole Traxion tanpa tonjolan memberikan daya cengkeram di berbagai medan dan bertransisi dengan mudah dari lapangan ke clubhouse dan aktivitas lainnya.', 13, 51, 'list_products/39.jpg'),
(40, 'SEPATU LIGHTSTRIKE GO', 1500000, 'SEPATU ULTRANYAMAN UNTUK MENCAPAI TARGET LARIMU DENGAN STYLISH.', 'Kenali tubuhmu. Kenali pikiranmu. Kenali planet bumi. Lari adalah latihan pamungkas untuk berbagai olahraga, dan sepatu adidas ini menunjang aktivitas itu dalam setiap milnya. Dibuat dari material hasil daur ulang, dan dilengkapi bantalan Lightstrike yang meningkatkan kenyamanan saat kamu memacu diri. Produk ini dibuat dengan Primegreen, rangkaian material hasil daur ulang beperforma tinggi. 50% dari upper berbahan konten hasil daur ulang. Tanpa virgin poliester.', 11, 55, 'list_products/40.jpg'),
(41, 'SEPATU X9000L4', 2200000, 'SEPATU RUNNING RESPONSIF DENGAN DESAIN YANG TERINSPIRASI GAMER.', 'Beberapa mil cukup untuk memulihkan pikiranmu. Sepatu running adidas ini membuatmu tetap merasa nyaman dalam sesi lari jarak pendek hingga menengah. Sepatu ini dilengkapi midsole Boost full-length yang memberikan pengembalian energi dalam setiap langkah. Desainnya mengambil inspirasi dari dunia virtual, dengan kejutan warna dan detail semi-transparan yang mengingatkan pada layar yang berpendar. Motif berkilau di bagian outsole menawarkan traksi berdaya cengkeram di jalanan perkotaan.', 12, 34, 'list_products/41.jpg'),
(42, 'SEPATU TRAIL RUNNING TERREX AGRAVIC TR', 1400000, 'SEPATU TRAIL RUNNING UNTUK SEGALA MACAM KONDISI PERMUKAAN.', 'Dapatkan pengalaman yang lebih luas. Bertualang di alam bebas dengan Sepatu Trail running Terrex Agravic dari adidas. Traksi, penopang, dan kenyamanan pada sepatu ini memungkinkan Anda untuk bergerak tanpa kendala di medan yang mulus, tidak rata, maupun berbatu.', 11, 35, 'list_products/42.jpg'),
(43, 'SEPATU EXHIBIT A EE (1 PAIR PER CUSTOMER)', 1900000, 'SEPATU BASKET RINGAN UNTUK SEGALA POSISI DI LAPANGAN.', 'Jika Exhibit A adalah seorang atlet, mungkin akan menjadi pemain serba bisa. Definisi keserbagunaan, sepatu basket adidas ini memberikan stabilitas serta kecepatan dalam desain yang dapat kamu pakai di luar aktivitas latihan. Upper berventilasi diperkuat dengan topangan di bagian yang kamu perlukan. Midsole Lightstrike siap untuk gerakan yang ringan dan dinamis. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.', 12, 91, 'list_products/43.jpg'),
(44, 'SEPATU TENIS PRIA MULTI-COURT APAC HALO', 1100000, 'SEPATU RINGAN UNTUK BERBAGAI JENIS PERMUKAAN LAPANGAN.', 'Anda menguasai permainan. Sepatu tenis adidas ini menyediakan platform-nya. Siap bermain dengan outsole berbahan karet multifungsi, sepatu ini akan membantu Anda mendominasi di semua jenis permukaan lapangan. Upper dari bahan mesh yang ringan membantu Anda agar bebas bergerak di lapangan. Busa di midsole memastikan pendaratan kaki yang lembut setelah melakukan loncatan servis dan smes yang tinggi.', 13, 70, 'list_products/44.jpg'),
(45, 'SEPATU RUN FALCON 2.0', 800000, 'SEPATU KASUAL ATLETIK UNTUK GAYA HIDUP YANG AKTIF.', 'Pakai sepatu running ini dan kamu siap untuk melakukan jogging di taman lalu minum kopi bersama teman. Dengan upper berbahan mesh untuk sirkulasi udara yang maksimal sepatu ini didesain agar nyaman dipakai sepanjang hari. Outsole dari bahan karet yang awet memberikan pijakan yang kuat seberapa sibuk pun jadwalmu.', 11, 35, 'list_products/45.jpg'),
(46, 'SEPATU RESPONSE SUPER 2.0', 1300000, 'SEPATU RUNNING UNTUK KENYAMANAN SEHARI-HARI.', 'Beraktivitas sepanjang hari dengan sensasi nyaman dan siap menghadapi apa pun dengan sepatu running adidas ini. Upper berbahan mesh yang breathable membuat kakimu tetap fresh bahkan dalam cuaca yang panas. Bantalan berenergi menghasilkan pantulan dalam setiap langkahmu. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.', 11, 31, 'list_products/46.jpg'),
(47, 'SEPATU GOLF SPIKELESS SOLARTHON PRIMEGREEN', 2300000, 'SEPATU GOLF YANG DIDESAIN AGAR NYAMAN DIPAKAI SEHARIAN.', 'Hari-hari panjang musim panas cocok untuk satu hal: golf. Maksimalkan waktu tambahan di lapangan dengan sepatu golf adidas ini. Bantalan Boost menghasilkan pengembalian energi pada setiap langkah untuk membuatmu tetap fresh dalam babak 18 hole dan aktivitas lainnya. Upper yang ringan dan breathable melindungi dari air, sehingga kakimu tetap kering saat berada di fairway yang lembap, dan Torsion System menambahkan stabilitas di bagian midfoot. Outsole Traxion spikeless memberikan daya cengkeram di medan yang tidak rata dan transisi yang mudah dari lapangan ke clubhouse.', 11, 75, 'list_products/47.jpg'),
(48, 'SEPATU PRO N3XT 2021', 1200000, 'SEPATU BASKET RINGAN YANG DIDESAIN UNTUK MEMBUAT ANDA LEBIH NYAMAN KETIKA BERMAIN DI LAPANGAN.', 'Mengacaukan pertahanan lawan sepanjang permainan. Sepatu basket adidas ini memungkinkanmu untuk bergerak cepat dengan sensasi yang nyaman berkat midsole Bounce yang ringan. Berkelok, berputar, dan mengungguli pemain bertahan lawan saat bermain di lapangan indoor yang rata ataupun lapangan black top. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.', 13, 58, 'list_products/48.jpg'),
(49, 'SEPATU COURTJAM BOUNCE', 1300000, 'SEPATU TENIS YANG MEMBUATMU TETAP FOKUS BERMAIN.', 'Dominasi lapangan tenis dengan nyaman. Material breathable mesh di bagian forefoot pada sepatu tenis adidas CourtJam Bounce membuatmu tetap sejuk, sedangkan overlay berbahan TPU memungkinkanmu meluncur dengan percaya diri. Di bagian bawah, midsole Bounce yang responsif memicu pantulan dan menjadi bantalan saat kaki mendarat. Bagian midfoot membuatmu tetap stabil dalam setiap perubahan arah.', 11, 35, 'list_products/49.jpg'),
(50, 'SEPATU FUTSAL PREDATOR FREAK.4 SALA INDOOR', 800000, 'SEPATU FUTSAL INDOOR YANG DIDESAIN UNTUK MEMAKSIMALKAN KONTROL.', 'Dinding tak bisa membatasimu. Lawan tak dapat menahanmu. Di lapangan, kamu menjadi pengendali. Keluarkan kemampuan dalam dirimu dengan Predator Freak. Dominasi permainan dengan sepatu futsal adidas sala ini. Upper yang nyaman terasa lembut dan adaptif. Outsole-nya membantumu bergerak dengan presisi di lapangan indoor yang datar.', 13, 51, 'list_products/50.jpg'),
(51, 'SEPATU BOLA PREDATOR FREAK.4 FLEXIBLE GROUND', 800000, 'SEPATU BOLA SERBAGUNA YANG DIDESAIN UNTUK MEMAKSIMALKAN KONTROL.', 'Kamu tidak dapat mengubah permainan hingga permainan mengubahmu. Setiap pertandingan adalah kesempatan untuk menjadi lebih hebat, lebih baik. Lebih memegang kendali. Keluarkan kemampuan dalam dirimu dengan Predator Freak. Sepatu bola adidas ini membuat bola tetap menempel di kakimu, ke mana pun arah permainan membawamu. Didesain dengan fungsi serbaguna, outsole-nya menghasilkan traksi tinggi di lapangan firm ground, hard ground, dan rumput sintetis.', 13, 65, 'list_products/51.jpg'),
(52, 'SEPATU GRAND COURT', 1100000, 'SNEAKER BERDESAIN MINIMALIS DENGAN STYLE KLASIK.', 'Style era 70-an yang dihadirkan kembali. Sepatu ini mengambil inspirasi dari style sporty ikonik dari koleksi klasik dan menghadirkannya ke masa depan. Sepatu ini memiliki desain yang kasual dengan upper berbahan kulit halus. 3-Stripes ciri khas adidas menghiasi bagian samping. Bantalan midsole yang empuk membuat kaki Anda nyaman saat melangkah.', 13, 78, 'list_products/52.jpg'),
(53, 'DAILY 3.0 SHOES', 900000, 'CLASSIC SHOES WITH A SEE-THROUGH OUTSOLE.', 'What do shoes have to be for you to wear them on the daily? Comfortable enough you don\'t think about them all day. And clean enough to match almost everything in your closet. This adidas pair accomplishes both, plus it has a translucent outsole that gives it a little edge.', 12, 69, 'list_products/53.jpg'),
(54, 'ULTRABOOST SUMMER.RDY TOKYO SHOES', 3000000, 'WARM-WEATHER RUNNING SHOES CO-CREATED BY HIROKO TAKAHASHI.', 'You might be sweaty and two uphill kilometres from home. But you can draw energy and inspiration from the athletes who\'ll compete this summer when you wear these adidas running shoes. They\'re designed in collaboration with Tokyo artist Hiroko Takahashi and her label, HIROCOLEDGE. The responsive midsole is decked out in circular shapes, a favourite pattern of hers for its neutrality in gender, nationality and time. From problem to performance This shoe\'s upper is made with Primeblue, a high-performance recycled material containing at least 50% Parley Ocean Plastic.', 11, 66, 'list_products/54.jpg'),
(55, 'SEPATU ULTRABOOST 4.0 DNA', 2800000, 'SEPATU ULTRABOOST YANG NYAMAN DIPAKAI SEHARI-HARI.', 'Legenda muda. adidas Ultraboost pertama kali dirilis di tahun 2015, dan trennya jauh melampaui dunia olahraga lari. Sepatu ini memiliki upper berbahan rajut lembut yang menawarkan ventilasi di bagian yang paling kami perlukan. Dilengkapi teknologi orisinal, dengan midsole Boost untuk menghasilkan kenyamanan yang harus kami rasakan sendiri untuk membuktikannya.', 12, 52, 'list_products/55.jpg'),
(56, 'SEPATU TENIS GAMECOURT', 850000, 'SEPATU YANG NYAMAN UNTUK MENDOMINASI PERMAINAN DI LAPANGAN.', 'Tingkatkan permainan tanpa meninggalkan zona nyamanmu. Upper dari bahan breathable mesh pada sepatu tenis adidas GameCourt ini membuat kakimu tetap terasa sejuk. Material TPU yang suportif membantu menyesuaikan dengan bentuk kaki untuk menghasilkan fit yang nyaman dan penguncian yang pas. Midsole Cloudfoam membuat setiap langkah terasa lembut saat intensitas meningkat.', 12, 39, 'list_products/56.jpg'),
(57, 'SEPATU ADIZERO ADIOS 5', 2200000, 'SEPATU RUNNING RINGAN YANG DIDESAIN UNTUK MEMAKSIMALKAN KECEPATAN.', 'Capai rekor pribadi yang baru dan tinggalkan para pesaingmu. Lakukan hal tersebut dengan sepatu running adidas ini. Didesain khusus untuk kecepatan, sesuai untukmu. Upper ultraringan beradaptasi dengan kaki untuk menghasilkan sensasi breathable yang nyaman. Bantalan Lightstrike dan Boost mengombinasikan sensasi pengembalian energi yang elastis. Siap untuk half-marathon? Kini, kamu siap.', 13, 78, 'list_products/57.jpg'),
(58, 'SEPATU GOLF SPIKELESS CODECHAOS 21 PRIMEBLUE', 2700000, 'SEPATU GOLF SPIKELESS UNTUK KENYAMANAN DAN TOPANGAN YANG MENINGKATKAN KEPERCAYAAN DIRI.', 'Hadirkan karakter disruptif di lapangan golf. Sepatu Golf Spikeless adidas Codechaos BOA® 21 Primeblue ini menghadirkan kenyamanan tinggi dan energi dalam permainanmu. Upper dari bahan rajut mesh waterproof dengan overlay suportif menawarkan performa ringan dengan tampilan yang unik. Boost di sepanjang bagian bawah memberikan energi seharian di lapangan golf, sedangkan outsole Adiwear spikeless dengan daya cengkeram yang kuat memberikan traksi dan stabilitas setingkat tur golf.', 11, 31, 'list_products/58.jpg'),
(59, 'SEPATU BOLA COPA SENSE.1 FIRM GROUND', 2800000, 'SEPATU BERBAHAN KULIT UNTUK SENTUHAN YANG SELEMBUT SUTRA.', 'Beberapa pemain menarik perhatian. Tapi yang benar-benar hebat tak seperti itu, memecah kebisingan dengan sentuhan yang paling ringan. Fokus pada insting sepak bolamu dengan adidas Copa Sense. Foam Sensepoda mengisi setiap celah di bagian tumit sepatu bola untuk lapangan padat ini, yang membuatmu menyatu dengan upper berbahan K-leather yang lembut. Di bagian luar, tambahan bantalan Touchpods dan Softstuds membuatmu tetap fokus pada permainan.', 13, 51, 'list_products/1.jpg'),
(60, 'SEPATU ULTRABOOST 21', 3200000, 'TINGKATKAN LEVEL LARIMU DENGAN SEPATU ULTRABOOST 21 INI.', 'Prototipe demi prototipe. Inovasi demi inovasi. Pengujian demi pengujian. Bersama-sama dengan kami dalam mewujudkan harmonisasi terbaik dalam hal berat, bantalan, dan responsitivitas. Ultraboost 21. Sambut pengembalian energi yang luar biasa.', 11, 45, 'list_products/2.jpg');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `password` varchar(100) NOT NULL,
  `roles` varchar(100) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id_user`, `username`, `email`, `nama`, `tanggal_lahir`, `password`, `roles`, `first_name`, `last_name`) VALUES
(1, 'pwsimpgodlike', 'samuel_20@mhs.istts.ac.id', 'Samuel Gunawan', '2002-07-01', 'eceddfdf7ace495d066389ca0f59a59b', 'admin', 'Samuel', 'Gunawan'),
(2, 'aaronlinggo', 'aaron_l20@mhs.istts.ac.id', 'Aaron Linggo Satria', '2002-01-01', '5eb116c57180cd6056b58b79ee84643d', 'admin', 'Aaron', 'Linggo Satria'),
(3, 'admin1', 'admin@dummy.com', 'Admin 1', '2002-11-25', 'e00cf25ad42683b3df678c61f42c6bda', 'admin', 'Admin', '1'),
(4, 'aaron', 'aaronlinggosatria@gmail.com', 'Aaron Linggo', '2002-01-01', '5eb116c57180cd6056b58b79ee84643d', 'Customer', 'Aaron', 'Linggo'),
(5, 'usertesting1', 'aaronlinggo@gmail.com', 'User Testing 1', '2002-01-01', '5eb116c57180cd6056b58b79ee84643d', 'Customer', 'User', 'Testing 1'),
(6, 'SamGun_Official', 'samgun9d32@gmail.com', 'Samuel Gunawan', '2002-07-01', '756725d5521d39d719c1ca11584c5c91', 'Customer', 'Samuel', 'Gunawan');


ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `sepatu_id` (`sepatu_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id_order_details`);

ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_item`);

ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`id_sepatu`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);


ALTER TABLE `cart_item`
  MODIFY `id_cart` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

ALTER TABLE `order_details`
  MODIFY `id_order_details` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

ALTER TABLE `order_items`
  MODIFY `id_order_item` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

ALTER TABLE `sepatu`
  MODIFY `id_sepatu` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

ALTER TABLE `users`
  MODIFY `id_user` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`sepatu_id`) REFERENCES `sepatu` (`id_sepatu`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
