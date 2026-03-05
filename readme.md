# admin table
CREATE TABLE admin (
	id int AUTO_INCREMENT PRIMARY KEY,
    admin_name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    pass varchar(255) NOT NULL,
    qna varchar(255) NOT NULL,
    create_at timestamp DEFAULT CURRENT_TIMESTAMP
);

# student table
CREATE TABLE students (
	id int AUTO_INCREMENT PRIMARY KEY,
    first_name varchar(100) NOT NULL,
    last_name varchar(100) NOT NULL,
    phone varchar(20) NOT NULL,
    dob date NOT NULL,
    gender ENUM("male", "female", "other") NOT NULL,
    address text,
    edu_qualification VARCHAR(150) NOT NULL,
    admition_date date NOT NULL,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    update_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);