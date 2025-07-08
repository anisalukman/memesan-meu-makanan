CREATE DATABASE restaurant_db;

USE restaurant_db;

CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    price INT,
    type ENUM('food', 'drink'),
    image VARCHAR(255)
);

-- Insert data contoh dengan gambar
INSERT INTO menu (name, description, price, type, image) VALUES
('Spaghetti Carbonara', 'Pasta dengan saus krim dan bacon', 40000, 'food', 'spaghetti.jpg'),
('Chicken Caesar Salad', 'Salad dengan ayam, keju, dan saus Caesar', 35000, 'food', 'salad.jpg'),
('Cappuccino', 'Kopi susu dengan busa krim', 25000, 'drink', 'cappuccino.jpg');
