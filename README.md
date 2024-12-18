# recipe-manager


An interactive, dynamic, and database-driven web application for managing recipes. Users can seamlessly add, view, edit, search, and delete recipes while enjoying a clean and responsive interface.

---

## Table of Contents

1. [Project Overview](#project-overview)
2. [Features](#features)
3. [Technologies Used](#technologies-used)
4. [Folder Structure](#folder-structure)
5. [Database Design](#database-design)
6. [Setup and Installation](#setup-and-installation)
7. [Sample SQL Schema](#sample-sql-schema)
8. [Credits](#credits)
9. [Notes](#notes)
10. [Contact](#Contact)
---

## Project Overview

The **Recipe Manager** simplifies recipe organization by providing a platform where users can:
- Register and securely log in.
- Add, edit, view, and delete recipes.
- Search and filter recipes based on various criteria.
- Upload images for recipes.

The application adheres to clean coding practices, ensuring modularity, clarity, and efficient folder organization.

---

## Features

### Core Functionalities
- **CRUD Operations**: Add, edit, view, and delete recipes seamlessly.
- **User Authentication**: Secure registration and login system.
- **Search and Filter**: Search recipes based on ingredients, cooking time, and type (e.g., vegetarian/non-vegetarian).
- **Image Uploads**: Upload and display recipe images.

### Dynamic Behavior
- Real-time modifications using JavaScript and DOM manipulation.
- Client-side form validation for a smooth user experience.
- **AJAX**: Used for filtering, searching, and deleting recipes asynchronously without page reloads.

### Responsive Design
- **Mobile and Tablet Friendly**: Fully responsive layout optimized for mobile and tablet devices using clean CSS.

---

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript, AJAX
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP
- **Tools**: Git, VSCode

---

## Folder Structure

```plaintext
recipe-manager/
│
├── database/
│   ├── database.php        # Database connection script
│   ├── db_credentials.php  # MySQL credentials configuration
│   └── recipemanager.sql   # SQL script for database setup
│
├── documentation/
│   └── Assignment 2 documentation.pdf
│
├── images/                 # Placeholder images for recipes
├── uploads/                # User-uploaded recipe images
│
├── pages/
│   ├── home_page.php       # Homepage UI
│   ├── login_page.php      # Login interface
│   ├── edit_recipe_page.php
│   ├── view_recipe.php
│   ├── registration_page.html
│   ├── new_recipe_page.php
│   ├── header.php          # Header component
│   └── footer.php          # Footer component
│
├── server/
│   ├── create_recipe.php   # Handles recipe creation logic
│   ├── delete_recipe.php   # Handles recipe deletion
│   ├── edit_recipe.php     # Updates recipe data
│   ├── filter_recipes.php  # Filtering logic
│   ├── login.php           # User authentication
│   ├── register_user.php   # User registration logic
│   ├── search_recipes.php  # Search handler
│   └── logout.php
│
├── style.css               # Global styles
├── script.js               # Dynamic JS functionality
├── index.html              # Main page
└── README.md               # This file
```

---

## Database Design

The database includes two tables: **`users`** and **`recipes`**, with a foreign key relationship for managing recipe ownership.

### Tables

#### 1. `users`
| Column         | Type           | Constraints                    | Description                       |
|----------------|----------------|--------------------------------|-----------------------------------|
| `UserID`       | INT(11)        | PRIMARY KEY, AUTO_INCREMENT    | Unique user identifier            |
| `Name`         | VARCHAR(100)   | NOT NULL                       | Full name of the user             |
| `Email`        | VARCHAR(100)   | NOT NULL, UNIQUE               | Unique user email                 |
| `PasswordHash` | VARCHAR(255)   | NOT NULL                       | Encrypted user password           |

#### 2. `recipes`
| Column         | Type           | Constraints                    | Description                       |
|----------------|----------------|--------------------------------|-----------------------------------|
| `RecipeID`     | INT(11)        | PRIMARY KEY, AUTO_INCREMENT    | Unique recipe identifier          |
| `Title`        | VARCHAR(100)   | NOT NULL                       | Recipe title                      |
| `TimeToCook`   | VARCHAR(50)    | NOT NULL                       | Cooking duration                  |
| `Vegetarian`   | TINYINT(1)     | NOT NULL                       | Vegetarian (1) or Non-veg (0)     |
| `Ingredients`  | TEXT           | NOT NULL                       | List of recipe ingredients        |
| `Directions`   | TEXT           | NOT NULL                       | Step-by-step cooking instructions |
| `Type`         | ENUM           | NOT NULL                       | Type: Appetizer, Main, Dessert    |
| `UserID`       | INT(11)        | FOREIGN KEY (users.UserID)     | ID of the recipe's creator        |
| `Image`        | VARCHAR(255)   | NOT NULL                       | Path to the uploaded image        |

**Relationships**:
- `UserID` in `recipes` references `UserID` in `users`.
- **ON DELETE CASCADE** ensures user deletion removes their recipes.

---

## Setup and Installation

### Prerequisites
- **XAMPP** (Apache and MySQL)
- **Git**
- **VSCode** (or any code editor)

### Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/SalehaQareen98/recipe-manager.git
   cd recipe-manager
   ```

2. **Set Up the Database**
   - Start Apache and MySQL from XAMPP.
   - Open `phpMyAdmin` and create a database named `recipemanager`.
   - Import the SQL script:
     ```sql
     database/recipemanager.sql
     ```

3. **Configure Database Credentials**
   Update `db_credentials.php` with your MySQL credentials:
   ```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $dbname = "recipemanager";
   ```

4. **Run the Project**
   - Place the project folder into the `htdocs` directory of XAMPP.
   - Open your browser and navigate to:
     ```
     http://localhost/recipe-manager/index.html
     ```

### Demo Credentials
For testing purposes, use the following credentials:
- **Email**: Rob@gmail.com
- **Password**: password_1

---

## Sample SQL Schema

```sql
-- Create the users table
CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create the recipes table
CREATE TABLE IF NOT EXISTS `recipes` (
  `RecipeID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `TimeToCook` varchar(50) NOT NULL,
  `Vegetarian` tinyint(1) NOT NULL,
  `Ingredients` text NOT NULL,
  `Directions` text NOT NULL,
  `Type` enum('Appetizer','Main Course','Dessert','Drinks') NOT NULL,
  `UserID` int(11) NOT NULL,
  `Image` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`RecipeID`),
  FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

---

## Credits

- **Project Lead**: Saleha Qareen
- **Course**: CST8285 - Web Programming

---


## Notes

- Ensure XAMPP services (Apache, MySQL) are running before accessing the project.
- Place the `uploads` and `images` folders correctly to ensure file storage works as intended.
- Clean coding practices were followed with comments for better readability.

---

## Contact

For questions or feedback, feel free to reach out:

- **Email**: salehaqareen@gmail.com
- **GitHub**: [SalehaQareen98]([https://github.com/your-username](https://github.com/SalehaQareen98))

---

