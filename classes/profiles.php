<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
use Aws\Credentials\CredentialProvider;
use Aws\S3\S3Client;

date_default_timezone_set('UTC');

$sdk = new Aws\Sdk([
    'endpoint'   => 'http://localhost:8000',
    'region'   => 'us-west-2',
    'version'  => 'latest',
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();
$tableName = 'bloghub-profiles';


class Profiles {

  public function getProfile($profileID){
    $key = $marshaler->marshalJson('
    {
      "profileID": "'.$profileID.'"
    }

    ');

    $params = [
      'TableName' => $tableName,
      'Key' => $key
    ];

    echo "Querying for a profile given its id " . $profileID . "\n";

    try {
      $result = $dynamodb->query($params);

      echo "Query succeeded. \n";

      foreach ($result['Items'] as $profileID) {
      echo $marshaler->unmarshalValue(bloghub-profiles['profileID']) . "\n";
  }

} catch (DynamoDbException $e) {
  echo "Unable to query:\n";
  echo $e->getMessage() . "\n";
}
    }
  }

  public function deleteProfile($username){
    $key = $marshaler->marshalJson('
        {
            "username": "' . $username . '"
        }
    ');


    $params = [
        'TableName' => $tableName,
        'Key' => $key
    ];

    try {
        $result = $dynamodb->deleteItem($params);
        echo "Deleted profile with a user name item." . $username ."\n";

    } catch (DynamoDbException $e) {
        echo "Unable to delete item:\n";
        echo $e->getMessage() . "\n";
    }

  }


  public function editProfile(){}


}


 ?>
