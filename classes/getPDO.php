<?
function getPDO()
{
    $host = 'localhost';
    $user = getenv('RDS_USERNAME');
    if (!$user) {
        $user = 'root';
    } else {
        $host = 'bloghub-rds.cisqnd3qf2b5.us-west-2.rds.amazonaws.com';
    }
    error_log($user);
    $password = getenv('RDS_PASSWORD');
    if (!$password) {
        $password = 'rootroot';
    }

    error_log($host);
    error_log($user);
    error_log($password);
    error_log(getenv('RDS_DB_NAME'));
    $dsn = 'mysql:host='.$host.';dbname=bloghub;charset=utf8';

    return new \Slim\PDO\Database($dsn, $user, $password);
}
