-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2020 at 10:27 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `VladLtd`
--

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Women', NULL),
(2, 'Booties', 1),
(3, 'Sandals', 1),
(4, 'Sneakers', 1),
(5, 'Boots', 1),
(6, 'Kids', NULL),
(7, 'Boys', 6),
(8, 'Girls', 6),
(9, 'Men', NULL),
(10, 'Boots', 9),
(11, 'Sneakers', 9),
(12, 'Dress', 9);


--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `product_id`, `path`) VALUES
(1, 1, 'DOMINIQUE-sm.jpg'),
(2, 1, 'DOMINIQUE-big.jpg'),
(3, 2, 'CLEARER-sm.jpg'),
(4, 2, 'CLEARER-big.jpg'),
(5, 3, 'CARRSON-sm.jpg'),
(6, 3, 'CARRSON-big.jpg'),
(9, 5, 'CAMRYN-sm.jpg'),
(10, 5, 'CAMRYN-big.jpg'),
(11, 6, 'CELEBRATE-sm.jpg'),
(12, 6, 'CELEBRATE-big.jpg'),
(13, 7, 'CHELS-sm.jpg'),
(14, 7, 'CHELS-big.jpg'),
(15, 8, 'CLIFF-sm.jpg'),
(16, 8, 'CLIFF-big.jpg'),
(17, 9, 'DONDDI-sm.jpg'),
(18, 9, 'DONDDI-big.jpg'),
(19, 10, 'ECENTRCQ-sm.jpg'),
(20, 10, 'ECENTRCQ-big.jpg'),
(21, 11, 'EDIE-sm.jpg'),
(22, 11, 'EDIE-big.jpg'),
(23, 12, 'GEORGETTE-sm.jpg'),
(24, 12, 'GEORGETTE-big.jpg'),
(25, 13, 'GILLS-sm.jpg'),
(26, 13, 'GILLS-big.jpg'),
(27, 14, 'GLASSY-sm.jpg'),
(28, 14, 'GLASSY-big.jpg'),
(29, 15, 'HINDLE-sm.jpg'),
(30, 15, 'HINDLE-big.jpg'),
(31, 16, 'IRENEE-sm.jpg'),
(32, 16, 'IRENEE-big.jpg'),
(33, 17, 'JACEY-sm.jpg'),
(34, 17, 'JACEY-big.jpg'),
(35, 18, 'JANAE-sm.jpg'),
(36, 18, 'JANAE-big.jpg'),
(37, 19, 'KAREENA-sm.jpg'),
(38, 19, 'KAREENA-big.jpg'),
(39, 20, 'KIMMIE-sm.jpg'),
(40, 20, 'KIMMIE-big.jpg'),
(41, 21, 'LATCH-sm.jpg'),
(42, 21, 'LATCH-big.jpg'),
(43, 22, 'LUNA-sm.jpg'),
(44, 22, 'LUNA-big.jpg'),
(45, 23, 'MYLES-sm.jpg'),
(46, 23, 'MYLES-big.jpg'),
(47, 24, 'RAVYN-sm.jpg'),
(48, 24, 'RAVYN-big.jpg'),
(49, 25, 'REZZA-sm.jpg'),
(50, 25, 'REZZA-big.jpg'),
(51, 26, 'ROOKIE-sm.jpg'),
(52, 26, 'ROOKIE-big.jpg'),
(53, 27, 'STARLING-sm.jpg'),
(54, 27, 'STARLING-big.jpg'),
(55, 28, 'TRISTA-sm.jpg'),
(56, 28, 'TRISTA-big.jpg'),
(57, 29, 'TRISTAN-sm.jpg'),
(58, 29, 'TRISTAN-big.jpg'),
(59, 30, 'WRANGLE-sm.jpg'),
(60, 30, 'WRANGLE-big.jpg'),
(61, 31, 'ANSARI-sm.jpg'),
(62, 31, 'ANSARI-big.jpg'),
(63, 32, 'CALLOWAY-sm.jpg'),
(64, 32, 'CALLOWAY-big.jpg'),
(65, 33, 'CAVIARR-sm.jpg'),
(66, 33, 'CAVIARR-big.jpg'),
(67, 34, 'COASTAL-sm.jpg'),
(68, 34, 'COASTAL-big.jpg'),
(69, 35, 'COMO-sm.jpg'),
(70, 35, 'COMO-big.jpg'),
(71, 36, 'CRUSHED-sm.jpg'),
(72, 36, 'CRUSHED-big.jpg'),
(73, 37, 'DAVLIN-sm.jpg'),
(74, 37, 'DAVLIN-big.jpg'),
(75, 38, 'DAZLING-sm.jpg'),
(76, 38, 'DAZLING-big.jpg'),
(77, 39, 'DEREK-sm.jpg'),
(78, 39, 'DEREK-big.jpg'),
(79, 40, 'DEX-sm.jpg'),
(80, 40, 'DEX-big.jpg'),
(81, 41, 'HANK-sm.jpg'),
(82, 41, 'HANK-big.jpg'),
(83, 42, 'HARDENN-sm.jpg'),
(84, 42, 'HARDENN-big.jpg'),
(85, 43, 'HIGHLYTE-sm.jpg'),
(86, 43, 'HIGHLYTE-big.jpg'),
(87, 44, 'HOBART-sm.jpg'),
(88, 44, 'HOBART-big.jpg'),
(89, 45, 'INSIDER-sm.jpg'),
(90, 45, 'INSIDER-big.jpg'),
(91, 46, 'ISLES-sm.jpg'),
(92, 46, 'ISLES-big.jpg'),
(93, 47, 'OFFSHORE-sm.jpg'),
(94, 47, 'OFFSHORE-big.jpg'),
(95, 48, 'PARDIN-sm.jpg'),
(96, 48, 'PARDIN-big.jpg'),
(97, 49, 'PERDY-sm.jpg'),
(98, 49, 'PERDY-big.jpg'),
(99, 50, 'PERRIS-sm.jpg'),
(100, 50, 'PERRIS-big.jpg'),
(101, 51, 'PHANTOM-sm.jpg'),
(102, 51, 'PHANTOM-big.jpg'),
(103, 52, 'PREY-sm.jpg'),
(104, 52, 'PREY-big.jpg'),
(105, 53, 'PUCKER-sm.jpg'),
(106, 53, 'PUCKER-big.jpg'),
(107, 54, 'SARDAN-sm.jpg'),
(108, 54, 'SARDAN-big.jpg'),
(109, 55, 'SIDETRACK-sm.jpg'),
(110, 55, 'SIDETRACK-big.jpg'),
(111, 56, 'STAN-sm.jpg'),
(112, 56, 'STAN-big.jpg'),
(113, 57, 'THEORY-sm.jpg'),
(114, 57, 'THEORY-big.jpg'),
(115, 58, 'TROOPER-sm.jpg'),
(116, 58, 'TROOPER-big.jpg'),
(117, 59, 'TYPHOON-sm.jpg'),
(118, 59, 'TYPHOON-big.jpg'),
(119, 60, 'YUBA-sm.jpg'),
(120, 60, 'YUBA-big.jpg'),
(121, 61, 'BANDI-sm.jpg'),
(122, 61, 'BANDI-big.jpg');

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `description`, `price`, `SKU`, `CREATED_AT`) VALUES
(1, 5, 'DOMINIQUE', 'Call attention to your lovely lower limbs this season with DOMINIQUE! This sexy statement boot boasts a daring thigh-high shaft and extra-tall stiletto heel for a leggy look that’s sure to turn heads!', '109.95', 'FEM1', '2020-02-23 16:39:32'),
(2, 3, 'CLEARER', 'With a modern silhouette and trend-right transparency, CLEARER is a star sandal of the season.  This stunner pairs perfectly with minimalist and/or futuristic ensembles.', '99.95', 'FEM2', '2020-02-23 17:23:39'),
(3, 3, 'CARRSON', 'Get your block heel groove on in CARRSON.  Features single band across toe with adjustable buckle strap at ankle.  This must-have sandal can be paired with everything from skinny jeans to bodycons.', '89.95', 'FEM3', '2020-02-24 12:55:20'),
(5, 2, 'CAMRYN', 'Now here’s a cowboy bootie that every girl can get behind! CAMRYN’s western silhouette is flattering and easy to style, thanks to a taller-than-usual heel, cropped shaft and minimal detailing. ', '99.95', 'FEM5', '2020-02-25 12:56:27'),
(6, 3, 'CELEBRATE', 'Now here’s a sleek suede style to CELEBRATE! With a simple heeled silhouette and soft matte surfaces, this sandal is warm weather’s answer to femininity and flattering lift.', '79.95', 'FEM6', '2020-02-25 12:57:01'),
(7, 2, 'CHELS', 'Crossing a cowboy silhouette with concealed elastic goring, the CHELS boot offers the best of Western and Mod worlds! Rock this low-key favorite with a denim mini and ruffled plaid shirt for a coquettish country look. ', '89.95', 'FEM7', '2020-02-25 12:57:42'),
(8, 4, 'CLIFF', 'Fashion and function collide this season to form the CLIFF sneaker — a hot new standout with a collaged construction and playfully exaggerated proportions. Incorporating mixed prints and creative color blocking, this kick is suited for runways and city streets alike!', '59.95', 'FEM8', '2020-02-25 12:59:06'),
(9, 3, 'DONDDI', 'DONDDI it is!  Her design is simple with a wide strap across vamp and adjustable ankle strap.  Try a muscle tee and faded denim skirt with these babies.', '59.95', 'FEM9', '2020-02-25 13:03:19'),
(10, 4, 'ECENTRCQ', 'Show off your fierce attitude with ECENTRCQ, the perfect slip on sneaker with a quilted leather upper with rubber outsole.  Rock ECENTRCQ with some knee-high printed socks, pleated mini and simple tank.', '69.95', 'FEM10', '2020-02-25 13:03:39'),
(11, 5, 'EDIE', 'Call attention to your lovely lower limbs this season with EDDIE! This statement boot boasts a daring thigh-high shaft and extra-tall stiletto heel for a leggy look that is sure to turn heads!', '109.95', 'FEM11', '2020-02-25 13:04:03'),
(12, 5, 'GEORGETTE', 'Try out the over-the-knee trend with this perfect starter style! Whether you are a footwear connoisseur or fashion rookie, GEORGETTE is a staple silhouette, with sleek lines, a modest heel and minimal detailing.', '119.95', 'FEM12', '2020-02-25 13:04:25'),
(13, 4, 'GILLS', 'A laceless kick for the leopard-lover! Feline spots enliven this laid-back slip-on, while a rubber flatform sole lifts and supports.', '59.95', 'FEM13', '2020-02-25 13:05:06'),
(14, 3, 'GLASSY', 'Keep it GLASSY all season in this totally transparent statement sandal! See-through straps complement the clear towering heel, making for a versatile and figure-flattering look.', '89.95', 'FEM14', '2020-02-25 13:05:26'),
(15, 5, 'HINDLE', 'Sturdy, stylish and crafted from soft suede, the HINDLE boot was made for struttin. Hit the streets in this looker and get ready to turn heads! ', '139.95', 'FEM15', '2020-02-25 13:05:52'),
(16, 3, 'IRENEE', 'A continuous favorite, IRENEE is better than ever in a wider width!  Follow in the fashion footsteps and buckle yourself into this effortlessly elegant sandal, featuring sleek slim straps and a comfortable yet flattering low heel.', '99.95', 'FEM16', '2020-02-25 13:06:29'),
(17, 5, 'JACEY', 'Show off your stems in the JACEY boot this season! A thigh-high shaft delivers sexy drama, while sumptuous surfaces add soft opulence.', '109.95', 'FEM17', '2020-02-25 13:07:05'),
(18, 5, 'JANAE', 'No footwear says fall like a new suede boot! The knee-high shaft and warm neutral hue will pair perfectly with a cozy sweater and spiced beverage. ', '129.95', 'FEM18', '2020-02-25 13:07:33'),
(19, 3, 'KAREENA', 'Play-up the ’90s vibe by pairing this style with duds like light jeans, baby tees and long cardigans.', '69.95', 'FEM19', '2020-02-25 13:07:59'),
(20, 3, 'KIMMIE', 'Featuring a stacked cork and jute flatform sole and thick sporty straps, KIMMIE makes a modern-rugged fashion statement while providing support that your feet will thank you for.', '79.95', 'FEM20', '2020-02-25 13:08:42'),
(21, 2, 'LATCH', 'Flatter your frame and stabilize your stride with the help of LATCH, a chic lace-up bootie featuring an elastic back panel and ruggedly treaded sole. Enjoy the flexible fit afforded by the stretchy shaft, as well as generous height provided by an extra-tall heel.', '109.95', 'FEM21', '2020-02-25 13:09:19'),
(22, 3, 'LUNA', 'Look no further than LUNA for a babe-approved sandal to style with your best bohemian wears. This perfectly proportioned newbie pairs a faux wooden sole and wearable yet flattering heel with supportive upper straps for a streamlined rustic aesthetic.', '89.95', 'FEM22', '2020-02-25 13:09:37'),
(23, 4, 'MYLES', 'Keep up with sneakerheads this season by adding MYLES to your footwear mix! The thick sole and raised collar form an ultra-current silhouette and sporty hardware makes for drawstring-style lacing.', '59.95', 'FEM23', '2020-02-25 13:12:16'),
(24, 2, 'RAVYN', 'With soft suede surfaces, a tall sturdy heel and a rustic neutral color palette, the RAVYN bootie is well-suited for cozy dressing. Pair with a roomy sweater for a sexy-without-trying look', '99.95', 'FEM24', '2020-02-25 13:12:56'),
(25, 4, 'REZZA', 'There is no need to break this star-spangled sneaker in — it comes lightly distressed for a perfectly worn look! A contrast collar accents without sacrificing versatility.', '49.95', 'FEM25', '2020-02-25 13:15:06'),
(26, 2, 'ROOKIE', 'This little bootie may be named ROOKIE, but even the chicest veterans are lining up to take it out for a stroll! Trendy dipped sides update the abbreviated shaft and a perfectly proportioned block heel provides lots of lift and support. ', '99.95', 'FEM26', '2020-02-25 13:15:26'),
(27, 4, 'STARLING', 'A suede star graphic and coordinating collar panel enhance this otherwise streamlined kick, while perforations provide fresh texture and an airy feel. ', '79.95', 'FEM27', '2020-02-25 13:15:47'),
(28, 2, 'TRISTA', 'With minimal detailing and a killer high-heeled silhouette, TRISTA is the power bootie! Step into this versatile style to enhance any ensemble.', '89.95', 'FEM28', '2020-02-25 13:16:06'),
(29, 2, 'TRISTAN', 'Put some style into your step with TRISTAN! This chic buckled bootie makes a fierce fashion statement while offering lots of lift via a tall stacked heel.', '109.95', 'FEM29', '2020-02-25 13:16:42'),
(30, 4, 'WRANGLE', 'Secretly add inches to your frame by stepping into WRANGLE — a choice slip-on sneaker. This laceless hidden wedge provides flattering lift, while the exaggerated collar exudes an avant-garde air.', '69.95', 'FEM30', '2020-02-25 13:17:21'),
(31, 10, 'ANSARI', 'With smooth leather surfaces, the ANSARI offers a clean-lined look that will style seamlessly into an array of ensembles.', '99.95', 'MEN31', '2020-02-25 13:35:49'),
(32, 11, 'CALLOWAY', 'With smooth leather surfaces, the CALLOWAY offers a clean-lined look that will style seamlessly into an array of ensembles. ', '69.95', 'MEN32', '2020-02-25 13:36:14'),
(33, 12, 'CAVIARR', 'Smoking slipper-style shoes take a starring role this season. CAVIARR takes on the trend with these loafers.  The upper is given even more texture with studs covering the entire thing.  Wear them with clean lines to ensure they stay center stage.', '109.95', 'MEN33', '2020-02-25 13:36:30'),
(34, 11, 'COASTAL', 'A must-have for casual minimalists, COASTAL looks low-key with few details and a monochromatic color palette. Style this lace-up with similarly simple wears for a sleek street-ready ensemble. ', '89.95', 'MEN34', '2020-02-25 13:36:56'),
(35, 11, 'COMO', 'A must-have for casual minimalists, COMO looks low-key with few details and a monochromatic color palette. Style this lace-up with similarly simple wears for a sleek street-ready ensemble. ', '59.95', 'MEN35', '2020-02-25 13:37:22'),
(36, 12, 'CRUSHED', 'Slip into the CRUSHED loafer to live your most luxurious life this fall! The slipper silhouette makes a regal statement, while a velvet upper and satin lining offer a posh look and pampered feel. ', '109.95', 'MEN36', '2020-02-25 13:38:24'),
(37, 12, 'DAVLIN', 'With smooth leather surfaces, the DAVLIN offers a clean-lined look that will style seamlessly into an array of ensembles. ', '89.95', 'MEN37', '2020-02-25 13:39:01'),
(38, 12, 'DAZLING', 'With a backless silhouette and fancy horse bit ornament, this leather mule oozes laid back luxury. A quilted interior emphasizes the slipper-like vibe while cushioning each step.', '99.95', 'MEN38', '2020-02-25 13:39:28'),
(39, 10, 'DEREK', 'Minimal detail yields maximum style when it comes to DEREK — a super-sleek boot with a tasteful shape and subtle silver metal trim. An inside zipper allows for easy entry without distracting from the streamlined look. ', '99.95', 'MEN39', '2020-02-25 13:39:50'),
(40, 10, 'DEX', 'Calling all fashion lovers — this one is for you! A narrow toe and low heel lend the DEX Chelsea boot stylish attitude and flair for a look worthy of Carnaby street.', '119.95', 'MEN40', '2020-02-25 13:40:16'),
(41, 11, 'HANK', 'Sleeken your street style with HANK, a lace-up sneaker that trades detail for an ultra-clean aesthetic. Take your pick between multiple color variations with a contrasting white sole.', '79.95', 'MEN41', '2020-02-25 13:40:37'),
(42, 10, 'HARDENN', 'Updating the classic desert boot with a texture-blocked suede upper, HARDENN delivers time-tested style with a subtly trendy twist. Rock this always-appealing lace-up with everyday basics for seasons to come.', '109.95', 'MEN42', '2020-02-25 13:40:53'),
(43, 10, 'HIGHLYTE', 'A subtle take on the classic Chelsea boot, HIGHLYTE streamlines the appearance with color-matched elastic goring. Suede surfaces provide rustic texture and an extra-short shaft ensures broad versatility.', '129.95', 'MEN43', '2020-02-25 13:41:20'),
(44, 10, 'HOBART', 'Work and play hard in HOBART. Emphasizing style and durability, this rugged lace-up features a color-blocked leather upper, cushioned construction and lug sole.', '109.95', 'MEN44', '2020-02-25 13:41:46'),
(45, 10, 'INSIDER', 'With smooth leather surfaces, the INSIDER boot offers a clean-lined look that will style seamlessly into an array of ensembles. ', '99.95', 'MEN45', '2020-02-25 13:42:27'),
(46, 11, 'ISLES', 'At once fashion-forward and performance-driven, ISLES is a new kick to watch. The style crosses a sculptural rubber sole with a flyknit upper for a design that is both trendy and high tech. ', '79.95', 'MEN46', '2020-02-25 13:43:13'),
(47, 11, 'OFFSHORE', 'With smooth leather surfaces, OFFSHORE sneaker offers a clean-lined look that will style seamlessly into an array of ensembles. ', '89.95', 'MEN47', '2020-02-25 13:43:35'),
(48, 12, 'PARDIN', 'With smooth leather surfaces, the PARDIN offers a clean-lined look that will style seamlessly into an array of ensembles. ', '89.95', 'MEN48', '2020-02-25 13:43:54'),
(49, 12, 'PERDY', 'With smooth leather surfaces, the PERDY offers a clean-lined look that will style seamlessly into an array of ensembles. ', '109.95', 'MEN49', '2020-02-25 13:44:24'),
(50, 12, 'PERRIS', 'With smooth leather surfaces, the PERRIS offers a clean-lined look that will style seamlessly into an array of ensembles. ', '79.95', 'MEN50', '2020-02-25 13:45:20'),
(51, 12, 'PHANTOM', 'With smooth leather surfaces, the PHANTOM offers a clean-lined look that will style seamlessly into an array of ensembles. ', '109.95', 'MEN51', '2020-02-25 13:45:40'),
(52, 12, 'PREY', 'Introducing PREY — an ultra-refined dress shoe designed with gentlemen in mind. This classic lace-up is timelessly tasteful, with perfect proportions and minimal detailing for maximum versatility.', '119.95', 'MEN52', '2020-02-25 13:46:04'),
(53, 11, 'PUCKER', 'With smooth leather surfaces, the PUCKER offers a clean-lined look that will style seamlessly into an array of ensembles. ', '59.95', 'MEN53', '2020-02-25 13:46:20'),
(54, 11, 'SARDAN', 'With smooth leather surfaces, the SARDAN offers a clean-lined look that will style seamlessly into an array of ensembles. ', '69.95', 'MEN54', '2020-02-25 13:46:59'),
(55, 10, 'SIDETRACK', 'With dual zipper closures and a buckled strap detail, this leather lace-up makes a utilitarian statement. Tonal piecing highlights construction details without straying from a monochromatic color palette. ', '139.95', 'MEN55', '2020-02-25 13:47:20'),
(56, 12, 'STAN', 'Balancing a structured silhouette with soft texture, STAN is the new suede shoe of the moment. Minimal detailing makes for a rich yet unfussy look. ', '89.95', 'MEN56', '2020-02-25 13:47:40'),
(57, 11, 'THEORY', 'Cement your sneakerhead status by stepping out in this offbeat kick. A bold star graphic lends lively decoration and bright orange accents pop against an otherwise light palette. ', '79.95', 'MEN57', '2020-02-25 13:48:02'),
(58, 10, 'TROOPER', 'With smooth leather surfaces, the TROOPER offers a clean-lined look that will style seamlessly into an array of ensembles. ', '109.95', 'MEN58', '2020-02-25 13:48:26'),
(59, 10, 'TYPHOON', 'With smooth leather surfaces, the TYPHOON offers a clean-lined look that will style seamlessly into an array of ensembles. ', '119.95', 'MEN59', '2020-02-25 13:48:49'),
(60, 11, 'YUBA', 'With smooth leather surfaces, the YUBA offers a clean-lined look that will style seamlessly into an array of ensembles. ', '89.95', 'MEN60', '2020-02-25 13:49:19'),
(61, 3, 'BANDI', 'A stretchy strappy upper tops off this hybrid rubber and cork flatform sandal, giving it a rustic-meets-modern vibe that we can’t get enough of! Pair with earthy warm weather wears for a clean bohemian look.', '69.95', 'FEM4', '2020-02-26 17:28:56');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`) VALUES
(1, 'John', 'Doe', 'testuser@test.com', '0df8e7d18996dc2a2035a9dd368261f1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
