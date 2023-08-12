CREATE TABLE userd (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    email VARCHAR(255)
);


CREATE TABLE friendlist (
    ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    Age INT
);

INSERT INTO friendlist (Name, Age) VALUES ('John Doe', 25);
INSERT INTO friendlist (Name, Age) VALUES ('Jane Smith', 30);
