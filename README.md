# Chatter
> AJAX-based web messenger.  Developed as part of classes at university.

## Key Features
* Exchanging messages between users
* Friends lists
* Managing user accounts

## Technologies
* PHP 7.4.3
* HTML & CSS
* JavaScript + jQuery
* Apache 2.4.41
* mysql Ver 15.1 Distrib 10.3.25-MariaDB
 
## How To Use
This project is tested on Linux (Ubuntu 20.04), although it can run on any OS with properly set environment. 
To clone and run this application, you'll need AMP stack. Feel free to build env with Xampp. 

Below You can find instructions to set the environment and run the app on Linux.
Required tools:
* [Git](https://git-scm.com) (or download the app directly) 
* [PHP](https://www.php.net/releases/7_4_3.php)
* [Apache](https://httpd.apache.org/download.cgi) 
* [MariaDB](https://mariadb.org/download/)

 From Your command line:

```bash
# Update local package Index
$ sudo apt update

# Install and start Apache web server
$ sudo apt install apache2
$ sudo systemctl start apache2

# Change directory to localhost folder
$ cd /var/www/

# Clone this repository
$ git clone https://github.com/robertlato/chatter.git

# Change ownership and access permissions
$ sudo chown -R $USER: chatter/
$ sudo chmod -R 755 chatter/

# Install and start MariaDB
$ sudo apt install mariadb-server
$ sudo systemctl start mysql

# Configure MariaDB
$ sudo mysql_secure_installation

# Create empty database and admin user
$ sudo mysql
MariaDB [(none)]> CREATE DATABASE chatter; 
MariaDB [(none)]> CREATE USER 'admin'@'localhost' IDENTIFIED BY 'projektPW!'; 
MariaDB [(none)]> GRANT ALL PRIVILEGES ON chatter.* TO 'admin'@'localhost'; 
MariaDB [(none)]> FLUSH PRIVILEGES;
MariaDB [(none)]> exit 

# Import database schema to chatter database
$ mysql -u 167866 -p chatter < /var/www/chatter/dataBase/chatter.sql

# Install PHP
$ sudo apt install php7.4 php7.4-mysql php7.4-cgi

```
<br>
Last step is to create a virtual host for Chatter. To do that we need to:

```bash
# 1. Create new virtual host file with domain information
$ sudo touch /etc/apache2/sites-available/chatter.conf
$ sudo nano /etc/apache2/sites-available/chatter.conf
```
Type in following details and save it:
```
<VirtualHost *:80>
	ServerName localhost
	ServerAdmin webmaster@chatter
	DocumentRoot /var/www/chatter
	
	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
Continue in command line:
```bash
# 2. Enable our new virtual host
$ sudo a2ensite chatter.conf

# 3. Disable default virtual host
$ sudo a2dissite 000-default.conf

# 4. Restart Apache
$ sudo systemctl restart apache2
```

You can now check the app by typing [http://localhost/](http://localhost/) in Your web browser. 

## Database
You can manage database in a MariaDB prompt using SQL statements. Here You can find few useful commands:

* show databases;
* show tables;
* use "database_name";
* describe "table_name";

From Your command line:
```bash
# Enter MariaDB prompt
$ sudo mysql

# Use any SQL statement (remember to end the statement with semicolon!)
MariaDB [(none)]> use chatter;
MariaDB [chatter]> SELECT * FROM uzytkownicy;
```

You can always change database configuration in `db.inc.php` file (/chatter/includes).

## Screenshots
![image](https://user-images.githubusercontent.com/44004809/109337950-d5dd1d00-7865-11eb-95f0-559f7e28a3b0.png)

<br>

![image](https://user-images.githubusercontent.com/44004809/109338497-a4b11c80-7866-11eb-9c26-e0d163ee0119.png)

<br>

![image](https://user-images.githubusercontent.com/44004809/109338774-ffe30f00-7866-11eb-81af-f928a80508d0.png)

<br>

![image](https://user-images.githubusercontent.com/44004809/109339292-bc3cd500-7867-11eb-9f4a-ca344a32e17c.png)
