# recipe-manager
Online Recipe Manager
Project Overview
The Online Recipe Manager is a dynamic, database-driven web application that allows users to:

Add, display, edit, search, filter, and remove recipes seamlessly.
Register and log in as users to manage their saved recipes.
Experience dynamic, interactive behavior with JavaScript.
Enjoy a responsive, clean, and user-friendly interface for desktop and mobile devices.
The project adheres to good coding practices, ensuring modularity, clarity, and efficient folder organization for all assets.

Table of Contents
Features
Technologies Used
Folder Structure
Database Design
Setup and Installation
Credits
Features
Core Functionalities
Backend Database Functionality

Recipes can be added, displayed, updated, or deleted through the website interface.
User information and favorite recipes are stored securely in a database.
Search and Filtering

Search recipes based on ingredients, time, or type (vegetarian/non-vegetarian).
User Registration and Login

Users can register and log in to save their favorite recipes.
Client-side form validation ensures a smooth registration process using JavaScript.
Dynamic Behavior

Interact with recipes dynamically: rate, favorite, or modify content in real time using JavaScript and DOM manipulation.
Responsive Design

Mobile-friendly, responsive web design implemented using CSS for usability across devices.
Clean HTML Structure

Semantically correct and well-structured HTML ensures a strong document foundation.
Image Management

uploads/ contains images uploaded by users.
images/ holds placeholder images for recipes.
Technologies Used
Frontend: HTML5, CSS3, JavaScript (for dynamic behavior and validation)
Backend: PHP
Database: MySQL (SQL scripts for DDL included)
Server: XAMPP
Tools: Git, VSCode

Database Design
The database is designed to store user and recipe information efficiently.

Tables
users

Stores registered user data (ID, username, email, password).
recipes

Stores recipe information, including title, ingredients, category, and images.
favorites

Tracks recipes favorited by registered users.
Database Script
All DDL and SQL scripts are available in the recipemanager.sql file under the database/ directory.

Setup and Installation
To run the project locally:

Install Required Tools

Install XAMPP (for PHP and MySQL support).
Install a text editor (e.g., VSCode) for code modifications.
Clone the Repository

bash
Copy code
git clone https://github.com/yourusername/recipe-manager.git
cd recipe-manager
Set Up the Database

Start Apache and MySQL through XAMPP.
Open phpMyAdmin and create a new database: recipemanager.
Import the recipemanager.sql file located in the database/ folder.
Configure Database Credentials

Update db_credentials.php in the database/ folder with your MySQL credentials:
php
Copy code
$host = "localhost";
$user = "root";
$password = "";
$dbname = "recipemanager";
Run the Project

Place the project folder in your XAMPP htdocs directory.
Open the browser and go to http://localhost/RECIPE-MANAGER/index.html.
Credits
This project was developed as part of the Web Programming Course (CST8285).

Project Lead: [Your Name]
Team Members: (if applicable)
Notes
The project adheres to clean coding standards, including consistent indentation, meaningful variable names, and appropriate comments for clarity.
Ensure all required folders (database, server, uploads, etc.) are in the correct directory before running the project.
