<?php
require 'vendor/autoload.php';

$dsn = 'mysql:host=localhost;dbname=bloghub;charset=utf8';
$usr = 'root';
$pwd = 'rootroot';

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

// SELECT * FROM users WHERE id = ?
$selectStatement = $pdo->select()
    ->from('follows');

$stmt = $selectStatement->execute();
$data = $stmt->fetchAll();

var_dump($data);

class Posts
{

    public function getAllPost()
    {

    }

    public function addPost($title, $author, $text, $img)
    {

    }

    public function removePost($postID)
    {

    }

    public function editPost($id, $title, $img, $text)
    {

    }

}
