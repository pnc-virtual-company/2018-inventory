# Inventory application

The Inventory application is designed for the Admin and Finance Team of Passerelles numériques in Cambodia.
It contains some useful features to make it easy to manage inventories of PNC:

 * Show the list of asset and also can create edit and delet any asset from this system
 * Has advance filter the list of asset 
 * Has report asset of each department by Bar chart
 * Has report asset of each condition by Pie chart
 * Process of select data is very fast by use the ajax, json
 * Can list, create, edit,and delete data category of items.
 * Can list, create, edit,and delete data material of items.
 * Can list, create, edit,and delete data department of items.
 * Can list, create, edit,and delete data location of items.


The Inventory application is a starter kit for any CodeIgniter 3 projects.
It contains a login page, session and user management.

## PHP requirements

 * PHP version at least 5.6 or 7.0+ (PHP 7 recommended).
 * PHP Extension dom
 * PHP Extension gd
 * PHP Extension mbstring
 * PHP Extension xml
 * PHP Extension zip
 * PHP Extension zlib

## Setup

If you have cloned the repository, you need an extra step to install the PHP libraries.
Use composer (PHP dependencies manager) to install the libraies with this command:

    composer install

Create a database named (for example) skeleton with the collating option `utf8_general_ci`
Import the schema by using the SQL script provided into the SQL folder.
Edit the file `application/config/database.php` and point to your database.
By default, the skeleton application uses a prefix (`skeleton_`) for all tables.
This behaviour can be changed by editing the databases options along with the name into the database.

The default user is *admin* and its password is *password*.

/!\ IMPORTANT: Please insert the script database in your server that we have in sql directory.
