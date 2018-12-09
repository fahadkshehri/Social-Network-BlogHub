<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
use Aws\S3\S3Client;

date_default_timezone_set('UTC');



class S3 {

  public function uploadPic($imgPath,$username){
    $s3 = new Aws\S3\S3Client([
      'region'  => 'us-west-2',
      'version' => 'latest',
      'scheme' => 'http',
    ]);

    // Send a PutObject request and get the result object.
    $key = 'profile-'. $username .'.jpg';

    $result = $s3->putObject([
      'Bucket' => 'bloghub-profilepics',
      'Key'    => $key,
      'Body'   => 'this is the body!',
      'ACL' => 'public-read',
      'SourceFile' => $imgPath // use this if you want to upload a file from a local location
    ]);

    //Return the url for the uploaded img
    return $result["@metadata"]["effectiveUri"];

  }

}

?>
