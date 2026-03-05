CREATE TABLE admin (
	id int AUTO_INCREMENT PRIMARY KEY,
    admin_name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    pass varchar(255) NOT NULL,
    qna varchar(255) NOT NULL,
    create_at timestamp DEFAULT CURRENT_TIMESTAMP
);