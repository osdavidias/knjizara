<html>
<head>

</head>

<body>

<h1>DOBRODOŠLI U KNJIŽARU</h1>
<h3>ODABERITE KATEGORIJU:</h3>

<?php
include ('klasa.php');

session_start();

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
?>
"></a>
</body>
</html>