CREATE DATABASE twitter;

CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL UNIQUE,
  hashed_password VARCHAR(255),
  description TEXT,
  is_active INT,
  PRIMARY KEY(id)
);

CREATE TABLE tweets (
  id INT NOT NULL AUTO_INCREMENT,
  content VARCHAR(140),
  user_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

ALTER TABLE tweets ADD creation_date DATETIME;

CREATE TABLE comments (
  id INT NOT NULL AUTO_INCREMENT,
  content VARCHAR(60),
  user_id INT NOT NULL,
  tweet_id INT NOT NULL,
  creation_date DATETIME,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);

CREATE TABLE messages (
  id INT NOT NULL AUTO_INCREMENT,
  content TEXT,
  sender_id INT NOT NULL,
  addresser_id INT NOT NULL,
  if_read INT,
  PRIMARY KEY (id),
  FOREIGN KEY (sender_id) REFERENCES users(id),
  FOREIGN KEY (addresser_id) REFERENCES users(id)
);
ALTER TABLE messages ADD creation_date DATETIME;
INSERT INTO `users` (`email`, `hashed_password`, `description`, `is_active`) VALUES ($email, $password, $description, $isActive);

SELECT * FROM users WHERE email='ala@test.pl';