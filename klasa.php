<?php

class baza{
    private $host = "localhost";
    private $user  = "root";
    private $pass  = "";
    private $dbname = "knjizara";
 
    private $p;
    private $error;
    private $stmt;
 // pri instanciranju novog objekta iz klase automatski otvara konekciju na bazu
    public function __construct(){
        
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // utf8 slova
        $options = array(
        	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        );
        // novi PDO
        try{
            $this->p = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // greške
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

public function query($query){
    $this->stmt = $this->p->prepare($query);
}

// metoda za ubacijvanje parametara, ovisno o tipu ubacuje odgovarajući parametar
public function bind($parametar, $vrijednost, $tip = null){
    if (is_null($tip)) {
        switch (true) {
            case is_int($vrijednost):
                $tip = PDO::PARAM_INT;
                break;
            case is_bool($vrijednost):
                $tip = PDO::PARAM_BOOL;
                break;
            case is_null($vrijednost):
                $tip = PDO::PARAM_NULL;
                break;
            default:
                $tip = PDO::PARAM_STR;
        }
    }
    $this->stmt->bindValue($parametar, $vrijednost, $tip);
}

public function execute(){
    return $this->stmt->execute();
}

public function dohvati()
{
$this->execute();
return $this->stmt->fetchAll(PDO::FETCH_OBJ);

}// kraj dohvati


}// kraj klase baza

class zaglavlje {
private $poruka;
private $linkovi;

function __construct($p)
// poruka za zaglavlje:
{
    $this->poruka=$p;
    echo "<h1>".$this->poruka."</h1>";
}

//linkovi:
function linkovi ($l){
$this->linkovi=func_get_args($l);

foreach ($this->linkovi as $key => $value) {
    echo '<a href="'.$value.'"> '.$value.' |</a>';
}
}

}// kraj klase zaglavlje


class provjera 
// provjerava unos polja i potvrdu lozinke
{
private $parametri; 
private $lozinka;
private $potvrda;

function nije_prazno()
// provjera popunjenosti podataka
{
 
 
  $this->parametri=func_get_args();
  foreach ($this->parametri as $key => $value) {
    if (empty($value)) {
      return "prazno";
    }

  }
}

function potvrdi ($a, $b)
// provjera lozinke
{
   $this->lozinka=$a;
   $this->potvrda=$b; 
if ($this->potvrda==$this->lozinka) {
    return "isto";
}

}



}// kraj klase provjera


?>