<?php
require '../vendor/autoload.php';

date_default_timezone_set('UTC');

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

$sdk = new Aws\Sdk([
    'endpoint' => 'http://localhost:8000',
    'region' => 'us-west-2',
    'version' => 'latest',
    'scheme' => 'http',
    'credentials' => array(
        'key' => 'AKIAJBYOEUWWLD2CCPDQ',
        'secret' => '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',
    ),
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();

$tableName = 'bloghub-profiles';

$item = $marshaler->marshalJson('
    {
        "username": "fridha",
        "school": "UWB",
        "info": {
            "plot": "Nothing happens at all.",
            "rating": 0
        }
    }
');

$params = [
    'TableName' => $tableName,
    'Item' => $item,
];

try {
    $result = $dynamodb->putItem($params);
    echo "Added item: $year - $title\n";

} catch (DynamoDbException $e) {
    echo "Unable to add item:\n";
    echo $e->getMessage() . "\n";
}
