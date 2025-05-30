<?php
//EX1
//1-

$a = true;
if($a = false)
    print("True");
else
    print("False");

//False

//2-GET est utilisé pour récupérer des données comme la recherche, le filtrage ou la pagination, tandis que POST est utilisé pour soumettre des formulaires, modifier des données ou créer de nouvelles ressources.

//3-

//4-récuperer un ou plusieurs elements

//5-

$V = array('Agadir','Meknes','Ifran','tata');
$P = array('Maroc','France','Suisse','USA');

$t = array_merge($V,$P);

for($i=0;$i<count($t);$i++)
    {
        echo $t[$i].'-';
    }
//

//EX2
class Produit {
    public $codeproduit;
    public $designation;
    public $prix;
    public $quantite_en_stock;

    
}
?>



