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
    payment_date varchar(50) NOT NULL,
    status       ENUM('pending', 'partial','paid') DEFAULT 'pending',
    received_by  int NOT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (received_by) REFERENCES admin(id),
);

1. Students who have PAID
SELECT 
    s.id,
    CONCAT(s.first_name, ' ', s.last_name) AS student_name,
    s.phone,
    f.fee_amount AS total_fee,
    fp.amount_paid,
    fp.payment_date,
    fp.status
FROM students s
INNER JOIN fee f ON s.id = f.student_id
INNER JOIN fee_payments fp ON s.id = fp.student_id
WHERE fp.status = 'paid';

2. Students who have NOT PAID (includes both pending/partial AND students with no payment record at all)
SELECT 
    s.id,
    CONCAT(s.first_name, ' ', s.last_name) AS student_name,
    s.phone,
    f.fee_amount AS total_fee,
    COALESCE(fp.amount_paid, 0.00) AS amount_paid,
    COALESCE(fp.status, 'pending') AS status
FROM students s
INNER JOIN fee f ON s.id = f.student_id
LEFT JOIN fee_payments fp ON s.id = fp.student_id
WHERE fp.status IN ('pending', 'partial') 
   OR fp.student_id IS NULL;

3. ALL Students with their payment status
SELECT 
    s.id,
    CONCAT(s.first_name, ' ', s.last_name) AS student_name,
    s.phone,
    s.admition_date,
    f.fee_amount                            AS total_fee,
    COALESCE(fp.amount_paid, 0.00)          AS amount_paid,
    (f.fee_amount - COALESCE(fp.amount_paid, 0.00)) AS balance_due,
    COALESCE(fp.status, 'pending')          AS payment_status,
    fp.payment_date,
    CONCAT(a.admin_name)                    AS received_by
FROM students s
INNER JOIN fee f          ON s.id = f.student_id
LEFT  JOIN fee_payments fp ON s.id = fp.student_id
LEFT  JOIN admin a         ON fp.received_by = a.id
ORDER BY s.id;

# filter student by their fee

SELECT
    s.id,

    CONCAT(s.first_name, ' ', s.last_name) AS student_name,

    s.phone,
    s.admition_date,

    -- 📅 Current month due date (based on today)
    DATE_ADD(
        s.admition_date,
        INTERVAL TIMESTAMPDIFF(
            MONTH,
            s.admition_date,
            CURDATE()
        ) MONTH
    ) AS current_due_date,

    -- 📅 Next month due date
    DATE_ADD(
        s.admition_date,
        INTERVAL TIMESTAMPDIFF(
            MONTH,
            s.admition_date,
            CURDATE()
        ) + 1 MONTH
    ) AS next_due_date,

    -- 💰 Fee details
    f.fee_amount AS total_fee,

    COALESCE(fp.amount_paid, 0.00) AS amount_paid,
    COALESCE(fp.status, 'pending') AS payment_status,

    -- ⏱️ Overdue days (0 if already paid)
    CASE
        WHEN COALESCE(fp.status, 'pending') = 'paid' THEN 0
        ELSE GREATEST(
            0,
            DATEDIFF(
                CURDATE(),
                DATE_ADD(
                    s.admition_date,
                    INTERVAL TIMESTAMPDIFF(
                        MONTH,
                        s.admition_date,
                        CURDATE()
                    ) MONTH
                )
            )
        )
    END AS days_overdue

FROM students s

INNER JOIN fee f
    ON s.id = f.student_id

LEFT JOIN fee_payments fp
    ON s.id = fp.student_id

ORDER BY
    s.admition_date;