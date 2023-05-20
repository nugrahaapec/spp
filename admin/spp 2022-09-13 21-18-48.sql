
-- Database Backup --
-- Ver. : 1.0.1
-- Host : 127.0.0.1
-- Generating Time : Sep 13, 2022 at 21:18:48:PM


CREATE TABLE `admin` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `uname` varchar(40) NOT NULL,
  `pass` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO admin VALUES
("1","Nugaraha Apec Tryawan","nugrahaapec@yahoo.com","admin","21232f297a57a5a743894a0e4a801fc3");

CREATE TABLE `bulan` (
  `id_bulan` int(10) NOT NULL AUTO_INCREMENT,
  `nama_bulan` char(30) NOT NULL,
  PRIMARY KEY (`id_bulan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO bulan VALUES
("1","Januari"),
("2","Februari"),
("3","Maret"),
("4","April"),
("5","Mei"),
("6","Juni"),
("7","Juli"),
("8","Agustus"),
("9","September"),
("10","Oktober"),
("11","November"),
("12","Desember");

CREATE TABLE `coba` (
  `id_coba` int(10) NOT NULL AUTO_INCREMENT,
  `id_pos` int(3) NOT NULL,
  `nisn` int(20) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `id_bulan` int(10) NOT NULL,
  `id_tahun` int(3) NOT NULL,
  `biaya` int(20) NOT NULL,
  `status_pay` int(1) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_coba`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

INSERT INTO coba VALUES
("1","2","1110512012","1","1","2","300000","0","2022-09-14"),
("2","2","1110512012","1","2","2","300000","0","2022-09-14"),
("3","2","1110512012","1","3","2","300000","0","2022-09-14"),
("4","2","1110512012","1","4","2","300000","0","2022-09-14"),
("5","2","1110512012","1","5","2","300000","0","2022-09-14"),
("6","2","1110512012","1","6","2","300000","0","2022-09-14"),
("7","2","1110512012","1","7","2","300000","0","2022-09-14"),
("8","2","1110512012","1","8","2","300000","0","2022-09-14"),
("9","2","1110512012","1","9","2","300000","0","2022-09-15"),
("10","2","1110512012","1","10","2","300000","0","2022-09-14"),
("11","2","1110512012","1","11","2","300000","0","2022-09-14"),
("12","2","1110512012","1","12","2","300000","0","2022-09-14"),
("13","2","1210512013","1","1","2","300000","0","2022-09-14"),
("14","2","1210512013","1","2","2","300000","0","2022-09-14"),
("15","2","1210512013","1","3","2","300000","0","2022-09-14"),
("16","2","1210512013","1","4","2","300000","0","2022-09-14"),
("17","2","1210512013","1","5","2","300000","0","2022-09-14"),
("18","2","1210512013","1","6","2","300000","0","2022-09-14"),
("19","2","1210512013","1","7","2","300000","0","2022-09-14"),
("20","2","1210512013","1","8","2","300000","0","2022-09-14"),
("21","2","1210512013","1","9","2","300000","1","2022-09-14"),
("22","2","1210512013","1","10","2","300000","0","2022-09-14"),
("23","2","1210512013","1","11","2","300000","0","2022-09-14"),
("24","2","1210512013","1","12","2","300000","0","2022-09-14"),
("25","3","1110512012","1","1","3","200000","0","2022-09-14"),
("26","3","1110512012","1","2","3","200000","0","2022-09-14"),
("27","3","1110512012","1","3","3","200000","0","2022-09-14"),
("28","3","1110512012","1","4","3","200000","0","2022-09-14"),
("29","3","1110512012","1","5","3","200000","0","2022-09-14"),
("30","3","1110512012","1","6","3","200000","0","2022-09-14"),
("31","3","1110512012","1","7","3","200000","0","2022-09-14"),
("32","3","1110512012","1","8","3","200000","0","2022-09-14"),
("33","3","1110512012","1","9","3","200000","1","2022-09-14"),
("34","3","1110512012","1","10","3","200000","0","2022-09-14"),
("35","3","1110512012","1","11","3","200000","0","2022-09-14"),
("36","3","1110512012","1","12","3","200000","0","2022-09-14");

CREATE TABLE `kelas` (
  `id_kelas` int(9) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(9) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO kelas VALUES
("1","X"),
("2","XI"),
("3","XII");

CREATE TABLE `lain_pay` (
  `id_lainpay` int(10) NOT NULL AUTO_INCREMENT,
  `nisn` int(20) NOT NULL,
  `nis` int(20) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `id_pay` int(10) NOT NULL,
  `pay_tipe` varchar(10) NOT NULL,
  `id_tahun` int(10) NOT NULL,
  `status_pay` int(1) NOT NULL,
  `bill_pay` int(10) NOT NULL,
  `bill_pay_cash` int(20) NOT NULL,
  PRIMARY KEY (`id_lainpay`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

INSERT INTO lain_pay VALUES
("1","1110512012","30220900","1","3","Lainnya","3","0","100000","50000"),
("2","1210512013","30220900","1","3","Lainnya","3","0","100000","0"),
("3","1310512014","30220900","1","3","Lainnya","3","0","100000","0"),
("4","1410512015","30220900","1","3","Lainnya","3","0","100000","0"),
("5","1510512016","30220900","1","3","Lainnya","3","0","100000","0"),
("6","1610512017","30220900","1","3","Lainnya","3","0","100000","0"),
("7","1710512018","30220900","1","3","Lainnya","3","0","100000","0"),
("8","1810512019","30220900","1","3","Lainnya","3","0","100000","0"),
("9","1910512020","30220900","1","3","Lainnya","3","0","100000","0"),
("10","2010512021","30220900","1","3","Lainnya","3","0","100000","0"),
("11","2010512231","30220900","1","3","Lainnya","3","0","100000","0"),
("12","2110512022","30220900","1","3","Lainnya","3","0","100000","0");

CREATE TABLE `lain_pay_proses` (
  `id_proses` int(20) NOT NULL AUTO_INCREMENT,
  `nisn` int(20) NOT NULL,
  `nis` int(20) NOT NULL,
  `id_pay` int(20) NOT NULL,
  `id_kelas_pay` int(20) NOT NULL,
  `id_tahun_pay` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  `biaya` int(20) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status_pay` int(1) NOT NULL,
  PRIMARY KEY (`id_proses`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO lain_pay_proses VALUES
("1","1110512012","30220900","3","1","3","2022-09-14","50000","test","1");

CREATE TABLE `pos` (
  `id_pos` int(10) NOT NULL AUTO_INCREMENT,
  `nama_pos` varchar(30) NOT NULL,
  `keterangan_pos` varchar(40) NOT NULL,
  PRIMARY KEY (`id_pos`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO pos VALUES
("1","Seragam Sekolah","Seragam"),
("2","SPP","SPP"),
("3","OSIS","Iuran Osis");

CREATE TABLE `pos_pay` (
  `pay_id` int(10) NOT NULL AUTO_INCREMENT,
  `pay_tipe` varchar(10) NOT NULL,
  `id_tahun` int(10) NOT NULL,
  `id_pos` int(10) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

INSERT INTO pos_pay VALUES
("1","Lainnya","1","1"),
("2","Lainnya","2","1"),
("3","Lainnya","3","1"),
("5","Bulanan","2","2"),
("6","Bulanan","3","2"),
("7","Lainnya","3","3"),
("8","Bulanan","3","3");

CREATE TABLE `siswa` (
  `nisn` int(15) NOT NULL,
  `nis` int(15) NOT NULL,
  `nama_siswa` char(50) NOT NULL,
  `tempat` char(30) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `ibu` char(50) NOT NULL,
  `ayah` char(50) NOT NULL,
  `jk` char(10) NOT NULL,
  `kelas` int(3) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `status` int(1) NOT NULL,
  `id_tahun` int(10) NOT NULL,
  PRIMARY KEY (`nisn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO siswa VALUES
("1110512012","20220890","Muhammad Faizal","Jakarta","2000-07-04","Lilis","Udin","Laki-laki","1","085278982354","Jakarta Timur","1","1"),
("1110512112","20220122","Muhammad faizal","Jakarta","2000-08-15","Lilis","Udin","laki-laki","2","085278982354","Jakarta Timur","1","2"),
("1110512113","21220123","Nugraha","Jakarta","1994-11-14","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512114","22220124","Nugraha","Jakarta","1994-11-15","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512115","23220125","Nugraha","Jakarta","1994-11-16","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512116","24220126","Nugraha","Jakarta","1994-11-17","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512117","25220127","Nugraha","Jakarta","1994-11-18","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512118","26220128","Nugraha","Jakarta","1994-11-19","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512119","27220129","Nugraha","Jakarta","1994-11-20","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512120","28220130","Nugraha","Jakarta","1994-11-21","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512121","29220131","Nugraha","Jakarta","1994-11-22","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512122","30220132","Nugraha","Jakarta","1994-11-23","Aminah","Dedi","laki-laki","2","085283572363","Jakarta","1","2"),
("1110512222","20220812","Muhammad faizal","Jakarta","2000-08-15","Lilis","Udin","laki-laki","3","085278982354","Jakarta Timur","1","3"),
("1210512013","21220891","Nugraha Apec Tryawan","Jakarta","1994-11-14","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("1210512223","21220813","Nugraha Apec Tryawan","Jakarta","1994-11-14","Aminah","Dedi","laki-laki","3","085283572363","Jakarta","1","3"),
("1310512014","22220892","Nugraha Apec Tryawan","Jakarta","1994-11-15","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("1310512224","22220814","Nugraha Apec Tryawan","Jakarta","1994-11-15","Aminah","Dedi","laki-laki","3","085283572363","Jakarta","1","3"),
("1410512015","23220893","Nugraha Apec Tryawan","Jakarta","1994-11-16","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("1410512225","23220815","Nugraha Apec Tryawan","Jakarta","1994-11-16","Aminah","Dedi","laki-laki","3","085283572363","Jakarta","1","3"),
("1510512016","24220894","Nugraha Apec Tryawan","Jakarta","1994-11-17","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("1510512226","24220816","Nugraha Apec Tryawan","Jakarta","1994-11-17","Aminah","Dedi","laki-laki","3","085283572363","Jakarta","1","3"),
("1610512017","25220895","Nugraha Apec Tryawan","Jakarta","1994-11-18","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("1610512227","25220817","Nugraha Apec Tryawan","Jakarta","1994-11-18","Aminah","Dedi","laki-laki","3","085283572363","Jakarta","1","3"),
("1710512018","26220896","Nugraha Apec Tryawan","Jakarta","1994-11-19","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("1710512228","26220818","Nugraha Apec Tryawan","Jakarta","1994-11-19","Aminah","Dedi","laki-laki","3","085283572363","Jakarta","1","3"),
("1810512019","27220897","Nugraha Apec Tryawan","Jakarta","1994-11-20","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("1810512229","27220819","Nugraha Apec Tryawan","Jakarta","1994-11-20","Aminah","Dedi","laki-laki","3","085283572363","Jakarta","1","3"),
("1910512020","28220898","Nugraha Apec Tryawan","Jakarta","1994-11-21","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("1910512230","28220820","Nugraha Apec Tryawan","Jakarta","1994-11-21","Aminah","Dedi","laki-laki","3","085283572363","Jakarta","1","3"),
("2010512021","29220899","Nugraha Apec Tryawan","Jakarta","1994-11-22","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1"),
("2010512231","29220821","Nugraha Apec Tryawan","Jakarta","1994-11-22","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","3"),
("2110512022","30220900","Nugraha Apec Tryawan","Jakarta","1994-11-23","Aminah","Dedi","laki-laki","1","085283572363","Jakarta","1","1");

CREATE TABLE `tahun` (
  `id_tahun` int(4) NOT NULL AUTO_INCREMENT,
  `tahun_awal` int(6) NOT NULL,
  `tahun_akhir` int(6) NOT NULL,
  PRIMARY KEY (`id_tahun`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO tahun VALUES
("1","2022","2023"),
("2","2023","2024"),
("3","2024","2025"),
("5","2025","2026");