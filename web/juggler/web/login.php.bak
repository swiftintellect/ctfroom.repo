<?php
require_once 'config.php';
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$json = json_decode(file_get_contents("php://input"));

// $auth = base64_encode($username.":".$password);

$result = "";

if (empty($json->username)) {
    $result = '{"status":"error","message":"Username missing"}';
} else if(empty($json->password)){
    $result = '{"status":"error","message":"password missing"}';
} else {
    $username = $json->username;
    $password = $json->password;
    $token = generateJWT($username, $secret);
    if($password == $token){
        $flag = implode("-", str_split(md5($secret), 4));
        $result = '{"status":"success","message":"Successfully authenticated","flag":"'.$flag.'","token":"'.$token.'"}';
    } else {
        $result = '{"status": "error", "message":"Invalid username or password"}';
    }
}

//Generate JWT token using username and token
function generateJWT($username, $secret)
{
    $sec =  $secret. ":". date("d m Y h:i:s") . ":" . $username;
    // Create token header as a JSON string
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    // Create token payload as a JSON string
    $payload = json_encode(['user_id' => $username]);
    // Encode Header to Base64Url String
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    // Encode Payload to Base64Url String
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    // Create Signature Hash
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $sec, true);
    // Encode Signature to Base64Url String
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    // Create JWT
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    return $jwt;
}

echo $result;

?>