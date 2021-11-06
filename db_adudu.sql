-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 05:18 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_adudu`
--
CREATE DATABASE IF NOT EXISTS `db_adudu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_adudu`;

-- --------------------------------------------------------

--
-- Table structure for table `dtrans`
--

DROP TABLE IF EXISTS `dtrans`;
CREATE TABLE `dtrans` (
  `id_dtrans` int(16) NOT NULL,
  `htrans_id` int(16) NOT NULL,
  `sepatu_id` int(16) NOT NULL,
  `harga_transaksi` int(16) NOT NULL,
  `qty_transaksi` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `htrans`
--

DROP TABLE IF EXISTS `htrans`;
CREATE TABLE `htrans` (
  `id_htrans` int(16) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `user_id` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sepatu`
--

DROP TABLE IF EXISTS `sepatu`;
CREATE TABLE `sepatu` (
  `id_sepatu` int(16) NOT NULL,
  `nama_sepatu` varchar(100) NOT NULL,
  `harga_sepatu` int(16) NOT NULL,
  `sub_desc` varchar(500) NOT NULL,
  `desc_sepatu` varchar(500) NOT NULL,
  `size_sepatu` int(16) NOT NULL,
  `stock_sepatu` int(16) NOT NULL,
  `link_gambarsepatu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sepatu`
--

INSERT INTO `sepatu` (`id_sepatu`, `nama_sepatu`, `harga_sepatu`, `sub_desc`, `desc_sepatu`, `size_sepatu`, `stock_sepatu`, `link_gambarsepatu`) VALUES
(1, 'SEPATU BOLA COPA SENSE.1 FIRM GROUND', 2800000, 'SEPATU BERBAHAN KULIT UNTUK SENTUHAN YANG SELEMBUT SUTRA.\r\n', 'Beberapa pemain menarik perhatian. Tapi yang benar-benar hebat tak seperti itu, memecah kebisingan dengan sentuhan yang paling ringan. Fokus pada insting sepak bolamu dengan adidas Copa Sense. Foam Sensepoda mengisi setiap celah di bagian tumit sepatu bola untuk lapangan padat ini, yang membuatmu menyatu dengan upper berbahan K-leather yang lembut. Di bagian luar, tambahan bantalan Touchpods dan Softstuds membuatmu tetap fokus pada permainan.\r\n', 11, 50, 'list_products/1.jpg'),
(2, 'SEPATU ULTRABOOST 21', 3200000, 'TINGKATKAN LEVEL LARIMU DENGAN SEPATU ULTRABOOST 21 INI.\r\n', 'Prototipe demi prototipe. Inovasi demi inovasi. Pengujian demi pengujian. Bersama-sama dengan kami dalam mewujudkan harmonisasi terbaik dalam hal berat, bantalan, dan responsitivitas. Ultraboost 21. Sambut pengembalian energi yang luar biasa.\r\n', 11, 20, 'list_products/2.jpg'),
(3, 'SEPATU FUTSAL PREDATOR FREAK.3 INDOOR', 1200000, 'SEPATU FUTSAL LOW-CUT YANG MEMBANTUMU MENGONTROL PERMAINAN DI LAPANGAN DENGAN PERMUKAAN DATAR.\r\n', 'Di luar dinding ini, sulit untuk membuat dirimu terdengar. Namun di lapangan, kamu menjadi pengendali. Bebaskan kepribadian unikmu dengan adidas Predator. Sepatu futsal ini memiliki upper berbahan mesh lembut yang dilengkapi lapisan untuk membantumu mendominasi permainan dengan nyaman. Desain low-cut membuat sepatu ini mudah untuk dipakai dan dilepas. Ekspansi lebar elemen Demonscale dengan proses cetak 3D mencengkeram bola untuk membuatmu tetap fokus.\r\n', 11, 30, 'list_products/3.jpg'),
(4, 'GAMEMODE TURF BOOTS', 1200000, 'SOFT SYNTHETIC BOOTS IN MAN UTD COLOURS.\r\n', 'Every court is a platform. Every cage a stage. Where some players picture hard work, others see opportunity. The choice is yours. Express your beautiful game in adidas Gamemode. These football boots have a HybridTouch upper for a lightweight feel and soft touch. The universal fit and EVA cushioning add comfort. Underneath, a lugged outsole helps you display your skills on artificial turf. Up top, Manchester United\'s colours and badge show you stand with your club.\r\n', 11, 100, 'list_products/4.jpg'),
(5, 'GAMEMODE TURF BOOTS', 1200000, 'SOFT SYNTHETIC BOOTS IN MAN UTD COLOURS.\r\n', 'Every court is a platform. Every cage a stage. Where some players picture hard work, others see opportunity. The choice is yours. Express your beautiful game in adidas Gamemode. These football boots have a HybridTouch upper for a lightweight feel and soft touch. The universal fit and EVA cushioning add comfort. Underneath, a lugged outsole helps you display your skills on artificial turf. Up top, Manchester United\'s colours and badge show you stand with your club.\r\n', 11, 10, 'list_products/5.jpg'),
(6, 'SEPATU FUTSAL RAJUT GAMEMODE INDOOR', 1200000, 'SEPATU BERBAHAN TEKSTIL RAJUT YANG LEMBUT DENGAN WARNA ARSENAL.\r\n', 'Setiap lapangan menjadi platform. Setiap arena menjadi panggung. Ketika beberapa pemain memperlihatkan kerja keras, yang lain melihat peluang. Pilihan ada di tanganmu. Ekspresikan permainan menawanmu dengan adidas Gamemode. Sepatu futsal ini memiliki upper rajut dari bahan tekstil yang lembut dan elastis untuk membuat sepatu mudah dipakai dan mengunci dengan pas. Fit universal dan bantalan EVA menambah kenyamanan. Di bagian bawah, outsole dari bahan karet dengan daya cengkeram kuat membantumu me', 11, 12, 'list_products/6.jpg'),
(7, 'SEPATU ADIDAS 4D FUTURECRAFT', 4000000, 'SEPATU RUNNING DENGAN BANTALAN YANG DIDESAIN SECARA CERMAT UNTUK KENYAMANAN SETIAP HARI.\r\n', 'Aktivitas lari menghadirkan fokus yang cermat ke masa kini. Sepatu running adidas ini membawamu tanpa ragu ke masa depan. Midsole adidas 4D yang mutakhir berdasarkan data aktivitas lari selama 17 tahun dan didesain khusus secara digital untuk memadukan kenyamanan dalam setiap langkah. Upper adidas Primeknit memastikan sensasi penguncian yang beradaptasi dengan kaki dalam siklus gerakan langkahmu.\r\n', 11, 29, 'list_products/7.jpg'),
(8, 'BARRICADE SHOES', 2200000, 'CONTROL THE COURT IN THESE SUPPORTIVE SHOES.\r\n', 'Without control, there are no guarantees on court. So Barricade is back to help you dominate. The intuitive lacing system on these adidas tennis shoes locks you in by pulling down the neoprene tongue to match your foot shape. A Geofit system in the heel fills the remaining gaps to complete the connection. Underneath, a cushioned Bounce midsole and TPU midfoot shank keep every step comfortable and stable. That bold adidas wordmark on the medial side is made from tough RPU to combat wear from foot', 11, 44, 'list_products/8.jpg'),
(9, 'SEPATU BOLA PREDATOR FREAK.3 FIRM GROUND', 1300000, 'SEPATU BOLA MID-CUT YANG MEMBANTUMU MENGONTROL PERTANDINGAN DI LAPANGAN FIRM GROUND.\r\n', 'Setiap kali kamu melewati garis putih itu, kamu memasuki dunia baru. Sebuah realitas alternatif di mana kamu melakukan tendangan. Lapangan ada dalam genggamanmu. Bebaskan ide unikmu dengan adidas Predator. Sepatu bola ini memiliki upper berbahan tekstil dengan lapisan untuk membantumu mendominasi permainan dengan nyaman. Desain mid-cut menopang pergelangan kakimu. Ekspansi lebar elemen Demonscale dengan proses cetak 3D mencengkeram bola untuk membuatmu tetap fokus.\r\n', 11, 38, 'list_products/9.jpg'),
(10, 'SEPATU ULTRA 4D', 4000000, 'SEPATU RUNNING YANG DIRANCANG UNTUK ATLET DAN OLEH ATLET.\r\n', 'Pada debut adidas Ultraboost di tahun 2015, sepatu ini memiliki dampak yang tersebar hingga di luar dunia olahraga lari. Untuk versi sepatu ini, kami menghadirkan desain baru dengan midsole cetak 3D. Konstruksi lebih padat di bagian lattice memberikan topangan yang lebih baik, dan bagian yang terbuka terasa lebih empuk. Sepatu ini tidak hanya terlihat seperti sepatu masa depan. Namun, sensasi dipakainya juga terasa demikian.\r\n', 11, 5, 'list_products/10.jpg'),
(11, 'SEPATU FUTSAL TOP SALA', 1000000, 'SEPATU YANG BREATHABLE UNTUK DIPAKAI DI LAPANGAN FUTSAL.\r\n', 'Ubah pertahanan menjadi serangan balik dalam sekejap mata. Dioptimalkan untuk futsal bertempo cepat, sepatu futsal adidas ini dilengkapi outsole dari bahan karet yang dibuat untuk gerakan eksplosif di permukaan indoor yang rata. Material kulit sintetis di bagian forefoot mengurangi dampak benturan dan gesekan saat Anda melakukan aksi terbaik Anda. Bahan mesh di bagian quarter membantu kaki tetap merasa sejuk dalam tempo permainan cepat.\r\n', 11, 2, 'list_products/11.jpg'),
(12, 'DAME 7 EXTPLY SHOES', 1900000, 'THE LATEST FROM ADIDAS BASKETBALL AND DAMIAN LILLARD.\r\n\r\n', 'It\'s not easy to be at the top of your game in basketball and hip hop. The Dame 7 EXTPLY shoes from adidas Basketball mixes the love for both of Damian Lillard\'s passions. Each \"track\" of these basketball shoes is studio inspired. Dame never cheats the grind, asserting himself as the best baller to ever grace the booth, period. Introducing: Dame D.O.L.L.A. This product is made with recycled content as part of our ambition to end plastic waste. 20% of pieces used to make the upper are made with m', 11, 13, 'list_products/12.jpg'),
(13, 'SEPATU SL20.2', 1800000, 'SEPATU SNEAKER RINGAN YANG RESPONSIF UNTUK BERBAGAI AKTIVITAS SEHARIAN.\r\n', 'Setiap kali kamu memijakkan kaki di jalanan, bumi pun akan hadir menjadi pijakanmu. Sepatu adidas SL20.2 ini sebagai balas budi kebaikan bumi, karenanya dibuat dari material hasil daur ulang. Mitra latihan yang ideal, sepatu ini menopang setiap langkah dengan upper berbahan mesh fleksibel dan outsole karet dengan traksi tinggi. Lightstrike meningkatkan kenyamanan dengan sensasi super-ringan yang responsif sehingga membantumu melaju dengan cepat dan percaya diri. Produk ini dibuat dengan Primegre', 11, 99, 'list_products/13.jpg'),
(14, 'SUPERNOVA SHOES', 1700000, 'RESPONSIVE RUNNING SHOES FOR YOUR DAILY MILES.\r\n', 'Squeeze in a few laps before work or sprint across the finish line of your first 10K. When you\'re upping your mileage and tackling new running goals, these adidas Supernova Shoes are your go-to pair. The engineered mesh upper gives you support and ventilation where you need it most. Springy Bounce in the forefoot combines with responsive Boost in the heel to give a smooth, easy ride.\r\n', 11, 4, 'list_products/14.jpg'),
(15, 'SEPATU FUTSAL SUPER SALA', 900000, 'SEPATU FUTSAL BREATHABLE UNTUK MENUNJUKKAN KEMAMPUAN FUTSAL.\r\n', 'Kecoh penjagaanmu dalam sekejap mata. Dibuat untuk futsal bertempo cepat, sepatu futsal adidas ini dilengkapi outsole dari bahan karet non-marking yang didesain untuk gerakan eksplosif di permukaan indoor yang rata. Material sintetis yang awet di bagian forefoot tahan terhadap benturan dan goresan, sedangkan upper berbahan mesh membuat kaki yang bergerak cepat tetap terasa sejuk.\r\n', 11, 2, 'list_products/15.jpg'),
(16, 'SEPATU TRAE YOUNG 1', 1900000, 'PRODUK TERBARU DARI ADIDAS BASKETBALL DAN TRAE YOUNG.\r\n', 'Trae Young 1, dari adidas Basketball dan Trae Young, memadukan tampilan tak tertandingi dan style unik Trae dalam permainan dengan kelincahan, pengendalian, dan kenyamanan terbaik. Membuat debut sepatu signature-nya, setiap pilihan warna dalam koleksi ini terlihat mengabadikan pesona dan kepribadian Young yang unik sekaligus menghadirkan teknologi top dalam sepatu basket adidas. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah pl', 11, 1, 'list_products/16.jpg'),
(17, 'SEPATU ADIZERO ADIOS 6', 2000000, 'SEPATU RUNNING RINGAN UNTUK LATIHAN DAN KEJUARAAN LARI.\r\n', 'Lari dengan interval dan tempo di pagi hari yang dingin terbayar sudah. Kamu berhasil sampai ke garis start. Selanjutnya hanya perlu bersiap maju dan menempuh jarak menggunakan sepatu running adidas ini. Upper berbahan mesh sangat ringan sehingga kamu tidak akan merasakannya saat berlari. Bantalan Lightstrike menghasilkan sensasi lari yang responsif dan pas. Produk ini dibuat dengan Primegreen, rangkaian material hasil daur ulang beperforma tinggi. 50% dari upper berbahan konten hasil daur ulang', 11, 9, 'list_products/17.jpg'),
(18, 'SEPATU GALAXY 5', 700000, 'SEPATU RUNNING YANG RINGAN DENGAN SIRKULASI UDARA YANG LEBIH BAIK.\r\n', 'Maksimalkan kualitas sesi lari Anda. Berapa pun jauh Anda berlari, sepatu adidas ini akan membuat setiap langkah Anda terasa nyaman. Beberapa blok lagi. Beberapa putaran lagi. Atau, beberapa kilometer lagi. Anda pasti bisa melakukannya.\r\n', 11, 17, 'list_products/18.jpg'),
(19, 'SEPATU ADIZERO BOSTON 10', 2200000, 'BERLARI SETIAP HARI SEPERTI DALAM KOMPETISI.\r\n', 'adizero Boston 10 adalah sepatu running serbaguna yang didesain untuk memaksimalkan sesi latihan lari panjangmu sehari-hari. Dibangun melalui warisan dan evolusi desain adizero, adizero Boston 10 menawarkan teknologi canggih bagi pelari, menghadirkan LIGHTSTRIKE PRO yang dikombinasikan dengan busa midsole LIGHTSTRIKE EVA yang tahan lama, ENERGYRODS, dan OUTSOLE KARET CONTINENTAL™ untuk menunjang latihan lari jarak jauh sehari-hari dengan sensasi yang ringan dan tahan lama.\r\n', 11, 30, 'list_products/19.jpg'),
(20, 'SEPATU ULTRABOOST UNCAGED LAB', 3200000, 'SEPATU RUNNING BEPERFORMA TINGGI YANG DIDESAIN DENGAN MEMPERHATIKAN KELESTARIAN BUMI.\r\n', 'Hampir mustahil untuk berlari setiap hari dan tidak berpikir tentang jalur yang dilalui. Dari taman kota hingga jalur gurun, alam adalah stadion milik pelari. Sepatu Ultraboost Uncaged ini didesain khusus untuk kelestarian planet. Upper adidas Primeknit tanpa jahitan dibuat dari TENCEL™, dengan tali sepatu linen. Outsole fleksibel beradaptasi dengan pendaratan kakimu sekaligus menunjukkan potensi maksimal Boost.\r\n', 11, 21, 'list_products/20.jpg'),
(21, 'SEPATU ULTRABOOST 5.0 DNA', 2800000, 'SEPATU RUNNING DENGAN TAMPILAN YANG COCOK DIPAKAI KE MANA PUN.\r\n', 'Kenyamanan yang berasal dari aktivitas lari berpadu dengan style kasual pada Sepatu adidas Ultraboost 5.0 DNA ini. Bantalan Boost memberikan pengembalian energi sehingga kamu bisa tampil stylish dan merasa nyaman sepanjang hari. Upper adidas Primeknit yang fleksibel namun suportif.\r\n', 11, 11, 'list_products/21.jpg'),
(22, 'SEPATU DONOVAN MITCHELL D.O.N. ISSUE #3 - PREP SCHOOL', 1800000, 'PERSEMBAHAN TERBARU DARI ADIDAS BASKETBALL DAN DONOVAN MITCHELL.\r\n', 'Seperti sitkom legendaris era 90-an, Donovan pindah dari kota ke daerah pinggiran untuk mengejar mimpi basketnya. D.O.N. Issue #3: Sepatu Prep School dari adidas Basketball dibuat dalam kolaborasi bersama Bel-Air Athletics. Dilengkapi upper berpola di bagian dalam dan luar yang menyerupai lining dari jaket prep school yang ikonis dari acara tersebut. Dari pusat kota hingga Greenwich, gaya unik Donovan yang diterjemahkan ke segala jenis lapangan.\r\n', 11, 1, 'list_products/22.jpg'),
(23, 'SEPATU 4DFWD', 3200000, 'SEPATU RUNNING YANG DIRANCANG OLEH ATLET, UNTUK ATLET AGAR DAPAT BERLARI DENGAN MULUS.\r\n', 'Setiap desain stylish dimulai dengan pertanyaan. Untuk adidas 4DFWD, kami bertanya: Bisakah menciptakan sepatu running untuk memudahkan sesi larimu? Kami mempelajari siklus langkah ribuan pelari, lalu menyempurnakan midsole lattice dengan zona yang ditempatkan secara presisi untuk menghasilkan topangan dan penyerapan. Sepatu ini mengembangkan inovasi adidas 4D dengan menambahkan sudut pada persamaan. Dilengkapi juga dengan heel cradle yang mendorong kaki ke depan untuk melangkah dengan lebih mud', 11, 13, 'list_products/23.jpg'),
(24, 'SEPATU GOLF ZG21 MOTION RECYCLED POLYESTER', 3200000, 'SEPATU GOLF YANG DIDESAIN AGAR KAMU TETAP PERCAYA DIRI SAAT DI LAPANGAN.\r\n', 'Kepercayaan diri dalam ayunanmu menghasilkan kesuksesan di setiap hole. Sepatu golf adidas ini memberikan fondasi yang kuat untuk permainanmu karena midsole Boost dan Lightstrike hybrid yang menghasilkan bantalan yang nyaman dan pengembalian energi. Outsole berbahan TPU Thintech berdesain enam spike memberikan stabilitas dan daya cengkeram untuk menghasilkan pukulan bola yang konsisten. Upper waterproof membuat kaki tetap kering bahkan dalam lingkungan yang basah.\r\n', 11, 1, 'list_products/24.jpg'),
(25, 'SEPATU GOLF ZG21 MOTION PRIMEGREEN BOA MID-CUT', 3600000, 'SEPATU GOLF DENGAN FIT PENYESUAIAN MIKRO.\r\n', 'Kepercayaan diri dalam ayunanmu menghasilkan kesuksesan di setiap hole. Sepatu golf adidas Primeknit mid-cut ini memberikan fondasi yang solid untuk permainanmu. Paduan midsole Lightstrike and Boost memberikan sensasi berenergi dan ringan dalam setiap langkah. Outsole berbahan TPU Thintech berdesain enam spike memberikan stabilitas dan daya cengkeram untuk menghasilkan pukulan bola yang konsisten. Sistem Fit BOA® memungkinkanmu menyesuaikan fit dengan presisi, dan upper waterproof membuat kakimu', 11, 54, 'list_products/25.jpg'),
(26, 'SEPATU D ROSE SON OF CHI - GODSPEED', 1600000, 'PRODUK TERBARU DARI ADIDAS BASKETBALL DAN DERRICK ROSE.\r\n', 'Terinspirasi kejayaan perjalanan basket Derrick Rose, Sepatu D Rose Son of Chi: Godspeed dari adidas Basketball adalah tentang berkaca ke masa depan. Rona warna biru muda di bagian upper digunakan untuk merepresentasikan ketenangan dan optimisme serupa dengan langit biru yang cerah. Pilihan warna sejuk ini dilengkapi heel counter dengan efek perubahan warna, midsole Bounce yang ringan, dan outsole dengan warna serupa mutiara.\r\n', 11, 33, 'list_products/26.jpg'),
(27, 'SEPATU COURT VISION 3', 1500000, 'SEPATU BASKET DENGAN BANTALAN FLEKSIBEL YANG NYAMAN DIPAKAI DALAM SEGALA MACAM PERTANDINGAN.\r\n', 'Taklukkan pertahanan lawan dan tunjukkan keunggulan permainan. Apakah kamu bermain di lapangan kayu atau blacktop, sepatu basket adidas ini menjadi perpaduan ideal antara performa dan style. Upper warna-warni pada sepatu ini terlihat menarik, dan midsole Bounce yang ringan menawarkan bantalan responsif dan pijakan yang nyaman saat kamu beraksi dari sisi ke sisi. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari m', 11, 13, 'list_products/27.jpg'),
(28, 'SEPATU TENIS ADIZERO UBERSONIC 4', 2000000, 'SEPATU SUPER-RESPONSIF YANG TERASA BEGITU RINGAN SAAT DIPAKAI DI HARD COURT.\r\n', 'Waktu menjadi senjata terbaikmu saat berada di lapangan tenis. Dapatkan keunggulan itu dengan sepatu adidas Adizero Ubersonic 4 yang ringan ini. Upper 360 dari bahan mesh rajut yang breathable dan tanpa jahitan ini membuatmu tetap nyaman dan fokus saat bermain dengan intens. Dilengkapi penguat di bagian dalam agar tetap stabil saat digunakan dalam gerakan lintas lapangan yang ekstrem. Di bawahnya, bantalan Lighstrike low-profile memastikanmu selalu siap merespons secara instan.\r\n', 11, 21, 'list_products/28.jpg'),
(29, 'ULTRABOOST 20 EXPLORER SHOES', 3200000, 'RESPONSIVE RUNNING SHOES FOR ALL-DAY COMFORT.\r\n', 'Even with its innovative design and legendary technology, the vision behind Ultraboost is quite simple — comfort. Lace into these adidas running shoes and find it wherever the day takes you. Boost cushioning fuels every step with energy, and the water-repellent upper keeps you going in cool weather.\r\n', 11, 37, 'list_products/29.jpg'),
(30, 'SEPATU BOLA X SPEEDFLOW.4 FLEXIBLE GROUND', 800000, 'SEPATU BOLA RINGAN UNTUK VERSI KECEPATANMU.\r\n', 'Dari ide ke sepatu ke bola. Dan kembali lagi. Saat ketajaman pikiran berpadu dengan kecepatan gerakan, kamu menjadi versi tercepat dari dirimu. Temukan ritmemu dan tinggalkan lawanmu. Bermain dengan maksimal menggunakan sepatu bola adidas X ini. Upper berbahan tekstil lembut dengan bahan pelapis membuat langkah terasa nyaman saat kamu beraksi. Di bagian bawah, outsole serbaguna membuatmu dapat bergerak dengan cepat di lapangan firm ground, hard ground, dan lapangan rumput sintetis.\r\n', 11, 60, 'list_products/30.jpg'),
(31, 'SEPATU ALPHABOUNCE', 1800000, 'SEPATU RUNNING SERBAGUNA UNTUK KECEPATAN DI SEGALA ARAH.\r\n', 'Sensasi kompetitif yang kau cari? Semua ada dalam rutinitas latihanmu. Sepatu running adidas ini membuatmu tetap merasa nyaman dalam sesi olahraga di gym, berlatih, dan sesi lari jarak pendek hingga menengah. Suportif namun fleksibel, sepatu ini memiliki sensasi stabil selama latihan dari sisi ke sisi seperti pemain ski es. Bantalan Bounce terasa elastis di bagian underfoot.\r\n', 11, 14, 'list_products/31.jpg'),
(32, 'SEPATU PUREBOOST 21', 2000000, 'SEPATU RUNNING RESPONSIF YANG DIDESAIN UNTUK GERAKAN YANG NATURAL.\r\n', 'Rencana latihan hanya sebagus usahamu dalam mengeksekusinya. Sepatu running adidas ini mendukung dedikasimu melalui pengembalian energi Boost yang luar biasa. Upper sepatu ini dibuat dari material hasil daur ulang, sehingga ada lebih dari satu hal positif dalam aktivitas larimu. Produk ini dibuat dengan Primeblue, material hasil daur ulang beperforma tinggi yang dibuat dengan Parley Ocean Plastic. 50% dari upper dibuat dari bahan tekstil, 75% dari bahan tekstilnya dibuat dari benang tenun Primeb', 11, 9, 'list_products/32.jpg'),
(33, 'SEPATU DAME 7 EXTPLY: OPPONENT ADVISORY', 1900000, 'DESAIN TERBARU DARI ADIDAS BASKETBALL DAN DAMIAN LILLARD.\r\n', 'Sepatu Dame 7 EXTPLY: Opponent Advisory dari adidas Basketball menyampaikan pesan untuk setiap pihak yang beroposisi di lapangan. Sepatu basket ini memadukan midsole Lightstrike super-ringan dan upper berwarna solid dengan motif putih cerah yang mengomunikasikan satu-satunya hal yang ingin ditunjukkan Dame jika kamu mencoba menjaganya: Lawan harus merespons dengan bijak. Jangan bilang dia tidak memperingatkanmu. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami unt', 11, 49, 'list_products/33.jpg'),
(34, 'SEPATU BOLA X SPEEDFLOW.3 LACELESS FIRM GROUND', 1300000, 'SEPATU BOLA RINGAN UNTUK VERSI KECEPATANMU.\r\n', 'Dari ide ke sepatu ke bola. Dan kembali lagi. Saat ketajaman pikiran berpadu dengan kecepatan gerakan, kamu menjadi versi tercepat dari dirimu. Temukan ritmemu dan tinggalkan lawanmu. Upper Speedskin semitransparan pada sepatu bola adidas X ini membuatmu tetap nyaman saat kamu melakukan aksi. Di bagian bawah, outsole berbahan TPU bisa digunakan untuk berakselerasi tinggi di lapangan firm ground. Fit tanpa tali yang pas di kaki membuatmu dapat melakukan kecohan dan kelokan untuk membuatmu selalu ', 12, 12, 'list_products/34.jpg'),
(35, 'BARRICADE TOKYO TENNIS SHOES', 2200000, 'SUPPORTIVE SHOES TO CONTROL THE COURT ON SPORT&#039;S BIGGEST STAGE.\r\n', 'Without control, there are no guarantees on court. So Barricade is back to help you dominate. The intuitive lacing system on these adidas tennis shoes locks you in by pulling down the neoprene tongue to match your foot shape. A Geofit system in the heel fills the remaining gaps to complete the connection. Underneath, a cushioned Bounce midsole and TPU midfoot shank keep every step comfortable and stable. That bold adidas wordmark on the medial side is made from tough RPU to combat wear from foot', 12, 31, 'list_products/35.jpg'),
(36, 'SEPATU GOLF SPIKELESS S2G', 1700000, 'SEPATU GOLF DENGAN KENYAMANAN SEHARI-HARI DAN FUNGSI SERBA GUNA DI LUAR LAPANGAN.\r\n', 'Bermain di sembilan hole pertama dan nikmati hari yang santai. Sepatu golf adidas ini menghadirkan kenyamanan sepanjang babak dan desain tanpa stud menjadikan serbaguna untuk aktivitas di luar lapangan. Upper dari bahan tekstil yang lembut mengikuti bentuk kaki untuk menghasilkan postur yang suportif. Midsole Bounce membuat sepatu ini terasa empuk dan nyaman dalam aktivitas apa pun.\r\n', 12, 82, 'list_products/36.jpg'),
(37, 'SEPATU GOLF S2G', 1800000, 'SEPATU GOLF DENGAN TONJOLAN YANG TERINSPIRASI DESAIN SEPATU SNEAKER YANG NYAMAN.\r\n', 'Ketika berada di sembilan atau satu babak penuh, sepatu golf adidas ini memberikan kenyamanan kasual dan traksi dengan tonjolan untuk kombinasi serbaguna. Upper dari bahan kulit menopang postur kaki dengan fit terkunci dan perlindungan waterproof. Dipadukan dengan midsole Bounce, sepatu ini memberikan kenyamanan dalam waktu yang lama dalam aktivitas apa pun. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari mater', 12, 44, 'list_products/37.jpg'),
(38, 'SEPATU TRAIL RUNNING TERREX SOULSTRIDE', 1400000, 'SEPATU TRAIL RUNNING YANG DIDESAIN UNTUK KENYAMANAN JARAK JAUH DARI JALUR JALANAN HINGGA TRAIL.\r\n', 'Maksimalkan jarak larimu dengan sepatu trail running adidas Terrex ini. Midsole yang empuk dan bantalan pillow-like di bagian tumit membuat sepatu ini nyaman digunakan seharian dalam setiap langkah. Lug sol hybrid memungkinkan transisi yang mudah antara jalanan dan jalur trail. Sidewall tinggi yang dilengkapi dengan upper berbahan mesh khusus guna menambahkan stabilitas untuk menghasilkan pijakan mantap ke mana pun kamu berlari.\r\n', 12, 54, 'list_products/38.jpg'),
(39, 'SEPATU GOLF SPIKELESS ADICROSS ZX PRIMEBLUE', 2100000, 'SEPATU GOLF SERBAGUNA YANG NYAMAN DIPAKAI DI DALAM DAN DI LUAR LAPANGAN.\r\n', 'Hadirkan kenyamanan dan performa dalam permainanmu dengan sepatu golf adidas ini. Midsole Boost memberikan pengembalian energi dari tee pertama hingga putt terakhir. Upper dari bahan tekstil dengan keunggulan waterproof membuat kaki tetap kering bahkan dalam kondisi basah. Outsole Traxion tanpa tonjolan memberikan daya cengkeram di berbagai medan dan bertransisi dengan mudah dari lapangan ke clubhouse dan aktivitas lainnya.\r\n', 12, 1, 'list_products/39.jpg'),
(40, 'SEPATU LIGHTSTRIKE GO', 1500000, 'SEPATU ULTRANYAMAN UNTUK MENCAPAI TARGET LARIMU DENGAN STYLISH.\r\n', 'Kenali tubuhmu. Kenali pikiranmu. Kenali planet bumi. Lari adalah latihan pamungkas untuk berbagai olahraga, dan sepatu adidas ini menunjang aktivitas itu dalam setiap milnya. Dibuat dari material hasil daur ulang, dan dilengkapi bantalan Lightstrike yang meningkatkan kenyamanan saat kamu memacu diri. Produk ini dibuat dengan Primegreen, rangkaian material hasil daur ulang beperforma tinggi. 50% dari upper berbahan konten hasil daur ulang. Tanpa virgin poliester.\r\n', 12, 5, 'list_products/40.jpg'),
(41, 'SEPATU X9000L4', 2200000, 'SEPATU RUNNING RESPONSIF DENGAN DESAIN YANG TERINSPIRASI GAMER.\r\n', 'Beberapa mil cukup untuk memulihkan pikiranmu. Sepatu running adidas ini membuatmu tetap merasa nyaman dalam sesi lari jarak pendek hingga menengah. Sepatu ini dilengkapi midsole Boost full-length yang memberikan pengembalian energi dalam setiap langkah. Desainnya mengambil inspirasi dari dunia virtual, dengan kejutan warna dan detail semi-transparan yang mengingatkan pada layar yang berpendar. Motif berkilau di bagian outsole menawarkan traksi berdaya cengkeram di jalanan perkotaan.\r\n', 12, 34, 'list_products/41.jpg'),
(42, 'SEPATU TRAIL RUNNING TERREX AGRAVIC TR', 1400000, 'SEPATU TRAIL RUNNING UNTUK SEGALA MACAM KONDISI PERMUKAAN.\r\n', 'Dapatkan pengalaman yang lebih luas. Bertualang di alam bebas dengan Sepatu Trail running Terrex Agravic dari adidas. Traksi, penopang, dan kenyamanan pada sepatu ini memungkinkan Anda untuk bergerak tanpa kendala di medan yang mulus, tidak rata, maupun berbatu.\r\n', 12, 3, 'list_products/42.jpg'),
(43, 'SEPATU EXHIBIT A EE (1 PAIR PER CUSTOMER)', 1900000, 'SEPATU BASKET RINGAN UNTUK SEGALA POSISI DI LAPANGAN.\r\n', 'Jika Exhibit A adalah seorang atlet, mungkin akan menjadi pemain serba bisa. Definisi keserbagunaan, sepatu basket adidas ini memberikan stabilitas serta kecepatan dalam desain yang dapat kamu pakai di luar aktivitas latihan. Upper berventilasi diperkuat dengan topangan di bagian yang kamu perlukan. Midsole Lightstrike siap untuk gerakan yang ringan dan dinamis. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari m', 12, 9, 'list_products/43.jpg'),
(44, 'SEPATU TENIS PRIA MULTI-COURT APAC HALO', 1100000, 'SEPATU RINGAN UNTUK BERBAGAI JENIS PERMUKAAN LAPANGAN.\r\n', 'Anda menguasai permainan. Sepatu tenis adidas ini menyediakan platform-nya. Siap bermain dengan outsole berbahan karet multifungsi, sepatu ini akan membantu Anda mendominasi di semua jenis permukaan lapangan. Upper dari bahan mesh yang ringan membantu Anda agar bebas bergerak di lapangan. Busa di midsole memastikan pendaratan kaki yang lembut setelah melakukan loncatan servis dan smes yang tinggi.\r\n', 12, 79, 'list_products/44.jpg'),
(45, 'SEPATU RUN FALCON 2.0', 800000, 'SEPATU KASUAL ATLETIK UNTUK GAYA HIDUP YANG AKTIF.\r\n', 'Pakai sepatu running ini dan kamu siap untuk melakukan jogging di taman lalu minum kopi bersama teman. Dengan upper berbahan mesh untuk sirkulasi udara yang maksimal sepatu ini didesain agar nyaman dipakai sepanjang hari. Outsole dari bahan karet yang awet memberikan pijakan yang kuat seberapa sibuk pun jadwalmu.\r\n', 12, 35, 'list_products/45.jpg'),
(46, 'SEPATU RESPONSE SUPER 2.0', 1300000, 'SEPATU RUNNING UNTUK KENYAMANAN SEHARI-HARI.\r\n', 'Beraktivitas sepanjang hari dengan sensasi nyaman dan siap menghadapi apa pun dengan sepatu running adidas ini. Upper berbahan mesh yang breathable membuat kakimu tetap fresh bahkan dalam cuaca yang panas. Bantalan berenergi menghasilkan pantulan dalam setiap langkahmu. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% konten hasil daur ulang.\r\n', 12, 11, 'list_products/46.jpg'),
(47, 'SEPATU GOLF SPIKELESS SOLARTHON PRIMEGREEN', 2300000, 'SEPATU GOLF YANG DIDESAIN AGAR NYAMAN DIPAKAI SEHARIAN.\r\n', 'Hari-hari panjang musim panas cocok untuk satu hal: golf. Maksimalkan waktu tambahan di lapangan dengan sepatu golf adidas ini. Bantalan Boost menghasilkan pengembalian energi pada setiap langkah untuk membuatmu tetap fresh dalam babak 18 hole dan aktivitas lainnya. Upper yang ringan dan breathable melindungi dari air, sehingga kakimu tetap kering saat berada di fairway yang lembap, dan Torsion System menambahkan stabilitas di bagian midfoot. Outsole Traxion spikeless memberikan daya cengkeram d', 12, 7, 'list_products/47.jpg'),
(48, 'SEPATU PRO N3XT 2021', 1200000, 'SEPATU BASKET RINGAN YANG DIDESAIN UNTUK MEMBUAT ANDA LEBIH NYAMAN KETIKA BERMAIN DI LAPANGAN.\r\n', 'Mengacaukan pertahanan lawan sepanjang permainan. Sepatu basket adidas ini memungkinkanmu untuk bergerak cepat dengan sensasi yang nyaman berkat midsole Bounce yang ringan. Berkelok, berputar, dan mengungguli pemain bertahan lawan saat bermain di lapangan indoor yang rata ataupun lapangan black top. Produk ini dibuat dengan konten hasil daur ulang sebagai bagian dari ambisi kami untuk mengurangi pencemaran limbah plastik. 20% dari material yang digunakan dalam upper dibuat dengan minimum 50% kon', 12, 12, 'list_products/48.jpg'),
(49, 'SEPATU COURTJAM BOUNCE', 1300000, 'SEPATU TENIS YANG MEMBUATMU TETAP FOKUS BERMAIN.\r\n', 'Dominasi lapangan tenis dengan nyaman. Material breathable mesh di bagian forefoot pada sepatu tenis adidas CourtJam Bounce membuatmu tetap sejuk, sedangkan overlay berbahan TPU memungkinkanmu meluncur dengan percaya diri. Di bagian bawah, midsole Bounce yang responsif memicu pantulan dan menjadi bantalan saat kaki mendarat. Bagian midfoot membuatmu tetap stabil dalam setiap perubahan arah.\r\n', 12, 17, 'list_products/49.jpg'),
(50, 'SEPATU FUTSAL PREDATOR FREAK.4 SALA INDOOR', 800000, 'SEPATU FUTSAL INDOOR YANG DIDESAIN UNTUK MEMAKSIMALKAN KONTROL.\r\n', 'Dinding tak bisa membatasimu. Lawan tak dapat menahanmu. Di lapangan, kamu menjadi pengendali. Keluarkan kemampuan dalam dirimu dengan Predator Freak. Dominasi permainan dengan sepatu futsal adidas sala ini. Upper yang nyaman terasa lembut dan adaptif. Outsole-nya membantumu bergerak dengan presisi di lapangan indoor yang datar.\r\n', 12, 1, 'list_products/50.jpg'),
(51, 'SEPATU BOLA PREDATOR FREAK.4 FLEXIBLE GROUND', 800000, 'SEPATU BOLA SERBAGUNA YANG DIDESAIN UNTUK MEMAKSIMALKAN KONTROL.\r\n', 'Kamu tidak dapat mengubah permainan hingga permainan mengubahmu. Setiap pertandingan adalah kesempatan untuk menjadi lebih hebat, lebih baik. Lebih memegang kendali. Keluarkan kemampuan dalam dirimu dengan Predator Freak. Sepatu bola adidas ini membuat bola tetap menempel di kakimu, ke mana pun arah permainan membawamu. Didesain dengan fungsi serbaguna, outsole-nya menghasilkan traksi tinggi di lapangan firm ground, hard ground, dan rumput sintetis.\r\n', 12, 6, 'list_products/51.jpg'),
(52, 'SEPATU GRAND COURT', 1100000, 'SNEAKER BERDESAIN MINIMALIS DENGAN STYLE KLASIK.\r\n', 'Style era 70-an yang dihadirkan kembali. Sepatu ini mengambil inspirasi dari style sporty ikonik dari koleksi klasik dan menghadirkannya ke masa depan. Sepatu ini memiliki desain yang kasual dengan upper berbahan kulit halus. 3-Stripes ciri khas adidas menghiasi bagian samping. Bantalan midsole yang empuk membuat kaki Anda nyaman saat melangkah.\r\n', 12, 78, 'list_products/52.jpg'),
(53, 'DAILY 3.0 SHOES', 900000, 'CLASSIC SHOES WITH A SEE-THROUGH OUTSOLE.\r\n', 'What do shoes have to be for you to wear them on the daily? Comfortable enough you don\'t think about them all day. And clean enough to match almost everything in your closet. This adidas pair accomplishes both, plus it has a translucent outsole that gives it a little edge.\r\n', 12, 69, 'list_products/53.jpg'),
(54, 'ULTRABOOST SUMMER.RDY TOKYO SHOES', 3000000, 'WARM-WEATHER RUNNING SHOES CO-CREATED BY HIROKO TAKAHASHI.\r\n', 'You might be sweaty and two uphill kilometres from home. But you can draw energy and inspiration from the athletes who\'ll compete this summer when you wear these adidas running shoes. They\'re designed in collaboration with Tokyo artist Hiroko Takahashi and her label, HIROCOLEDGE. The responsive midsole is decked out in circular shapes, a favourite pattern of hers for its neutrality in gender, nationality and time. From problem to performance This shoe\'s upper is made with Primeblue, a high-perfo', 12, 11, 'list_products/54.jpg'),
(55, 'SEPATU ULTRABOOST 4.0 DNA', 2800000, '2800000\r\n', 'Legenda muda. adidas Ultraboost pertama kali dirilis di tahun 2015, dan trennya jauh melampaui dunia olahraga lari. Sepatu ini memiliki upper berbahan rajut lembut yang menawarkan ventilasi di bagian yang paling kami perlukan. Dilengkapi teknologi orisinal, dengan midsole Boost untuk menghasilkan kenyamanan yang harus kami rasakan sendiri untuk membuktikannya.\r\n', 12, 13, 'list_products/55.jpg'),
(56, 'SEPATU TENIS GAMECOURT', 850000, 'SEPATU YANG NYAMAN UNTUK MENDOMINASI PERMAINAN DI LAPANGAN.\r\n', 'Tingkatkan permainan tanpa meninggalkan zona nyamanmu. Upper dari bahan breathable mesh pada sepatu tenis adidas GameCourt ini membuat kakimu tetap terasa sejuk. Material TPU yang suportif membantu menyesuaikan dengan bentuk kaki untuk menghasilkan fit yang nyaman dan penguncian yang pas. Midsole Cloudfoam membuat setiap langkah terasa lembut saat intensitas meningkat.\r\n', 12, 32, 'list_products/56.jpg'),
(57, 'SEPATU ADIZERO ADIOS 5', 2200000, 'SEPATU RUNNING RINGAN YANG DIDESAIN UNTUK MEMAKSIMALKAN KECEPATAN.\r\n', 'Capai rekor pribadi yang baru dan tinggalkan para pesaingmu. Lakukan hal tersebut dengan sepatu running adidas ini. Didesain khusus untuk kecepatan, sesuai untukmu. Upper ultraringan beradaptasi dengan kaki untuk menghasilkan sensasi breathable yang nyaman. Bantalan Lightstrike dan Boost mengombinasikan sensasi pengembalian energi yang elastis. Siap untuk half-marathon? Kini, kamu siap.\r\n', 12, 78, 'list_products/57.jpg'),
(58, 'SEPATU GOLF SPIKELESS CODECHAOS 21 PRIMEBLUE', 2700000, 'SEPATU GOLF SPIKELESS UNTUK KENYAMANAN DAN TOPANGAN YANG MENINGKATKAN KEPERCAYAAN DIRI.\r\n', 'Hadirkan karakter disruptif di lapangan golf. Sepatu Golf Spikeless adidas Codechaos BOA® 21 Primeblue ini menghadirkan kenyamanan tinggi dan energi dalam permainanmu. Upper dari bahan rajut mesh waterproof dengan overlay suportif menawarkan performa ringan dengan tampilan yang unik. Boost di sepanjang bagian bawah memberikan energi seharian di lapangan golf, sedangkan outsole Adiwear spikeless dengan daya cengkeram yang kuat memberikan traksi dan stabilitas setingkat tur golf.\r\n', 12, 33, 'list_products/58.jpg'),
(59, 'ADIDAS ULTRABOOST X LEGO® COLORS SHOES (1 PAIR PER CUSTOMER)', 2560000, 'HIGH-PERFORMANCE RUNNING SHOES MADE IN PARTNERSHIP WITH THE LEGO GROUP.\r\n', 'Running is your time to play. And if you couldn\'t tell by the pops of colour and LEGO® bricks inspired design, these adidas running shoes created with the LEGO Group are all about play. Play, and comfort. Because nothing needs to get in the way of a good time. A plush Boost midsole takes care of the cushioning, and the Continental™ Better Rubber outsole balances fast moves with steady grounding.\r\n', 12, 90, 'list_products/59.jpg'),
(60, 'SEPATU HARDEN VOL. 5 FUTURENATURAL TOKYO', 1400000, 'PRODUK TERKINI DARI ADIDAS BASKETBALL DAN JAMES HARDEN.\r\n', 'Harden Vol. 5 dari adidas Basketball memiliki fit dan penguncian revolusioner untuk bergerak bebas dengan maksimal saat berada di lapangan basket, terinspirasi kecepatan dan kemampuan James Harden yang tak tertandingi untuk mengubah arah saat mendribel bola. Teknologi Futurenatural memperkenalkan sistem fit baru dan konstruksi tanpa jahitan untuk menghasilkan kontrol yang optimal. Kombinasi midsole Boost dan keunggulan Lightstrike yang ringan menghasilkan kenyamanan dan stabilitas yang dibutuhka', 12, 5, 'list_products/60.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `saldo` int(16) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dtrans`
--
ALTER TABLE `dtrans`
  ADD PRIMARY KEY (`id_dtrans`),
  ADD KEY `htrans_id` (`htrans_id`);

--
-- Indexes for table `htrans`
--
ALTER TABLE `htrans`
  ADD PRIMARY KEY (`id_htrans`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sepatu`
--
ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`id_sepatu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dtrans`
--
ALTER TABLE `dtrans`
  MODIFY `id_dtrans` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `htrans`
--
ALTER TABLE `htrans`
  MODIFY `id_htrans` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sepatu`
--
ALTER TABLE `sepatu`
  MODIFY `id_sepatu` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(16) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dtrans`
--
ALTER TABLE `dtrans`
  ADD CONSTRAINT `dtrans_ibfk_1` FOREIGN KEY (`htrans_id`) REFERENCES `htrans` (`id_htrans`);

--
-- Constraints for table `htrans`
--
ALTER TABLE `htrans`
  ADD CONSTRAINT `htrans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
