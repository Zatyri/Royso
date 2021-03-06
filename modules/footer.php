<footer>
  <div class='container'>
    <div class="flexEven">
      <div id='collaboration'>
        <h3>I sammarbete med</h3>
        <img src='/media/logo/Konstsamfundet_svart.png' alt='Konstamfundet' />
      </div>
    </div>
    <div class='navigation flexEven'>
      <a href='/'>HEM</a>
      <a href='boken'>BOKEN</a>
      <a href='royso'>OM RÖYSÖ</a>
      <a href='butik'>KÖP BOKEN</a>
    </div>
    <div class="contact flexEven">
      <button id='contactButton' class="secondaryButton contactButton">Kontakta oss</button>
    </div>
    <?php
    include './modules/contact.php';
    ?>
  </div>
  <div class="flexCol">

    <div>
      <span>
        © <?php
          echo date("Y");
          ?>
        Projektforum Oy Ab
      </span>
      <a class="privacyButton" href="./privacyStatement" rel="nofollow">Dataskydd</a>
    </div>
    <div>
      Sidan av Oskar Gustafsson
    </div>
  </div>
</footer>
</body>
<script type='text/javascript' src='./scripts/main.js'></script>

</html>