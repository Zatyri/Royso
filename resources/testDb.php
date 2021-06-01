<?php
require '../environment.php';

$host = $_ENV['serverName'];
$userName = $_ENV['username'];
$password = $_ENV['password'];
$dbName = 'roysofi_royso';

$orderSuccess = true;

$conn = new mysqli($host, $userName, $password, $dbName);

if ($conn->connect_error) {
  die("Connection to database failed " . $conn->connect_error);
}
