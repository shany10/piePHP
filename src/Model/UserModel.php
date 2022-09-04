<?php

namespace Model;

include "../env.php";
use PDO;
use PDOException;
use Core\Entity;

class UserModel extends Entity {
    private $email;
    private $password;
    private $database;
    private static $relations;
    
    function __construct()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
        try {
            $this->database = new PDO("mysql:host=localhost;dbname=piephp",$_ENV["user"],$_ENV["pwd"]);
        }
        catch(PDOException $e){
            print "Erreur:" . $e->getMessage();
            die;
        }
    }

    function save() {
        $requet = "INSERT INTO users (email, password) VALUES ('$this->email','$this->password')";
        $requet = $this->database->prepare($requet);
        $requet->execute();
    }

    
}