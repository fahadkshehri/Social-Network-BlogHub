<?
function getPDO()
{
    $dsn = 'mysql:host=localhost;dbname=bloghub;charset=utf8';
    $usr = 'root';
    $pwd = 'rootroot';

    return new \Slim\PDO\Database($dsn, $usr, $pwd);
}
