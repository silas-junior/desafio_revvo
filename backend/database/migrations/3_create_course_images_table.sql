CREATE TABLE IF NOT EXISTS course_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT references courses(id),
    image_id INT references courses(id)
);