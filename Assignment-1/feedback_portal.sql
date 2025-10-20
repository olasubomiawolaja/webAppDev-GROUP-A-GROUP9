CREATE DATABASE feedback_portal;


CREATE TABLE feedbacks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100),
  last_name VARCHAR(100),
  email VARCHAR(100),
  rating INT,
  comments TEXT
);