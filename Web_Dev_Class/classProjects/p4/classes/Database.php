
<?php
//This script is used to connect to database-

$databaseName = 'project4';
$host = '127.0.0.1';
$dsn = "mysql:dbname=$databaseName;host=$host";
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (\PDOException $e) {
    echo "Unable to connect to database!";
    exit;
}