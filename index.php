<html>
<head>

</head>

<body>
<?php
session_start();
include ('klasa.php');
$z=new zaglavlje("DOBRODOŠLI U KNJIŽARU");
$z->linkovi("registracija.php", "login.php");
?>

<h3>ODABERITE KATEGORIJU:</h3>

<?php



// dohvati kategorije iz baze
$k=new baza();
$k->query("SELECT * FROM kategorije");
$kategorije=$k->dohvati();

echo "<pre>";
print_r($kategorije);
echo "</pre>";

foreach ($kategorije as $key => $value) {
	echo '<a href="kategorije.php?id='.$value->br_kategorije.'"> '.$value->naziv_kategorije.' |</a>';
}

$knjige=new baza();
$knjige->query("SELECT * FROM knjige ORDER BY dodano LIMIT 6");
$rez=$knjige->dohvati();
?>

</body>
</html>