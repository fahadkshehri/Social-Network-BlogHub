CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(128) NOT NULL,
    password BINARY(64) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE posts (
    id INT NOT NULL AUTO_INCREMENT,
    title NVARCHAR(60) NOT NULL,
    img NVARCHAR(2083),
    content LONGTEXT,
    owner_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (owner_id) REFERENCES users(id)
);

CREATE TABLE follows (
    follower INT NOT NULL,
    following INT NOT NULL,
    FOREIGN KEY (follower) REFERENCES users(id),
    FOREIGN KEY (following) REFERENCES users(id)
);