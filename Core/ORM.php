<?php

namespace Core;

include "../env.php";

use PDO;
use PDOException;
class ORM
{

    public $database;

    function __construct()
    {
        try {
            $this->database = new PDO("mysql:host=localhost;dbname=piephp", $_ENV["user"], $_ENV["pwd"]);            
        }
        catch(PDOException $e){
            print "Erreur:" . $e->getMessage();
            die;
        }
    }

    public function create($table, $fields)
    {
        $virgul = '';
        $colonne_create = '';
        $colonne = '';
        $donne = '';

        foreach ($fields as $key => $value) {
            if ($key !== array_key_first($fields)) {
                $virgul = ', ';
            }

            $colonne_create = $colonne_create . $virgul . $key . " VARCHAR(100)";
            $colonne = $colonne . $virgul . $key;
            $donne = $donne . $virgul . "'$value'";
        }
        $requet = "CREATE TABLE $table
                (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                $colonne_create)";
        $requet = $this->database->prepare($requet);
        $requet->execute();

        $requet = "INSERT INTO $table ($colonne) VALUES ($donne)";
        $requet = $this->database->prepare($requet);
        $requet->execute();

        $requet = "SELECT id FROM $table WHERE " .
            array_key_first($fields) . " = " .
            "'" . $fields[array_key_first($fields)] . "'";
        $requet = $this->database->prepare($requet);
        $requet->execute();
        $result = $requet->fetch();
        
        return $result['id'];
    }

    public function read($table, $id)
    {
        $requet = "SELECT * FROM $table 
                    WHERE id = '$id'"; 
        $requet = $this->database->prepare($requet);
        $requet->execute();
        $result = $requet->fetch();
        return $result;
    }

    public function update($table, $id, $fields)
    {

        $requet = "UPDATE $table SET ";
        $virgul = '';
        foreach($fields as $key => $value) {
            if($key !== array_key_first($fields)) {
                $virgul = ', ';
            }
            $requet = $requet . $virgul . $key . ' = ' . "'$value'";
        }

        $requet = $requet . " WHERE id  = '$id'"; 
        $requet = $this->database->prepare($requet);
        return $requet->execute();
    }

    public function delete($table, $id)
    {
        $requet = "DELETE FROM $table WHERE id = '$id'";
        $requet = $this->database->prepare($requet);
        return $requet->execute();        
    }

    public function find($table, $params = ['WHERE' => '1', 'ORDER BY' => 'id ASC', 'LIMIT' => ''])
    {
      
    }

    function getQueryParams() {
        $orm = new ORM();

        $id = $orm->create('articles', array(
            'titre' => "un super titre",
            'content' => 'et voici une super article de blog',
            'author' => 'Rodrigue'
        ));

        $arr_of_id = $orm->read('articles' , $id);

        $arr = [$id => $arr_of_id];
        return  $arr;
    }
}






// $bool_update = $orm->update('articles', 1, array(
//     'titre' => "un super titre",
//     'content' => 'et voici un super article de blog',
//     'author' => 'Rodrigue'
// ));

// $bool_delete = $orm->delete(' articles ', 1);

// $orm->find('article');