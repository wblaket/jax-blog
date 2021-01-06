# JaxBlog - micro-blogging app
Social media website built with PHP and MySQL for miocro-blogging.

## Table of Contents
* General Info
* Technologies 
* Setup
* Support


## General Information
This is a social media web application built with PHP, JS, and MySQL. It utilizes AJAX functions for users to
submit blog posts and browse all of the sites posts without every having to leave the home page.

They can also customize their profiles by adding a profile picture and bio. The site also has a password reset
feature and a blog search page that uses AJAX to instantly search the database of blogposts as the user types.

## Technologies
Project is created with:
* PHP version: 7.2.4 
* MariaDB 10.1.31
* Apache 2.4.33


## Installation
Download the repository and place the entire folder on your web server. For this project I used XAAMP's Apache
HTTP Server for hosting. You can download XAAMP here: https://www.apachefriends.org/download.html

You will also need to open "\includes\mysqli.connect.php" file and define the variables below with the database
information on lines 7-10 between the second set of quotes on each line:

```
  DEFINE ('DB_USER', '');
  DEFINE ('DB_PASSWORD', '');
  DEFINE ('DB_HOST', '');
  DEFINE ('DB_NAME', '');
```

This project will require a MYSQL database named "mylibrary" and two tables: "books" which will store
the data for the book entries, and "users" to store the data for the user accounts. You can quickly set this up
using the following database queries:

Create database:

```
CREATE DATABASE jaxblog;
```

Create two tables:
```
CREATE TABLE blogposts (book_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, blog_txt VARCHAR(140) NOT NULL, 
blog_time DATETIME NOT NULL, user_id VARCHAR(20), FOREIGN KEY (user_id) REFERENCES users(user_id));
```

```
CREATE TABLE users (user_id VARCHAR(20) PRIMARY KEY NOT NULL, user_fn VARCHAR(30) NOT NULL, user_ln VARCHAR(30) NOT NULL, 
user_password VARCHAR(20) NOT NULL,user_email VARCHAR(60) NOT NULL, imageFilePath VARCHAR(60), user_bio VARCHAR(500), 
user_dob DATE NOT NULL);
```

## Support
You can contact me at wblaketharp@gmail.com for any suggestions, feedback, or support for this application.
