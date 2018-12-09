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


$s3 = new Aws\S3\S3Client([
	'region'  => 'us-west-2',
	'version' => 'latest',
  'scheme' => 'http',
]);


$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();
$tableName = 'bloghub-profiles';


class Profiles
{


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

    public function uploadPic($imgPath,$username){
      // Send a PutObject request and get the result object.
      $key = 'profile-'. $username .'.jpg';

      $result = $GLOBALS['s3']->putObject([
      	'Bucket' => 'bloghub-profilepics',
      	'Key'    => $key,
      	'Body'   => 'this is the body!',
        'ACL' => 'public-read',
      	'SourceFile' => $imgPath // use this if you want to upload a file from a local location
      ]);

      // Print the body of the result by indexing into the result object.
      return $result["@metadata"]["effectiveUri"];

    }

    public function editProfile($name, $username, $img, $bio)
    {
        $name = 'fahad';
        $username = 'fahad';
        $img = "pic.jpg";
        $bio = "sometext";

        $marshaler = new Marshaler();

        echo $name ." ". $username ." ". $img ." ". $bio;
        if($name == " " || $username == " " || $img == " " || $bio == " "){
          echo "Empty spaces!";

        }

        $key = $marshaler->marshalJson('{"username": "' . $username . '",}');

        $eav = $marshaler->marshalJson('
            {
                ":name": "'.$name.'" ,
                ":img": "'.$img.'",
                ":bio": "'.$bio.'",
            }
        ');

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
