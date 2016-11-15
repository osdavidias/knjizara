<html>
<head>

</head>


<body>
<?php
include "klase.php";
?>
<h2>Login:</h2>
<form method="post">
unsername:<br>	
<input type="text" name="user">
<br>lozinka:<br>
<input type="password" name="pass">
<br><input type="submit" name="dugme">
</form>	
<?php
if (isset($_POST["dugme"])) {
	$p=new baza();
$p->query("SELECT * FROM kupci WHERE username LIKE :u AND password LIKE :p");
$p->bind(":u", $_POST["user"]);
$pass=md5($_POST["pass"]);
$p->bind(":p", $pass);
$rezultat=$p->dohvati();

if (empty($rezultat) OR !$rezultat)
 {
	echo '<div ><b>Pogrešno korisničko ime ili lozinka!</b></div>';
}
	
else 
 {

	session_start();
	$_SESSION["user"]=$_POST["user"];
	$_SESSION["pass"]=$pass;
	header("location:profil_kupca.php");

}

}

?>




</body>

</html>