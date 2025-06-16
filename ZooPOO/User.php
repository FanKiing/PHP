<?php  

class User{
    private $idUser;
    private $email;

    private $cin;
    private $role;

    public function __construct($idU,$email,$c,$r){
        $this->idUser=$idU;
        $this->email=$email;
        $this->cin=$c;
        $this->role=$r;
    }

    public function __toString(){
        return "id:{$this->idUser}-email: {$this->email} - cin : {$this->email}";
       
    }

    public function equal($u){
           return $u->idUser == $this->idUser && $u->email == $this->email;
    }

    public function getEmail(){

        return $this->email;
    }
    public function setEmail($newEmail){
        $this->email=$newEmail;
    }
}

class Visiteur extends User{
    private $age;
    //surcharger le constructeur 
    public function __construct($idU,$email,$c,$r,$age){
       parent::__construct($idU,$email,$c,$r);
       $this->age=$age;

    }
    //surcharger toString
    public function __toString(){
        return parent::__toString()."age : {$this->age}";

    }
    
    public function equal($v){
           return parent::equal($v) &&$this->age==$v->age;
    }
}


$v=new Visiteur(1,"email","jb","user",15);
echo $v;










?>