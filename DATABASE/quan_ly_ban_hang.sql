-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for quan_ly_ban_hang
CREATE DATABASE IF NOT EXISTS `quan_ly_ban_hang` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `quan_ly_ban_hang`;

-- Dumping structure for table quan_ly_ban_hang.chitiethoadon
CREATE TABLE IF NOT EXISTS `chitiethoadon` (
  `idHoaDon` int(11) NOT NULL,
  `idSanPham` int(11) NOT NULL,
  `soLuong` int(11) DEFAULT NULL,
  PRIMARY KEY (`idHoaDon`,`idSanPham`),
  KEY `idSanPham` (`idSanPham`),
  CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`idHoaDon`) REFERENCES `hoadon` (`id`),
  CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`idSanPham`) REFERENCES `sanpham` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitiethoadon: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.chitietkiemke
CREATE TABLE IF NOT EXISTS `chitietkiemke` (
  `idKiemKe` int(11) NOT NULL,
  `idSanPham` int(11) NOT NULL,
  `soLuongTonKho` int(11) DEFAULT NULL,
  PRIMARY KEY (`idKiemKe`,`idSanPham`),
  KEY `idSanPham` (`idSanPham`),
  CONSTRAINT `chitietkiemke_ibfk_1` FOREIGN KEY (`idKiemKe`) REFERENCES `kiemke` (`id`),
  CONSTRAINT `chitietkiemke_ibfk_2` FOREIGN KEY (`idSanPham`) REFERENCES `sanpham` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietkiemke: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.chitietphieunhap
CREATE TABLE IF NOT EXISTS `chitietphieunhap` (
  `idPhieuNhap` int(11) NOT NULL,
  `idSanPham` int(11) NOT NULL,
  `soLuong` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPhieuNhap`,`idSanPham`),
  KEY `idSanPham` (`idSanPham`),
  CONSTRAINT `chitietphieunhap_ibfk_1` FOREIGN KEY (`idPhieuNhap`) REFERENCES `phieunhap` (`id`),
  CONSTRAINT `chitietphieunhap_ibfk_2` FOREIGN KEY (`idSanPham`) REFERENCES `sanpham` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietphieunhap: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.chitietquyen
CREATE TABLE IF NOT EXISTS `chitietquyen` (
  `idquyen` int(11) NOT NULL,
  `idchucnang` int(11) NOT NULL,
  `hanhdong` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`idquyen`,`idchucnang`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietquyen: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.chucnang
CREATE TABLE IF NOT EXISTS `chucnang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chucnang: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.donvitinh
CREATE TABLE IF NOT EXISTS `donvitinh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenDonViTinh` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.donvitinh: ~5 rows (approximately)
INSERT INTO `donvitinh` (`id`, `tenDonViTinh`) VALUES
	(1, 'Cái'),
	(2, 'Chiếc'),
	(3, 'Hộp'),
	(4, 'Đôi'),
	(5, 'Gói');

-- Dumping structure for table quan_ly_ban_hang.hoadon
CREATE TABLE IF NOT EXISTS `hoadon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ngayLap` date NOT NULL,
  `idKhachHang` int(11) DEFAULT NULL,
  `trangThai` int(11) DEFAULT NULL,
  `tongTien` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idKhachHang` (`idKhachHang`),
  CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`idKhachHang`) REFERENCES `khachhang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.hoadon: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.khuyenmai
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenKhuyenMai` varchar(255) NOT NULL,
  `hanSuDung` date DEFAULT NULL,
  `giaTri` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.khuyenmai: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.kiemke
CREATE TABLE IF NOT EXISTS `kiemke` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ngayKiem` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.kiemke: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.loaisp
CREATE TABLE IF NOT EXISTS `loaisp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenLoaiSP` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.loaisp: ~5 rows (approximately)
INSERT INTO `loaisp` (`id`, `tenLoaiSP`) VALUES
	(1, 'Điện thoại di động'),
	(2, 'Laptop'),
	(3, 'Đồ gia dụng'),
	(4, 'Thời trang'),
	(5, 'Đồ chơi');

-- Dumping structure for table quan_ly_ban_hang.phieunhap
CREATE TABLE IF NOT EXISTS `phieunhap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ngayNhap` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.phieunhap: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.quyen
CREATE TABLE IF NOT EXISTS `quyen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenQuyen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.quyen: ~2 rows (approximately)
INSERT INTO `quyen` (`id`, `tenQuyen`) VALUES
	(1, 'server'),
	(2, 'client');

-- Dumping structure for table quan_ly_ban_hang.sanpham
CREATE TABLE IF NOT EXISTS `sanpham` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenSanPham` varchar(255) NOT NULL,
  `giaBan` int(11) NOT NULL,
  `idLoaiSP` int(11) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  `moTa` text DEFAULT NULL,
  `maDVT` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idLoaiSP` (`idLoaiSP`),
  KEY `maDVT` (`maDVT`),
  CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`idLoaiSP`) REFERENCES `loaisp` (`id`),
  CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`maDVT`) REFERENCES `donvitinh` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.sanpham: ~5 rows (approximately)
INSERT INTO `sanpham` (`id`, `tenSanPham`, `giaBan`, `idLoaiSP`, `src`, `moTa`, `maDVT`) VALUES
	(1, 'Samsung Galaxy S21', 12000000, 1, NULL, NULL, 1),
	(2, 'Dell XPS 13', 25000000, 2, NULL, NULL, 2),
	(3, 'Instant Pot Duo', 1500000, 3, NULL, NULL, 3),
	(4, 'Nike Air Max', 2000000, 4, NULL, NULL, 4),
	(5, 'LEGO Star Wars Set', 500000, 5, NULL, NULL, 5);

-- Dumping structure for table quan_ly_ban_hang.taikhoan
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taikhoan` int(11) NOT NULL,
  `matkhau` int(11) NOT NULL,
  `quyen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.taikhoan: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(50) NOT NULL DEFAULT '0',
  `diachi` varchar(50) DEFAULT '0',
  `sdt` varchar(15) DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  `src` varchar(200) DEFAULT '0',
  `usertype` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
