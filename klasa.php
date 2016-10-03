<?php

class klasa{
    private $host = "localhost";
    private $user  = "root";
    private $pass  = "";
    private $dbname = "knjizara";
 
    private $p;
    private $error;
    private $stmt;
 
    public function __construct(){
        
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // utf8 slova
        $options = array(
        	PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
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

// metoda za ubacijvanje parametara
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

}// kraj klase



?>