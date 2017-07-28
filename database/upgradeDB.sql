CREATE UNIQUE INDEX idx_users_id ON users (id);
CREATE UNIQUE INDEX idx_users_username ON users (username);
CREATE UNIQUE INDEX idx_users_email ON users (email);

CREATE UNIQUE INDEX idx_posts_id ON posts (id);
CREATE INDEX idx_posts_idUser ON posts (idUser);