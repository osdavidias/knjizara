<?php
session_start();
include 'klasa.php';
$id=$_GET["id"];

$k=new baza();
$k->query('SELECT knjige.*, kategorije.* FROM knjige JOIN kategorije ON knjige.br_knjige=kategorije.br_kategorije WHERE kategorije.br_kategorije = :kat');
$k->bind(":kat", $id);
$rezultat=$k->dohvati();
echo "<pre>";
print_r($rezultat);
echo "</pre>";

?>