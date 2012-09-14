<?php

$developeMode = true;

if(!$developeMode)
{
	die('This setup script can only be run when in develope mode.
		<br />This can be set in file.');
}

$mysqli = new mysqli('localhost', 'proj-ep', 'pe', 'project-epimetheus');

$mysqli->query('DROP TABLE IF EXISTS user');
$mysqli->query('CREATE TABLE user (
			email VARCHAR(255) UNIQUE NOT NULL,
			password VARCHAR(255) NOT NULL, INDEX(password),
			salt VARCHAR(255) NOT NULL,
			accessLevel INT(1) NOT NULL DEFAULT 0,
			firstname VARCHAR(255),
			lastname VARCHAR(255),
			phone INT,
			PRIMARY KEY (email)
		)
		DEFAULT CHARSET utf8
		ENGINE=InnoDB');
echo $mysqli->error;

$mysqli->query('DROP TABLE IF EXISTS user_cookie');
$mysqli->query('CREATE TABLE user_cookie (
		email VARCHAR(255) NOT NULL,
		cookie VARCHAR(255) NOT NULL, INDEX(cookie),
		expires DATETIME,
		FOREIGN KEY (email) REFERENCES user(email) ON DELETE CASCADE ON UPDATE CASCADE,
		PRIMARY KEY(email, cookie)
	) 
	DEFAULT CHARSET utf8
	ENGINE=InnoDB');
echo $mysqli->error;    

// Username: user@user.com
// Pass: test
$pass = hash('sha512', 'testsalt');
$pass = hash('sha512', 'salt' . $pass);
$mysqli->query('INSERT INTO user (email, password, salt, accessLevel, firstname, lastname, phone) VALUES ("user@user.com", "' . $pass . '", "salt", 9, "Test", "User", 555010101)');
echo $mysqli->error;

?>
