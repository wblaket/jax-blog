# JaxBlog

JaxBlog is social media application using MySQL and PHP. It contains a registration/login page,
a profile page with customized details for the user, and a home page that acts as a feed for all blog posts.


## Installation




##  Database Requirements

This project requires one database named 'jaxblog' two database tables named 'blogposts' and 'users'.

To quickly create the database and the tables. Use the following code:

### Create database
CREATE DATABASE jaxblog;

### Create tables
CREATE TABLE blogposts (book_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, blog_txt VARCHAR(140) NOT NULL, blog_time DATETIME NOT NULL,
user_id VARCHAR(20), FOREIGN KEY (user_id) REFERENCES users(user_id));

CREATE TABLE users (user_id VARCHAR(20) PRIMARY KEY NOT NULL, user_fn VARCHAR(30) NOT NULL, user_ln VARCHAR(30) NOT NULL, user_password VARCHAR(20) NOT NULL,
user_email VARCHAR(60) NOT NULL, imageFilePath VARCHAR(60), user_bio VARCHAR(500), user_dob DATE NOT NULL);

## Support

You can contact me at wblaketharp@gmail.com for any suggestions, feedback, or support for this application.

# Authors and acknowledgement

This program was created and written by William Blake Tharp. Last updated on 11/22/20
Thank you Larry Ullman's PHP and MySQL for Dynamic Web Sites Fourth Edition.
Thank you to W3Schools for a great tutorial on how to use Ajax.

# Future Changes
Some additional improvements and changes I plan on making:
I. Adding an initial profile picture option as part of user registration, but I have yet
to find a way to use ajax for file uploads.
II. Additionally making the update profile picture section of the edit profile page work with ajax,
so user does not have the leave the page once the file has been uploaded.
III. Modifying the update password feature to use ajax to update the password.
