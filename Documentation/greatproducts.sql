-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2022 at 12:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greatproducts`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `AddressID` int(255) NOT NULL,
  `UserID` int(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `Zip` int(32) NOT NULL,
  `State` varchar(12) NOT NULL,
  `Country` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`AddressID`, `UserID`, `Street`, `City`, `Zip`, `State`, `Country`) VALUES
(1, 3, '1402 Barrows Down', 'Hobbiton', 11311, 'Shire', 'Middle Earth'),
(2, 2, '998 Googles Drive', 'New York City', 78202, 'New York', 'US'),
(3, 6, 'Search Engine Lane', '11 Bing Street', 1010, 'Washington', 'US'),
(4, 5, '402 Lunar Avenue', 'Quebec ', 75452, 'Quebec', 'Canada'),
(5, 5, '772 Painters Way', 'San Diego', 55555, 'California', 'US');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CatID` int(255) NOT NULL,
  `CatName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CatID`, `CatName`) VALUES
(1, 'Trading Card Games'),
(2, 'Roleplaying Games'),
(3, 'Board Games'),
(4, 'Miniature Games'),
(5, 'Game Supplies');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `OrderID` int(255) NOT NULL,
  `Status` enum('cart','ordered','shipped','delivered') DEFAULT NULL,
  `UserID` int(255) NOT NULL,
  `AddressID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`OrderID`, `Status`, `UserID`, `AddressID`) VALUES
(1, 'delivered', 2, 5),
(2, 'cart', 3, 1),
(3, 'ordered', 2, 2),
(4, 'ordered', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE `productcategory` (
  `ProductID` int(255) NOT NULL,
  `CatID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`ProductID`, `CatID`) VALUES
(1, 5),
(2, 5),
(3, 3),
(4, 3),
(5, 3),
(6, 1),
(7, 2),
(8, 2),
(9, 3),
(10, 4),
(11, 4),
(12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `productorder`
--

CREATE TABLE `productorder` (
  `ProductID` int(255) NOT NULL,
  `OrderID` int(255) NOT NULL,
  `Count` int(255) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productorder`
--

INSERT INTO `productorder` (`ProductID`, `OrderID`, `Count`) VALUES
(4, 2, 1),
(10, 1, 1),
(6, 3, 1),
(1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(255) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Cost` double NOT NULL,
  `Details` varchar(2200) NOT NULL,
  `Count` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `Cost`, `Details`, `Count`) VALUES
(1, 'Card Protectors', 9.95, 'Standard trading card size, single-page, holds up to 12 cards a page. 6 Protectors in a pack.', 11),
(2, 'Card Sleeves', 4.95, 'Pack of 100 generic trading card sleeves.', 200),
(3, 'Settles of Catan ', 49.95, 'Whether you\'re on the train, in the ski lodge, or picnicking in the woods, this compact Traveler Edition lets you take Catan everywhere! The space-saving box unfolds to reveal the variable board, with roads, settlements, and cities held firmly in place in their locking drawers, cards securely stashed in holder trays, and dice stored in a hex-shaped shaker.\r\n\r\nContents:\r\n1 Folding Box\r\n6 Double-sided Game Board Parts\r\n1 Dice Shaker\r\n97 Game Pieces\r\n2 Card Holders\r\n134 Cards\r\n\r\nAges: 10+\r\nPlayers: 2-4\r\nGame Length: 90 minutes', 13),
(4, 'London 2nd Ed', 39.99, 'As one of the Capital\'s architects you must raise a brand new city from the ashes of the old. Choices must be made: iconic monuments bring great prestige, but at what cost? Aggressive expansion may increase poverty, but how much do you care? Your rivals are busy too, so plan wisely to ensure your buildings dominate the skyline.\r\n\r\nMartin Wallace\'s classic tableau-builder has been entirely updated for this edition, with revised rules and new artwork. Ovdersized borough cards showcase famous locations, while they city cards follow the development of London right up to the twentieth century. Grow your city through the years, as you vie to become an icon of London.\r\n\r\nContents:\r\n101 City Cards\r\n20 Oversizded Borough Cards\r\n32 Wooden Tokens\r\n60 Cardboard Tokens\r\nDevelopment Board\r\n\r\n\r\nAges: 14+\r\nPlayers: 2-4\r\nGame Length: 60-90 minutes', 43),
(5, 'Mage Knight', 67.99, 'The Mage Knight Board Game throws you and up to three other Mage Knights into the sprawling and ever-changing world of the Atlantean Empire, a land that is but a distant memory since your transformation into a mysterious Mage Knight. Build your armies, defeat bands of marauding enemies, and eventually conquer cities in the name of the mysterious Void Council.\r\n\r\n\r\nAs a Mage Knight you must control your reputation and walk the line - or embrace the role of benevolent leader or brutal dictator. Accumulate Fame and experience to acquire powerful Spells and abilities, then use your power to influence units to join your ranks. Featuring a variety of campaign options allowing you to play both competitively or cooperatively.\r\n\r\nContents:\r\n240 Cards\r\n8 Intricately Painted Miniatures\r\n196 Tokens\r\n20 Map Tiles\r\n54 Mana Crystals\r\n7 Mana Dice\r\n2 Game Mats\r\n2 Rulebooks\r\n\r\n\r\nAges: 14+\r\nPlayers: 1-4\r\nGame Length: 150 minutes\r\n', 7),
(6, 'MTGA: Baldurs Gate Bundle', 50, 'Commander Legends meets D&D in this exciting crossover set! Power up your Commander decks with iconic legendary characters from Dungeons & Dragons, brand-new Background cards, and tons of other multiplayer goodies.\r\n\r\nContents:\r\n8 Commander Legends: Battle for Baldur\'s Gate Set Booster Packs\r\n1 Foil Alt-art Promo Card (Wand of Wonder)\r\n40 Basic Land Cards (20 Foil + 20 Nonfoil)\r\n1 Oversized d20\r\n1 Card Storage Box\r\n2 Reference Cards\r\n', 22),
(7, 'D&D 5E RPG Starter', 19.95, 'Explore subterranean labyrinths!\r\nPlunder hoards of treasure!\r\n\r\nBattle legendary monsters!\r\n\r\nThe Dungeons and Dragons 5th Edition Starter Set is your gateway to the action-packed stories of the imagination. This box contains the essential rules of the game plus everything you need to pay heroic characters on perilous adventures in worlds of fantasy.\r\n\r\nContents:\r\n64-page Adventure Book\r\n32-page Rulebook\r\n5 Pregenerated Characters\r\n  ‣ Each with character sheet and supporting reference material\r\n6 Game Dice.', 99),
(8, 'Legend of the Five Rings Core Ru', 43.99, 'Honor is Stronger Than Steel\r\n\r\nIn the land of Rokugan, the Emerald Empire has lasted for a thousand years. Under the guidance of the noble Hantei emperors, the Great Clans of samurai have protected the lands from threats within and without since the time the Kami came down from the heavens and established Rokugan as the most favored of kingdoms.\r\n\r\nBut after centuries of prosperity, cracks appear in the Empire\'s foundations. The spirits of the land have become restless and wild. Armies of evil horrors march from the Shadowlands. Members of the Great Clans have begun to wonder if the time of hte Hantei is over, and whether the heavens would favor new rulers. . .\r\n\r\nAs a samurai of the Emerald Empire, your duty lies in service to your lord, your Clan, and your Emperor. Will you stay true to your duty, no matter what sacrifices it demands of you? Or will you hold true to your own code of honor, even to the point of death?\r\n\r\nIn this rulebook you will find everything you need to forge your own legend.\r\n\r\n ', 5),
(9, 'Fallout Wasteland Warfare', 65.99, 'In the ashes of civilization, factions of humanity struggle against horrific creatures, irradiated wastes, and human nature itself. Grab your weapon, assemble your forces, and fight for control of the wasteland and the ultimate prize - survival.\r\n\r\nFallout: Wasteland Warfare is a narrative skirmish wargame set in the post-apocalyptic future of the Fallout video game series. Build your own crew of iconic characters from the Fallout series, and play in apocalyptic games of 3-30 high-quality 32mm scale miniatures.\r\n\r\nThis two-player starter set includes everything you need to get started in the world of Fallout and includes rules for two-player games (versus or co-op), 1-player solo play, narrative settlement modes and competitive battle mode. This is backed up by extensive online content available free from the manufacturer, allowing you to take the game even further and conquer the wasteland for your faction!', 122),
(10, 'Star Wars Legion Core Set', 99.99, 'It Is a Period of Civil War...\r\n\r\nThe Galactic Empire tightens its grip on the galaxy, wielding overwhleming military might with unchecked ruthlessness. Standing bravely in their way are the heroic soldiers of the Rebel Alliance, striking from hidden bases in a desperate gambit to cripple the Emperor\'s war machine. It is an epic struggle in which every battle could mean the difference between victory and defeat...\r\n\r\nExperience the legendary ground battles of Star Wars! Command your forces as they clash in epic encountes with the Star Wars: Legion miniatures game. Each miniature is finely detailed to bring to life the heroes, villains, soldiers, and vehicles of the Star Wars universe. This core set contains everything that two players need to stage a battle between the forces of the Galactic Empire and the soldiers of the Rebel Alliance. This core set is a starting point for collecting Star Wars: Legion miniatures and for building and customizing your own Imperial or Rebel army!', 43),
(11, 'Star Wars Legion Essentials', 9.95, 'Help your players dive into the battles of Star Wars: Legion with this helpful kit! The Essentials Kit gathers together all the necessary cards, dice, tokens, and other tools players need to play the game in one convenient package, letting them get started quickly and easily. Additionally, this kit also collects the 12 battle cards for the 500-point Skirmish mode in a product for the first time, inviting new and veteran players alike to explore this alternate way to play.\r\n\r\nContents:\r\n3 Plastic Movement Tools\r\n15 Plastic Dice\r\n1 Plastic Range Ruler\r\n24 Battle Cards\r\n8 Command Cards\r\n50 Assorted Tokens\r\n1 Insert Sheet', 400),
(12, 'Deck Box Apple Red', 2.95, '• Holds up to 110 Standard sized sleeved cards\r\n• Self-locking lid design with thumb notch for easy access to cards\r\n• Includes 1 card divider\r\n• Made with archival-safe, non-PVC rigid polypropylene material', 900);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(255) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Userpass` varchar(32) DEFAULT NULL,
  `Email` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Admin`, `Username`, `Userpass`, `Email`) VALUES
(0, 0, 'sysUser', NULL, NULL),
(1, 1, 'ngestiehr', 'pass', 'gestiehrn1@nku.edu'),
(2, 1, 'Kenneth Welch', 'hi', 'Kwelch@nku.edu'),
(3, 0, 'Qu Eerie', 'pun', 'dummysearch@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`AddressID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CatID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `location` (`AddressID`),
  ADD KEY `purchase` (`UserID`);

--
-- Indexes for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD KEY `category2product` (`CatID`),
  ADD KEY `product2category` (`ProductID`);

--
-- Indexes for table `productorder`
--
ALTER TABLE `productorder`
  ADD KEY `userbuy` (`OrderID`),
  ADD KEY `order2product` (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `AddressID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CatID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `OrderID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `location` FOREIGN KEY (`AddressID`) REFERENCES `address` (`AddressID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `purchase` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD CONSTRAINT `category2product` FOREIGN KEY (`CatID`) REFERENCES `category` (`CatID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product2category` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productorder`
--
ALTER TABLE `productorder`
  ADD CONSTRAINT `order2product` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userbuy` FOREIGN KEY (`OrderID`) REFERENCES `invoice` (`OrderID`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
