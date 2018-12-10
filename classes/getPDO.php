<?
function getPDO()
{
    error_log(getenv('RDS_HOSTNAME'));
    error_log(getenv('RDS_PORT'));
    error_log(getenv('RDS_DB_NAME'));
    error_log(getenv('RDS_USERNAME'));
    error_log(getenv('RDS_PASSWORD'));
    $dsn = 'mysql:host=localhost;dbname=bloghub;charset=utf8';
    $usr = 'root';
    $pwd = 'rootroot';

    return new \Slim\PDO\Database($dsn, $usr, $pwd);
}
