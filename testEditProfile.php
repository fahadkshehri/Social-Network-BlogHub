<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
use Aws\S3\S3Client;

date_default_timezone_set('UTC');



$sdk = new Aws\Sdk([
    'endpoint' => 'http://localhost:8000',
    'region' => 'us-west-2',
    'version' => 'latest',
    'scheme' => 'http',
    'credentials' => [
         'key' => 'not-a-real-key',
         'secret' => 'not-a-real-secret',
     ],
]);


$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();
$tableName = 'bloghub-profiles';


$name = 'fahad';
$username = 'fahad';
$img = "pic.jpg";
$bio = "sometext";

$key = $marshaler->marshalJson('{"username": "' . $username . '"}');


$eav = $marshaler->marshalJson('
    {
        ":name": "'.$name.'" ,
        ":img": "'.$img.'",
        ":bio": "'.$bio.'"
    }
');

$params = [
    'TableName' => $tableName,
    'Key' => $key,
    'UpdateExpression' =>
        'set profileName = :name, img=:img, bio=:bio',
    'ExpressionAttributeValues'=> $eav,
    'ReturnValues' => 'UPDATED_NEW'
];

try {
    $result = $dynamodb->updateItem($params);
    echo "done";

} catch (DynamoDbException $e) {
    echo "Unable to update item:\n";
    echo $e->getMessage() . "\n";
}





?>
