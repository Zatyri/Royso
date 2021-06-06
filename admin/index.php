<?php
require '../environment.php';


function getOrders()
{
  $host = $_ENV['serverName'];
  $userName = $_ENV['username'];
  $password = $_ENV['password'];
  $dbName = 'roysofi_royso';

  $conn = new mysqli($host, $userName, $password, $dbName);
  if ($conn->connect_error) {
    die("Connection to database failed " . $conn->connect_error);
  }


  $sql = "SELECT o.customer, o.amount, o.date, o.payed, o.delivered, c.id, c.name 
  FROM `orders` AS `o` 
  JOIN `customer` AS `c` 
  ON o.customer = c.id
  ORDER BY o.date, c.name";

  $orders = $conn->query($sql);

  if ($orders->num_rows > 0) {
    while ($row = $orders->fetch_assoc()) {
      echo "<tr>
      <td> <a href='./kund.php?id=" . $row['id'] ."'>" . $row['name'] . "</a></td>
      <td>" . $row['amount'] . "</td>
      <td>" . $row['payed'] . "</td>
      <td>" . $row['delivered'] . "</td>
      <td>" . $row['date'] . "</td>
      </tr>";
    }
  }

  $conn->close();
}

?>
<!DOCTYPE html>
<html lang="sv-fi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <title>Beställnings register</title>
</head>

<body>
  <h1>Öppna beställningar</h1>
  <table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th>
        Namn
      </th>
      <th>
        Antal böcker
      </th>
      <th>
        Faktura skickad
      </th>
      <th>
        Levererad
      </th>
      <th>
        Beställningen mottagen
      </th>
    </tr>
    </thead>
    <?php
    getOrders();
    ?>
  </table>
</body>

</html>