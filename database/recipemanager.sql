-- Create the database
CREATE DATABASE IF NOT EXISTS recipemanager;

USE recipemanager;

-- Create the users table
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`) -- Unique constraint on Email
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;

-- Insert data into the users table
INSERT INTO `users` (`UserID`, `Name`, `Email`, `PasswordHash`) VALUES
(1, 'Rob', 'Rob@gmail.com', '$2b$12$3brPOpDYAg0tUB.40/lCt.mkq28wuHvE31Dzi45HJCmE8JLYC5Wfa');

-- Create the recipes table
CREATE TABLE IF NOT EXISTS `recipes` (
  `RecipeID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `TimeToCook` varchar(50) NOT NULL,
  `Vegetarian` tinyint(1) NOT NULL, -- tinyint acts as boolean
  `Ingredients` text NOT NULL,
  `Directions` text NOT NULL,
  `Type` enum('Appetizer','Main Course','Dessert','Drinks') NOT NULL, -- Predefined list
  `UserID` int(11) NOT NULL,
  `Image` VARCHAR(255) NOT NULL, -- Store the uploaded image in binary format
  PRIMARY KEY (`RecipeID`),
  FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE -- Foreign key constraint
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=9;


-- Insert data into the recipes table
INSERT INTO `recipes` (`RecipeID`, `Title`, `TimeToCook`, `Vegetarian`, `Ingredients`, `Directions`, `Type`, `UserID`, `Image`) 
VALUES
-- Existing Recipes
(1, 'Bruschetta', '15 minutes', 1, 
'4 slices of Bread
2 medium Tomatoes diced
5-6 Basil leaves chopped
2 tbsp Olive Oil
Salt and Pepper to taste', 
'1. Slice the bread into pieces and toast them lightly in the oven or on a grill. 
2. Dice the tomatoes and mix them with chopped basil, olive oil, salt, and pepper. 
3. Spoon the tomato mixture onto the toasted bread slices. 
4. Optionally, drizzle a bit more olive oil on top before serving.', 
'Appetizer', 1, '../uploads/bruschetta.jpg'),

(2, 'Chicken Wings', '30 minutes', 0, 
'12 Chicken Wings
1 cup BBQ Sauce
1 tbsp Paprika
1 tsp Garlic Powder
Salt and Pepper to taste', 
'1. Preheat the oven to 375°F (190°C) or prepare a grill. 
2. Marinate the chicken wings in BBQ sauce and your favorite spices for 10-15 minutes. 
3. Place the wings on a baking sheet or grill and cook for about 25 minutes, turning halfway through. 
4. Brush additional BBQ sauce on the wings and bake or grill for an extra 5 minutes. 
5. Serve hot with a side of ranch or blue cheese dip.', 
'Appetizer', 1, '../uploads/chicken-wings.jpg'),

(3, 'Vegetarian Lasagna', '1 hour', 1, 
'6 Lasagna Sheets
2 cups Cheese grated
3 cups Vegetables diced (zucchini, bell peppers, mushrooms)
2 cups Tomato Sauce
2 tbsp Olive Oil', 
'1. Preheat the oven to 375°F (190°C). 
2. Sauté the vegetables in olive oil until tender. 
3. In a baking dish, layer lasagna sheets, tomato sauce, sautéed vegetables, and cheese. Repeat the layers until the dish is full, ending with a layer of cheese. 
4. Cover with foil and bake for 40 minutes. 
5. Remove the foil and bake for another 10 minutes to brown the cheese. 
6. Let cool slightly before serving.', 
'Main Course', 1, '../uploads/vegi-lasagna.jpg'),

(4, 'Grilled Steak', '45 minutes', 0, 
'1 Steak (250g)
1 tsp Salt
1 tsp Pepper
2 Garlic cloves minced', 
'1. Let the steak rest at room temperature for 20-30 minutes. 
2. Season the steak generously with salt, pepper, and minced garlic. 
3. Heat a grill or skillet over high heat. 
4. Cook the steak for 3-4 minutes per side for medium-rare, or adjust the time based on your desired doneness. 
5. Remove from the grill and let the steak rest for 5-10 minutes before slicing. 
6. Serve with your choice of sides, such as mashed potatoes or roasted vegetables.', 
'Main Course', 1, '../uploads/grilled-steak.jpg'),

(5, 'Chocolate Cake', '1.5 hours', 1, 
'2 cups Flour
1.5 cups Sugar
0.5 cup Cocoa Powder
3 Eggs
1 cup Milk
0.5 cup Butter', 
'1. Preheat the oven to 350°F (175°C). 
2. Mix the dry ingredients: flour, sugar, and cocoa powder. 
3. Beat the eggs and add them to the dry mixture along with milk and melted butter. 
4. Pour the batter into a greased cake pan. 
5. Bake for 35-40 minutes or until a toothpick inserted into the center comes out clean. 
6. Let the cake cool before frosting with chocolate frosting.', 
'Dessert', 1, '../uploads/chocolate-cake.jpg'),

-- Additional Recipes
(6, 'Greek Salad', '10 minutes', 1, 
'2 cups Romaine Lettuce chopped
1 cup Cherry Tomatoes halved
1/2 cup Feta Cheese crumbled
1/4 cup Black Olives sliced
2 tbsp Olive Oil
1 tbsp Lemon Juice
1 tsp Oregano', 
'1. Wash and chop the romaine lettuce. 
2. Combine lettuce, cherry tomatoes, feta cheese, and black olives in a salad bowl. 
3. Drizzle olive oil and lemon juice over the salad. 
4. Sprinkle oregano on top. 
5. Toss gently and serve immediately.', 
'Appetizer', 1,'../uploads/greek-salad.jpg'),

(7, 'Spaghetti Bolognese', '45 minutes', 0, 
'400g Spaghetti
200g Ground Beef
1 cup Tomato Sauce
1 medium Onion diced
2 cloves Garlic minced
2 tbsp Olive Oil
Salt and Pepper to taste', 
'1. Cook the spaghetti according to package instructions. 
2. Heat olive oil in a pan and sauté onions and garlic until fragrant. 
3. Add ground beef and cook until browned. 
4. Pour in the tomato sauce and simmer for 20 minutes. 
5. Season with salt and pepper to taste. 
6. Serve the sauce over cooked spaghetti and garnish with grated cheese if desired.', 
'Main Course', 1, '../uploads/Spaghetti-Bolognese.jpg'),

(8, 'Lemonade', '5 minutes', 1, 
'4 Lemons juiced
1/2 cup Sugar
4 cups Water
Ice cubes
Mint leaves for garnish', 
'1. Squeeze the juice from the lemons and pour it into a pitcher. 
2. Add sugar and stir until dissolved. 
3. Pour in water and mix well. 
4. Serve over ice and garnish with mint leaves.', 
'Drinks', 1, '../uploads/mojito.jpg');
