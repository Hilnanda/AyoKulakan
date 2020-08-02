-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `ref_ppob_pulsa_provider`;
CREATE TABLE `ref_ppob_pulsa_provider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ref_ppob_pulsa_provider` (`id`, `code`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `type`, `deskripsi`) VALUES
(1,	'0895',	'three',	'hthree,threedata',	71,	71,	'2019-06-19 16:01:01',	'2019-06-22 08:09:52',	'pulsa',	NULL),
(2,	'0895',	'tri_paket_internet',	'hthree,threedata',	71,	71,	'2019-06-22 10:00:28',	'2019-06-22 10:00:41',	'data',	NULL),
(3,	'Garena',	'garena',	'-',	71,	71,	'2019-06-23 09:45:50',	'2019-06-23 10:31:26',	'game',	'<span><span><p class=\"u-fg--ash-dark\">Garena, platform game online milik\r\n Forrest Li, memiliki mata uang online sendiri berupa Garena Shell yang \r\ndapat kamu isi ulang untuk membeli produk game dan/atau in-games dari \r\nGarena.</p> <h2 class=\"u-txt--bold u-mrgn-bottom--2\">Daftar Game</h2> <p class=\"u-fg--ash-dark\">Arena of Valor, Free Fire, Contra Return, FIFA Online 3, League of Legends, dan lain-lain.</p></span></span>'),
(4,	'Google Play',	'google_play_indonesia',	'-',	71,	71,	'2019-06-23 09:46:23',	'2019-06-23 10:48:15',	'game',	NULL),
(5,	'Gemschool',	'gemscool',	'-',	71,	71,	'2019-06-23 09:46:47',	'2019-06-23 10:30:59',	'game',	'<span><span><p class=\"u-fg--ash-dark\">Voucher G-Cash bisa kamu gunakan \r\nuntuk memainkan berbagai game online seru dan menikmati berbagai konten \r\nmenarik lainnya dari Gemschool.</p> <h2 class=\"u-txt--bold u-mrgn-bottom--2\">Daftar Game</h2> <p class=\"u-fg--ash-dark\">Age\r\n of Wushu, Atlantica Online, Cabal Online, Crazy Shooter, Dizzel Online,\r\n Dragon Nest, Kart Rider Online Indonesia, Lost Saga, Tales Hero, \r\nYulgang Online dan lain-lain</p></span></span>'),
(6,	'Point Blank',	'point_blank',	'-',	71,	71,	'2019-06-23 09:47:08',	'2019-06-23 10:30:37',	'game',	'<span><span>Point Blank (PB Online) merupakan salah satu online game FPS\r\n paling populer di Indonesia yang menantang dan kompetitif dengan \r\nmembeli voucher Point Blank pemain dapat membeli item aksesoris, senjata\r\n hingga kostumisasi karakter sehingga menambah kemampuan dalam game</span></span>'),
(7,	'Mobile Legend',	'mobile_legend',	'-',	71,	71,	'2019-06-23 09:48:52',	'2019-06-23 10:30:11',	'game',	'<span><span>Mobile Legends adalah game yang dirancang untuk ponsel.di \r\ndalam permainan kedua tim lawan berjuang untuk mencapai dan \r\nmenghancurkan basis musuh sambil mempertahankan basis mereka sendiri \r\ndengan karakter role hero yang beragam</span></span>'),
(8,	'Wifi ID',	'wifi_id',	'-',	71,	71,	'2019-06-23 09:49:33',	'2019-06-23 10:30:01',	'game',	NULL),
(9,	'Free Fire',	'free_fire',	'-',	71,	71,	'2019-06-23 09:50:14',	'2019-06-23 10:29:51',	'game',	'<span><span>Garena Free Fire adalah game bergenre survival tembak \r\nmenembak yang tersedia di Android dan juga iOS. Kamu akan berada di \r\npulau terpencil di mana kamu akan bertempur dengan 49 pemain lain untuk \r\nmencari kelangsungan hidup. </span></span>'),
(10,	'Ituns Gift Card',	'itunes_gift_card_indonesia',	'-',	71,	71,	'2019-06-23 09:50:45',	'2019-06-23 10:47:59',	'game',	'<span><span>iTunes Gift Card adalah voucher pengisian saldo iTunes \r\nWallet yang digunakan untuk membeli musik, film, TV show, buku, games, \r\naplikasi dan konten-konten menarik lainnya yang tersedia di iTunes \r\nStore, App Store, iBooks Store dan Mac App Store.</span></span>'),
(11,	'Megaxus',	'megaxus',	'-',	71,	71,	'2019-06-23 09:51:09',	'2019-06-23 10:29:13',	'game',	'<span><span><h2 class=\"u-txt--bold u-mrgn-bottom--2\">Megaxus MI-Cash</h2> <p class=\"u-fg--ash-dark\">Megaxus\r\n merupakan salah portal game online Indonesia yang sudah berdiri ditahun\r\n 2006 silam. Game yang diluncurkan oleh Megaxus menyajikan konsep \'life \r\nentertainment\'. Ayo isi ulang  voucher Megaxusmu dan mainkan berbagai \r\ngame online serunya</p> <h2 class=\"u-txt--bold u-mrgn-bottom--2\">Daftar Game</h2> <p class=\"u-fg--ash-dark\">Audition\r\n AyoDance, Counter Strike Online (CSO), AyoOke (Online Karaoke), Heroes \r\nof Atarsia, World in AyoDance, Royal Master dan Closers Online</p></span></span>'),
(12,	'PUBG (PC)',	'pubg',	'-',	71,	71,	'2019-06-23 09:51:45',	'2019-06-23 10:29:03',	'game',	'<span><span><h2 class=\"u-txt--bold u-mrgn-bottom--2\">PUBG (PC)</h2> <p class=\"u-fg--ash-dark\">PlayerUnknown\'s\r\n Battlegrounds (PUBG) adalah game online multiplayer bergenre battle \r\nroyale yang dikembangkan dan diterbitkan oleh PUBG Corporation.</p> <h2 class=\"u-txt--bold u-mrgn-bottom--2\">Daftar Game</h2> <p class=\"u-fg--ash-dark\">PUBG (PC)</p></span></span>'),
(13,	'Steam Sea',	'steam_sea',	'-',	71,	71,	'2019-06-23 09:52:21',	'2019-06-23 10:28:52',	'game',	NULL),
(14,	'Battlenet Sea',	'battlenet_sea',	'-',	71,	71,	'2019-06-23 09:54:32',	'2019-06-23 10:28:43',	'game',	'<span><span><h2 class=\"u-txt--bold u-mrgn-bottom--2\">Battle.net Balance Card</h2> <p class=\"u-fg--ash-dark\">Isi\r\n ulang saldo kamu dengan Balance Card Battle.net untuk memainkan \r\nberbagai game online seru dari Battle.net by Blizzard Entertainment.</p> <h2 class=\"u-txt--bold u-mrgn-bottom--2\">Daftar Game</h2> <p class=\"u-fg--ash-dark\">Hearthstone, World of Warcraft, Diablo III, Starcraft II, Overwatch, Heroes of the Storm dan lain-lain</p></span></span>'),
(15,	'Wave Game',	'wave_game',	'-',	71,	71,	'2019-06-23 09:54:52',	'2019-06-23 10:28:29',	'game',	'<p><span style=\"font-size: 14px;\">﻿<b>Wafe Game</b></span><span style=\"font-size: 11px;\"></span><span><span style=\"font-size: 10px;\"></span></span><span><span><span style=\"font-size: 11px;\"> </span></span></span></p><p class=\"u-fg--ash-dark\"><span style=\"font-size: 11px;\">Wave\r\n Game merupakan publisher game online Indonesia yang menyediakan beragam\r\n game menarik berbasis client games, browser games, dan mobile games.</span></p><span style=\"font-size: 11px;\"><b>Daftar Game</b></span><span style=\"font-size: 11px;\"> </span><p class=\"u-fg--ash-dark\"><span style=\"font-size: 11px;\">3 Kingdoms Online & Angel Love Online, 3 Kingdom Frontier, Gods War Online, One Piece Online, Touch, dan lainnya</span></p><p></p>'),
(16,	'Ragnarok',	'ragnarok_m:_eternal_love',	'-',	71,	71,	'2019-06-23 09:56:07',	'2019-06-23 10:47:48',	'game',	'Untuk mengetahui User ID Anda, klik pada gambar karakter Anda. User ID Anda dapat ditemukan di bawah nama karakter Anda. Silakan masukkan User ID Anda untuk menyelesaikan transaksi. Contoh: <b>1234567890</b>');

-- 2019-06-27 16:15:35
