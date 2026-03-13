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

# student fee
CREATE TABLE fee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    fee_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);

# student fee recored
CREATE TABLE IF NOT EXISTS fee_payments (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    student_id   INT           NOT NULL,
    amount_paid  DECIMAL(10,2) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fee_month    VARCHAR(30)    NOT NULL,   
    fee_year    VARCHAR(30)    NOT NULL,   
    status       ENUM('pending', 'partial','paid') DEFAULT 'pending',
    received_by  int NOT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (received_by) REFERENCES admin(id),
    UNIQUE KEY unique_fee (student_id, fee_month) 
);