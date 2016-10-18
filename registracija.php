<html>
<head>

</head>



<body>

<?php
session_start();
include ('klasa.php');
$z=new zaglavlje("REGISTRITAJTE SE:");
$z->linkovi("index.php", "login.php");


?>

<h3>Registracija:</h3>

<form method="post" enctype="multipart/form-data">

Ime:<br>
<input type="text" name="ime"
value="<?php if(!empty($_POST['ime']))
{
 echo $_POST['ime'];
} ?>" ><br>
Prezime:<br>
<input type="text" name="prezime" value="<?php if(!empty($_POST['prezime']))
{
 echo $_POST['prezime'];
} ?>"><br>
Adresa:<br>
<input type="text" name="adresa" value="<?php if(!empty($_POST['adresa']))
{
 echo $_POST['adresa'];
} ?>"><br>
Poštanski broj:<br>
<input type="text" name="post_broj" value="<?php if(!empty($_POST['post_broj']))
{
 echo $_POST['post_broj'];
} ?>"><br>
Mjesto:<br>
<input type="text" name="mjesto" value="<?php if(!empty($_POST['mjesto']))
{
 echo $_POST['mjesto'];
} ?>"><br>
Telefon:<br>
<input type="text" name="telefon" value="<?php if(!empty($_POST['telefon']))
{
 echo $_POST['telefon'];
} ?>"><br>

Email:<br>
<input type="text" name="mail" value="<?php if(!empty($_POST['mail']))
{
 echo $_POST['mail'];
} ?>"><br>
Username:<br>
<input type="text" name="username" value="<?php if(!empty($_POST['username']))
{
 echo $_POST['username'];
} ?>"><br>
Lozinka:<br>
<input type="password" name="password"><br>
Potvrdi lozinku:<br>
<input type="password" name="potvrda"><br>


<br><input type="submit" name="dugme" value="Pošalji">

<?php
if (isset($_POST["dugme"])) {



$ime=$_POST["ime"];
$prezime=$_POST["prezime"];
$adresa=$_POST["adresa"];
$post_broj=$_POST["post_broj"];
$mjesto=$_POST["mjesto"];
$telefon=$_POST["telefon"];
$mail=$_POST["mail"];
$username=$_POST["username"];
$password=$_POST["password"];
$potvrda=$_POST["potvrda"];

$b=new baza();
$b->query("SELECT * FROM kupci WHERE username LIKE :u OR email LIKE :e ");
$b->bind(":u", $username);
$b->bind(":e", $mail);
$r=$b->dohvati();

if ($r) {
  echo "<br> <b>KORISNIČKO IME ILI EMAIL ADRESA VEĆ SU REGISTRIRANI!</b>";
}

// provjera jesu li svi podaci unešeni i potvrda lozinke:
$provjera=new provjera();
if ($provjera->nije_prazno($ime, $prezime, $adresa, $post_broj, $mjesto, $telefon, $mail, $username, $password, $potvrda)
	!=="prazno" AND $provjera->potvrdi($password, $potvrda)=="isto" AND !($r)) {
	$password=md5($password);
    
 // unos podataka:
 $unos=new baza();
 $unos->query('INSERT INTO kupci(ime, prezime, grad, adresa, post_br, username, password, email, telefon)
 	VALUES (:ime, :prezime, :grad, :adresa, :post_br, :username, :password, :email, :telefon)'); 
 $unos->bind(":ime", $ime);
 $unos->bind(":prezime", $prezime);
 $unos->bind(":adresa", $adresa);
 $unos->bind(":grad", $mjesto);
 $unos->bind(":post_br", $post_broj);
 $unos->bind(":username", $username);
 $unos->bind(":password", $password);
 $unos->bind(":email", $mail);
 $unos->bind(":telefon", $telefon);
 $unos->execute();

// slanje maila:
 $posta=new mail($mail, "Dobrodošli u Knjižaru!", "Dobrodošli u našu knjižaru. Želimo vam ugodnu kupovinu i čitanje.",
 	"From: Knjižara <knjizara@knjizara.hr>");
 $posta->posalji();

	echo '<br> <b>Podaci uspješno unijeti</b>';
}

else
{
	echo "<br> <b>Niste dobro unijeli lozinku ili neko od traženih polja</b>";
}


}// kraj if isset dugme
?>

</body>




</html>