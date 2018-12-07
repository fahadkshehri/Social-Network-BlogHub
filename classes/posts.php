<?php
require '../vendor/autoload.php';

$dsn = 'mysql:host=aa1cqahmu0x18pk.cisqnd3qf2b5.us-west-2.rds.amazonaws.com;dbname=aa1cqahmu0x18pk;port=3306;charset=utf8';
$usr = 'BlogHubMaster';
$pwd = 'abdulfahadfatih';

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

// SELECT * FROM users WHERE id = ?
$selectStatement = $pdo->select()
    ->from('users');

$stmt = $selectStatement->execute();
$data = $stmt->fetch();

var_dump(data);

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
