<?php
include ('funkcije.php');

session_start();

echo "<p>Odaberite kategroiju:</p>";
// dohvati kategorije iz baze
$k=dohvati_kategorije();
// prikaži kategorije
echo $k;


?>
