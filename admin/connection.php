<?php
require '../environment.php';

$conn = new mysqli($host, $userName, $password, $dbName);

if ($conn->connect_error) {
  die("Connection to database failed " . $conn->connect_error);
} else {
  echo "Connection established";
}