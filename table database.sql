CREATE DATABASE shop_db;

USE shop_db;

CREATE TABLE `user_info` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4


CREATE TABLE `cart` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4

insert into `cart`(user_id, name, price, image, quantity)values
(1, 'Motorola RAZR V3', 2500, 'product-1.jpg', 1),
(2, 'Samsung E250', 5000, 'product-2.jpg', 2),
(3, 'Apple iPhone 6', 7500, 'product-3.jpg', 3),
(4, 'Nokia 1100', 10000, 'product-4.jpg', 4),
(5, 'Nokia 1100', 10000, 'product-5.jpg', 5),
(6, 'Nokia 1100', 10000, 'product-6.jpg', 6);


CREATE TABLE `products` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` VARCHAR(5000),
  `quantity` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4

insert into `products`(id, user_id, name, price, image, description, quantity)values
(1, 1, 'Motorola RAZR V3', 2500, 'product-1.jpg', "gözəl telefondur almaqınız məsləhətlidir !", 1),
(2, 2, 'Samsung E250', 5000, 'product-2.jpg', "gözəl telefondur almaqınız məsləhətlidir !", 2),
(3, 3, 'Apple iPhone 6', 7500, 'product-3.jpg', "gözəl telefondur almaqınız məsləhətlidir !", 3),
(4, 4, 'Nokia 13100', 10000, 'product-4.jpg', "gözəl telefondur almaqınız məsləhətlidir !", 4),
(5, 5, 'Nokia 115400', 10000, 'product-5.jpg', "gözəl telefondur almaqınız məsləhətlidir !", 5),
(6, 6, 'Nokia 11070', 10000, 'product-6.jpg', "gözəl telefondur almaqınız məsləhətlidir !", 6);
