<?php

namespace Core;

use Router;

class Core
{

    public function run($base_uri)
    {
        // echo __CLASS__ . "[ OK ]" . PHP_EOL;
        // $taille = strlen($base_uri);
        include 'src/routes.php';
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace($base_uri, '', $url);

        if (substr($url, 1) == "" || substr($url, 1) == "register") {
            $route =  new Router();
            $url = $route->get($url);
            $this->control($url);
            return;
        }
        $url = substr($url, 1);
        $occurence = stripos($url, "/");

        if ($occurence === false) {
            $this->control_get();
            return;
        }

        $tableau = explode("/", $url);

        if (isset($_GET['id'])) {
            $route =  new Router();
            $url = $route->get('/user/{id}');
            $this->control($url);
            return;
        }
        $url = ['Controller' => $tableau[0], 'action' => $tableau[1]];
        $this->control($url);
    }


    function control($url)
    {
        $file = './src/' . array_key_first($url) . '/' .
            $url[array_key_first($url)] . array_key_first($url) . '.php';

        if (!file_exists($file)) {
            echo "error 404";
            return;
        }

        $route = array_key_first($url) . '\\' . $url[array_key_first($url)] . array_key_first($url);
        $method = $url[array_key_last($url)] . array_key_last($url);

        $classe = new $route();

        if ($url[array_key_last($url)] == 'show') {

            $classe->show($_GET['id']);
            return;
        }

        if (!method_exists($classe, $method)) {
            echo "error 404";
            return;
        }
        $classe->$method();
    }


    public function control_get()
    {
        if (!isset($_GET['c'])) {
            $_GET['c'] = 'AppController';
        }

        $url = ['Controller' => $_GET['c'], 'action' => $_GET['a']];
        $this->control($url);
    }
}
