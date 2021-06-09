<?php
require '../../environment.php';

function connect()
{
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

function displayOrderTable($orders)
{
  if ($orders->num_rows > 0) {
    while ($row = $orders->fetch_assoc()) {
      if ($row['payed'] == 1) {
        $payed = "btn btn-success";
        $payedText = "Ja";
      } else {
        $payed = "btn-warning";
        $payedText = "Markera skickad";
      }
      if ($row['delivered'] == 1) {
        $delivered = "btn btn-success";
        $deliveredText = "Ja";
      } else {
        $delivered = "btn-warning";
        $deliveredText = "Markera levererad";
      }

      echo "<tr>
      <td> <a href='./kund.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></td>
      <td>" . $row['amount'] . "</td>
      <td>
      <form action='./index' method='post'>
      <input type='hidden' name='orderId'value=" . $row['orderId'] . ">
      <input type='hidden' name='currentPayedStatus' value=" . $row['payed'] . ">               
      <input class= 'btn " . $payed . "' type='submit' name='updatePayed' value='" . $payedText . "'>
      </form></td>
      <td>
      <form action='./index' method='post'>
      <input type='hidden' name='orderId'value=" . $row['orderId'] . ">
      <input type='hidden' name='currentDeliveredStatus' value=" . $row['delivered'] . ">               
      <input class= 'btn " . $delivered . "' type='submit' name='updateDelivered' value='" . $deliveredText . "'>
      </form></td>
      <td>" . $row['date'] . "</td>
      </tr>";
    }
  }
}

function displayCustomerInfo($info)
{  
      echo "<tr>
      <td>" . $info['name'] . "</td>
      <td>" . $info['company'] . "</td> 
      <td>" . $info['adress'] . "</td>    
      <td>" . $info['zipcode'] . "</td>  
      <td>" . $info['city'] . "</td>  
      <td>0" . $info['phone'] . "</td>  
      <td>" . $info['mail'] . "</td>
      <td>
      <form action='./index' method='post'>
      <input type='hidden' name='customerIdToDelete' value=" . $info['id'] . ">
      <input class='btn btn-danger' type='submit' 'name='deleteCustomer' value='Redigera'>
      </form>
      </td>
      </tr>";
  
  
}

function getAllOpenOrders()
{
  $conn = connect();

  $sql = "SELECT o.id AS `orderId`, o.customer, o.amount, o.date, o.payed, o.delivered, c.id, c.name 
  FROM `orders` AS `o`  
  JOIN `customers` AS `c`   
  ON o.customer = c.id
  WHERE o.payed = 0 OR o.delivered = 0
  ORDER BY o.date, c.name";

  $orders = $conn->query($sql);

  if(!$orders){
    echo "virhe";
  }

  displayOrderTable($orders);

  $conn->close();
}

function updatePayed($id, $status)
{
  $conn = connect();

  if ($status == 1) {
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

function updateDelivered($id, $status)
{
  $conn = connect();

  if ($status == 1) {
    $status = 0;
  } else {
    $status = 1;
  }

  $stmt = $conn->prepare("UPDATE `orders` SET `delivered` = ? WHERE `id` = ?");
  $stmt->bind_param("ii", $status, $id);
  $stmt->execute();
  $stmt->close();
  $conn->close();
  header('Location: ./index');
}

function getAllOrders()
{
  $conn = connect();

  $sql = "SELECT o.id AS `orderId`, o.customer, o.amount, o.date, o.payed, o.delivered, c.id, c.name 
  FROM `orders` AS `o`  
  JOIN `customers` AS `c`   
  ON o.customer = c.id  
  ORDER BY o.date, c.name";

  $orders = $conn->query($sql);

  displayOrderTable($orders);
  $conn->close();
}

function getCustomer($id)
{
  $conn = connect();
  $stmt = $conn->prepare("SELECT id, `name`, company, adress, zipcode, city, phone, mail FROM `customers` WHERE `id` = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $customer = [];
  $stmt->bind_result($customer['id'],
    $customer['name'], 
  $customer['company'], 
  $customer['adress'], 
  $customer['zipcode'], 
  $customer['city'], 
  $customer['phone'], 
  $customer['mail'] );
  
  
  $stmt->fetch();

  displayCustomerInfo($customer);

  $stmt->close();
  $conn->close();
}

function deleteCustomer($id){  
  $conn = connect();
  $stmt = $conn->prepare("DELETE FROM `customers` WHERE `id` = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();

  $stmt->close();
  $conn->close();
}


if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['updatePayed'])) {
  updatePayed($_POST['orderId'], $_POST['currentPayedStatus']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['updateDelivered'])) {
  updateDelivered($_POST['orderId'], $_POST['currentDeliveredStatus']);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['customerIdToDelete'])) {
  deleteCustomer($_POST['customerIdToDelete']);
}