-- Create a new database named tp3
CREATE DATABASE IF NOT EXISTS tp3;

-- Select the tp3 database to use
USE tp3;

-- Create the Users table
CREATE TABLE Users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(300) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create the activity table with a foreign key to Users
CREATE TABLE activity (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  responsable VARCHAR(255) NOT NULL,
  max_places INT(11),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create the inscription table with a foreign key to activity
CREATE TABLE inscription (
  id INT(11) NOT NULL AUTO_INCREMENT,
  lname VARCHAR(255) NOT NULL,
  fname VARCHAR(255) NOT NULL,
  bdate VARCHAR(255),
  sex VARCHAR(50),
  motivation VARCHAR(255),
  activity_id INT(11),
  PRIMARY KEY (id),
  FOREIGN KEY (activity_id) REFERENCES activity(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


insert into tp3.Users values(1, 'admin','admin') ;
insert into tp3.Users values (2 , 'simon' , 'simon');

insert into tp3.activity values (1, 'Peinture', 'simon',10);
insert into tp3.activity values (2, 'Yoga en nature', 'simon',10);

insert into tp3.inscription values (1, 'Lavoie', 'Simon', '1999-01-01', 'M', 'Je veux apprendre à peindre', 1);

