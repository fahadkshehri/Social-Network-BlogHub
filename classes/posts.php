<?php
require 'vendor/autoload.php';

$dsn = 'mysql:host=localhost;dbname=bloghub;charset=utf8';
$usr = 'root';
$pwd = 'rootroot';

$pdo = new \Slim\PDO\Database($dsn, $usr, $pwd);


class Posts
{
    public function getAllPost()
    {
      // SELECT * FROM Posts
      $selectStatement = $GLOBALS['pdo']->select()
          ->from('posts');

      $stmt = $selectStatement->execute();
      $data = $stmt->fetchAll();
      return $data;
    }

    public function addPost($title, $author, $text, $img)
    {
      // INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
      $insertStatement = $GLOBALS['pdo']->insert(array('title', 'img_url', 'content', 'owner_id'))
                             ->into('posts')
                             ->values(array($title, $img, $text, $author));

      $insertId = $insertStatement->execute(false);
      return $insertID;
    }

    public function getPost($postID)
    {
      // SELECT * FROM users WHERE id = ?
      $selectStatement = $GLOBALS['pdo']->select()
                             ->from('posts')
                             ->where('id', '=', $postID);

      $stmt = $selectStatement->execute();
      $data = $stmt->fetch();
      return $data;
    }

    public function removePost($postID)
    {

    }

    public function editPost($id, $title, $img, $text)
    {
      // UPDATE users SET pwd = ? WHERE id = ?
      $updateStatement = $GLOBALS['pdo']->update(array('title' => $title,'img_url' => $img,'content' => $text))
                             ->table('posts')
                             ->where('id', '=', $id);

      $affectedRows = $updateStatement->execute();
    }

}
