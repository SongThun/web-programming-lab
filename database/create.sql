
drop schema if exists lorem_ipsum;

ALTER USER 'root'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON lorem_ipsum.* TO 'root'@'localhost'; 

create schema lorem_ipsum;
use lorem_ipsum;

create table users (
	userID int PRIMARY KEY auto_increment,
	username varchar(255) UNIQUE NOT NULL,
    password text NOT NULL,
    email varchar(255) UNIQUE,
    urole enum('admin','user') default 'user' NOT NULL
);

create table categories (
	catID int PRIMARY KEY auto_increment,
    catName varchar(255)
);

create table products (
	id int PRIMARY KEY auto_increment,
    title varchar(255) NOT NULL,
    imageLink text,
    productDesc text,
    catID int,
    createdDate datetime default current_timestamp, 
    price decimal(10,2),
    salesAmount decimal(10) default 0,
    inStock decimal(10) default 0,
    discount decimal(5,2) default 0,
    FOREIGN KEY (catID) references categories(catID)
);

create table banners (
	id int PRIMARY KEY auto_increment,
    imageLink text,
    urlLink text,
    isactive enum ('active','inactive'),
    banType varchar(255),
    createdDate datetime default current_timestamp
);

create table sales (
	salesID int PRIMARY KEY auto_increment,
    productID int NOT NULL,
    userID int NOT NULL,
    amount decimal(5),
    totalPrice decimal(10,2),
    salesDate datetime default current_timestamp,
    FOREIGN KEY (userID) references users(userID)
); 

create table cart (
    userID int NOT NULL,
    productID int NOT NULL,
    amount decimal(4,0),
    PRIMARY KEY (userID, productID)
);

DELIMITER $$

CREATE PROCEDURE GetFirstImagePerCategory()
BEGIN
    SELECT c.*, 
           (SELECT p.imageLink 
            FROM products p 
            WHERE p.catID = c.catID 
            ORDER BY p.id ASC 
            LIMIT 1) AS imageLink
    FROM categories c;
END$$

DELIMITER ;
