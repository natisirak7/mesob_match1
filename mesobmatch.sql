CREATE DATABASE IF NOT EXISTS ethiopian_recipes;
USE ethiopian_recipes;

-- Users table (with default role 'author')
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'author') NOT NULL DEFAULT 'author'
);

-- Recipes table (add author_id)
CREATE TABLE IF NOT EXISTS recipes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) UNIQUE,
  title VARCHAR(255),
  category VARCHAR(50),
  cook_time VARCHAR(50),
  servings INT,
  image VARCHAR(255),
  description TEXT,
  author_id INT,
  FOREIGN KEY (author_id) REFERENCES users(id)
);

-- Ingredients table
CREATE TABLE IF NOT EXISTS ingredients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) UNIQUE
);

-- Recipe-Ingredients (many-to-many)
CREATE TABLE IF NOT EXISTS recipe_ingredients (
  recipe_id INT,
  ingredient_id INT,
  is_optional BOOLEAN,
  FOREIGN KEY (recipe_id) REFERENCES recipes(id),
  FOREIGN KEY (ingredient_id) REFERENCES ingredients(id)
);

-- Instructions table
CREATE TABLE IF NOT EXISTS instructions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  recipe_id INT,
  step_number INT,
  instruction TEXT,
  FOREIGN KEY (recipe_id) REFERENCES recipes(id)
);
