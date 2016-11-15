<!Doctype-html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stil.css">
</head>

<body>
<?php
session_start();
include 'klase.php';
$knjiga=new baza();
$knjiga->query('SELECT * FROM knjige WHERE br_knjige= :k');
$knjiga->bind("k", $_GET["k"]);
$rezultat=$knjiga->dohvati();

?>

<div class="knjiga">
<img id="velika" src=<?php echo '" slike/'.$rezultat[0]->slika.'"'; ?>>
</div>








</body>


</html>