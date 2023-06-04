/*
Navicat MySQL Data Transfer

Source Server         : yerel
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : rentacar

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-06-04 16:23:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_kullanici` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_sifre` varchar(100) NOT NULL,
  `admin_token` char(32) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'gizemkarydi@icloud.com', '66b65567cedbc743bda3417fb813b9ba', '3d7edd680c01ebbbcdb38b5c4a913de6');

-- ----------------------------
-- Table structure for `araclar`
-- ----------------------------
DROP TABLE IF EXISTS `araclar`;
CREATE TABLE `araclar` (
  `arac_id` int(11) NOT NULL AUTO_INCREMENT,
  `arac_model` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `arac_model_yili` varchar(50) NOT NULL DEFAULT '',
  `arac_resim` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `arac_yakit` varchar(50) NOT NULL DEFAULT '',
  `arac_kira_ucreti` int(50) DEFAULT NULL,
  `arac_durum` bit(1) NOT NULL DEFAULT b'0',
  `marka_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`arac_id`),
  KEY `fk_araclar_marka` (`marka_id`),
  CONSTRAINT `fk_araclar_marka` FOREIGN KEY (`marka_id`) REFERENCES `markalar` (`marka_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of araclar
-- ----------------------------
INSERT INTO `araclar` VALUES ('1', 'DBS', '2019', 'dbs.png', 'Benzin', '1400', '', '1');
INSERT INTO `araclar` VALUES ('2', 'Stelvio', '2020', 'stelvio.png', 'Dizel', '950', '\0', '2');
INSERT INTO `araclar` VALUES ('3', 'S3', '2015', 'S3.png', 'Benzin', '750', '\0', '3');
INSERT INTO `araclar` VALUES ('4', 'Q8', '2018', 'Q8.png', 'Dizel', '1200', '\0', '3');
INSERT INTO `araclar` VALUES ('5', 'R8', '2016', 'R8.png', 'Dizel', '1050', '\0', '3');
INSERT INTO `araclar` VALUES ('6', 'A6', '2018', 'A6.png', 'Dizel', '875', '', '3');
INSERT INTO `araclar` VALUES ('7', 'M3', '2018', 'M3.png', 'Benzin', '890', '\0', '4');
INSERT INTO `araclar` VALUES ('8', 'X6', '2017', 'X6.png', 'Benzin', '900', '\0', '4');
INSERT INTO `araclar` VALUES ('9', 'M1', '2019', 'bmw1.png', 'Benzin', '760', '\0', '4');
INSERT INTO `araclar` VALUES ('10', 'M4', '2017', 'bmw4.png', 'Dizel', '1080', '\0', '4');
INSERT INTO `araclar` VALUES ('11', '320i', '2018', 'bmw320.png', 'Dizel', '1345', '\0', '4');
INSERT INTO `araclar` VALUES ('12', 'Ranger', '2018', 'ranger.png', 'Benzin', '1600', '\0', '5');
INSERT INTO `araclar` VALUES ('13', 'A Sınıfı', '2017', 'asinif.png', 'Benzin', '1500', '\0', '6');
INSERT INTO `araclar` VALUES ('14', 'CLA', '2019', 'cla.png', 'Dizel', '1600', '\0', '6');
INSERT INTO `araclar` VALUES ('15', 'AMG', '2019', 'amg.png', 'Dizel', '1345', '\0', '6');
INSERT INTO `araclar` VALUES ('16', 'GLC', '2014', 'glc.png', 'Dizel', '1320', '\0', '6');
INSERT INTO `araclar` VALUES ('17', 'QASHQAI', '2020', 'qiqi.png', 'Dizel', '1690', '\0', '7');
INSERT INTO `araclar` VALUES ('18', 'Juke', '2019', 'juke.png', 'Benzin', '1750', '\0', '7');
INSERT INTO `araclar` VALUES ('19', '508', '2017', '508.png', 'Benzin', '765', '\0', '8');
INSERT INTO `araclar` VALUES ('20', 'Zoe', '2021', 'zoe.png', 'Elektrikli', '1750', '\0', '9');
INSERT INTO `araclar` VALUES ('21', 'Megane Sedan', '2019', 'megane.png', 'Dizel', '1600', '\0', '9');
INSERT INTO `araclar` VALUES ('22', 'Polo', '2020', 'polo.png', 'Dizel', '1430', '\0', '10');

-- ----------------------------
-- Table structure for `iletisim`
-- ----------------------------
DROP TABLE IF EXISTS `iletisim`;
CREATE TABLE `iletisim` (
  `iletisim_id` int(11) NOT NULL AUTO_INCREMENT,
  `iletisim_ad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `iletisim_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `iletisim_konu` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `iletisim_mesaj` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  PRIMARY KEY (`iletisim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of iletisim
-- ----------------------------
INSERT INTO `iletisim` VALUES ('1', 'gizem', 'gizemkarydi@icloud.com', 'asd', 'aaa');
INSERT INTO `iletisim` VALUES ('2', 'gizem', 'gizemkarydi@icloud.com', 'asd', 'aaa');
INSERT INTO `iletisim` VALUES ('3', 'gizem', 'gizemkarydi@icloud.com', 'asd', 'gcghkcj\r\n');

-- ----------------------------
-- Table structure for `kiralama`
-- ----------------------------
DROP TABLE IF EXISTS `kiralama`;
CREATE TABLE `kiralama` (
  `kira_id` int(11) NOT NULL AUTO_INCREMENT,
  `kira_basla` date DEFAULT NULL,
  `kira_bitir` date DEFAULT NULL,
  `arac_id` int(11) DEFAULT NULL,
  `musteri_id` int(11) DEFAULT NULL,
  `fiyat` int(11) DEFAULT NULL,
  PRIMARY KEY (`kira_id`),
  KEY `fk_Kiralama_arac` (`arac_id`),
  KEY `fk_Kiralama_musteri` (`musteri_id`),
  CONSTRAINT `fk_Kiralama_arac` FOREIGN KEY (`arac_id`) REFERENCES `araclar` (`arac_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Kiralama_musteri` FOREIGN KEY (`musteri_id`) REFERENCES `musteriler` (`musteri_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- ----------------------------
-- Records of kiralama
-- ----------------------------
INSERT INTO `kiralama` VALUES ('28', '2023-05-24', '2023-05-25', '6', '7', '875');
INSERT INTO `kiralama` VALUES ('29', '2023-05-14', '2023-05-15', '1', '7', '1400');

-- ----------------------------
-- Table structure for `markalar`
-- ----------------------------
DROP TABLE IF EXISTS `markalar`;
CREATE TABLE `markalar` (
  `marka_id` int(11) NOT NULL AUTO_INCREMENT,
  `marka_adi` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `marka_hakkinda` mediumtext CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `marka_resim` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  PRIMARY KEY (`marka_id`,`marka_adi`),
  KEY `marka_id` (`marka_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of markalar
-- ----------------------------
INSERT INTO `markalar` VALUES ('1', 'Alfa_Romeo', '1910 yılında İtalya\'nın Milano şehrinde, Milanolu aristokrat bir aile tarafından kurulmuş olan bir otomobil üreticisidir. Özellikle 1960\'lı yıllarda Avrupa\'da popüler bir marka haline gelen Alfa Romeo, 1986 yılında Fiat\'a katılmıştır. Yönetimi Fiat\'ın elindedir. Ürettiği spor model otomobillerle dikkat çeken Alfa Romeo, ilk zamanlar kamyon, minibüs ve troleybüs gibi çeşitli vasıtaları da üretse de daha sonra sadece binek otomobil üretmeye karar vermiştir.', 'alfa romeo.png');
INSERT INTO `markalar` VALUES ('2', 'Aston_Martin', 'İngiliz otomobil üreticisi firma.\r\n\r\n1913 yılında Londra’da küçük bir atölyede Lionel Martin ve Robert Bamford tarafından kurulmuştur. İlk otomobillerini 1914 yılında piyasaya sürmüşlerdir. Aston Martin otomobilleri tamamen el yapımı olup üzerlerine, en son parçayı monte eden işçinin adı yazılır. Araçta plastik madde kullanılmadığından küllük, düğmeler ve havalandırma ızgaraları alüminyumdan imal edilir.', 'aston martin.png');
INSERT INTO `markalar` VALUES ('3', 'Audi', 'Alman menşeili bir otomobil şirketidir ve Volkswagen grubunun bir markasıdır. Şirketin merkezi Ingolstadt, Bavyera\'da bulunmaktadır. Şirketin geçmişi 1899 yılına ve August Horch\'a dayanmaktadır. İlk Horch otomobili kendisi tarafından 1901 yılında tasarlanmıştı. 1910 yılında Horsche, şirket dışına atılmış ve kendi adını, eski ortaklarıyla olan anlaşmazlıklar nedeniyle yaptığı tasarımlarda kullanamayacak hale gelmişti. Eski Almancada anlamı \"Dinle!\" olan \"Horch\", Latincede aynı anlama gelen Audi\'yi kendi markası olarak kullanmaya başladı.', 'audi.png');
INSERT INTO `markalar` VALUES ('4', 'BMW', '1916 yılında kurulan Alman: otomobil, motosiklet, motor ve bisiklet üreticisidir. BMW ayrıca, Mini ve Rolls-Royce, otomobil şirketlerinin sahibidir. Çalışan sayısı 120.726’dır. 2020 cirosu 98 Milyar 998 Milyon Euro’dur, aynı yıl 2.494.451 araç üretmiştir. Bu üretimin 2.028.841 adedi BMW markası altındadır.', 'bmw.png');
INSERT INTO `markalar` VALUES ('5', 'Ford', 'Henry Ford tarafından Detroit, Michigan, ABD\'de 16 Haziran 1903 tarihinde kuruldu. Şu anda merkezi Dearborn, Michigan\'dadır.', 'ford.png');
INSERT INTO `markalar` VALUES ('6', 'Mercedes-Benz', '1926 yılında Karl Benz\'in şirketi Benz & Cie. ve Gottlieb Daimler\'in şirketi Daimler Motoren Gesellschaft\'in birleşmesi sonucu kurulmuş otomotiv ve motor markası. Almanya\'nın Stuttgart şehrinde kurulmuştur.', 'mercedes.png');
INSERT INTO `markalar` VALUES ('7', 'Nissan', '1934 yılında Jidosha-Seizo co. ve Nihon Sangyo Co.ltd. şirketleri birleşerek Ni-san adını alır. 1 Haziran 1934\'te şirketin adı Nissan Motor Co. Ltd. olur.\r\n\r\nGeleneksel olarak Nis san Dürüst samuray demektir ve görevi, verilen emaneti ve görevi canının son noktasına kadar korumak ve güvenliği sağlamadan can vermemektir. Bu yüzden Nissan - Made in Japan olan modeller daha uzun ömürlü motor ve şase yapısına sahiptir.', 'nissan.png');
INSERT INTO `markalar` VALUES ('8', 'Peugeot', 'Fransız otomobil, bisiklet ve motosiklet markası, günümüzde Stellantis`in bir parçasıdır. 1810 yılında el aletleri ile üretime başlamıştır, 1890 yılından bu yana da otomobil üreticisidir.', 'peugeot.png');
INSERT INTO `markalar` VALUES ('9', 'Renault', 'Fransız araç üreticisi. Otomobil, kamyon, traktör, tank, tren, uçak, motosiklet, bisiklet, otobüs gibi birçok farklı türde araç üretmektedir. Türkiye\'de Bursa\'da kurulu bulunan Oyak-Renault ortaklığı (%51) ile yatırımı vardır. Ayrıca Nissan otomobil markasının motorlarını üretmektedir.', 'renault.png');
INSERT INTO `markalar` VALUES ('10', 'Volkswagen', 'Almanya\'da, 1937 yılında tek model halk tipi otomobil üretimi için Nasyonal Sosyalist Alman İşçi Partisi tarafından Alman Otomotiv Birliğine kurdurulan otomobil firması.', 'volkswagen.png');

-- ----------------------------
-- Table structure for `musteriler`
-- ----------------------------
DROP TABLE IF EXISTS `musteriler`;
CREATE TABLE `musteriler` (
  `musteri_id` int(11) NOT NULL AUTO_INCREMENT,
  `musteri_ad` varchar(50) DEFAULT '',
  `musteri_soyad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `musteri_sifre` char(32) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `musteri_tel` varchar(15) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `musteri_email` varchar(50) DEFAULT NULL,
  `musteri_adres` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `musteri_token` char(32) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  PRIMARY KEY (`musteri_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of musteriler
-- ----------------------------
INSERT INTO `musteriler` VALUES ('7', 'Gizem', 'Karyağdı', 'fbd4b2d060c46709c60bbe083ac5bcc9', '551-435-3394', 'gizemkarydi@icloud.com', '', null);

-- ----------------------------
-- Table structure for `resimler`
-- ----------------------------
DROP TABLE IF EXISTS `resimler`;
CREATE TABLE `resimler` (
  `resim_id` int(11) NOT NULL,
  `arac_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`resim_id`),
  KEY `fk_resimler_arac` (`arac_id`) USING BTREE,
  CONSTRAINT `fk_resimler_arac` FOREIGN KEY (`arac_id`) REFERENCES `araclar` (`arac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of resimler
-- ----------------------------

-- ----------------------------
-- Table structure for `site_bilgileri`
-- ----------------------------
DROP TABLE IF EXISTS `site_bilgileri`;
CREATE TABLE `site_bilgileri` (
  `site_id` int(11) NOT NULL,
  `site_adi` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `site_slogan` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `site_kisa_bilgi` tinytext DEFAULT NULL,
  `site_hakkinda` text CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT '',
  `site_resim` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `site_adres` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `site_tel` varchar(14) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `site_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `site_kullanici` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `site_sifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '',
  `site_font` longtext CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of site_bilgileri
-- ----------------------------
INSERT INTO `site_bilgileri` VALUES ('1', 'RentGo', 'Daha fazla yenilik ve daha da ötesi için..', 'Amacımız daima güvenli araç ve yüksek hizmet kalitesi ile ekonomik fiyat garantisi sunmaktır.', 'RentGo, 100 yılı aşan köklü geçmişi ile Türkiye’nin en güvenilir ve önde gelen araç kiralama markasıdır.\r\n\r\nAraç kiralamada daima yeni ve güvenli araçlar ve yüksek hizmet kalitesi sunan RentGo, çatısı altında bulunduğu topluluğun 30 yıldan fazla kurumsal otomotiv sektörü deneyimini, yenilikçi vizyonu ve uzman kadrosu ile birleştirerek, kısa sürede araç kiralama sektörünün lider oyuncularından biri haline gelmiştir.\r\n\r\nTamamı yerli sermaye ile kurulan RentGo, günlük kiralama hizmetinin önde gelen şirketlerinden biridir.', 'a.jpg', 'Odunpazarı,Eskişehir,Türkiye', '222 413 22 57', 'rentacar_musteri@gmail.com', '', '', '');
INSERT INTO `site_bilgileri` VALUES ('2', '', '', null, null, 'b.jpg', '', '', '', '', '', '');
INSERT INTO `site_bilgileri` VALUES ('3', '', '', null, '', 'c.jpg', '', '', '', '', '', '');
INSERT INTO `site_bilgileri` VALUES ('4', '', '', null, '', 'd.jpg', '', '', '', '', '', '');
INSERT INTO `site_bilgileri` VALUES ('5', '', '', null, '', 'e.jpg', '', '', '', '', '', '');
INSERT INTO `site_bilgileri` VALUES ('6', '', '', null, '', 'f.jpg', '', '', '', '', '', '');
INSERT INTO `site_bilgileri` VALUES ('7', '', '', null, '', 'g.jpg', '', '', '', '', '', '');
INSERT INTO `site_bilgileri` VALUES ('8', '', '', null, '', 'h.jpg', '', '', '', '', '', '');
