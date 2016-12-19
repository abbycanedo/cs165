CREATE DATABASE canedo;

\c canedo

DROP TABLE Users;
DROP TABLE Password_resets;
DROP TABLE Profiles;
DROP TABLE Products;
DROP TABLE Carts;
DROP TABLE Transactions;

CREATE TABLE Users (
  id SERIAL NOT NULL,
  firstname VARCHAR NOT NULL,
  lastname VARCHAR NOT NULL,
  email VARCHAR NOT NULL,
  password VARCHAR NOT NULL,
  isadmin BOOLEAN NOT NULL,
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Password_resets (
  email VARCHAR NOT NULL,
  token VARCHAR NOT NULL,
  created_at TIMESTAMP NOT NULL,
  PRIMARY KEY (token)
);

CREATE TABLE Profiles (
  id SERIAL NOT NULL,
  users_id INT NOT NULL,
  bday DATE NOT NULL,
  contact VARCHAR NOT NULL,
  address VARCHAR NOT NULL,
  transactions INT NOT NULL,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Products (
  id SERIAL NOT NULL,
  name VARCHAR NOT NULL,
  brand VARCHAR NOT NULL,
  code VARCHAR NOT NULL,
  status BOOLEAN NOT NULL,
  quantity INT NOT NULL,
  price REAL NOT NULL,
  imageurl VARCHAR NOT NULL,
  description TEXT NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Carts (
  id SERIAL NOT NULL,
  profile_id INT NOT NULL,
  transaction_no INT NOT NULL,
  product_id INT NOT NULL,
  active BOOLEAN NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Transactions (
  id SERIAL NOT NULL,
  transaction_no INT NOT NULL,
  profile_id INT NOT NULL,
  total REAL NOT NULL,
  creator_id INT NOT NULL,
  created_at TIMESTAMP NOT NULL,
  PRIMARY KEY (id)
);
