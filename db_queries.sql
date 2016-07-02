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

CREATE TABLE comments (
  id INT NOT NULL AUTO_INCREMENT,
  content VARCHAR(60),
  tweet_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (tweet_id) REFERENCES tweets()
);

CREATE TABLE messages (
  id INT NOT NULL AUTO_INCREMENT,
  content TEXT,
  user_id 
);