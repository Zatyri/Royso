<?php
include './modules/head.php';
include './environment.php';

$googleKey = $_ENV['googleKey'];

?>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<div class='background'>
  <main class='mainRoyso'>
    <div class='container'>
      <article>
        <div class='header'>
          <h2>Röysö</h2>
        </div>
        <p>Röysö har en areal på 0,75 km2 och ligger ca 22 km öster om Helsingfors. Det högsta berget Kummelberg, Högberget eller ”Högis” höjer sig ca 27 m över havet. På berget finns ett röse som enligt Arkeologiska kommissionens undersökning 1934 förmodligen härstammar från bronsåldern. Ifall man skulle ta sig en promenad på strandkallan runt holmen så skulle man få gå ca 7 km.</p>
      </article>
      <article>
        <div class='header'>
          <h2>Karta över Röysö</h2>
        </div>
        <div id="googleMap"></div>
        <cite>Platser och namn av Nils-Erik Bäckblom</cite>
      </article>
      <?php
      include './modules/text.php'; 
      ?>
    </div>
  </main>
</div>
<script src="./scripts/googleMaps.js"></script>

<script src=<?php echo ("https://maps.googleapis.com/maps/api/js?key=" . $googleKey . "&callback=initMap") ?> async></script>

<?php
include './modules/footer.php';
?>