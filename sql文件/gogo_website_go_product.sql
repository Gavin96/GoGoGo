-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: gogo_website
-- ------------------------------------------------------
-- Server version	5.6.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `go_product`
--

DROP TABLE IF EXISTS `go_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `go_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pName` varchar(30) NOT NULL,
  `cId` int(11) NOT NULL,
  `pIndex` varchar(30) NOT NULL,
  `pNum` int(11) NOT NULL,
  `mPrice` double NOT NULL,
  `iPrice` double NOT NULL,
  `pDescription` longtext NOT NULL,
  `pImg` varchar(255) NOT NULL,
  `pTime` int(11) NOT NULL,
  `isShow` int(11) NOT NULL DEFAULT '1',
  `isHot` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `go_product`
--

LOCK TABLES `go_product` WRITE;
/*!40000 ALTER TABLE `go_product` DISABLE KEYS */;
INSERT INTO `go_product` VALUES (1,'荸荠（地栗/马蹄）500g',1,'sc001',500,8.3,6.9,'荸荠皮色紫黑，肉质洁白，味甜多汁，清脆可口，有“地下雪梨”之美誉，北方人称之为“江南人参”，既可做水果生吃，又可做蔬菜食用，是大众喜爱的时令之品。','./uploads',1465535235,1,0),(2,'胡萝卜500g',1,'zs002',200,6.7,5.8,'根作蔬菜食用。并含多种维生素甲、乙、丙及胡萝卜素。','./uploads',1465535328,1,0),(3,'毛芋艿500g',1,'sc003',300,6,5.5,'芋艿的营养价值极高，块茎中的淀粉含量有70%%，既可当粮食，又可做蔬菜，是老幼皆宜的秋补素食一宝。','./uploads',1465535446,1,0),(4,'山芋500g',1,'sc004',300,5.5,4.2,'山芋含有膳食纤维、胡萝卜素、维生素A、B、C、E以及钾、铁、铜、硒、钙等10余种微量元素，营养价值很高，被营养学家们称为营养最均衡的保健食品。','./uploads',1465535563,1,0),(5,'甜玉米500g',1,'sc005',300,9,7.8,'玉米味道香甜，可做各式菜肴，如玉米烙、玉米汁等。','./uploads',1465535648,1,12),(6,'土豆500g',1,'sc006',400,5.4,4.3,'一般新鲜土豆中所含成分：淀粉9～20%，蛋白质1.5～2.3%。','./uploads',1465535761,1,0),(7,'香菇150g',1,'zs007',100,11.2,7.5,'味道鲜美，香气沁人，营养丰富。香菇富含维生素B群、铁、钾、维生素D原（经日晒后转成维生素D）、味甘，性平。主治食欲减退，少气乏力。','./uploads',1465535842,1,0),(8,'小南瓜500g',1,'zs008',600,4.5,3,'小南瓜，葫芦科。皮为翠青色，上有淡黄色斑纹。与西葫芦长相相似，但形状有圆的，也有长的。小南瓜逐渐成熟后即为一般的金黄色的南瓜。','./uploads',1465535915,1,0),(9,'美国新奇士橙12只装',2,'sg001',300,96,88,'橙子富含多种有机酸、维生素，可调节人体新陈代谢，尤其对老年人及心血管病患者十分有益。橙皮中含有果酸，可促进食欲。','./uploads',1465536137,1,24),(10,'新西兰红玫瑰苹果4粒装',2,'sg002',300,28.5,25.8,'苹果中含有大量的镁、硫、铁，铜、碘、锰、锌等微量元素，可使皮肤细腻、润滑、红润有光泽。','./uploads',1465536202,1,41),(11,'进口红提 500g',2,'sg003',400,25,24,'红提营养十分丰富，它含有17%以上的葡萄糖和果糖，0.5%-1.5%的苹果酸、酒石酸、柠檬酸等，含有多种维生素和氨基酸。','./uploads',1465536275,1,0),(12,'海南火山村紫娘喜 1500g',2,'sg004',196,218,178,'荔枝味甘、酸、性温，入心、脾、肝经；有补脑健身，开胃益脾，有促进食欲之功效。荔枝木材坚实，纹理雅致，耐腐，历来为上等名材。[sale]','./uploads',1465536403,1,4),(13,'海南小贵妃芒果 约2000g',2,'sg005',200,68,48,'芒果为著名热带水果之一，芒果果实含有糖、蛋白质、粗纤维，芒果所含有的维生素A的前体胡萝卜素成分特别高，是所有水果中少见的。[sale]','./uploads',1465536524,1,21),(14,'四川安岳柠檬 4粒',2,'sg006',300,15.8,14.8,'柠檬因其味极酸，含有丰富的柠檬酸，因此被誉为“柠檬酸仓库”。它的果实汁多肉脆，有浓郁的芳香气。','./uploads',1465536610,1,0),(15,'山东栖霞苹果 6粒 ',2,'sg007',500,35.8,32.8,'苹果，是最常见的水果之一。苹果树属于蔷薇科，其果实球形，味甜，口感爽脆，且富含丰富的营养，是世界四大水果之冠。','./uploads',1465536682,1,0),(16,'海南青柠檬 4只装',2,'sg008',100,15,12.8,'皮薄味酸 泡茶必备','./uploads',1465536722,1,0),(17,'泰国山竹 750g',2,'sg009',200,48,45,'山竹可生吃、榨汁、做沙拉、制作罐头等。山竹果皮味苦涩，剥皮时需防止将果皮汁液染在肉瓣上，以免影响口感。','./uploads',1465536805,1,0),(18,'海南千禧圣女果 500g装',2,'sg0010',300,12,8.8,'圣女果，常被称为小西红柿，中文正式名叫做樱桃番茄，是一年生草本植物，属茄科番茄属，植株最高时能长到2米。具有生津止渴、健胃消食、清热解毒、凉血平肝，补血养血和增进食欲的功效。可治口渴，食欲不振。','./uploads',1465536867,1,0),(19,'北极贝特大号150g',3,'hx001',100,48,38,'来自深海的极致美贝,肉质肥嫩,口感爽滑.[sale]','./uploads',1465537357,1,0),(20,'东海野生带鱼段 500g',3,'hx002',300,28,12,'带鱼性温，味甘，具有暖胃、泽肤、补气、养血、健美以及强心补肾、舒筋活血、消炎化痰、清脑止泻、消除疲劳、提精养神之功效。[sale]','./uploads',1465537426,1,0),(21,'熟冻波士顿龙虾 300-350g',3,'hx003',298,108,98,'波士顿龙虾生活于寒冷海域，肉较嫩滑细致，产品具有高蛋白，低脂肪，维生素A、C、D及钙、钠、钾、镁、磷、铁、硫、铜等微量元素丰富，味道鲜美。','./uploads',1465537488,1,20),(22,'秋刀鱼500g',3,'hx004',400,15.8,14.8,'体内含丰富的蛋白质和脂肪等，味道鲜美，所以蒸、煮、煎、烤都可以。秋刀鱼蛋白质含量为20.7%。','./uploads',1465537555,1,0),(23,'冰冻三文鱼块300g',3,'hx005',500,68,62,'三文鱼中含有丰富的不饱和脂肪酸，能有效降低血脂和血胆固醇，防治心血管疾病。','./uploads',1465537615,1,0),(24,'丹江口野生餐条鲦鱼300g',3,'hx006',100,18.8,15.8,'鲦鱼,又名参鱼，白脑(上平江叫法)，雾子(下平江叫法)鲦鱼，侧扁，背部几成直线，腹部略凸，营养价值极高。','./uploads',1465537693,1,0),(25,'东海小黄鱼450g',3,'hx007',300,28.8,25,'东海捕捞 肉质肥美','./uploads',1465537771,1,4),(26,'鳕鱼片250g*3',3,'hx008',100,42,38.8,'鳕鱼富含的不饱和脂肪酸具有防治心血管病的功效，还含有儿童发育所必需的各种氨基酸，易被消化吸收。','./uploads',1465537830,1,0);
/*!40000 ALTER TABLE `go_product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-10 15:10:16
