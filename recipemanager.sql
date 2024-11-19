-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 06:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipemanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `RecipeID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `TimeToCook` varchar(50) NOT NULL,
  `Vegetarian` tinyint(1) NOT NULL,
  `Ingredients` text NOT NULL,
  `Directions` text NOT NULL,
  `Type` enum('Appetizer','Main Course','Dessert','Drinks') NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`RecipeID`, `Title`, `TimeToCook`, `Vegetarian`, `Ingredients`, `Directions`, `Type`, `UserID`) VALUES
(1, 'Bruschetta', '15 minutes', 1, 'Bread, Tomatoes, Basil, Olive Oil', '1. Slice the bread into pieces and toast them lightly in the oven or on a grill.\n2. Dice the tomatoes and mix them with chopped basil, olive oil, salt, and pepper.\n3. Spoon the tomato mixture onto the toasted bread slices.\n4. Optionally, drizzle a bit more olive oil on top before serving.', 'Appetizer', 1),
(2, 'Chicken Wings', '30 minutes', 0, 'Chicken Wings, BBQ Sauce, Spices', '1. Preheat the oven to 375°F (190°C) or prepare a grill.\n2. Marinate the chicken wings in BBQ sauce and your favorite spices for 10-15 minutes.\n3. Place the wings on a baking sheet or grill and cook for about 25 minutes, turning halfway through.\n4. Brush additional BBQ sauce on the wings and bake or grill for an extra 5 minutes.\n5. Serve hot with a side of ranch or blue cheese dip.', 'Appetizer', 2),
(3, 'Vegetarian Lasagna', '1 hour', 1, 'Lasagna Sheets, Cheese, Vegetables, Tomato Sauce', '1. Preheat the oven to 375°F (190°C).\n2. Sauté the vegetables in olive oil until tender.\n3. In a baking dish, layer lasagna sheets, tomato sauce, sautéed vegetables, and cheese. Repeat the layers until the dish is full, ending with a layer of cheese.\n4. Cover with foil and bake for 40 minutes.\n5. Remove the foil and bake for another 10 minutes to brown the cheese.\n6. Let cool slightly before serving.', 'Main Course', 1),
(4, 'Grilled Steak', '45 minutes', 0, 'Steak, Salt, Pepper, Garlic', '1. Let the steak rest at room temperature for 20-30 minutes.\n2. Season the steak generously with salt, pepper, and minced garlic.\n3. Heat a grill or skillet over high heat.\n4. Cook the steak for 3-4 minutes per side for medium-rare, or adjust the time based on your desired doneness.\n5. Remove from the grill and let the steak rest for 5-10 minutes before slicing.\n6. Serve with your choice of sides, such as mashed potatoes or roasted vegetables.', 'Main Course', 2),
(5, 'Chocolate Cake', '1.5 hours', 1, 'Flour, Sugar, Cocoa Powder, Eggs', 'Mix ingredients, bake, and frost with chocolate.', 'Dessert', 1),
(6, 'Panna Cotta', '2 hours', 1, 'Cream, Sugar, Gelatin, Vanilla', 'Heat cream, mix gelatin, chill, and serve.', 'Dessert', 2),
(7, 'Mojito', '10 minutes', 1, 'Mint Leaves, Lime, Sugar, Soda', 'Muddle mint and lime, mix with soda.', 'Drinks', 1),
(8, 'Mango Smoothie', '5 minutes', 1, 'Mango, Yogurt, Honey', 'Blend all ingredients and serve chilled.', 'Drinks', 2),
(9, 'Bruschetta', '15 minutes', 1, 'Bread, Tomatoes, Basil, Olive Oil', '1. Slice the bread into pieces and toast them lightly in the oven or on a grill.\n2. Dice the tomatoes and mix them with chopped basil, olive oil, salt, and pepper.\n3. Spoon the tomato mixture onto the toasted bread slices.\n4. Optionally, drizzle a bit more olive oil on top before serving.', 'Appetizer', 1),
(10, 'Chicken Wings', '30 minutes', 0, 'Chicken Wings, BBQ Sauce, Spices', '1. Preheat the oven to 375°F (190°C) or prepare a grill.\n2. Marinate the chicken wings in BBQ sauce and your favorite spices for 10-15 minutes.\n3. Place the wings on a baking sheet or grill and cook for about 25 minutes, turning halfway through.\n4. Brush additional BBQ sauce on the wings and bake or grill for an extra 5 minutes.\n5. Serve hot with a side of ranch or blue cheese dip.', 'Appetizer', 2),
(11, 'Vegetarian Lasagna', '1 hour', 1, 'Lasagna Sheets, Cheese, Vegetables, Tomato Sauce', '1. Preheat the oven to 375°F (190°C).\n2. Sauté the vegetables in olive oil until tender.\n3. In a baking dish, layer lasagna sheets, tomato sauce, sautéed vegetables, and cheese. Repeat the layers until the dish is full, ending with a layer of cheese.\n4. Cover with foil and bake for 40 minutes.\n5. Remove the foil and bake for another 10 minutes to brown the cheese.\n6. Let cool slightly before serving.', 'Main Course', 1),
(12, 'Grilled Steak', '45 minutes', 0, 'Steak, Salt, Pepper, Garlic', '1. Let the steak rest at room temperature for 20-30 minutes.\n2. Season the steak generously with salt, pepper, and minced garlic.\n3. Heat a grill or skillet over high heat.\n4. Cook the steak for 3-4 minutes per side for medium-rare, or adjust the time based on your desired doneness.\n5. Remove from the grill and let the steak rest for 5-10 minutes before slicing.\n6. Serve with your choice of sides, such as mashed potatoes or roasted vegetables.', 'Main Course', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Email`, `PasswordHash`) VALUES
(1, 'Rob@gmail.com', 'password_1'),
(2, 'Steve@gmail.com', 'password_2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`RecipeID`),
  ADD KEY `CreatedBy` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `RecipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
