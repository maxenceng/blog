ALTER TABLE posts DROP FOREIGN KEY fk_idUser;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS posts CASCADE;

CREATE TABLE users(
  id INT PRIMARY KEY NOT NULL,
  username VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL
);

CREATE TABLE posts(
  id INT PRIMARY KEY NOT NULL,
  title VARCHAR(100) NOT NULL,
  slug VARCHAR(100) NOT NULL,
  text VARCHAR(100) NOT NULL,
  public BOOLEAN NOT NULL,
  idUser INT NOT NULL,
  CONSTRAINT fk_idUser FOREIGN KEY (id)
  REFERENCES users(id)
);

INSERT INTO users VALUES (
  1,
  'max',
  'max@max.fr',
  'root'
);

INSERT INTO users VALUES (
  2,
  'test',
  'test@test.fr',
  'root'
);

INSERT INTO users VALUES (
  3,
  'testas',
  'testas@testas.fr'
  'root'
);

INSERT INTO posts VALUES (
  1,
  'Title 1',
  'title-1',
  'text1',
  true,
  2
);

INSERT INTO posts VALUES (
  2,
  'Title 2',
  'title-2',
  'text2',
  false,
  3
);

INSERT INTO posts VALUES (
  3,
  'Title 3',
  'title-3',
  'text3',
  true,
  3
);