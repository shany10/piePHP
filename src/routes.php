<?php

include "./Core/Router.php";
Router::connect('/', ['Controller' => 'App', 'Action' => 'index']);
Router::connect('/register', ['Controller' => 'User', 'Action' => 'add']);
Router::connect('/user/{id}', ['Controller' => 'user', 'Action' => 'show']);



