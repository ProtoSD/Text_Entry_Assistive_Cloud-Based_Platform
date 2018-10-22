<?php
error_reporting(0);
// this file has reference to '$bingTextAnalyticsKey' variable that needs to hold the Microsoft API key
include("credentials.php");
$q = htmlspecialchars(($_GET["q"]));

//$q = urldecode($q);
$data =array (
    'documents' =>
        array (
            0 =>
                array (
                    'language' => 'en',
                    'id' => '1',
                    'text' => $q,
                )
        ),
);

$data_string = json_encode($data);

$ch = curl_init('https://westus.api.cognitive.microsoft.com/text/analytics/v2.0/entities');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Ocp-Apim-Subscription-Key: $bingTextAnalyticsKey",
        'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close ($ch);
//print_r( $result );

$return =  json_decode($result, true);

/*
print "<pre>";
print_r( $return);
print "</pre>";
*/

for ($i = 0; $i <= count($return[documents][0][entities])-1; $i++) {
    echo $return[documents][0][entities][$i][wikipediaId]."|";
}




?>