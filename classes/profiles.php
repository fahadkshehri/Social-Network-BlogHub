<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\Exception\DynamoDbException;

date_default_timezone_set('UTC');

use Aws\DynamoDb\Marshaler;

$sdk = new Aws\Sdk([
    'region' => 'us-west-2',
    'version' => 'latest',
    'scheme' => 'http',
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();
$tableName = 'bloghub-profiles';



class Profiles
{

    getProfile("fatih");

    public function getProfile($username)
    {
        $sdk = new Aws\Sdk([
            'region' => 'us-west-2',
            'version' => 'latest',
            'scheme' => 'http',
        ]);

        $dynamodb = $sdk->createDynamoDb();
        $marshaler = new Marshaler();
        $tableName = 'bloghub-profiles';

        $key = $marshaler->marshalJson('
            {
<<<<<<< HEAD
                "profileID": "' . $username . '"
=======
                "username": "' . $profileID . '"
>>>>>>> 4167ceb2f633b498c0fafcda8a9a4c48fd74d3a5
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key,
        ];

        echo "Querying for a profile given its id " . $username . "\n";

        try {
            $result = $dynamodb->query($params);

            echo "Query succeeded. \n";

            foreach ($result['Items'] as $username) {
                echo $marshaler->unmarshalValue(bloghub - profiles['username']) . "\n";
            }

        } catch (DynamoDbException $e) {
            echo "Unable to query:\n";
            echo $e->getMessage() . "\n";
        }
    }

    public function deleteProfile($username)
    {
        $key = $marshaler->marshalJson('
            {
                "username": "' . $username . '"
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key,
        ];

        try {
            $result = $dynamodb->deleteItem($params);
            echo "Deleted profile with a user name item." . $username . "\n";

        } catch (DynamoDbException $e) {
            echo "Unable to delete item:\n";
            echo $e->getMessage() . "\n";
        }

    }

    public function editProfile()
    {}

}
