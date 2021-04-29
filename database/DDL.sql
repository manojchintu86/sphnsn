DROP DATABASE sphn;
CREATE DATABASE sphn;

CREATE TABLE users (
    user_id             INT NOT NULL AUTO_INCREMENT,
    user_firstname      VARCHAR(20) NOT NULL,  
    user_lastname       VARCHAR(20) NOT NULL,
    user_password       VARCHAR(255) NOT NULL,
    user_email          VARCHAR(255) NOT NULL,
    user_gender         CHAR(1) NOT NULL,
    user_type           CHAR(7) NOT NULL,
    user_birthdate      DATE NOT NULL,
    user_hometown       VARCHAR(255),
    PRIMARY KEY (user_id)
);

CREATE TABLE posts (
    post_id             INT NOT NULL AUTO_INCREMENT,
    post_title          TEXT NOT NULL,
    post_content        TEXT NOT NULL,
    post_time           TIMESTAMP NOT NULL, 
    post_img_url        TEXT NOT NULL,
    post_org_url        TEXT NOT NULL,
    post_by             INT NOT NULL,
    PRIMARY KEY (post_id),
    FOREIGN KEY (post_by) REFERENCES users(user_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE events (
    event_id             INT NOT NULL AUTO_INCREMENT,
    event_title          TEXT NOT NULL,
    event_content        TEXT NOT NULL,
    event_time           TIMESTAMP NOT NULL, 
    event_img_url        TEXT NOT NULL,
    event_org_url        TEXT NOT NULL,
    event_by             INT NOT NULL,
    PRIMARY KEY (event_id),
    FOREIGN KEY (event_by) REFERENCES users(user_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE profile_pic (
    profile_id           INT NOT NULL,
    profile_image        TEXT NOT NULL,
    PRIMARY KEY (profile_id),
    FOREIGN KEY (profile_id) REFERENCES users(user_id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;