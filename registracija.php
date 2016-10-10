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




</body>




</html>