<?php
//error messages
$errors = [
  'name' => '',
  'subject' => '',
  'mail' => '',
  'message' => '',
];

$email = [
  'to' => 'oskar@royso.fi',
  'from' => '',
  'subject' => '',
  'name' => '',
  'message' => '',
  'headers' => ''
];


if (filter_has_var(INPUT_POST, 'contactSubmitButton')) {
  if (filter_has_var(INPUT_POST, 'name')) {
    $name = $_POST['name'];
    if (empty($name)) {
      $errors['name'] = 'Namnet fattas';
    } else {
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $email['name'] = $name;
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
      $email['from'] = $mail;
      $email['headers'] = 'From: ' . $mail . "\r\n" . 'Reply-To: ' . $mail . "\r\n";
    }
  }
  if (filter_has_var(INPUT_POST, 'subject')) {
    $subject = $_POST['subject'];
    if (empty($subject)) {
      $errors['subject'] = 'Rubriken fattas';
    } else {
      $subject = filter_var($subject, FILTER_SANITIZE_STRING);
      $email['subject'] = $subject;
    }
  }
  if (filter_has_var(INPUT_POST, 'message')) {
    $message = $_POST['message'];
    if (empty($message)) {
      $errors['message'] = 'Meddelande fattas';
    } else if (preg_match('/http|www/i', $message)) {
      $errors['message'] = 'Vi accepterar inga länkar i meddelander';
    } else {
      $message = filter_var($message, FILTER_SANITIZE_STRING);      
      $email['message'] = 'Meddelande från ' . $email['name'] . "\r\n" . $message;
      $email['message'] = wordwrap($email['message'],70);
      
    }
  }

  // check if any errors
  $ready = true;
  foreach ($errors as $error) {
    if ($error != '') {
      $ready = false;
    }
  }
  if ($ready) {
    $success = sendMail($email);
    if ($success) {
      // echo ('mail sent');
      $_POST = array();
    } else {
      // echo ('mail not sent');
    }
  }
}



function sendMail($email)
{
  return mail($email['to'], $email['subject'], $email['message'], $email['headers']);
}


?>


<section id='contactForm'>
  <i id='closeContactForm' class="material-icons" style="font-size:36px">arrow_forward</i>
  <div>
    <h4>Kontakta oss</h4>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="inputContainer">
        <label>Namn<input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
          <div <?php echo $errors['name'] ? "class='contactErrorMsg'" : '' ?>><?php echo ($errors['name']) ?></div>
        </label>
      </div>
      <div class="inputContainer">
        <label>E-post<input type="email" name="mail" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : '' ?>">
          <div <?php echo $errors['mail'] ? "class='contactErrorMsg'" : '' ?>><?php echo ($errors['mail']) ?></div>
        </label>
      </div>
      <div class="inputContainer">
        <label>Rubrik<input type="text" name="subject" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : '' ?>">
          <div <?php echo $errors['subject'] ? "class='contactErrorMsg'" : '' ?>><?php echo ($errors['subject']) ?></div>
        </label>
      </div>
      <div class="inputContainer">
        <label>Meddelande<textarea type="text" name="message" value="<?php echo isset($_POST['message']) ? $_POST['message'] : '' ?>"></textarea>
          <div <?php echo $errors['message'] ? "class='contactErrorMsg'" : '' ?>><?php echo ($errors['message']) ?></div>
        </label>
      </div>
      <div class='inputContainer'>
        <input id='contactSubmitButton' name='contactSubmitButton' class='secondaryButton' type="submit" value='Skicka meddelandet'></input>
      </div>
    </form>
  </div>
</section>