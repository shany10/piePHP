<?php

namespace Core;

use Router;

class Controller
{
    static public $_render;
    public $request;

    function __construct()
    {
        $this->request = new ORM();
    }
    
    protected function render($view, $scope = [])
    {
        extract($scope);
        $f = implode(DIRECTORY_SEPARATOR, [
            dirname(__DIR__), 'src', 'View',
            str_replace('Controller', '', basename(get_class($this))), $view
        ]) . '.php';
        if (file_exists($f)) {
            ob_start();
            include($f);
            $view = ob_get_clean();
            ob_start();
            include(implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'src', 'View', 'index']) . '.php');
            return self::$_render = ob_get_clean();
        }
    }
}
