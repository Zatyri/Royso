<?php

$errors = [
  'name' => '',
  'adress' => '',
  'zipcode' => '',
  'area' => '',
  'phone' => '',
];

if (filter_has_var(INPUT_POST, 'submitButton')) {
  if (filter_has_var(INPUT_POST, 'name')) {
    $name = $_POST['name'];
    if (empty($name)) {
      $errors['name'] = 'Namnet fattas';
    } else {
      $name = filter_var($name, FILTER_SANITIZE_STRING);
    }
  }
  if (filter_has_var(INPUT_POST, 'adress')) {
    $adress = $_POST['adress'];
    if (empty($adress)) {
      $errors['adress'] = 'Adressen fattas';
    } else {
      $adress = filter_var($adress, FILTER_SANITIZE_STRING);
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
    }
  }
  if (filter_has_var(INPUT_POST, 'area')) {
    $area = $_POST['area'];
    if (empty($area)) {
      $errors['area'] = 'Staden fattas';
    } else {
      $area = filter_var($area, FILTER_SANITIZE_STRING);
    }
  }
  if (filter_has_var(INPUT_POST, 'phone')) {
    $phone = $_POST['phone'];
    if (empty($phone)) {
      $errors['phone'] = 'Telefon nummer fattas';
    } else {
      $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
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
    }
  }
}
?>

<div class="inputForm">

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2>Fyll i kontaktuppgifterna</h2>
    <div class="inputContainer">
      <label>Namn<input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
      <div <?php echo $errors['name'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['name']) ?></div></label>
    </div>
    <div class="inputContainer">
      <label>Adress<input type="text" name="adress" value="<?php echo isset($_POST['adress']) ? $_POST['adress'] : '' ?>">
      <div <?php echo $errors['adress'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['adress']) ?></div></label>
    </div>
    <div class="inputContainer">
      <label>Postnummer<input type="number" name="zipcode" value="<?php echo isset($_POST['zipcode']) ? $_POST['zipcode'] : '' ?>">
      <div <?php echo $errors['zipcode'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['zipcode']) ?></div></label>
    </div>
    <div class="inputContainer">
      <label>Stad<input type="text" name="area" value="<?php echo isset($_POST['area']) ? $_POST['area'] : '' ?>">
      <div <?php echo $errors['area'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['area']) ?></div></label>
    </div>
    <div class="inputContainer">
      <label>Telefon<input type="tel" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
      <div <?php echo $errors['phone'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['phone']) ?></div></label>
    </div>
    <div class="inputContainer">
      <label>E-post<input type="email" name="mail" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : '' ?>">
      <div <?php echo $errors['mail'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['mail']) ?></div></label>
    </div>
    <div class='inputContainer'>
      <button name='submitButton' class='' type="submit" value='submit'>Beställ boken</button>
    </div>
  </form>
</div>