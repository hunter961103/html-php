CREATE DATABASE IF NOT EXISTS online_bookstore;
CREATE TABLE books(
	book_id VARCHAR(10) NOT NULL,
	title VARCHAR(100) NOT NULL,
	author VARCHAR(100) NOT NULL,
	description TEXT,
	price DECIMAL(9, 2) NOT NULL,
	publisher VARCHAR(100) NOT NULL,
	image TEXT,
	PRIMARY KEY (book_id));
INSERT INTO books VALUES ('VT892', 'Statistic', 'Jit & Chandran', 'Statistic for business', '50.00', 'Tan', 'book_image/9062999.jpg');
INSERT INTO books VALUES ('KH551', 'Architecture', 'Oxford', 'Dictionary for architecture', '65.00', 'Tan', 'book_image/ARC9.jpg');
INSERT INTO books VALUES ('PE014', 'C# Programming', 'Public', 'Programming for beginners', '82.00', 'Ng', 'book_image/1861004877.jpg');
INSERT INTO books VALUES ('AX283', 'Cost and Management Accounting', 'Edward', 'Textbook for cost and management accounting', '59.50', 'Wong', 'book_image/busi7.jpg');
INSERT INTO books VALUES ('NC116', 'Physics', 'Richard', 'Reviews of physics', '44.00', 'Wong', 'book_image/p2.jpg');

CREATE TABLE shopping_cart(
	shopping_cart_id INT(10) NOT NULL AUTO_INCREMENT,
	book_id VARCHAR(10) NOT NULL,
	price DECIMAL(9, 2) NOT NULL,
	quantity INT(10) NOT NULL,
	username VARCHAR(100) NOT NULL,
	PRIMARY KEY (shopping_cart_id));

CREATE TABLE users(
	username VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	address TEXT NOT NULL,
	phone VARCHAR(11) NOT NULL,
	user_type VARCHAR(6) NOT NULL,
	PRIMARY KEY (username));
INSERT INTO users VALUES ('Admin', '12345', 'admin@gmail.com', '48, Douglas Street 2, Secret Garden', '0164435282', 'admin');
	