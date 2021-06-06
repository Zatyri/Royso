<?php
require './environment.php';

function errorMail($cust, $dbError){
  $message = "Ett fel uppstod: \r\n
  Kunden: " . print_r($cust) . " \r\n
  Databas fel: " . $dbError;
  $email = [
    'to' => 'oskar@royso.fi',      
    'subject' => 'Ett fel uppstod',      
    'message' => $message
  ];
  mail($email['to'], $email['subject'], $email['message']);
}


function saveOrderToDb($customer)
{
  $host = $_ENV['serverName'];
  $userName = $_ENV['username'];
  $password = $_ENV['password'];
  $dbName = 'roysofi_royso';

  $orderSuccess = true;

  $conn = new mysqli($host, $userName, $password, $dbName);

  if ($conn->connect_error) {   
    errorMail($customer, $conn->connect_error); 
    die("Connection to database failed");
  }
  $customerId = null;
  //check if customer exists
  $stmt = $conn->prepare("SELECT `id` FROM `customers` WHERE `mail` = ?"); 
  $stmt->bind_param('s', $customer['mail']);
  if(!$stmt->execute()){      
    errorMail($customer, $stmt->error); 
    die("Det uppstod ett fel i databasen, var god försök igen. 1");
  }  
  $stmt->bind_result($customerId);
  $stmt->fetch();  
  $stmt->close();

  //add new customer if one does not exist
  if (!$customerId) {
    $stmt = $conn->prepare("INSERT INTO `customers`(`name`, `company`, `adress`, `zipcode`, `city`, `phone`, `mail`) VALUES (?,?,?,?,?,?,?)");
    
    $stmt->bind_param(
      'sssssis',
      $customer['name'],
      $customer['company'],
      $customer['adress'],
      $customer['zipcode'],
      $customer['area'],
      $customer['phone'],
      $customer['mail']
    );

    if(!$stmt->execute()){           
      errorMail($customer, $stmt->error);
        
      die("Det uppstod ett fel i databasen, var god försök igen. 2");
    }  
    $customerId = $stmt->insert_id; 
    $stmt->close();
  }

  //add order  
  $stmt  = $conn->prepare("INSERT INTO `orders`(`customer`, `book`, `amount`) VALUES (?,?,?)");
  $bookId = 1; 
  
  $stmt ->bind_param(
    'iii',
    $customerId, 
    $bookId,
    $customer['amount']
  );
 
  if(!$stmt->execute()){    
    errorMail($customer, $stmt->error);
    die("Det uppstod ett fel i beställningen, var god och pröva pånytt. Om felet upprepas bör du kontakta oss på ulf@royso.fi 
    eller kontakta oss via länken i nedra hörnet");
  }  
  $stmt ->close();
  $conn ->close();

  return $orderSuccess;
}

