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


class Profiles
{
    public function addProfile($username)
    {
      $item = $GLOBALS['marshaler']->marshalJson('
          {
              "username": "' . $username . '"
          }
      ');

      $params = [
          'TableName' => $GLOBALS['tableName'],
          'Item' => $item
      ];


      try {
          $result = $GLOBALS['dynamodb']->putItem($params);
          echo "Added item.\n";

      } catch (DynamoDbException $e) {
          echo "Unable to add item:\n";
          echo $e->getMessage() . "\n";
      }
    }

    public function getProfile($username)
    {
        $key = $GLOBALS['marshaler']->marshalJson('
            {
                "username": "' . $username . '"
            }
        ');

        $params = [
            'TableName' => $GLOBALS['tableName'],
            'Key' => $key,
        ];


        try {
            $result = $GLOBALS['dynamodb']->getItem($params);
            return $result['Item'];
        } catch (DynamoDbException $e) {
            echo "Unable to query:\n";
            echo $e->getMessage() . "\n";
        }
    }

    public function deleteProfile($username)
    {
        $key = $GLOBALS['marshaler']->marshalJson('
            {
                "username": "' . $username . '"
            }
        ');

        $params = [
            'TableName' => $GLOBALS['tableName'],
            'Key' => $key,
        ];

        try {
            $result = $GLOBALS['dynamodb']->deleteItem($params);
            echo "Deleted profile with a user name item." . $username . "\n";

        } catch (DynamoDbException $e) {
            echo "Unable to delete item:\n";
            echo $e->getMessage() . "\n";
        }

    }

    public function editProfile($name, $username, $img, $bio)
    {
        $marshaler = new Marshaler();

        $keyString = '{"username": "' . $username . '"}';
        $key = $marshaler->marshalJson($keyString);

        $eavString  = '
            {
                ":name": "'.$name.'" ,
                ":img": "'.$img.'",
                ":bio": "'.$bio.'"
            }
        ';
        $eav = $marshaler->marshalJson($eavString);

        $params = [
            'TableName' => $GLOBALS['tableName'],
            'Key' => $key,
            'UpdateExpression' =>
                'set profileName = :name, img=:img, bio=:bio',
            'ExpressionAttributeValues'=> $eav,
            'ReturnValues' => 'UPDATED_NEW'
        ];

        try {
            $result = $GLOBALS['dynamodb']->updateItem($params);

        } catch (DynamoDbException $e) {
            echo "Unable to update item:\n";
            echo $e->getMessage() . "\n";
        }

    }

}
