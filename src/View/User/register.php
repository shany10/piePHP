<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>inscription</h1>
        <form action="register" method="GET">
            <label for="email">Email : </label><br>
            <input name="email" type="email" name="email"><br>
            <label for="password">Password : </label><br>
            <input name="password" type="password" name="password">
            <input type="submit" value="envoyer">
        </form>
    </main>
</body>
</html>

<?php

if(isset($_POST['email']) && isset($_POST['password'])) {
    
    $classe = new Controller\UserController();
    $classe->registerAction();
}






