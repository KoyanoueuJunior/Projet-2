<<<<<<< HEAD
-- Création de la base de données
CREATE DATABASE buzz_app;
USE buzz_app;

-- Création de la table buzz_posts
CREATE TABLE  buzz_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(250) NOT NULL,
    source_link VARCHAR(500) NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
=======
-- Création de la base de données
CREATE DATABASE buzz_app;
USE buzz_app;

-- Création de la table buzz_posts
CREATE TABLE  buzz_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(250) NOT NULL,
    source_link VARCHAR(500) NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
>>>>>>> bcb1587184b9d94fbd91bf1c34ae138503ea8b2f
