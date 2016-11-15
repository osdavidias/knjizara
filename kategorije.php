<!Doctype-html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stil.css">
</head>

<body>

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
session_start();
include 'klase.php';
$id=$_GET["id"];

// sortiranje:
if (isset($_POST["button"])) {
	$sortiranje=new sortiranje($_POST["sortiraj"]);
	$sortiraj=$sortiranje->sortiraj();
	
}// kraj if is set

else
{
	$sortiraj="dodano DESC";
}

$k=new baza();
$k->query('SELECT knjige.*, kategorije.* FROM knjige JOIN kategorije ON knjige.br_kategorije=kategorije.br_kategorije WHERE kategorije.br_kategorije = :kat ORDER BY '.$sortiraj);
$k->bind(":kat", $id);
$rezultat=$k->dohvati();

?>

 
<h3><?php
// naziv kategorije: 
	echo $rezultat[0]->naziv_kategorije.":";
  ?></h3>

<?php
foreach ($rezultat as $key => $value) {


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