<?php

class DateNaissance{
    public $jour;
    public $mois;
    public $annee;
    //toString
    public function __toString(){
        return $this->jour."/".$this->mois."/".$this->annee;
    }

    public function __construct($j=1,$m=1,$a=2000){
        $this->jour=$j;
$this->mois=$m;
$this->annee=$a;
    }
     
}

$d=new DateNaissance();
echo $d;










?>