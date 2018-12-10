<?php
  include 'getPDO.php';
  $pdo = getPDO();
  var_dump($pdo);

  $users = $pdo->select()
      ->from('users')
      ->execute()
      ->fetchAll();

  var_dump($users);

  $posts = $pdo->select()
      ->from('posts')
      ->execute()
      ->fetchAll();

  var_dump($posts);

  $follows = $pdo->select()
      ->from('follows')
      ->execute()
      ->fetchAll();

  var_dump($follows);
?>