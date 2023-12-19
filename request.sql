CREATE DATABASE IF NOT EXISTS your_database_name;
USE your_database_name;

CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(255) NOT NULL,
    userReview TEXT NOT NULL
);


ALTER TABLE reviews
ADD COLUMN moderation_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending';




