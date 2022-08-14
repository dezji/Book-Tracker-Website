DROP DATABASE IF EXISTS BookInventory;
CREATE DATABASE IF NOT EXISTS BookInventory;
USE BookInventory;

CREATE TABLE publishers
(Publisher_ID int(3) AUTO_INCREMENT,
Name varchar(25) NOT NULL,
Phone bigint(10) NOT NULL,
State tinytext NOT NULL,
CONSTRAINT publishers_publisherID_pk PRIMARY KEY(Publisher_ID));
ALTER TABLE publishers AUTO_INCREMENT = 300;

CREATE TABLE authors
(Author_ID int(3) AUTO_INCREMENT,
Publisher_ID int(3),
First_Name varchar(25) NOT NULL,
Last_Name varchar(25) NOT NULL,
Full_Name varchar(50) NOT NULL,
CONSTRAINT authors_authorID_pk PRIMARY KEY(Author_ID),
CONSTRAINT authors_publisherID_fk FOREIGN KEY(Publisher_ID) REFERENCES publishers(Publisher_ID) ON DELETE CASCADE ON UPDATE CASCADE);
ALTER TABLE authors AUTO_INCREMENT = 100;

CREATE TABLE books
(ISBN bigint(13),
Order_ID bigint(11),
Title varchar(35) NOT NULL,
Author_ID int(3) NOT NULL,
On_Order tinyint(1) NOT NULL,
CONSTRAINT books_isbn_pk PRIMARY KEY(ISBN),
CONSTRAINT books_authorID_fk FOREIGN KEY (Author_ID) REFERENCES authors(Author_ID) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE orders
(Order_ID bigint(11) AUTO_INCREMENT,
ISBN bigint(13) NOT NULL,
Order_Date date NOT NULL,
Cost decimal(5,2) NOT NULL,
CONSTRAINT orders_orderID_pk PRIMARY KEY(Order_ID),
CONSTRAINT orders_isbn_fk FOREIGN KEY (ISBN) REFERENCES books(ISBN) ON DELETE CASCADE ON UPDATE CASCADE);
ALTER TABLE orders AUTO_INCREMENT = 20220000001;


-- phone mask provided by https://stackoverflow.com/users/365338/zak (Zak)
-- at https://stackoverflow.com/questions/10112718/mysql-output-masking-i-e-phone-number-ssn-etc-display-formatting

DELIMITER //

CREATE FUNCTION mask (unformatted_value BIGINT, format_string CHAR(32))
RETURNS CHAR(32) DETERMINISTIC

BEGIN
# Declare variables
DECLARE input_len TINYINT;
DECLARE output_len TINYINT;
DECLARE temp_char CHAR;

# Initialize variables
SET input_len = LENGTH(unformatted_value);
SET output_len = LENGTH(format_string);

# Construct formated string
WHILE ( output_len > 0 ) DO

SET temp_char = SUBSTR(format_string, output_len, 1);
IF ( temp_char = '#' ) THEN
IF ( input_len > 0 ) THEN
SET format_string = INSERT(format_string, output_len, 1, SUBSTR(unformatted_value, input_len, 1));
SET input_len = input_len - 1;
ELSE
SET format_string = INSERT(format_string, output_len, 1, '0');
END IF;
END IF;

SET output_len = output_len - 1;
END WHILE;

RETURN format_string;
END //


-- if these privileges produce an error 
-- remove them as it seems to fix the error

GRANT ALL PRIVILEGES ON *.* TO `root`@`localhost` WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `BookInventory`.* TO `root`@`localhost` WITH GRANT OPTION;

GRANT PROXY ON ''@'%' TO 'root'@'localhost' WITH GRANT OPTION;

COMMIT;