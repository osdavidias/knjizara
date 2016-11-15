<!Doctype-html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stil.css">
</head>

<body>
<?php
session_start();
include ('klase.php');
$z=new zaglavlje("DOBRODOŠLI U KNJIŽARU");
$z->linkovi("registracija.php", "login.php");
?>

<h3>ODABERITE KATEGORIJU:</h3>

<?php



// dohvati kategorije iz baze
$k=new baza();
$k->query("SELECT * FROM kategorije");
$kategorije=$k->dohvati();


foreach ($kategorije as $key => $value) {
	echo '<a href="kategorije.php?id='.$value->br_kategorije.'"> '.$value->naziv_kategorije.' |</a>';
}

// početna vrijednost sortiranja

?>

<br>
<h2>NAJNOVIJE:</h2>
<br>
<form method="post">
<b>Sortiraj:</b>
<select name="sortiraj">
  <option value="">Odaberi...</option>
  <option value="1">Prema datumu, najnoviji</option>
  <option value="2">Prema datumu, najstariji</option>
  <option value="3">S nižom cijenom</option>
  <option value="4">S višom cijenom</option>
  <option value="5">Prema nazivu A-Z</option>
  <option value="6">Prema nazivu Z-A</option>  
</select>
<input type="submit" name="button" >
</form>

<?php
// sortiranje:
if (isset($_POST["button"])) {
	$sortiranje=new sortiranje($_POST["sortiraj"]);
	$sortiraj=$sortiranje->sortiraj();
	
}// kraj if is set

else
{
	$sortiraj="dodano DESC";
}

$knjige=new baza();
$knjige->query("SELECT * FROM knjige ORDER BY ".$sortiraj." LIMIT 6");
$rez=$knjige->dohvati();

foreach ($rez as $key => $value) {


?>
<div class="prikaz">
	<h4><?php echo $value->naslov; ?></h4>
	<a href=<?php echo '"'.'knjige.php?k='.$value->br_knjige.'"'; ?>><img id="mala" src=<?php echo '"'.'slike/'.$value->slika.'"'; ?>></a>
	<br>
	<h4>
	<?php
	$cijena=str_replace(".", ",", $value->cijena);
	 echo $cijena.' kn'; ?>
	</h4>
</div> 

<?php
 } // kraj foreach

?>



</body>
</html>