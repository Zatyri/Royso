<?php
  require './modules/shopFormControl.php'
?>

<div class="inputForm">

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h3>Fyll i kontaktuppgifterna</h3>
    <div class="inputContainer">
      <label>Namn:<input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
        <div <?php echo $errors['name'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['name']) ?></div>
      </label>
    </div>
    <div class="inputContainer">
      <label>Företag: <span>(valfri)</span><input type="text" name="company" value="<?php echo isset($_POST['company']) ? $_POST['company'] : '' ?>">
    </div>
    <div class="inputContainer">
      <label>Adress:<input type="text" name="adress" value="<?php echo isset($_POST['adress']) ? $_POST['adress'] : '' ?>">
        <div <?php echo $errors['adress'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['adress']) ?></div>
      </label>
    </div>
    <div class="inputContainer">
      <label>Postnummer:<input type="number" name="zipcode" value="<?php echo isset($_POST['zipcode']) ? $_POST['zipcode'] : '' ?>">
        <div <?php echo $errors['zipcode'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['zipcode']) ?></div>
      </label>
    </div>
    <div class="inputContainer">
      <label>Stad:<input type="text" name="area" value="<?php echo isset($_POST['area']) ? $_POST['area'] : '' ?>">
        <div <?php echo $errors['area'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['area']) ?></div>
      </label>
    </div>
    <div class="inputContainer">
      <label>Telefon:<input type="tel" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
        <div <?php echo $errors['phone'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['phone']) ?></div>
      </label>
    </div>
    <div class="inputContainer">
      <label>E-post:<input type="email" name="mail" value="<?php echo isset($_POST['mail']) ? $_POST['mail'] : '' ?>">
        <div <?php echo $errors['mail'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['mail']) ?></div>
      </label>
    </div>
    <div class="inputContainer">
      <div>
        <label>Antal exemplar: </label>
        <input class="bookAmount" type="number" min="1" name="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '1' ?>">
        <div> á 50€/st</div>
      </div>
      <div <?php echo $errors['amount'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['amount']) ?></div>
    </div>
    <div class="notification">
      OBS! Vi skickar fakturan på uppköpet efter vi behandlat din beställning. Boken levereras efter betalning.
    </div>
    <div class="inputContainer">
      <div>
        <input class="checkbox" type="checkbox" name="consent" value="consent" required>
        <label>Jag försäkrar att mina uppgiter är korrekta och godkänner
          <a href="../privacyStatement.php" target="_blank">dataskyddsförordningen</a>
          samt leverans villkoren

          <div <?php echo $errors['consent'] ? "class='errorMsg'" : '' ?>><?php echo ($errors['consent']) ?></div>

        </label>
      </div>
    </div>


    <div class='inputContainer'>
      <button name='submitButton' class='secondaryButton' type="submit" value='submit'>Beställ boken</button>
    </div>
  </form>
</div>