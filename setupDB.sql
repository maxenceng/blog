ALTER TABLE posts DROP FOREIGN KEY fk_idUser;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS posts CASCADE;

CREATE TABLE users(
  idUser INT PRIMARY KEY NOT NULL,
  username VARCHAR(100) NOT NULL ,
  password VARCHAR(100) NOT NULL
);

CREATE TABLE posts(
  idPost INT PRIMARY KEY NOT NULL,
  title VARCHAR(100) NOT NULL,
  text VARCHAR(100) NOT NULL,
  idUser INT NOT NULL,
  CONSTRAINT fk_idUser FOREIGN KEY (idUser)
  REFERENCES users(idUser)
);

INSERT INTO users VALUES (
  1,
  'max',
  'root'
);

INSERT INTO users VALUES (
  2,
  'test',
  'root'
);

INSERT INTO posts VALUES (
  1,
  'title1',
  'text1',
  2
);