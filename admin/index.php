<?php
require './adminAPI.php';

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
    getAllOpenOrders();
    ?>
  </table>
</body>

</html>