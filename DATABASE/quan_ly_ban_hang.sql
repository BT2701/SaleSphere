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

-- Dumping structure for table quan_ly_ban_hang.chitietgiohang
CREATE TABLE IF NOT EXISTS `chitietgiohang` (
  `idsanpham` int(11) NOT NULL,
  `soluong` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`idsanpham`,`userid`),
  KEY `FK_chitietgiohang_users` (`userid`),
  CONSTRAINT `FK_chitietgiohang_sanpham` FOREIGN KEY (`idsanpham`) REFERENCES `sanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_chitietgiohang_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietgiohang: ~2 rows (approximately)
INSERT INTO `chitietgiohang` (`idsanpham`, `soluong`, `userid`) VALUES
	(1, 5, 1);

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

-- Dumping data for table quan_ly_ban_hang.chitiethoadon: ~24 rows (approximately)
INSERT INTO `chitiethoadon` (`idHoaDon`, `idSanPham`, `soLuong`) VALUES
	(1, 2, 5),
	(2, 3, 4),
	(2, 4, 10),
	(3, 1, 1),
	(4, 1, 1),
	(5, 1, 1),
	(6, 1, 3),
	(7, 1, 1),
	(8, 34, 1),
	(9, 1, 1),
	(9, 34, 1),
	(10, 1, 101),
	(11, 1, 1),
	(12, 1, 10),
	(13, 1, 1),
	(14, 30, 1),
	(15, 34, 2),
	(16, 5, 1),
	(17, 30, 1),
	(18, 34, 2),
	(19, 38, 1),
	(20, 1, 4),
	(21, 1, 1),
	(22, 1, 1);

-- Dumping structure for table quan_ly_ban_hang.chitietkhuyenmai
CREATE TABLE IF NOT EXISTS `chitietkhuyenmai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsanpham` int(11) NOT NULL DEFAULT 0,
  `idkhuyenmai` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_idsanpham` (`idsanpham`),
  KEY `fk_idkhuyenmai` (`idkhuyenmai`),
  CONSTRAINT `fk_idkhuyenmai` FOREIGN KEY (`idkhuyenmai`) REFERENCES `khuyenmai` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_idsanpham` FOREIGN KEY (`idsanpham`) REFERENCES `sanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietkhuyenmai: ~28 rows (approximately)
INSERT INTO `chitietkhuyenmai` (`id`, `idsanpham`, `idkhuyenmai`) VALUES
	(14, 5, 6),
	(15, 37, 6),
	(16, 1, 6),
	(17, 2, 6),
	(18, 3, 6),
	(19, 4, 6),
	(20, 6, 6),
	(21, 7, 6),
	(22, 8, 6),
	(23, 9, 6),
	(24, 10, 6),
	(25, 11, 6),
	(26, 14, 6),
	(27, 16, 6),
	(28, 26, 6),
	(29, 28, 6),
	(30, 29, 6),
	(31, 30, 6),
	(32, 31, 6),
	(33, 32, 6),
	(34, 33, 6),
	(35, 34, 6),
	(36, 35, 6),
	(37, 36, 6),
	(38, 38, 6),
	(39, 39, 6),
	(40, 40, 6),
	(41, 41, 6);

-- Dumping structure for table quan_ly_ban_hang.chitietkiemke
CREATE TABLE IF NOT EXISTS `chitietkiemke` (
  `idSanPham` int(11) NOT NULL,
  `soLuongTonKho` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSanPham`) USING BTREE,
  CONSTRAINT `chitietkiemke_ibfk_2` FOREIGN KEY (`idSanPham`) REFERENCES `sanpham` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietkiemke: ~9 rows (approximately)
INSERT INTO `chitietkiemke` (`idSanPham`, `soLuongTonKho`) VALUES
	(1, 86),
	(5, 0),
	(8, 11),
	(30, 0),
	(32, 1),
	(34, 1),
	(35, 1),
	(38, 0),
	(41, 4);

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

-- Dumping data for table quan_ly_ban_hang.chitietphieunhap: ~17 rows (approximately)
INSERT INTO `chitietphieunhap` (`idPhieuNhap`, `idSanPham`, `soLuong`) VALUES
	(1, 1, 1),
	(2, 1, 99),
	(2, 8, 10),
	(2, 34, 5),
	(2, 41, 4),
	(3, 1, 1),
	(3, 30, 1),
	(3, 35, 1),
	(4, 1, 1),
	(4, 8, 1),
	(6, 1, 1),
	(6, 30, 2),
	(6, 32, 1),
	(6, 38, 1),
	(7, 5, 1),
	(7, 35, 1),
	(8, 1, 3);

-- Dumping structure for table quan_ly_ban_hang.chitietquyen
CREATE TABLE IF NOT EXISTS `chitietquyen` (
  `idquyen` int(11) NOT NULL,
  `idchucnang` int(11) NOT NULL,
  `hanhdong` varchar(50) NOT NULL DEFAULT '',
  `id` int(11) NOT NULL,
  `TinhTrang` int(11) DEFAULT NULL,
  PRIMARY KEY (`idquyen`,`idchucnang`,`id`) USING BTREE,
  KEY `FK_chitietquyen_chucnang` (`idchucnang`),
  CONSTRAINT `FK_chitietquyen_chucnang` FOREIGN KEY (`idchucnang`) REFERENCES `chucnang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_chitietquyen_quyen` FOREIGN KEY (`idquyen`) REFERENCES `quyen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietquyen: ~40 rows (approximately)
INSERT INTO `chitietquyen` (`idquyen`, `idchucnang`, `hanhdong`, `id`, `TinhTrang`) VALUES
	(3, 1, 'T', 1, 1),
	(3, 1, 'S', 2, 1),
	(3, 1, 'X', 3, 1),
	(3, 1, 'L', 4, 1),
	(3, 1, 'T', 21, 1),
	(3, 1, 'S', 22, 1),
	(3, 1, 'X', 23, 1),
	(3, 1, 'L', 24, 1),
	(3, 2, 'T', 5, 1),
	(3, 2, 'S', 6, 1),
	(3, 2, 'X', 7, 1),
	(3, 2, 'L', 8, 1),
	(3, 2, 'T', 25, 1),
	(3, 2, 'S', 26, 1),
	(3, 2, 'X', 27, 1),
	(3, 2, 'L', 28, 1),
	(3, 3, 'T', 9, 1),
	(3, 3, 'S', 10, 1),
	(3, 3, 'X', 11, 1),
	(3, 3, 'L', 12, 1),
	(3, 3, 'T', 29, 1),
	(3, 3, 'S', 30, 1),
	(3, 3, 'X', 31, 1),
	(3, 3, 'L', 32, 1),
	(3, 4, 'T', 13, 1),
	(3, 4, 'S', 14, 1),
	(3, 4, 'X', 15, 1),
	(3, 4, 'L', 16, 1),
	(3, 4, 'T', 33, 1),
	(3, 4, 'S', 34, 1),
	(3, 4, 'X', 35, 1),
	(3, 4, 'L', 36, 1),
	(3, 5, 'T', 17, 1),
	(3, 5, 'S', 18, 1),
	(3, 5, 'X', 19, 1),
	(3, 5, 'L', 20, 1),
	(3, 5, 'T', 37, 1),
	(3, 5, 'S', 38, 1),
	(3, 5, 'X', 39, 1),
	(3, 5, 'L', 40, 1);

-- Dumping structure for table quan_ly_ban_hang.chucnang
CREATE TABLE IF NOT EXISTS `chucnang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chucnang: ~5 rows (approximately)
INSERT INTO `chucnang` (`id`, `ten`) VALUES
	(1, 'Quản lý sản phẩm'),
	(2, 'Quản lý hóa đơn'),
	(3, 'Quản lý thống kê'),
	(4, 'Quản lý khuyến mãi'),
	(5, 'Quản lý nhập hàng');

-- Dumping structure for table quan_ly_ban_hang.danhgia
CREATE TABLE IF NOT EXISTS `danhgia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idsanpham` int(11) DEFAULT NULL,
  `noidung` varchar(200) DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `idhoadon` int(11) NOT NULL,
  `idkhachhang` int(11) NOT NULL,
  `ngaydanhgia` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_danhgia_sanpham` (`idsanpham`),
  KEY `FK_danhgia_users` (`idkhachhang`),
  KEY `FK_danhgia_hoadon` (`idhoadon`),
  CONSTRAINT `FK_danhgia_hoadon` FOREIGN KEY (`idhoadon`) REFERENCES `hoadon` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_danhgia_sanpham` FOREIGN KEY (`idsanpham`) REFERENCES `sanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_danhgia_users` FOREIGN KEY (`idkhachhang`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.danhgia: ~10 rows (approximately)
INSERT INTO `danhgia` (`id`, `idsanpham`, `noidung`, `star`, `idhoadon`, `idkhachhang`, `ngaydanhgia`) VALUES
	(1, 1, 'đỉnh của đỉnh', 5, 1, 1, '2024-01-20'),
	(2, 3, 'cũng tạm', 4, 1, 2, '2024-02-22'),
	(3, 3, 'được', 4, 2, 1, '2024-04-14'),
	(4, 4, 'đánh giá tạm', 3, 2, 1, '2024-04-14'),
	(5, 4, 'a', 3, 2, 1, '2024-04-14'),
	(6, 3, 'aaaa', 3, 2, 1, '2024-04-14'),
	(7, 4, '1', 4, 2, 1, '2024-04-14'),
	(8, 1, 'aaa', 1, 4, 1, '2024-04-24'),
	(9, 1, 'sản phẩm chất lượng', 4, 3, 1, '2024-05-05'),
	(10, 1, 'a', 4, 5, 1, '2024-05-05'),
	(11, 38, 'được', 5, 19, 18, '2024-05-17');

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

-- Dumping structure for table quan_ly_ban_hang.giohangnhap
CREATE TABLE IF NOT EXISTS `giohangnhap` (
  `soLuong` int(11) DEFAULT NULL,
  `idSanPham` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idSanPham`,`idUser`) USING BTREE,
  KEY `FK_giohangnhap_users` (`idUser`),
  CONSTRAINT `FK_giohangnhap_sanpham` FOREIGN KEY (`idSanPham`) REFERENCES `sanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_giohangnhap_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.giohangnhap: ~0 rows (approximately)

-- Dumping structure for table quan_ly_ban_hang.hoadon
CREATE TABLE IF NOT EXISTS `hoadon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ngayLap` date NOT NULL,
  `idKhachHang` int(11) DEFAULT NULL,
  `trangThai` int(11) DEFAULT NULL,
  `tongTien` int(11) DEFAULT NULL,
  `idNV` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_idKhachHang` (`idKhachHang`),
  KEY `FK_hoadon_users` (`idNV`),
  CONSTRAINT `FK_hoadon_users` FOREIGN KEY (`idNV`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_idKhachHang` FOREIGN KEY (`idKhachHang`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.hoadon: ~20 rows (approximately)
INSERT INTO `hoadon` (`id`, `ngayLap`, `idKhachHang`, `trangThai`, `tongTien`, `idNV`) VALUES
	(1, '2024-03-22', 1, 4, 1300000, 14),
	(2, '2024-03-27', 1, 4, 1300000, 1),
	(3, '2024-04-14', 1, 3, 11280000, NULL),
	(4, '2024-04-14', 1, 3, 11280000, 1),
	(5, '2024-04-14', 1, 3, 11280000, NULL),
	(6, '2024-05-03', 1, 4, 33840000, 14),
	(7, '2024-05-03', 1, 4, 11280000, 14),
	(8, '2024-05-03', 1, 2, 499000, 14),
	(9, '2024-05-03', 1, 2, 11779000, 14),
	(10, '2024-05-08', 14, 3, 1090800000, 2),
	(11, '2024-05-08', 2, 3, 10800000, 2),
	(12, '2024-05-08', 14, 3, 108000000, 2),
	(13, '2024-05-09', 14, 3, 10800000, 2),
	(14, '2024-05-09', 2, 3, 288000, 2),
	(15, '2024-05-09', 2, 3, 898200, 2),
	(16, '2024-05-09', 2, 3, 450000, 2),
	(17, '2024-05-09', 2, 3, 288000, 2),
	(18, '2024-05-09', 2, 3, 898200, 2),
	(19, '2024-05-17', 18, 3, 23000000, 17),
	(20, '2024-05-17', 18, 2, 43200000, 17),
	(21, '2024-05-17', 18, 1, 10800000, NULL),
	(22, '2024-05-17', 18, 1, 10800000, NULL);

-- Dumping structure for table quan_ly_ban_hang.khuyenmai
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenKhuyenMai` varchar(255) NOT NULL,
  `hanSuDung` date DEFAULT NULL,
  `giaTri` int(11) DEFAULT NULL,
  `background` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.khuyenmai: ~3 rows (approximately)
INSERT INTO `khuyenmai` (`id`, `tenKhuyenMai`, `hanSuDung`, `giaTri`, `background`) VALUES
	(4, 'Tết thiếu nhi', '2022-03-29', 8, 'blue'),
	(6, 'Trợ giá mùa dịch1', '2024-05-17', 10, '#ff0000'),
	(7, 'Trung thu', '2024-05-18', 2, '#002aff');

-- Dumping structure for table quan_ly_ban_hang.loaisp
CREATE TABLE IF NOT EXISTS `loaisp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenLoaiSP` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.loaisp: ~7 rows (approximately)
INSERT INTO `loaisp` (`id`, `tenLoaiSP`) VALUES
	(1, 'Điện thoại di động'),
	(2, 'Laptop'),
	(3, 'Đồ gia dụng'),
	(4, 'Thời trang'),
	(5, 'Đồ chơi'),
	(6, 'Gia công'),
	(7, 'Thực phẩm');

-- Dumping structure for table quan_ly_ban_hang.phieunhap
CREATE TABLE IF NOT EXISTS `phieunhap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ngayNhap` date NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `tongtien` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_phieunhap_users` (`idUser`),
  CONSTRAINT `FK_phieunhap_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.phieunhap: ~8 rows (approximately)
INSERT INTO `phieunhap` (`id`, `ngayNhap`, `idUser`, `tongtien`) VALUES
	(1, '2024-05-01', 2, 10000000),
	(2, '2024-05-03', 2, 1252250000),
	(3, '2024-05-03', 2, 10750000),
	(4, '2024-05-03', 2, 30000000),
	(5, '2024-05-03', 2, 0),
	(6, '2024-05-03', 2, 31050000),
	(7, '2024-05-03', 2, 850000),
	(8, '2024-05-08', 2, 30000000);

-- Dumping structure for table quan_ly_ban_hang.quyen
CREATE TABLE IF NOT EXISTS `quyen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenQuyen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.quyen: ~3 rows (approximately)
INSERT INTO `quyen` (`id`, `tenQuyen`) VALUES
	(1, 'admin'),
	(2, 'client'),
	(3, 'quanly');

-- Dumping structure for table quan_ly_ban_hang.sanpham
CREATE TABLE IF NOT EXISTS `sanpham` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenSanPham` varchar(255) NOT NULL,
  `giaBan` int(11) NOT NULL,
  `idLoaiSP` int(11) DEFAULT NULL,
  `src` varchar(255) DEFAULT '/web2/STATIC/assets/default.png',
  `moTa` text DEFAULT NULL,
  `maDVT` int(11) DEFAULT NULL,
  `trangthai` int(11) DEFAULT NULL,
  `giaNhap` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idLoaiSP` (`idLoaiSP`),
  KEY `maDVT` (`maDVT`),
  CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`idLoaiSP`) REFERENCES `loaisp` (`id`),
  CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`maDVT`) REFERENCES `donvitinh` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.sanpham: ~41 rows (approximately)
INSERT INTO `sanpham` (`id`, `tenSanPham`, `giaBan`, `idLoaiSP`, `src`, `moTa`, `maDVT`, `trangthai`, `giaNhap`) VALUES
	(1, 'Samsung Galaxy S21', 12000000, 1, '/SaleSphere/STATIC/assets/phone4.jpg', 'abc', 1, 1, 10000000),
	(2, 'Dell XPS 13', 25000000, 2, '/SaleSphere/STATIC/assets/product3.png', NULL, 2, 1, 20000000),
	(3, 'Instant Pot Duo', 1500000, 3, '/SaleSphere/STATIC/assets/product3.png', NULL, 3, 1, 1000000),
	(4, 'Nike Air Max', 2000000, 4, '/SaleSphere/STATIC/assets/product3.png', NULL, 4, 1, 1500000),
	(5, 'LEGO Star Wars Set', 500000, 5, '/SaleSphere/STATIC/assets/product3.png', NULL, 5, 1, 400000),
	(6, 'áo thun', 10000, 4, '/SaleSphere/STATIC/assets/product3.png', NULL, 5, 1, 8000),
	(7, 'Áo thun Polo unisex', 1200000, 4, '/SaleSphere/STATIC/assets/product3.png', NULL, 1, 1, 1000000),
	(8, 'iPhone 15 ultra', 25000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', 'apple', 1, 1, 20000000),
	(9, 'Sữa bột', 200000, 7, '/SaleSphere/STATIC/assets/product3.png', NULL, 3, 1, 180000),
	(10, 'Sữa tươi', 15000, 7, '/SaleSphere/STATIC/assets/product3.png', NULL, 3, 1, 10000),
	(11, 'Mỳ hảo hảo', 5000, 7, '/SaleSphere/STATIC/assets/product3.png', NULL, 5, 1, 4000),
	(14, 'iPhone 15 promax', 23000000, 1, '/SaleSphere/STATIC/assets/product3.png', 'apple', 1, 1, 20000000),
	(16, 'iPhone 15 pro', 23000000, 1, '/SaleSphere/STATIC/assets/product3.png', 'apple', 1, 1, 20000000),
	(26, 'mỳ tôm hảo hảo', 5000, 1, '/SaleSphere/STATIC/assets/mytom1.jpg', 'hảo hảo', 1, 0, 4000),
	(28, 'ao thun nữ', 100000, 4, '/SaleSphere/STATIC/assets/aothun1.jpg', 'áo thun', 2, 1, 90000),
	(29, 'điện thoại samsung', 1000000, 2, '/SaleSphere/STATIC/assets/phone2.jpg', 'máy ảnh', 1, 0, 900000),
	(30, 'Áo thun nao cao cấp', 320000, 4, '/SaleSphere/STATIC/assets/aothun1.jpg', '', 1, 1, 300000),
	(31, 'iPhone 15', 15000000, 1, '/SaleSphere/STATIC/assets/quantay2.png', '', 1, 1, 12000000),
	(32, 'Quầy tây nam', 499000, 4, '/SaleSphere/STATIC/assets/quantay1.jpg', '', 1, 0, 450000),
	(33, 'Quầy tây nam thời trang', 499000, 4, '/SaleSphere/STATIC/assets/quantay2.png', '', 1, 1, 450000),
	(34, 'Quầy tây nam thời trang cao cấp', 499000, 4, '/SaleSphere/STATIC/assets/quantay2.png', '', 1, 1, 450000),
	(35, 'laptop gamming', 499000, 2, '/SaleSphere/STATIC/assets/laptop1.jpg', '', 1, 0, 450000),
	(36, '1', 100000, 2, '/SaleSphere/STATIC/assets/default.png', 'áo thun', 1, 0, 90000),
	(37, '2', 100000, 1, '/SaleSphere/STATIC/assets/laptop1.png', 'áo thun', 1, 1, 90000),
	(38, 'Iphone 15', 23000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', 'apple 15', 1, 1, 20000000),
	(39, 'iPhone 15', 23000000, 1, '/SaleSphere/STATIC/assets/iphone1.jpg', '', 1, 0, 20000000),
	(40, 'iPhone 15 abc', 23000000, 1, '/SaleSphere/STATIC/assets/iphone2.jpg', '', 1, 0, 20000000),
	(41, 'Tủ lạnh cao cấp', 19999000, 3, '/SaleSphere/STATIC/assets/tulanh1.jpg', 'Tủ lạnh cao cấp với thương hiệu nổi tiếng panasonic', 1, 0, 15000000),
	(42, 'điện thoại 1', 0, 1, '/SaleSphere/STATIC/assets/phone4.jpg', '', 1, 1, 15000000),
	(43, 'điện thoại 2', 23000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', '', 1, 1, 15000000),
	(44, 'điện thoại 3', 23000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', '', 1, 1, 15000000),
	(45, 'điện thoại 4', 23000000, 1, '/SaleSphere/STATIC/assets/phone2.jpg', '', 1, 0, 15000000),
	(46, 'abc', 23000000, 1, '/SaleSphere/STATIC/assets/aothun1.png', '', 1, 0, 15000000),
	(47, 'iPhone 15', 23000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', 'apple', 1, 1, 15000000),
	(48, 'mỳ tôm hảo hảo', 5000, 1, '/SaleSphere/STATIC/assets/mytom1.jpg', 'hảo hảo', 1, 1, 4000),
	(49, 'mỳ tôm hảo hảo', 5000, 1, '/SaleSphere/STATIC/assets/tulanh1.jpg', 'hảo hảo', 1, 1, 4000),
	(50, 'iPhone 15 pro', 23000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', 'apple', 1, 1, 20000000),
	(51, 'iPhone 15 pro', 23000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', 'apple', 1, 1, 20000000),
	(52, 'iPhone 15', 25000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', '', 1, 1, 15000000),
	(53, 'iPhone 15', 25000000, 1, '/SaleSphere/STATIC/assets/phone5.jpg', '', 1, 1, 15000000),
	(54, 'ac', 25000000, 1, '/SaleSphere/STATIC/assets/laptop1.jpg', '', 1, 1, 15000000),
	(55, 'ac', 25000000, 1, '/SaleSphere/STATIC/assets/ao1.jpg', '', 1, 1, 15000000);

-- Dumping structure for table quan_ly_ban_hang.taikhoan
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenTaiKhoan` varchar(50) NOT NULL DEFAULT '',
  `matKhau` varchar(255) DEFAULT '',
  `maQuyen` int(11) NOT NULL,
  `TinhTrang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.taikhoan: ~13 rows (approximately)
INSERT INTO `taikhoan` (`id`, `tenTaiKhoan`, `matKhau`, `maQuyen`, `TinhTrang`) VALUES
	(1, 'truong', 'Truong@123456', 1, 0),
	(2, 'bt', '$2y$10$opTOi36ztC0LlUMMXF/GGetzeDuPJgZOqAMDhQW0kM.Bnb2Wyltw2', 3, 1),
	(9, 'truong12', 'Vuvuong@b01234', 1, 1),
	(10, 'truong13', 'Vuvuong@b01234', 2, 1),
	(11, 'truong14', 'Vuvuong@b01234', 2, 1),
	(12, 'truong15', 'Vuvuong@b01234', 2, 1),
	(13, 'truong16', 'Vuvuong@b01234', 2, 1),
	(14, 'truong00', '$2y$10$b4OIorrtHF.yfNRXkErRK.lY97l8ezRFXSvyoREV4ZLzCNnzwwNka', 2, 1),
	(15, 'truong1', '$2y$10$fzqmev./Fh2qDrYe5iqREuYsS0jTPQhUqpqqJyyBccBypbYE0dFDO', 1, 1),
	(16, 'Truong2727', '$2y$10$xKtx0ifh12pguejIRYIXWOfwtFv2n0b3/R5WvUgpTklJ1wwsyc9DW', 1, 1),
	(17, 'Truong1234', '$2y$10$0LcAn/2/fR/wMpSx.DH1veYSYFsyZbWI3LZtika61Uvyo/FbcUSdW', 3, 1),
	(18, 'Truong2003', '$2y$10$oVbalmR5oBA9Uv.xdeWKveXkPdYV134hGVt4SLVNWgBTBEuTyg3WO', 2, 1),
	(19, 'Truong12345', '$2y$10$C4ssnm5/4i6sW7a.4IDZ/enMPMtJWV.bXNIQAjWdGSyvVWOSuhQiW', 2, 1);

-- Dumping structure for table quan_ly_ban_hang.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(50) NOT NULL DEFAULT '0',
  `diachi` varchar(50) DEFAULT '0',
  `sdt` varchar(15) DEFAULT '0',
  `email` varchar(50) DEFAULT '0',
  `src` varchar(200) DEFAULT '0',
  `usertype` varchar(10) NOT NULL DEFAULT '0',
  `google_id` varchar(200) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `facebook_id` varchar(200) DEFAULT NULL,
  `gender` varchar(50) DEFAULT 'Nam',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.users: ~14 rows (approximately)
INSERT INTO `users` (`id`, `ten`, `diachi`, `sdt`, `email`, `src`, `usertype`, `google_id`, `dob`, `facebook_id`, `gender`) VALUES
	(1, 'Nguyễn Văn A', 'xxxx', '1234567890', 'a@gmail.com', '/web2/STATIC/assets/poster.png', 'khachhang', NULL, NULL, NULL, NULL),
	(2, '0546_Dương Thành Trưởng', 'abc', '1234567111', 'truongnopro1111@gmail.com', '/web2/STATIC/assets/default_avatar_2.png', 'nhanvien', '107460906523637345202', '2003-02-25', NULL, 'Nam'),
	(7, 'truong11', '0', '0386094783', '', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(9, 'truong12', '0', '0386094783', '', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(10, 'truong13', '0', '0386094783', '', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(11, 'truong14', '0', '0386094783', '', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(12, 'truong15', '0', '0386094783', '', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(13, 'truong16', '0', '0386094783', '', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(14, 'Lê Văn C', '0', '0', '0', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(15, 'truong1', '0', '0', '0', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(16, 'Truong2727', '0', '0', '0', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(17, 'Truong1234', '0', '0', '0', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(18, 'Truong2003', 'abc', '1234567111', 'truongnopro1111@gmail.com', '/SaleSphere/STATIC/assets/default_avatar_1.jpg', 'khachhang', NULL, '2024-05-16', NULL, 'Nam'),
	(19, 'Truong12345', '0', '0', '0', '0', 'khachhang', NULL, NULL, NULL, 'Nam');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
