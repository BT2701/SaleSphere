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
  KEY `FK_chitietgiohang_taikhoan` (`userid`),
  CONSTRAINT `FK_chitietgiohang_sanpham` FOREIGN KEY (`idsanpham`) REFERENCES `sanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_chitietgiohang_taikhoan` FOREIGN KEY (`userid`) REFERENCES `taikhoan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietgiohang: ~0 rows (approximately)

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

-- Dumping data for table quan_ly_ban_hang.chitiethoadon: ~11 rows (approximately)
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
	(9, 34, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietkhuyenmai: ~7 rows (approximately)
INSERT INTO `chitietkhuyenmai` (`id`, `idsanpham`, `idkhuyenmai`) VALUES
	(1, 1, 1),
	(4, 5, 4),
	(6, 6, 1),
	(7, 3, 3),
	(8, 7, 3),
	(9, 2, 2),
	(10, 4, 2);

-- Dumping structure for table quan_ly_ban_hang.chitietkiemke
CREATE TABLE IF NOT EXISTS `chitietkiemke` (
  `idSanPham` int(11) NOT NULL,
  `soLuongTonKho` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSanPham`) USING BTREE,
  CONSTRAINT `chitietkiemke_ibfk_2` FOREIGN KEY (`idSanPham`) REFERENCES `sanpham` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chitietkiemke: ~9 rows (approximately)
INSERT INTO `chitietkiemke` (`idSanPham`, `soLuongTonKho`) VALUES
	(1, 101),
	(5, 1),
	(8, 11),
	(30, 2),
	(32, 1),
	(34, 5),
	(35, 1),
	(38, 1),
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

-- Dumping data for table quan_ly_ban_hang.chitietphieunhap: ~16 rows (approximately)
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
	(7, 35, 1);

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

-- Dumping data for table quan_ly_ban_hang.chitietquyen: ~2 rows (approximately)
INSERT INTO `chitietquyen` (`idquyen`, `idchucnang`, `hanhdong`, `id`, `TinhTrang`) VALUES
	(3, 1, 'thêm', 1, 1),
	(3, 1, 'sửa', 2, NULL);

-- Dumping structure for table quan_ly_ban_hang.chucnang
CREATE TABLE IF NOT EXISTS `chucnang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.chucnang: ~1 rows (approximately)
INSERT INTO `chucnang` (`id`, `ten`) VALUES
	(1, 'Quản lý nhân viên');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.danhgia: ~9 rows (approximately)
INSERT INTO `danhgia` (`id`, `idsanpham`, `noidung`, `star`, `idhoadon`, `idkhachhang`, `ngaydanhgia`) VALUES
	(1, 1, 'đỉnh của đỉnh', 5, 1, 1, '2024-01-20'),
	(2, 3, 'cũng tạm', 4, 1, 2, '2024-02-22'),
	(3, 3, 'được', 4, 2, 1, '2024-04-14'),
	(4, 4, 'đánh giá tạm', 3, 2, 1, '2024-04-14'),
	(5, 4, 'a', 3, 2, 1, '2024-04-14'),
	(6, 3, 'aaaa', 3, 2, 1, '2024-04-14'),
	(7, 4, '1', 4, 2, 1, '2024-04-14'),
	(8, 1, 'aaa', 1, 4, 1, '2024-04-24'),
	(9, 1, 'sản phẩm chất lượng', 4, 3, 1, '2024-05-05');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.hoadon: ~9 rows (approximately)
INSERT INTO `hoadon` (`id`, `ngayLap`, `idKhachHang`, `trangThai`, `tongTien`, `idNV`) VALUES
	(1, '2024-03-22', 1, 1, 1300000, NULL),
	(2, '2024-03-27', 1, 4, 1300000, 1),
	(3, '2024-04-14', 1, 3, 11280000, NULL),
	(4, '2024-04-14', 1, 3, 11280000, 1),
	(5, '2024-04-14', 1, 1, 11280000, NULL),
	(6, '2024-05-03', 1, 1, 33840000, NULL),
	(7, '2024-05-03', 1, 1, 11280000, NULL),
	(8, '2024-05-03', 1, 1, 499000, NULL),
	(9, '2024-05-03', 1, 1, 11779000, NULL);

-- Dumping structure for table quan_ly_ban_hang.khuyenmai
CREATE TABLE IF NOT EXISTS `khuyenmai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenKhuyenMai` varchar(255) NOT NULL,
  `hanSuDung` date DEFAULT NULL,
  `giaTri` int(11) DEFAULT NULL,
  `background` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.khuyenmai: ~4 rows (approximately)
INSERT INTO `khuyenmai` (`id`, `tenKhuyenMai`, `hanSuDung`, `giaTri`, `background`) VALUES
	(1, 'Trợ giá mùa dịch', '2025-03-22', 6, 'blue'),
	(2, 'Mừng lễ 8/3', '2025-03-27', 3, '#DE1C05'),
	(3, 'Vui đón tết', '2025-03-29', 7, 'green'),
	(4, 'Tết thiếu nhi', '2022-03-29', 8, 'blue');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.phieunhap: ~7 rows (approximately)
INSERT INTO `phieunhap` (`id`, `ngayNhap`, `idUser`, `tongtien`) VALUES
	(1, '2024-05-01', 2, 10000000),
	(2, '2024-05-03', 2, 1252250000),
	(3, '2024-05-03', 2, 10750000),
	(4, '2024-05-03', 2, 30000000),
	(5, '2024-05-03', 2, 0),
	(6, '2024-05-03', 2, 31050000),
	(7, '2024-05-03', 2, 850000);

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
	(3, 'employee');

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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.sanpham: ~28 rows (approximately)
INSERT INTO `sanpham` (`id`, `tenSanPham`, `giaBan`, `idLoaiSP`, `src`, `moTa`, `maDVT`, `trangthai`, `giaNhap`) VALUES
	(1, 'Samsung Galaxy S21', 12000000, 1, '/web2/STATIC/assets/iphone2.jpg', 'abc', 1, 1, 10000000),
	(2, 'Dell XPS 13', 25000000, 2, '/web2/STATIC/assets/product3.png', NULL, 2, 0, 20000000),
	(3, 'Instant Pot Duo', 1500000, 3, '/web2/STATIC/assets/product3.png', NULL, 3, 0, 1000000),
	(4, 'Nike Air Max', 2000000, 4, '/web2/STATIC/assets/product3.png', NULL, 4, 0, 1500000),
	(5, 'LEGO Star Wars Set', 500000, 5, '/web2/STATIC/assets/product3.png', NULL, 5, 1, 400000),
	(6, 'áo thun', 10000, 4, '/web2/STATIC/assets/product3.png', NULL, 5, 0, 8000),
	(7, 'Áo thun Polo unisex', 1200000, 4, '/web2/STATIC/assets/product3.png', NULL, 1, 0, 1000000),
	(8, 'iPhone 15 ultra', 25000000, 1, '/web2/STATIC/assets/iphone1.jpg', 'apple', 1, 1, 20000000),
	(9, 'Sữa bột', 200000, 7, '/web2/STATIC/assets/product3.png', NULL, 3, 0, 180000),
	(10, 'Sữa tươi', 15000, 7, '/web2/STATIC/assets/product3.png', NULL, 3, 0, 10000),
	(11, 'Mỳ hảo hảo', 5000, 7, '/web2/STATIC/assets/product3.png', NULL, 5, 0, 4000),
	(14, 'iPhone 15 promax', 23000000, 1, '/web2/STATIC/assets/product3.png', 'apple', 1, 0, 20000000),
	(16, 'iPhone 15 pro', 23000000, 1, '/web2/STATIC/assets/product3.png', 'apple', 1, 0, 20000000),
	(26, 'mỳ tôm hảo hảo', 5000, 1, '/web2/STATIC/assets/mytom1.jpg', 'hảo hảo', 1, 0, 4000),
	(28, 'ao thun nữ', 100000, 4, '/web2/STATIC/assets/aothun1.jpg', 'áo thun', 2, 0, 90000),
	(29, 'máy ảnh', 1000000, 2, '/web2/STATIC/assets/laptop2.jpg', 'máy ảnh', 1, 0, 900000),
	(30, 'Áo thun nao cao cấp', 320000, 4, '/web2/STATIC/assets/aothun1.jpg', '', 1, 1, 300000),
	(31, 'iPhone 15', 15000000, 1, '/web2/STATIC/assets/quantay2.png', '', 1, 0, 12000000),
	(32, 'Quầy tây nam', 499000, 4, '/web2/STATIC/assets/quantay1.jpg', '', 1, 1, 450000),
	(33, 'Quầy tây nam thời trang', 499000, 4, '/web2/STATIC/assets/quantay2.png', '', 1, 0, 450000),
	(34, 'Quầy tây nam thời trang cao cấp', 499000, 4, '/web2/STATIC/assets/quantay2.png', '', 1, 1, 450000),
	(35, 'laptop gamming', 499000, 2, '/web2/STATIC/assets/laptop1.jpg', '', 1, 1, 450000),
	(36, '1', 100000, 2, '/web2/STATIC/assets/default.png', 'áo thun', 1, 0, 90000),
	(37, '2', 100000, 1, '/web2/STATIC/assets/laptop1.jpg', 'áo thun', 1, 0, 90000),
	(38, 'Iphone 15', 23000000, 1, '/web2/STATIC/assets/iphone1.jpg', 'apple 15', 1, 1, 20000000),
	(39, 'iPhone 15', 23000000, 1, '/web2/STATIC/assets/iphone1.jpg', '', 1, 1, 20000000),
	(40, 'iPhone 15 abc', 23000000, 1, '/web2/STATIC/assets/iphone2.jpg', '', 1, 0, 20000000),
	(41, 'Tủ lạnh cao cấp', 19999000, 3, '/web2/STATIC/assets/tulanh1.jpg', 'Tủ lạnh cao cấp với thương hiệu nổi tiếng panasonic', 1, 1, 15000000);

-- Dumping structure for table quan_ly_ban_hang.taikhoan
CREATE TABLE IF NOT EXISTS `taikhoan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tenTaiKhoan` varchar(50) NOT NULL DEFAULT '',
  `matKhau` varchar(255) DEFAULT '',
  `maQuyen` int(11) NOT NULL,
  `TinhTrang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.taikhoan: ~9 rows (approximately)
INSERT INTO `taikhoan` (`id`, `tenTaiKhoan`, `matKhau`, `maQuyen`, `TinhTrang`) VALUES
	(1, 'truong', 'Truong@123456', 1, 0),
	(2, 'bt', 'a', 1, 1),
	(8, 'truong11', 'Vuvuong@b01234', 2, 1),
	(9, 'truong12', 'Vuvuong@b01234', 2, 1),
	(10, 'truong13', 'Vuvuong@b01234', 2, 1),
	(11, 'truong14', 'Vuvuong@b01234', 2, 1),
	(12, 'truong15', 'Vuvuong@b01234', 2, 1),
	(13, 'truong16', 'Vuvuong@b01234', 2, 1),
	(14, 'truong00', '$2y$10$b4OIorrtHF.yfNRXkErRK.lY97l8ezRFXSvyoREV4ZLzCNnzwwNka', 0, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_ban_hang.users: ~10 rows (approximately)
INSERT INTO `users` (`id`, `ten`, `diachi`, `sdt`, `email`, `src`, `usertype`, `google_id`, `dob`, `facebook_id`, `gender`) VALUES
	(1, 'Nguyễn Văn A', 'xxxx', '1234567890', 'a@gmail.com', '/web2/STATIC/assets/poster.png', 'khachhang', NULL, NULL, NULL, NULL),
	(2, '0546_Dương Thành Trưởng', 'abc', '1234567111', 'dttruonga8tqtpy@gmail.com', '/web2/STATIC/assets/default_avatar_2.png', 'nhanvien', '107460906523637345202', '2003-02-25', NULL, 'Nam'),
	(7, 'truong11', '0', '0386094783', 'dttruonga8tqtpy@gmail.com', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(8, 'truong11', '0', '0386094783', 'dttruonga8tqtpy@gmail.com', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(9, 'truong12', '0', '0386094783', 'dttruonga8tqtpy@gmail.com', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(10, 'truong13', '0', '0386094783', 'dttruonga8tqtpy@gmail.com', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(11, 'truong14', '0', '0386094783', 'dttruonga8tqtpy@gmail.com', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(12, 'truong15', '0', '0386094783', 'dttruonga8tqtpy@gmail.com', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(13, 'truong16', '0', '0386094783', 'dttruonga8tqtpy@gmail.com', '0', 'khachhang', NULL, NULL, NULL, 'Nam'),
	(14, 'Lê Văn C', '0', '0', '0', '0', 'khachhang', NULL, NULL, NULL, 'Nam');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
