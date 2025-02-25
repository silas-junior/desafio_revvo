CREATE TABLE IF NOT EXISTS images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT references courses(id),
    content VARCHAR(255) NOT NULL,
    extension TEXT
);