<?php
require 'vendor/autoload.php';

include 'getPDO.php';

function registerUser($username, $password)
{
    try {
        $pdo = getPDO();

        $selectStatement = $pdo->select()
            ->from('users')
            ->where('username', '=', $username);
        $pdostatement = $selectStatement->execute();

        if ($pdostatement->rowCount() > 0) {
            return 'Username already exists.';
        } else {
            $insertStatement = $GLOBALS['pdo']->insert(array('username', 'password'))
                ->into('users')
                ->values(array($username, hash('sha512', $password)));

            $insertId = $insertStatement->execute();
            return '';
        }
    } catch (PDOException $e) {
        return 'There was an error registering the account. Please try again.';
    }
}

function loginUser($username, $password)
{
    try {
        $pdo = getPDO();

        $selectStatement = $pdo->select()
            ->from('users')
            ->where('username', '=', $username)
            ->where('password', '=', hash('sha512', $password));
        $pdostatement = $selectStatement->execute();

        if ($pdostatement->rowCount() == 0) {
            return 'Login failed; that username/password combination does not exist.';
        } else {
            $_SESSION['username'] = $username;
            header('Location: ./');
        }
    } catch (PDOException $e) {
        return 'There was an error logging in. Please try again.';
    }
}
