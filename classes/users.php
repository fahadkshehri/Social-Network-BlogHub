<?php
require 'vendor/autoload.php';

$dsn = 'mysql:host=localhost;dbname=bloghub;charset=utf8';
$usr = 'root';
$pwd = 'rootroot';

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

function registerUser($username, $password)
{
    $dsn = 'mysql:host=localhost;dbname=bloghub;charset=utf8';
    $usr = 'root';
    $pwd = 'rootroot';

    $pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

    $insertStatement = $pdo->insert(array('username', 'password'))
        ->into('users')
        ->values(array($username, hash('sha512', $password)));

    $insertId = $insertStatement->execute();
    echo $insertId;
}

class User
{

    public function login($username, $password)
    {

    }

    public function register($username, $password)
    {
        $insertStatement = $pdo->insert(array('username', 'password'))
            ->into('users')
            ->values(array($username, hash('sha512', $password)));

        $insertId = $insertStatement->execute();
        echo $insertId;
    }
}
