<?php

require './sql/dbConnection.php';

$errors = [
  'name' => '',
  'adress' => '',
  'zipcode' => '',
  'area' => '',
  'phone' => '',
  'mail' => '',
  'amount' => '',
  'consent' => ''
];

$customer = [
  'name' => '',
  'company' => '',
  'adress' => '',
  'zipcode' => '',
  'area' => '',
  'phone' => '',
  'mail' => '',
  'amount' => ''
];

if (filter_has_var(INPUT_POST, 'submitButton')) {
  if (filter_has_var(INPUT_POST, 'name')) {
    $name = $_POST['name'];
    if (empty($name)) {
      $errors['name'] = 'Namnet fattas';
    } else {
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $customer['name'] = $name;
    }
  }
  if (filter_has_var(INPUT_POST, 'company')) {
    $company = $_POST['company'];
    if (!empty($name)) {
      $company = filter_var($company, FILTER_SANITIZE_STRING);
      $customer['company'] = $company;
    } 
  }
  if (filter_has_var(INPUT_POST, 'adress')) {
    $adress = $_POST['adress'];
    if (empty($adress)) {
      $errors['adress'] = 'Adressen fattas';
    } else {
      $adress = filter_var($adress, FILTER_SANITIZE_STRING);
      $customer['adress'] = $adress;
    }
  }
  if (filter_has_var(INPUT_POST, 'zipcode')) {
    $zipcode = $_POST['zipcode'];
    if (empty($zipcode)) {
      $errors['zipcode'] = 'Postnummer fattas';
    } else if (strlen($zipcode) != 5) {
      $errors['zipcode'] = 'Postnumret är fel längd';
    } else {
      $zipcode = filter_var($zipcode, FILTER_SANITIZE_NUMBER_INT);
      $customer['zipcode'] = $zipcode;
    }
  }
  if (filter_has_var(INPUT_POST, 'area')) {
    $area = $_POST['area'];
    if (empty($area)) {
      $errors['area'] = 'Staden fattas';
    } else {
      $area = filter_var($area, FILTER_SANITIZE_STRING);
      $customer['area'] = $area;
    }

  }
  if (filter_has_var(INPUT_POST, 'phone')) {
    $phone = $_POST['phone'];
    if (empty($phone)) {
      $errors['phone'] = 'Telefon nummer fattas';
    } else {
      $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
      $customer['phone'] = $phone;
    }
  }
  if (filter_has_var(INPUT_POST, 'mail')) {
    $mail = $_POST['mail'];
    if (empty($mail)) {
      $errors['mail'] = 'E-mailen fattas';
    } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $errors['mail'] = 'Ge en korrekt e-mail adress';
    } else {
      $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);
      $customer['mail'] = $mail;
    }
  }
  if (filter_has_var(INPUT_POST, 'amount')) {
    $amount = $_POST['amount'];
    if (empty($amount)) {
      $errors['amount'] = 'Antalet exemplar fattas';
    } else if (!filter_var($amount, FILTER_VALIDATE_INT, ["options" =>  ["min_range" => 1]])) {
      $errors['amount'] = 'Fel med antalet exemplar';
    } else {
      $amount = filter_var($amount, FILTER_SANITIZE_NUMBER_INT);
      $customer['amount'] = $amount;
    }
  }
  if (filter_has_var(INPUT_POST, 'consent')) {
    $consent = $_POST['consent'];    
    if($consent != 'consent'){
      echo 'iran';
      $errors['consent'] = 'Vi kräver att du godtar villkoren och dataskyddsförordningen. 
      I fall du har frågor, var god och kontakta oss';
    } 
  }
  $hasError = false;
  foreach ($errors as $error){
    if($error != ''){
      $hasError = true;
    } 
  }
  if(!$hasError){
    $orderSuccess = saveOrderToDb($customer);    
    echo $orderSuccess;
  } 
  if($orderSuccess){
    $message = "Hurra! Ny beställning av boken! \r\n 
    Kunden \r\n
    namn: " . $customer['name'] . "\r\n 
    adress: " . $customer['adress'] . ", " . $customer['zipcode'] . ", " . $customer['area'] . "\r\n
    tel: " . $customer['phone'] . "\r\n
    email: " . $customer['mail'] . "\r\n
    antal böcker: " . $customer['amount'] . "st"; 
    $email = [
      'to' => 'ulf@royso.fi',      
      'subject' => 'Ny beställning av: ' . $customer['name'],      
      'message' => $message
    ];
    mail($email['to'], $email['subject'], $email['message']);
    header("Location: tack"); 
    exit();
  }
  
}
