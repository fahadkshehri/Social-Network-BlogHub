<?php

require 'vendor/autoload.php';

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
use Aws\Credentials\CredentialProvider;
use Aws\S3\S3Client;

date_default_timezone_set('UTC');

$sdk = new Aws\Sdk([
    //'endpoint'   => 'http://localhost:8000',
    'region'   => 'us-west-2',
    'version'  => 'latest',
]);

$dynamodb = $sdk->createDynamoDb();
$marshaler = new Marshaler();
$tableName = 'posts';



class Posts{

    public function getAllPost(){

    }

    posts->addPost("New to css","Fahad", "this is text", "pic.jpg");


    public function addPost($title, $author, $text, $img){

        $item = $marshaler->marshalJson('
            {
                "title": "' . $title . '",
                "author": "' . $author . '",
                "text": "' . $text . '",
                "img": "' . $img . '",
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Item' => $item
        ];


        try {
            $result = $dynamodb->putItem($params);
            echo "Added item \n";

        } catch (DynamoDbException $e) {
            echo "Unable to add item:\n";
            echo $e->getMessage() . "\n";
        }

    }

    public function removePost($postID){
        $key = $marshaler->marshalJson('
            {
                "postID": "' . $postID . '"
            }
        ');


        $params = [
            'TableName' => $tableName,
            'Key' => $key,
        ];

        try {
            $result = $dynamodb->deleteItem($params);
            echo "Deleted item.\n";

        } catch (DynamoDbException $e) {
            echo "Unable to delete item:\n";
            echo $e->getMessage() . "\n";
        }
    }

    public function editPost($id, $title, $img, $text){
        $key = $marshaler->marshalJson('
            {
                "year": ' . $year . ',
                "title": "' . $title . '"
            }
        ');


        $eav = $marshaler->marshalJson('
            {
                ":r": 5.5 ,
                ":p": "Everything happens all at once.",
                ":a": [ "Larry", "Moe", "Curly" ]
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key,
            'UpdateExpression' =>
                'set info.rating = :r, info.plot=:p, info.actors=:a',
            'ExpressionAttributeValues'=> $eav,
            'ReturnValues' => 'UPDATED_NEW'
        ];

        try {
            $result = $dynamodb->updateItem($params);
            echo "Updated item.\n";
            print_r($result['Attributes']);

        } catch (DynamoDbException $e) {
            echo "Unable to update item:\n";
            echo $e->getMessage() . "\n";
        }
    }

}
?>
