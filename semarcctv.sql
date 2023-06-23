-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2023 at 06:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `semarcctv`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun_users`
--

CREATE TABLE `akun_users` (
  `user_id` int NOT NULL,
  `jenis_akun` enum('0','1') NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `pw` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun_users`
--

INSERT INTO `akun_users` (`user_id`, `jenis_akun`, `nama`, `email`, `no_hp`, `pw`) VALUES
(2, '0', 'SU Semar CCTV', 'admin@semarcctv.test', '000000000', '$2y$10$ls/6TeF9bNWlmyB5K8qtyu0u4WbdLAmgdKRf4G6DyexnAi7fjgora');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` text NOT NULL,
  `produk_id` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gambar_produk`
--

CREATE TABLE `gambar_produk` (
  `id_img` int NOT NULL,
  `produk_id` int NOT NULL,
  `nama_gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gambar_produk`
--

INSERT INTO `gambar_produk` (`id_img`, `produk_id`, `nama_gambar`) VALUES
(5, 5, '5_1.jpg'),
(6, 6, '6_1.jpg'),
(7, 7, '7_1.jpg'),
(8, 8, '8_1.jpg'),
(9, 9, '9_1.jpg'),
(10, 10, '10_1.png'),
(11, 11, '11_1.jpg'),
(12, 12, '12_1.jpg'),
(13, 13, '13_1.png'),
(14, 14, '14_1.jpg'),
(15, 15, '15_1.png'),
(16, 16, '16_1.png'),
(17, 17, '17_1.jpg'),
(18, 18, '18_1.jpg'),
(19, 19, '19_1.jpg'),
(20, 20, '20_1.png'),
(21, 21, '21_1.jpg'),
(22, 22, '22_1.jpg'),
(23, 23, '23_1.jpg'),
(24, 24, '24_1.jpeg'),
(25, 25, '25_1.jpg'),
(26, 26, '26_1.jpg'),
(27, 27, '27_1.jpg'),
(28, 28, '28_1.jpg'),
(29, 29, '29_1.jpg'),
(30, 30, '30_1.jpg'),
(31, 31, '31_1.jpg'),
(32, 32, '32_1.jpg'),
(33, 33, '33_1.jpg'),
(34, 34, '34_1.png'),
(35, 35, '35_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int NOT NULL,
  `nm_pelangan` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipe_layanan` varchar(90) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `alamat_tujuan` varchar(255) NOT NULL DEFAULT ' <a href="https://goo.gl/maps/Vf2m23VJAtmcHQv46" target="_blank">Klik Tautan</a>',
  `total_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` text,
  `tanggal_pemesanan` varchar(90) NOT NULL,
  `status` varchar(90) NOT NULL DEFAULT 'Selesai',
  `konfirmasi` varchar(12) DEFAULT 'Belom',
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_produk`
--

CREATE TABLE `pesanan_produk` (
  `id` int NOT NULL,
  `pesanan_id` int NOT NULL,
  `produk_id` int NOT NULL,
  `nm_produk` varchar(255) NOT NULL,
  `jumlah` text NOT NULL,
  `sub_total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `uuid` text NOT NULL,
  `slug` text NOT NULL,
  `kategori_produk` enum('cctv indoor','cctv outdoor','accessories') NOT NULL,
  `brand` varchar(255) NOT NULL,
  `nm_produk` text NOT NULL,
  `ket_produk` text NOT NULL,
  `harga` int NOT NULL,
  `stok_produk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `uuid`, `slug`, `kategori_produk`, `brand`, `nm_produk`, `ket_produk`, `harga`, `stok_produk`) VALUES
(5, '943cd311-ae00-499d-8bf9-dcbdab79e1d0', 'kepala-kabel-lan-rj45', 'accessories', 'Tech 4', 'Kepala Kabel LAN RJ45', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong><br>â—¾ 8P8C Modular<br>â—¾ Color : White transparent color / Metal<br>â—¾ Type : RJ45 Cat6 UTP FTP / Cat6A UTP FTP<br>â—¾ Connector : 24K Gold Plated<br>â—¾ Connector Shell : Metal Shield<br>â—¾ Product Material : Plastic / Metal</p>', 50000, 1500),
(6, '5ea15639-209e-4afa-a1b9-fd16192303cd', 'kabel-lan-cat-5e', 'accessories', 'Tech 4', 'Kabel LAN CAT 5e', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong></p><p>1 Meter</p>', 23500, 1500),
(7, '79f7573f-99f0-4654-a766-1867605270a9', 'bracket-cctv--ip-camera', 'accessories', 'AmSecu', 'Bracket CCTV / IP Camera', '', 13000, 1500),
(8, 'e5c56ad0-a3f4-4275-937b-35511e8b92de', 'breket-cctv-camera-indoor-putih', 'accessories', 'AmSecu', 'BREKET CCTV CAMERA INDOOR PUTIH', '', 16999, 1500),
(9, 'a71afb8d-60d3-49fd-8526-13d14fe4b67e', 'bracket-cctv-tiang--breket-cctv-mounting-30cm-lengkap', 'accessories', 'AmSecu', 'Bracket CCTV Tiang / Breket CCTV Mounting 30cm Lengkap', '', 60000, 1500),
(10, '88beb8ce-57dd-49f7-89f0-bc091504e123', 'kamera-cctv-3-pin-125-mm-video-kabel-panjang-kabel-sekitar-500-mm-untuk-kamera-cctv-dc-input-bnc-video-output', 'accessories', 'AmSecu', 'Kamera CCTV 3 Pin 1.25 Mm Video Kabel Panjang Kabel Sekitar 500 Mm, untuk Kamera CCTV (DC Input BNC Video Output)', '', 6695, 1500),
(11, 'b0cd2d6b-a6f8-4c77-8207-747d0cec6c70', 'adaptor-5-ampere-12-volt-dvr-dan-camera-cctv-adaftor-1a-12v', 'accessories', 'TechTrance', 'Adaptor 5 Ampere 12 Volt DVR dan Camera CCTV Adaftor 1A 12V', '', 128000, 1500),
(12, '3cb06743-448c-4754-8042-a74d3aabe133', 'dvr-cctv-uniarch-xvr-uniarch-4ch-xvr-104g-garansi-resmi', 'accessories', 'Uniarch', 'Dvr Cctv Uniarch Xvr Uniarch 4ch XVR-104G Garansi Resmi', '', 369000, 1500),
(13, 'cd8831b5-6d04-4262-97da-19e0c325b720', 'power-adaptor-cctv-12v-1a-murni-adaptor-termurah', 'accessories', 'Uniarch', 'POWER ADAPTOR CCTV 12V 1A MURNI ADAPTOR TERMURAH', '', 50000, 1500),
(14, '7ac845a5-1575-4fb6-b0b0-e6ede40c4ddc', 'poe-switch-hub-8-port-ananta-full-spedd-poe-garansi-1-tahun', 'accessories', 'Uniarch', 'PoE Switch Hub 8 Port ANANTA Full Spedd POE Garansi 1 Tahun', '<p><strong>Fitur Unggulan :</strong><br>â€¢ 8 POE Port at 10/100Mpbs each without missing data.<br>â€¢ 2 Ethernet Uplink at 10/100Mpbs each.<br>â€¢ Extend networking port can extend signal and distance up to 250m.<br>â€¢ Every port supports MDI/MDI auto flip and self negotiation.<br>â€¢ Support CAT-5e or better access point(AP) and data transmission for networking camera<br>â€¢ CASING METAL</p>', 405000, 1500),
(15, 'fba50102-5717-4b0c-916b-489925e88bc2', 'ds-2fa1205-c8-power-adaptor-hikvision-8ch-switching-mode-power-supply', 'accessories', 'HIKVISION', 'DS-2FA1205-C8 POWER ADAPTOR HIKVISION 8CH SWITCHING MODE POWER SUPPLY', '', 144000, 1500),
(16, '2e2c7a33-29e1-4d09-9f29-0efc318ea265', 'bardi-smart-indoor-ptz-ip-camera-cctv-wifi-iot-home-automation--micro-sd-128gb-v-gen', 'cctv indoor', 'BARDI ', 'BARDI Smart Indoor PTZ IP Camera CCTV Wifi IoT Home Automation + Micro SD 128GB V GEN', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;</p><p>â—†Support motion detection, instant&amp;accurate alerts<br>â—†Support two-way audio<br>â—†Support micro SD card (max 128 GB) storage<br>â—†Support Android /iOS system mobile devices, remote real-time monitoring<br>â—†Pan/Tilt<br>â—†IR distance max 10m</p>', 694000, 1500),
(17, 'bfa875ca-ba81-4cd4-997d-3e11066c741e', 'avaro-k259-smart-indoor-ipcam-ip-camera-cctv-wifi-home-automation', 'cctv indoor', 'AVARO', 'AVARO K259 Smart Indoor IPCam IP Camera CCTV Wifi Home Automation', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong><br>â€¢ 355ï‚° Rotation, 135ï‚° Visible<br>â€¢ Mengawasi lebih luas, dengan kemapuan rotasi AVARO IP Camera yang maksimal<br>â€¢ Operating Tempearture<br>â€¢ Mengawasi dengan udara apapun, baik panas ataupun dingin, AVARO IP CAM dapat bekerja maksimal.</p>', 320000, 1500),
(18, '664cd155-59aa-4fd4-88d1-ffb229e38452', 'kamera-cctv-dahua-hac-hdw1239tl-a-led---2mp---full-color---mic', 'cctv indoor', 'Dahua', 'Kamera CCTV Dahua HAC-HDW1239TL-A-LED - 2MP - Full Color - Mic', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong><br>â€¢ 1/2.8\" 2Megapixel Sony CMOS<br>â€¢ 25/30fps@1080P,&nbsp;<br>â€¢ 25/30/50/60fps@720P<br>â€¢ Full-color Starlight<br>â€¢ ICR,&nbsp;<br>â€¢ OSD,&nbsp;<br>â€¢ 3.6mm fixed lens(2.8mm optional),&nbsp;<br>â€¢ 20m LED,&nbsp;<br>â€¢ smart white light<br>â€¢ CVI/TVI/AHD/CVBS output switchable&nbsp;<br>â€¢ DC12V,&nbsp;<br>â€¢ IP67, &nbsp;<br>â€¢ built-in mic</p>', 499000, 1500),
(19, 'af9bf18c-2f53-4dcb-b444-0832cabf6521', 'camera-hd-hikvision-5mp-ds-2ce56h0t-itpf', 'cctv indoor', 'HIKVISION', 'CAMERA HD HIKVISION 5MP DS-2CE56H0T-ITPF', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></p><ul><li>5 Megapixel high-performance CMOS</li><li>Analog HD output, up to 5MP resolution</li><li>True Day/Night</li><li>OSD menu, 2D DNR, DWDR</li><li>EXIR technology, up to 20m IR distance</li><li>4 in 1 video output (switchable TVI/AHD/CVI/CVBS)</li><li>Up the Coax(HIKVISION-C)</li></ul>', 355000, 1500),
(20, 'ed94442b-1ca6-4e03-a069-849f0a05b4c5', 'xiaomi-mi-home-security-camera-360-1080p---xiaomi-cctv-ip-cam-kamera---hd-c200', 'cctv indoor', 'Xiaomi', 'Xiaomi Mi Home Security Camera 360Â° 1080P - Xiaomi CCTV Ip cam Kamera - HD C200', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong></p><ul><li>Model: MJSXJ14CM</li><li>Resolusi: 1920x1080P</li><li>Memori: Kartu Micro SD (up to 256GB)</li><li>Suhu pengoperasian: -10â„ƒ-40â„ƒ</li><li>Konektivitas: Wi-Fi IEEE 802.11b/g/n, 2.4GHz</li><li>Berat: 254g</li><li>Daya: 5V/2A</li><li>Sudut tampilan: 110Â°</li><li>Dimensi: 108Ã—75Ã—75mm</li><li>Kompatibel dengan: Android 4.4, iOS 9.0</li></ul>', 449000, 1500),
(21, 'b7b69f1e-cf6e-4c68-a1bb-442db52024b2', 'ezviz-c6n-ip-cam-indoor-cctv-w-sandisk-sd-card-64128256gb', 'cctv indoor', 'EZVIZ', 'Ezviz C6N IP Cam Indoor CCTV w/ Sandisk SD Card 64/128/256GB', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></p><ul><li>Model : CS-C6N-A0-1C2WFR</li><li>Image Sensor : 1/4\" Progressive Scan CMOS</li><li>Shutter Speed : Self-adaptive shutter</li><li>Lens : 4mm@ F2.4, view angle: 85Â° diagonal, 75Â° horizontal, 45Â° vertical</li><li>Lens Mount : M12</li><li>Day &amp; Night : IR-cut filter with auto-switching</li><li>DNR : 3D DNR</li><li>WDR : Digital WDR</li></ul>', 518000, 1500),
(22, '8d886b62-afcd-4d87-92cb-7d6d8ca9f95c', 'ezviz-c1c-720p-indoor-ip-wifi-camera', 'cctv indoor', 'EZVIZ', 'Ezviz C1C 720p Indoor IP WiFi Camera', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></p><ul><li>Model: C1C 720p</li><li>Image Sensor: 1/4 Progressive Scan CMOS 1/2.9\" Progressive Scan CMOS</li><li>Shutter Speed: Self-adaptive shutter Self-adaptive shutter</li><li>Lens: 2.8mm, view angle:92 (Horinzotal), 110 (Diagonal) 2.8,view anggle: 106 (Horizontal), 130 (Diagonal)</li><li>Lens Mount: M12</li><li>Day &amp; Night: IR-cut with auto-switching IR-cut filter with auto-switching</li><li>Smart Alarm: Motion detection</li><li>Wi-Fi Pairing: AP pairing</li><li>Protocol: EZVIZ cloud propriertry protocol</li><li>Interface Protocol: EZVIZ cloud propriertry protocol</li><li>General Features: Anti-Flicker, Dual-Stream, Heart Beat,Mirror</li><li>Image,Password Protection, Watermark</li><li>Stroge: Support Micro SD card(Max. 256G)</li><li>Power: Micro USB</li><li>Power Supply: DC 5V+10%</li><li>Power Consumption: Max. 4.0W</li><li>IR Range: Max. 12meters</li><li>Product Dimensions: 64mm x 64mm x 103mm</li><li>Packaging Dimensions: 123mm x 79mm x 125.5mm</li><li>Weight: 96g</li></ul>', 265000, 1500),
(23, 'ec22f6fe-3349-4d45-87e2-6e247ad48d69', 'bardi-smart-ip-camera-static-cctv-indoor', 'cctv indoor', 'BARDI', 'BARDI Smart IP Camera Static CCTV Indoor', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></p><ul><li>Berat 300grm</li><li>Ukuran 140x90x60mm</li></ul>', 289000, 1500),
(24, '56d911d6-7462-438f-884e-44acdd95fb1a', 'cctv-hd-vivotek-fd9380-h-5mp', 'cctv indoor', 'VIVOTEK', 'CCTV HD VIVOTEK FD9380-H 5MP', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong><br>CCTV HD CAMERA VIVOTEK FD9380-H 5MP</p><p>- H.265 Compression Technology<br>- 20 fps @ 2560x1920 (WDR Pro on)<br>- SNV (Supreme Night Visibility) for Low Light Conditions<br>- WDR Pro for Unparalleled Visibility in Extremely Bright and Dark Environments<br>- Smart Stream III to Optimize Bandwidth Efficiency<br>- Built-in IR Illuminators, Effective up to 30 Meters<br>- Trend Micro IoT Security<br>- Weather-proof IP66-rated and Vandal-proof IK10-rated Housing<br>- Built-in MicroSD/SDHC/SDXC Card Slot for On-board Storage</p>', 4150000, 1500),
(25, '78971d70-43a3-4685-b483-364ca03e90f4', 'cctv-samsung-hd-indoor-wisenet-qnv-6020r-2mp', 'cctv indoor', 'Samsung', 'CCTV Samsung HD INDOOR WISENET QNV-6020R 2MP', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong><br>- 2MP (1920 x 1080) resolution<br>- Built-in 3.6mm fixed lens<br>- 30fps@all resolutions (H.265/H.264)<br>- H.265, H.264, MJPEG codec supported, Multiple streaming<br>- Day &amp; Night (ICR), WDR (120dB)<br>- Motion detection, Tampering, Defocus detection<br>- micro SD (128GB) memory slot, PoE / 12V DC<br>- IR viewable length 25m, IP66, IK10<br>- Hallway view support<br>- LDC support (Lens Distortion Correction)</p>', 1126000, 1500),
(26, '9e8e24b6-e6cb-48fd-9e5b-55a05b958ca7', 'cctv-hd-outdoor-wisenet-qno-6022r-2-mp', 'cctv outdoor', 'WISENET', 'CCTV HD OUTDOOR WISENET QNO-6022R 2 MP', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong><br>- Maximum 2megapixel (1920 x 1080) resolution<br>- 0.03Lux (Color), 0Lux (B/W, IR LED on)<br>- 4mm fixed lens<br>- Maximum 30fps@2MP all resolutions (H.265/H.264)<br>- H.265, H.264, MJPEG codec supported, Multiple streaming<br>- Motion detection, Tampering, Defocus detection<br>- Hallway view (90Â°/270Â°), LDC support<br>- Micro SD/SDHC/SDXC memory slot (Max. 128GB)<br>- IR viewable length 25m<br>- IP66, IK10, PoE, 12VDC<br>- No-audio model</p>', 2405000, 1500),
(27, '8b949cec-da41-4367-b77e-560072917a19', 'hikvision-cctv-outdoor-camera1080p', 'cctv outdoor', 'HIKVISION', 'HIKVISION CCTV OUTDOOR CAMERA1080p', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong></p><p>- Fix Lens 2.8/3.6mm<br>- HD 1080P / 2MP CMOS sensor<br>- 1pcs EXIR LEDs,<br>- Smart IR, 20m IR<br>- Outdoor EXIR Bullet<br>- ICR<br>- 0,02 Lux<br>- 12VDC<br>- IP66<br>- Support TVI/AHD/CVI/CVBS Video output</p>', 321000, 1500),
(28, 'ac4b7b2c-b5f7-44ef-8fd9-d2099486cd64', 'camera-cctv-outdor-hikvision-5mp-1080p-full-hd-ds-2ce16hot-itpf', 'cctv outdoor', 'HIKVISION ', 'CAMERA CCTV OUTDOR HIKVISION 5MP 1080P FULL HD DS-2CE16HOT-ITPF', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong></p><ul><li>5MP,</li><li>5MP CMOS Sensor,</li><li>18fps at 1920*1536 resolution,</li><li>EXIR, 20m IR,</li><li>Indor EXIR Bullet, ICR,</li><li>0.01 Lux/F1.2, 12 VDC,</li><li>Smart IR, DNR, OSD Menu(Up the Coax),</li><li>IP66.</li></ul>', 458000, 1500),
(29, '1a2351cc-f68b-4763-afc4-b66b85e3a7fa', 'cctv-camera-outdoor-color-vu-xvi-2mp-series-type-f991', 'cctv outdoor', 'Color Vu', 'CCTV CAMERA OUTDOOR COLOR VU XVI 2MP SERIES TYPE-F991', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong></p><ul><li>CAMERA CCTV OUTDOOR COLOR VU SPT 2MP 4 IN 1</li><li>LENSA :3,6MM 5MP</li><li>RESOLUSI 2MP</li><li>SIANG MALAM BERWARNA</li><li>GARANSI 1TAHUN</li><li>HARGA BELUM TERMASUK ADAPTOR</li></ul>', 165000, 1500),
(30, '9902547d-f29d-447b-bbe1-a14f14c50e3b', 'ezviz-husky-c3wn-outdoor-full-hd-ip-camera-cctv-wifi-waterproof-1080p', 'cctv outdoor', 'EZVIZ', 'EZVIZ HUSKY C3WN Outdoor Full HD IP Camera CCTV WiFi WATERPROOF 1080P', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong><br>- Model Name : CS-CV310-A0-1C2WFR<br>- Camera: Image sensor: 1/2.9\" Progressive Scan CMOS<br>- Minimum Illumination: 0.02 lux @(F2.0, AGC ON), 0 lux with IR<br>- Lens: 2.8mm @ F1.8, view angle: 95 (Horizontal), 110(Diagonal)<br>4mm@ F2.0, view angle: 81 (Horizontal), 94(Diagonal)<br>- DNR: 3D DNR<br>- WDR: Digital WDR<br>- Compression: Video Compression H.264<br>- Video Bit Rate: Ultra-HD; HD; Standard. Adaptive bit rate<br>- Image: Max. Resolution 1920 x 1080<br>- Frame Rate: Max: 30fps; Self-Adaptive during network transmission<br>- Interface Protocol: EZVIZ Cloud Proprietary Protocol<br>- General Function: Anti-Flicker, Dual-Stream, Heart Beat, Mirror Image, Password Protection, Watermark<br>Interface<br>- Storage Support Micro SD cared (Max 256GB)<br>- Interface: Wired network, A RJ45 Ethernet Port (Kabel LAN), adaptive rate or 10 / 100M<br>- Security: 64/128-bit WEP, WPA / WPA2, WPA-PSK / WPA2-PSK, WPS<br>- General Operating Conditions (-30\"C ~ 60\"C), humidity 95% or less<br>- IR Range Max. 30 meters<br>- Dimensions (mm): 72mm x 72mm x 150 mm</p>', 499000, 1500),
(31, '1509611b-681b-49e4-904b-212ee6649d66', 'new-v380-hd-5mp-full-hd-outdoor-wifi-cctv-ip-camera-waterpoof', 'cctv outdoor', 'V380', 'New V380 HD 5MP FULL HD Outdoor Wifi Cctv Ip Camera Waterpoof', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong><br>- Is_customized:Yes<br>- Power Consumption(W): 10w<br>- Viewing Angle (Degree):355 degrees Rotation<br>- Supported Operating Systems:Windows XP,Windows Vista,Windows 7,Windows 8<br>- Lens (mm):3.6mm<br>- High Definition: 8MP 1080(HD)<br>- Style:Bullet Camera<br>- Special Features:Other<br>- Color:White<br>- Technology:Infrared<br>- Power Supply(V):12V-1A<br>- Sensor:CMOS<br>- Dimensions (L x W x D)(mm):8.5*6.8*12.5<br>- Supported Mobile Systems:iPhone OS,Android<br>- Type:IP Camera<br>- Video Compression Format:H.264<br>- Network Interface:Wi-Fi/802.11/b/g</p>', 10000, 1500),
(32, '4b9d0699-1cbb-4dae-9aa4-f98a9c26d604', 'ip-camera-cctv-outdoor-cctv-wifi-360-ptz-pan-tilt-8-mp-v380-pro', 'cctv outdoor', 'V380', 'IP Camera CCTV Outdoor CCTV Wifi 360 PTZ Pan Tilt 8 MP V380 Pro', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong><br>- Image sensor: 8MP HD 1080/25fps</p><p>- Wireless: IEEE802.11b/g/n</p><p>- Wireless mode: Direct mode/WiFi mode</p><p>- Storage Media: Up to 128GB(no include TF card)</p><p>- Video compression: H.264</p><p>- Lens:3.6mm</p><p>- Bisa Live 4 camera sekaligus dlm 1 layar Hp</p><p>-Support Mmc Max.128gb,</p>', 215000, 1500),
(33, '883a4ecb-5960-4bd1-aed1-2187cd346eb7', 'bardi-smart-ip-camera-outdoor-ptz-cctv-wifi', 'cctv outdoor', 'BARDI', 'BARDI Smart IP Camera Outdoor PTZ CCTV Wifi', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong><br>BARDI IP Camera Outdoor PTZ TPD merupakan kamera pintar dengan resolusi 1080p (Full HD) yang dapat digerakkan berputar secara vertikal dan horizontal, sehingga dapat memantau kondisi secara lebih luas karena dapat dikontrol dari aplikasi Bardi Smart Home pada smartphone Anda.</p>', 569000, 1500),
(34, 'aa1c58ec-c2f5-4208-9406-1753fae3cb70', 'camera-cctv-wifi-outdoor-thunderin-th-787-icsee', 'cctv outdoor', 'THUNDERIN', 'CAMERA CCTV WIFI OUTDOOR THUNDERIN TH-787-ICSEE', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong><br>-&gt; High Definition: 5.0 Megapixels<br>-&gt; Lens (mm): 4Mm<br>-&gt; Style: Dome Camera<br>-&gt; Type: Speed Dome Camera<br>-&gt; Connectivity: IP/Network Wireless<br>-&gt; Installation: Ceiling<br>-&gt; Wall Bracket: Side<br>-&gt; Supported Mobile Systems: ios &amp; Android<br>-&gt; Special Features: Waterproof / Weatherproof<br>-&gt; Power Consumption(W): Storage: UP To 128GB<br>-&gt; Color: White<br>-&gt; Minimum Illumination(Lux): 0.01Lux<br>-&gt; Sensor: CMOS<br>-&gt; Power Supply(V): DC 12V 2A<br>-&gt; Network Interface: Wi-Fi/802.11/b/g<br>-&gt; Megapixels: 5MP<br>-&gt; Video Compression Format: H.265X<br>-&gt; Technology: LED Super Bright<br>-&gt; Power Supply: Normal</p>', 299000, 1500),
(35, 'd2845bcd-dfe2-4b5d-a697-2424250f94c3', 'camera-cctv-ezviz-outdoor-cs-h8c-1080p-2mp', 'cctv outdoor', 'EZVIZ', 'CAMERA CCTV EZVIZ OUTDOOR CS-H8C 1080P/ 2MP', '<p><strong>spesifikasi&nbsp;&nbsp;&nbsp;&nbsp;:</strong></p><p>â€¢ Model: CS-H8C (1080P)<br>â€¢ Image Sensor: 1/2.7\" Progressive Scan CMOS<br>â€¢ Video: H.265 / H.264<br>â€¢ Lens Type: 4mm Fixed Lens<br>â€¢ IR Length: 30m<br>â€¢ Wireless: IEEE802.11b, 802.11g, 802.11n<br>â€¢ Interface: Micro SD Card Slot (up to 512GB), Built-in Mic , RJ45 Ã— 1(10M/100M Adaptive Ethernet Port), 3D DNR, Digital WDR<br>â€¢ Power: 12V DC, 1A (Max 12W)<br>â€¢ Net Dimension: 140mm Ã— 140mm Ã— 192mm<br>â€¢ Net Weight: 420g</p>', 769000, 1500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun_users`
--
ALTER TABLE `akun_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD PRIMARY KEY (`id_img`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_produk`
--
ALTER TABLE `pesanan_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun_users`
--
ALTER TABLE `akun_users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gambar_produk`
--
ALTER TABLE `gambar_produk`
  MODIFY `id_img` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan_produk`
--
ALTER TABLE `pesanan_produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `hapus_pesanan` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-04-06 01:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM pesanan
WHERE waktu < DATE_ADD(NOW(), INTERVAL -1 DAY) AND bukti_pembayaran IS NULL$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
