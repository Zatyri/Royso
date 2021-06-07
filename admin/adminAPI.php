<?php
require '../environment.php';

function connect(){
  $host = $_ENV['serverName'];
  $userName = $_ENV['username'];
  $password = $_ENV['password'];
  $dbName = 'roysofi_royso';
  $conn = new mysqli($host, $userName, $password, $dbName);
  if ($conn->connect_error) {
    die("Connection to database failed " . $conn->connect_error);
  }
  return $conn;
}

function getAllOpenOrders()
{
  $conn = connect();

  $sql = "SELECT o.id AS `orderId`, o.customer, o.amount, o.date, o.payed, o.delivered, c.id, c.name 
  FROM `orders` AS `o` 
  JOIN `customers` AS `c` 
  ON o.customer = c.id
  ORDER BY o.date, c.name";

  $orders = $conn->query($sql);

  if ($orders->num_rows > 0) {
    while ($row = $orders->fetch_assoc()) {
      if($row['payed'] == 1){
        $payed = "btn btn-success";
        $payedText = "Skickad";
      } else {
        $payed = "btn-warning";
        $payedText = "Oskickad";
      }
      echo "<tr>
      <td> <a href='./kund.php?id=" . $row['id'] ."'>" . $row['name'] . "</a></td>
      <td>" . $row['amount'] . "</td>
      <td>
      <form action='./index' method='post'>
      <input type='hidden' name='orderId'value=" . $row['orderId'] . ">
      <input type='hidden' name='currentPayedStatus' value=" . $row['payed'] . ">               
      <input class= 'btn " . $payed . "' type='submit' name='updatePayed' value=" . $payedText . ">
      </form></td>
      <td>" . $row['delivered'] . "</td>
      <td>" . $row['date'] . "</td>
      </tr>";
    }
  }
  $conn->close();
}

function updatePayed($id, $status){  
  $conn = connect();

  if($status == 1){
    $status = 0;
  } else {
    $status = 1;
  }

  $stmt = $conn->prepare("UPDATE `orders` SET `payed` = ? WHERE `id` = ?");
  $stmt->bind_param("ii", $status, $id);
  $stmt->execute();
  $stmt->close();
  $conn->close();
  header('Location: ./index');
}


    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['updatePayed']))
    {
        updatePayed($_POST['orderId'], $_POST['currentPayedStatus']);
    }
  



