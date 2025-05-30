<?php  
class Produit{
    private $codep;
    private $intitule;

    public function GetCodep(){
        return $this->codep;
    }
    public function SetCodep($value){
         $this->codep=$value;
    }
    public function __construct($cop=1000,$intitule="default Prod"){
        $this->codep=$cop;
        $this->intitule=$intitule;
    }
    
    public function __toString(){
        return "code P :  ".$this->codep." - Intitule : ".$this->intitule."<br>";
    }

// coder __eq


    


}

/*$p=new Produit();
$p2=new Produit(2000,"Ordinateur");
echo $p;//echo : convert $p tp string (__toString) - display strify $p*/  

//vous un fichier csv ou txt contenant une lliste de produits : charger les produits et pour chaque produit créer un objet Produit et y ajouter dans la liste (le tableau $list)



?>