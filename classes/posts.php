<?php
require '../vendor/autoload.php';

$dsn = 'mysql:host=bloghub-rds.cisqnd3qf2b5.us-west-2.rds.amazonaws.com:3306;dbname=bloghub;charset=utf8';
$usr = 'BlogHubMaster';
$pwd = 'abdulfahadfatih';

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);

// SELECT * FROM users WHERE id = ?
$selectStatement = $pdo->select()
    ->from('users');

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
?>
