<?php

namespace Controller;

use Model\UserModel;

class UserController extends \Core\Controller
{
    

    function addAction()
    {
        echo  $this->render('register'); // Va rendre la vue src/View/User/register.php  
    }

    function registerAction()
    {
    
        $params = $this->request->getQueryParams();
        $user = new UserModel($params);
        if (!$user -> id) { 
            $user -> save();
            self::$_render = "Votre compte a ete cree." . PHP_EOL;
            echo self::$_render;
        }
    }

    public function show($id) {
        echo "ID de l'utilisateur a afficher : $id" . PHP_EOL;
    }
}
