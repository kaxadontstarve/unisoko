# project unisoko-exam

## Prerequisites:

The project is written in php 8.1, runs on the apache_2.4-PHP_8.1 server.

## First step:

Clone this (or you command) GIT repository to your computer.

## Server deployment

For quick deployment of the server, it is recommended to use ready-made solutions, as an example of OpenServer Panel - https://biblprog.org.ua/ua/open_server/

### Configuration of server modules

Installation panel, Web servers: Apache 2.4(for PHP 8.0-8.1) + Nginx 1.23, PHP: PHP 8.1, DBMS: MySQL 8.0-Win10, NoSQL systems: -, DNS: -, Web applications: phpMyAdmin 5.2.0, Programs for web development: - Mandatory Microsoft components.

### Database deployment

Go to phpMyAdmin, for authorization, enter the login: "root", leave the password blank. Create the "unisoko" database, go to it, select the "Import" item, select the "unisoko.sql" file.

## How to run?

Select the appropriate modules for OSPanel. Download the project to the "domains" folder. Start OSPanel. Go to the link "unisoko"

# Requirements
## Functional requirements:
1. The user has the opportunity to register on the website.
2. When registering a user, all email and password input fields must be validated.
3. The user can register only with a unique email address.
4. The user can log in to the account if he was previously registered.
5. During user authorization, all fields for entering the electronic address and password must be validated.
6. The password must be at least 8 characters long and contain no special characters.
7. Email address validation is standard.
8. The user must be able to add the product to the cart.
9. The product is added to the cart under the following conditions: the user is registered, the product is present in the database, and the product has not yet been added to the user's cart.
## Non-functional requirements:
1. All product and user data must be stored in the database.
2. DBMS - mysql.
3. The php language should be used to write the backend.

## Contributors

Nozadze Kakhaber k.nozadze@student.sumdu.edu.ua
