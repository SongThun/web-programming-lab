-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: lorem_ipsum
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `lorem_ipsum`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `lorem_ipsum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `lorem_ipsum`;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `imageLink` text,
  `urlLink` text,
  `isactive` enum('active','inactive') DEFAULT NULL,
  `banType` varchar(255) DEFAULT NULL,
  `createdDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `userID` int NOT NULL,
  `productID` int NOT NULL,
  `amount` decimal(4,0) DEFAULT NULL,
  PRIMARY KEY (`userID`,`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `catID` int NOT NULL AUTO_INCREMENT,
  `catName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`catID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Drinkware'),(2,'Tableware'),(3,'Home Decor'),(4,'Figurines'),(5,'Stationery'),(6,'Toys'),(7,'Storage'),(8,'Lighting'),(9,'Bedding'),(10,'Wall Art');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `imageLink` text,
  `productDesc` text,
  `catID` int DEFAULT NULL,
  `createdDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `price` decimal(10,2) DEFAULT NULL,
  `salesAmount` decimal(10,0) DEFAULT '0',
  `inStock` decimal(10,0) DEFAULT '0',
  `discount` decimal(5,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `catID` (`catID`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`catID`) REFERENCES `categories` (`catID`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Dog Family Ceramic Mug','dog-family-figure.jpg','Adorable dog family-themed ceramic mug, perfect for your morning coffee or afternoon tea. Features a playful design of a dog family that brings joy to your daily beverage routine.',1,'2025-04-20 17:30:51',15.01,23,81,0.00),(2,'Cartoon Snail Ceramic Mug','cartoon-snail-ceramic-mug.jpg','Charming cartoon snail ceramic mug with vibrant colors and whimsical design. This eye-catching mug brings character to your kitchen collection and makes a perfect gift for snail enthusiasts.',1,'2025-04-20 17:30:51',10.38,32,75,0.20),(3,'Lovely Flower Tea Cup','lovely-flower-cup.jpg','Elegant tea cup with beautiful flower motifs. Fine porcelain with delicate hand-painted floral design makes this cup perfect for afternoon tea gatherings or as a decorative piece.',1,'2025-04-20 17:30:51',12.63,64,99,0.00),(4,'Mountain Adventure Tumbler','dog-family-figure.jpg','Double-walled insulated tumbler featuring outdoor wilderness scenes. Keeps your beverages hot or cold for hours while showcasing your love for adventure.',1,'2025-04-20 17:30:51',22.26,123,92,0.20),(5,'Cat Family Collector Mug','cat-family-figure.jpg','Limited edition collector mug featuring an adorable cat family design. Made from premium ceramic with glossy finish, this mug combines functionality with artistic charm.',1,'2025-04-20 17:30:51',22.12,2,96,0.00),(6,'Pastel Jam Container','pastel-jam-container.jpg','Stylish pastel-colored jam container with airtight seal. Perfect for preserving homemade jams and spreads while adding a touch of color to your breakfast table.',1,'2025-04-20 17:30:51',16.22,14,90,0.00),(7,'Banana Tissue Box Cover','banana-tissue-box.jpg','Quirky banana-shaped tissue box cover that adds a playful touch to any room. Made from durable resin with detailed texture and vibrant yellow finish.',1,'2025-04-20 17:30:51',27.04,10,78,0.00),(8,'Happy Dog Travel Mug','happy-dog-figure.jpg','Insulated travel mug featuring a cheerful dog design. Leak-proof lid and comfortable grip make this the perfect companion for dog lovers on the go.',1,'2025-04-20 17:30:51',26.92,10,72,0.00),(9,'Angel Pig Ceramic Mug','angle-pig-decorator.jpg','Whimsical ceramic mug featuring an adorable angel pig design. The unique handle and quality glazing make this a charming addition to your mug collection.',1,'2025-04-20 17:30:51',12.02,14,92,0.20),(10,'Strawberry Porcelain Teacup','strawberry-porcelain-plate.jpg','Delicate porcelain teacup with strawberry pattern. Perfect for serving tea or coffee with a touch of sweetness and seasonal charm.',1,'2025-04-20 17:30:51',18.91,12,89,0.30),(11,'Nautical Snail Serving Bowl','cartoon-snail-ceramic-mug.jpg','Large ceramic serving bowl with nautical snail motif. Perfect for salads, pasta, or as a decorative centerpiece with its unique design and durable construction.',2,'2025-04-20 17:30:51',27.91,3,83,0.00),(12,'Woodland Creatures Dinner Plate','cartoon-snail-ceramic-mug.jpg','Charming dinner plate featuring woodland creatures in vibrant colors. Made from durable stoneware that\'s dishwasher and microwave safe.',2,'2025-04-20 17:30:51',15.52,7,89,0.00),(13,'Ocean Life Salad Bowl','cartoon-snail-ceramic-mug.jpg','Deep salad bowl decorated with colorful ocean life scenes. Perfect for serving fresh salads or as a decorative piece in your kitchen.',2,'2025-04-20 17:30:51',19.48,14,89,0.30),(14,'Frog Prince Serving Platter','frog-figure.jpg','Whimsical serving platter shaped like a friendly frog prince. This conversation starter is perfect for serving appetizers or as a decorative accent.',2,'2025-04-20 17:30:51',7.06,5,88,0.00),(15,'Cute Apple Fruit Plate','cute-apple-plate.jpg','Adorable apple-shaped plate perfect for serving fruits, desserts, or as a decorative accent. The glossy ceramic finish and realistic details make this a delightful addition to your table.',2,'2025-04-20 17:30:51',14.66,3,80,0.00),(16,'Harvest Angel Pig Platter','angle-pig-decorator.jpg','Festive angel pig decorative platter perfect for holiday gatherings. The playful design and quality craftsmanship make this a conversation starter at any meal.',2,'2025-04-20 17:30:51',13.75,16,77,0.00),(17,'Kawaii Water Bottle','kawaii-water-bottle.jpg','Cute kawaii-styled water bottle with a cheerful character design. BPA-free with leak-proof cap, perfect for keeping hydrated with style throughout the day.',2,'2025-04-20 17:30:51',12.14,12,85,0.00),(18,'Sky Bird Porcelain Plate','sky-bird-porcelain-plate.jpg','Elegant porcelain plate featuring a delicate sky bird design. Hand-painted with fine details, this plate brings artistic touch to your dining experience.',2,'2025-04-20 17:30:51',29.90,9,85,0.00),(19,'Countryside Picnic Set','dog-family-figure.jpg','Complete picnic set with dog family motif on each piece. Includes plates, cups, and utensils for a coordinated outdoor dining experience.',2,'2025-04-20 17:30:51',27.70,11,87,0.00),(20,'Lily Pad Serving Dish','frog-figure.jpg','Nature-inspired serving dish shaped like a lily pad. Perfect for presenting appetizers or sushi with an organic touch to your table setting.',2,'2025-04-20 17:30:51',13.06,16,81,0.00),(21,'Feline Family Figurine','cat-family-figure.jpg','Charming cat family figurine portraying a mother cat with kittens. Hand-painted ceramic with fine details makes this a perfect gift for cat lovers or as a shelf accent.',3,'2025-04-20 17:30:51',18.76,10,71,0.00),(22,'Blossom Vase Collection','lovely-flower-cup.jpg','Elegant flower-inspired vase set for fresh or dried arrangements. The delicate design and quality porcelain construction add sophistication to any room.',3,'2025-04-20 17:30:51',28.87,5,75,0.20),(23,'Spring Meadow Candle Holder','lovely-flower-cup.jpg','Delicate candle holder with spring flower motifs. Perfect for creating a warm, inviting atmosphere with its soft, nature-inspired design.',3,'2025-04-20 17:30:51',8.05,0,70,0.00),(24,'Modern Hydration Vase','kawaii-water-bottle.jpg','Dual-purpose water bottle shaped vase with contemporary design. Perfect for minimalist home decor or as a functional water container for your desk.',3,'2025-04-20 17:30:51',10.98,19,86,0.00),(25,'Strawberry Accent Dish','strawberry-porcelain-plate.jpg','Charming strawberry-shaped accent dish to hold small trinkets, jewelry, or as a decorative piece. The vibrant colors and glossy finish make this a delightful addition to any room.',3,'2025-04-20 17:30:51',11.18,8,94,0.00),(26,'Tropical Banana Accessory Tray','banana-tissue-box.jpg','Playful banana-shaped tray for organizing small items on your vanity or entryway. The unique design adds a touch of whimsy to your home.',3,'2025-04-20 17:30:51',23.96,9,77,0.00),(27,'Lucky Cat Feng Shui Statue','lucky-cat-water-bottle.jpg','Traditional Japanese Maneki-neko (lucky cat) figurine believed to bring good fortune and prosperity. Hand-painted with fine details and a raised paw to welcome abundance.',3,'2025-04-20 17:30:51',15.88,15,90,0.00),(28,'Celestial Bird Decorative Plate','sky-bird-porcelain-plate.jpg','Ornate wall plate featuring a celestial bird design with gold accents. Perfect as a wall hanging or displayed on a plate stand as a sophisticated decor element.',3,'2025-04-20 17:30:51',11.08,7,94,0.00),(29,'Guardian Angel Pig Figurine','angle-pig-decorator.jpg','Whimsical angel pig figurine with detailed wings and halo. This charming piece brings playful protection and character to your shelf or mantel.',3,'2025-04-20 17:30:51',5.22,14,74,0.30),(30,'Botanical Splendor Potpourri Bowl','lovely-flower-cup.jpg','Delicate flower-patterned bowl perfect for displaying potpourri or decorative elements. The intricate design makes this both functional and decorative.',3,'2025-04-20 17:30:51',8.06,2,78,0.00),(31,'Vintage Jam Jar Figurine','pastel-jam-container.jpg','Detailed miniature figurine of a vintage-style jam jar with removable lid. Perfect for collectors of kitchen memorabilia or as a charming shelf accent.',4,'2025-04-20 17:30:51',18.41,18,90,0.20),(32,'Enchanted Garden Fairy','lovely-flower-cup.jpg','Delicate fairy figurine nestled among flower blossoms. Hand-painted with pearlescent finish and fine details, perfect for fairy garden enthusiasts.',4,'2025-04-20 17:30:51',13.78,7,78,0.00),(33,'Happy Dog Collectible Figurine','happy-dog-figure.jpg','Joyful dog figurine captured in a playful pose. Made from high-quality ceramic with hand-painted details, this figurine brings a smile to any collection.',4,'2025-04-20 17:30:51',23.85,0,89,0.00),(34,'Cherub Pig Collector\'s Piece','angle-pig-decorator.jpg','Limited edition cherub pig figurine with detailed wings and celestial elements. Each piece is individually numbered and makes a unique addition to any collection.',4,'2025-04-20 17:30:51',23.31,35,74,0.00),(35,'Anime Mascot Collectible','kawaii-water-bottle.jpg','Anime-inspired character figurine with vibrant colors and dynamic pose. Perfect for anime fans and collectors of Japanese pop culture memorabilia.',4,'2025-04-20 17:30:51',16.00,7,76,0.00),(36,'Meadow Fairy Princess','lovely-flower-cup.jpg','Enchanting fairy princess figurine surrounded by delicate flowers. The intricate details and pastel colors make this a magical addition to any figurine collection.',4,'2025-04-20 17:30:51',26.86,8,75,0.00),(37,'Curious Monkey Banana Figurine','banana-tissue-box.jpg','Playful monkey figurine interacting with a banana. This whimsical piece combines humor with detailed craftsmanship for a delightful display.',4,'2025-04-20 17:30:51',21.31,2,76,0.00),(38,'Harvest Apple Gnome','cute-apple-plate.jpg','Adorable gnome figurine with an apple-themed design. This seasonal piece brings charm to your home during autumn months or year-round for fruit enthusiasts.',4,'2025-04-20 17:30:51',19.12,11,92,0.00),(39,'Frog Prince Collectible','frog-figure.jpg','Detailed frog prince figurine with crown and royal attire. This fairy tale-inspired piece is perfect for collectors of classic stories or amphibian enthusiasts.',4,'2025-04-20 17:30:51',6.70,18,72,0.00),(40,'Garden Snail Figurine','cartoon-snail-ceramic-mug.jpg','Whimsical garden snail figurine with intricate shell details. Made from weather-resistant resin, suitable for indoor display or garden decoration.',4,'2025-04-20 17:30:51',10.27,7,91,0.20),(41,'Apple Orchard Sticky Notes','cute-apple-plate.jpg','Apple-shaped sticky note pad with scented pages. Perfect for leaving sweet reminders or organizing your thoughts with a fruity twist.',5,'2025-04-20 17:30:51',28.64,12,77,0.00),(42,'Piggy Baker Memo Holder','pink-pig-seasoning-dish.jpg','Cute pink pig-shaped memo holder with clip. Keeps your notes, photos, or recipes organized while adding a touch of farmhouse charm to your desk or kitchen.',5,'2025-04-20 17:30:51',29.18,20,96,0.00),(43,'Lucky Cat Pen Holder','lucky-cat-water-bottle.jpg','Traditional Maneki-neko (lucky cat) desk organizer with compartments for pens and small stationery items. Brings good fortune and organization to your workspace.',5,'2025-04-20 17:30:51',27.12,6,72,0.00),(44,'Songbird Notepad Set','sky-bird-porcelain-plate.jpg','Elegant notepad set featuring songbird illustrations. Includes notepad, matching envelopes, and bird-shaped paper clips for coordinated correspondence.',5,'2025-04-20 17:30:51',17.54,9,70,0.00),(45,'Strawberry Fields Journal','strawberry-porcelain-plate.jpg','Hardcover journal with strawberry-themed cover and ribbon bookmark. Acid-free pages make this perfect for journaling, sketching, or preserving memories.',5,'2025-04-20 17:30:51',29.60,18,89,0.00),(46,'Kawaii Character Pencil Case','kawaii-water-bottle.jpg','Adorable pencil case featuring kawaii-style characters. Multiple compartments keep school or art supplies organized with a playful touch.',5,'2025-04-20 17:30:51',8.19,1,73,0.00),(47,'Loyal Companion Bookends','dog-family-figure.jpg','Sturdy bookends shaped like a loyal dog family. These functional decorative pieces keep your books upright while adding character to your shelves.',5,'2025-04-20 17:30:51',25.06,7,99,0.20),(48,'Pastel Tulip Stationery Set','pastel-tulip-cup-set.jpg','Complete stationery set featuring pastel tulip designs. Includes notecards, envelopes, and washi tape for creating beautiful correspondence.',5,'2025-04-20 17:30:51',26.29,1,88,0.00),(49,'Guardian Angel Desk Organizer','angle-pig-decorator.jpg','Multifunctional desk organizer with angel pig design. Features compartments for pens, clips, and small office supplies with a whimsical touch.',5,'2025-04-20 17:30:51',16.91,8,73,0.00),(50,'Feline Family Washi Tape Set','cat-family-figure.jpg','Decorative washi tape set featuring playful cat family designs. Perfect for journaling, scrapbooking, or adding feline charm to gift wrapping.',5,'2025-04-20 17:30:51',13.79,20,97,0.30),(51,'Blossom Petal Plush Toy','lovely-flower-cup.jpg','Soft plush flower with smiley face and crinkle petals. Perfect for infants and toddlers with sensory-stimulating textures and vibrant colors.',6,'2025-04-20 17:30:51',5.52,11,86,0.30),(52,'Frog Jumper Interactive Toy','frog-figure.jpg','Interactive frog toy that jumps when pressed. Encourages fine motor skills and cause-effect learning through playful interaction.',6,'2025-04-20 17:30:51',7.60,14,76,0.00),(53,'Strawberry Counting Game','strawberry-porcelain-plate.jpg','Educational counting game with strawberry-themed pieces. Helps develop early math skills while engaging children with bright, fruit-shaped components.',6,'2025-04-20 17:30:51',16.15,1,74,0.00),(54,'Sky Bird Flying Toy','sky-bird-porcelain-plate.jpg','Bird-shaped glider toy that soars through the air. The aerodynamic design and colorful wings make outdoor play exciting and active.',6,'2025-04-20 17:30:51',25.36,15,82,0.00),(55,'Snail Racing Game Set','cartoon-snail-ceramic-mug.jpg','Entertaining board game featuring racing snails. This family-friendly game combines strategy with luck for hours of slow-paced fun.',6,'2025-04-20 17:30:51',13.03,1,88,0.00),(56,'Tulip Garden Building Blocks','pastel-tulip-cup-set.jpg','Colorful building blocks with tulip theme. These eco-friendly wooden blocks help develop spatial awareness and creativity in young children.',6,'2025-04-20 17:30:51',6.71,15,89,0.00),(57,'Piggy Bank Money Game','pink-pig-seasoning-dish.jpg','Educational money counting game featuring a piggy bank. Teaches coin recognition and basic addition while developing fine motor skills.',6,'2025-04-20 17:30:51',22.61,17,100,0.00),(58,'Snail Mail Delivery Game','cartoon-snail-ceramic-mug.jpg','Cooperative board game where players help snails deliver mail. Perfect for teaching teamwork and strategic thinking with adorable characters.',6,'2025-04-20 17:30:51',23.51,18,71,0.00),(59,'Lucky Cat Electronic Pet','lucky-cat-water-bottle.jpg','Interactive electronic pet in the shape of a traditional lucky cat. Features realistic movements, sounds, and responds to touch for endless entertainment.',6,'2025-04-20 17:30:51',24.45,20,72,0.00),(60,'Garden Snail Puzzle Set','cartoon-snail-ceramic-mug.jpg','Wooden puzzle set featuring garden snail theme. Multiple difficulty levels make this educational toy perfect for developing problem-solving skills.',6,'2025-04-20 17:30:51',24.92,12,86,0.00),(61,'Piggy Seasoning Organizer','pink-pig-seasoning-dish.jpg','Adorable pink pig-shaped seasoning dish with compartments for different spices. Brings charm to your kitchen while keeping cooking essentials organized.',7,'2025-04-20 17:30:51',13.41,4,72,0.00),(62,'Dog Family Jewelry Box','dog-family-figure.jpg','Decorative jewelry box featuring a loyal dog family design. Multiple compartments keep your treasures organized while adding a touch of canine charm.',7,'2025-04-20 17:30:51',9.23,17,81,0.00),(63,'Piglet Condiment Caddy','pink-pig-seasoning-dish.jpg','Charming pig-shaped caddy for organizing condiments. Perfect for barbecues or family meals with its playful design and practical compartments.',7,'2025-04-20 17:30:51',17.00,2,95,0.00),(64,'Kawaii Desk Organizer','kawaii-water-bottle.jpg','Cute desk organizer with kawaii character design. Features multiple compartments for stationery and office supplies with a playful aesthetic.',7,'2025-04-20 17:30:51',19.87,12,83,0.00),(65,'Strawberry Kitchen Canister','strawberry-porcelain-plate.jpg','Ceramic kitchen canister with strawberry design and airtight seal. Perfect for storing flour, sugar, or cookies with a touch of fruit-inspired charm.',7,'2025-04-20 17:30:51',22.11,19,93,0.20),(66,'Happy Dog Toy Basket','happy-dog-figure.jpg','Playful dog-shaped storage basket for toys or pet supplies. The durable construction and adorable design make organization fun for any room.',7,'2025-04-20 17:30:51',14.26,12,95,0.00),(67,'Cat Family Craft Organizer','cat-family-figure.jpg','Multi-compartment craft supply organizer with cat family theme. Keeps your creative materials sorted while adding feline charm to your crafting space.',7,'2025-04-20 17:30:51',25.40,2,74,0.00),(68,'Floral Bathroom Organizer','lovely-flower-cup.jpg','Elegant bathroom organizer with flower motifs. Features compartments for toothbrushes, cosmetics, and other essentials with a touch of botanical beauty.',7,'2025-04-20 17:30:51',6.33,20,84,0.00),(69,'Garden Bloom Storage Jars','lovely-flower-cup.jpg','Set of nesting storage jars with floral design. Perfect for organizing small items like buttons, beads, or office supplies with style.',7,'2025-04-20 17:30:51',17.87,14,91,0.00),(70,'Pond Life Desk Caddy','frog-figure.jpg','Frog-themed desk caddy with lily pad design. Organizes your workspace with character while adding a touch of nature to your office décor.',7,'2025-04-20 17:30:51',22.25,12,89,0.00),(71,'Piggy Night Light','pink-pig-seasoning-dish.jpg','Soft-glow night light in the shape of a cute pink pig. Perfect for nurseries or children\'s rooms with its gentle illumination and adorable design.',8,'2025-04-20 17:30:51',22.28,20,92,0.00),(72,'Frog Prince Table Lamp','frog-figure.jpg','Whimsical table lamp with frog prince base. The fairytale-inspired design adds character to any room with its unique silhouette and warm glow.',8,'2025-04-20 17:30:51',5.61,13,92,0.00),(73,'Cat Family Shadow Projector','cat-family-figure.jpg','Enchanting night light that projects cat family shadows on walls. Creates a magical atmosphere with rotating patterns and adjustable brightness.',8,'2025-04-20 17:30:51',24.15,18,85,0.00),(74,'Angel Pig Fairy Lights','angle-pig-decorator.jpg','String of decorative lights featuring angel pig figures. Perfect for parties, holidays, or year-round whimsical decor with warm white LEDs.',8,'2025-04-20 17:30:51',23.59,5,77,0.00),(75,'Farmyard Ceiling Projector','pink-pig-seasoning-dish.jpg','Ceiling projector with rotating farmyard animals including pink pigs. Creates a soothing environment for children with gentle sounds and movement.',8,'2025-04-20 17:30:51',14.01,16,88,0.20),(76,'Piglet Desk Lamp','pink-pig-seasoning-dish.jpg','Adjustable desk lamp with playful pig design. Features touch controls and multiple brightness levels for reading or study time with character.',8,'2025-04-20 17:30:51',17.42,5,70,0.00),(77,'Garden Snail Solar Light','cartoon-snail-ceramic-mug.jpg','Solar-powered garden light shaped like a whimsical snail. Illuminates garden paths with color-changing LEDs and eco-friendly operation.',8,'2025-04-20 17:30:51',9.27,13,75,0.00),(78,'Puppy Patrol Night Light','dog-family-figure.jpg','Motion-activated night light featuring a dog family design. Provides gentle illumination for nighttime navigation with an automatic shut-off feature.',8,'2025-04-20 17:30:51',6.08,5,98,0.00),(79,'Banana Mood Light','banana-tissue-box.jpg','Unique banana-shaped mood light with adjustable brightness. The playful design and warm glow create a fun atmosphere in any room.',8,'2025-04-20 17:30:51',19.85,2,76,0.00),(80,'Lily Pad Floating Lights','frog-figure.jpg','Set of floating lily pad lights with frog accents. Perfect for pool parties or bath time with waterproof construction and gentle illumination.',8,'2025-04-20 17:30:51',26.64,4,79,0.00),(81,'Floral Embroidered Pillowcase','lovely-flower-cup.jpg','Hand-embroidered pillowcase featuring delicate flower designs. Made from 100% cotton with intricate needlework for a touch of handcrafted elegance.',9,'2025-04-20 17:30:51',11.54,20,86,0.00),(82,'Angel Pig Throw Blanket','angle-pig-decorator.jpg','Soft fleece throw blanket with angel pig pattern. Perfect for cozy nights with its lightweight warmth and whimsical design.',9,'2025-04-20 17:30:51',13.06,12,75,0.00),(83,'Banana Print Duvet Cover','banana-tissue-box.jpg','Playful duvet cover with banana print pattern. Made from 100% organic cotton for a comfortable and eco-friendly bedding option with tropical flair.',9,'2025-04-20 17:30:51',21.02,3,78,0.00),(84,'Garden Bloom Bed Sheet Set','lovely-flower-cup.jpg','Luxurious bed sheet set with delicate flower patterns. Includes fitted sheet, flat sheet, and pillowcases in soft, breathable cotton.',9,'2025-04-20 17:30:51',15.35,18,92,0.00),(85,'Piglet Dreams Crib Set','pink-pig-seasoning-dish.jpg','Complete crib bedding set featuring adorable pink pigs. Includes quilt, fitted sheet, and dust ruffle in soft, baby-safe materials.',9,'2025-04-20 17:30:51',16.16,7,77,0.20),(86,'Loyal Companion Dog Bed','dog-family-figure.jpg','Premium pet bed with dog family design. Features orthopedic foam for joint support and removable, machine-washable cover for easy cleaning.',9,'2025-04-20 17:30:51',16.88,12,81,0.30),(87,'Pastel Jam Jar Pillow Set','pastel-jam-container.jpg','Decorative pillows shaped like vintage jam jars in pastel colors. Adds a touch of farmhouse charm to your bedroom or living room decor.',9,'2025-04-20 17:30:51',8.17,10,79,0.00),(88,'Frog Prince Kids Bedding','frog-figure.jpg','Enchanting bedding set featuring a frog prince theme. Includes comforter and sheet set with fairytale illustrations for magical dreams.',9,'2025-04-20 17:30:51',23.45,15,74,0.20),(89,'Kawaii Character Sleep Mask','kawaii-water-bottle.jpg','Soft sleep mask with adorable kawaii design. Features gentle elastic and plush fabric for comfortable, light-blocking rest with a cute twist.',9,'2025-04-20 17:30:51',5.18,4,70,0.00),(90,'Lily Pad Throw Pillow','frog-figure.jpg','Decorative throw pillow shaped like a lily pad with frog accent. Adds a touch of whimsy and nature-inspired charm to any seating area.',9,'2025-04-20 17:30:51',10.66,17,76,0.00),(91,'Farmhouse Pig Wall Clock','pink-pig-seasoning-dish.jpg','Rustic wall clock with pig motif and distressed finish. Perfect for country kitchens or dining rooms with its charming farm animal theme.',10,'2025-04-20 17:30:51',11.15,8,83,0.00),(92,'Tropical Banana Canvas Art','banana-tissue-box.jpg','Bold canvas art featuring banana imagery in a pop art style. Makes a statement in modern interiors with its bright colors and fruit motif.',10,'2025-04-20 17:30:51',6.14,2,87,0.00),(93,'Pastel Tulip Framed Print','pastel-tulip-cup-set.jpg','Elegant framed print featuring delicate pastel tulips. Hand-finished frame complements the soft floral artwork for a sophisticated wall accent.',10,'2025-04-20 17:30:51',25.27,16,94,0.00),(94,'Botanical Garden Canvas Set','lovely-flower-cup.jpg','Set of three coordinating canvas prints featuring botanical flower illustrations. Perfect for creating a gallery wall with cohesive natural imagery.',10,'2025-04-20 17:30:51',27.77,14,98,0.00),(95,'Strawberry Fields Metal Sign','strawberry-porcelain-plate.jpg','Vintage-style metal sign with strawberry design. Adds rustic charm to kitchens or dining areas with its fruit-themed nostalgic appeal.',10,'2025-04-20 17:30:51',29.30,19,87,0.00),(96,'Banana Leaf Macramé Hanging','banana-tissue-box.jpg','Handcrafted macramé wall hanging with banana leaf design. Adds texture and tropical flair to any room with natural cotton fibers and wooden beads.',10,'2025-04-20 17:30:51',6.22,7,82,0.00),(97,'Tropical Fruit Wall Hooks','banana-tissue-box.jpg','Decorative wall hooks shaped like tropical fruits including bananas. Functional and playful addition to entryways, bathrooms, or children\'s rooms.',10,'2025-04-20 17:30:51',7.84,6,100,0.00);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `salesID` int NOT NULL AUTO_INCREMENT,
  `productID` int NOT NULL,
  `userID` int NOT NULL,
  `amount` decimal(5,0) DEFAULT NULL,
  `totalPrice` decimal(10,2) DEFAULT NULL,
  `salesDate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`salesID`),
  KEY `userID` (`userID`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `urole` enum('admin','user') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin_jane','$2y$10$Uk.d0sp7dwcut2wbvNpTE.qW3MHr5aqB.E3nYotcPVwkN8bJIpnJa','jane.admin@example.com','admin'),(2,'admin_mike','$2y$10$2GZKuiB2ev3UR6apSpq/xOL8jBJJVtzRJ0DINJS.ZPgskUQlsjDpG','mike.admin@example.com','admin'),(3,'user_sara','$2y$10$wT2cRZZodgrUNqDDlDy/AONSmukR17K9MR0CjCw9rJMrE6MqdK4qm','sara.user@example.com','user'),(4,'user_tom','$2y$10$KSauyQlHKbWEKM/XOO80/eH2G3rYqY32HWwPkVa3CTcN9iY7QQXpO','tom.user@example.com','user'),(5,'user_emily','$2y$10$K2auK2HpkROSzfkylRHkPeGhVIPScYwQ8VMTEC79rnySbZLYKDX0S','emily.user@example.com','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'lorem_ipsum'
--
/*!50003 DROP PROCEDURE IF EXISTS `GetFirstImagePerCategory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetFirstImagePerCategory`()
BEGIN
    SELECT c.*, 
           (SELECT p.imageLink 
            FROM products p 
            WHERE p.catID = c.catID 
            ORDER BY p.id ASC 
            LIMIT 1) AS imageLink
    FROM categories c;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-20 17:32:23
