<?php

$q = htmlspecialchars(($_GET["q"]));

$url = 'https://en.wikipedia.org/w/api.php?action=query&list=search&srnamespace=0&srprop=snippet&format=json&origin=*&prop=links|extracts|categories|images&srsearch='.urlencode($q);
$json = file_get_contents($url);

/*
print "<pre>";print_r($json);print "</pre>";
*/

$data = json_decode($json,true);


try {
    if ($data) {
if ($data['query']['search'][0]['title']) {
   // $result =  str_replace(" ","_",$data['query']['search'][0]['title']);
    $result =  $data['query']['search'][0]['title'];
    echo $result;
}
}
} catch (Exception $e) {}

//

/*
print "<pre>";
print_r($data);
print "</pre>";

/*
$titles = array();
foreach ($json[query] as $page) {
    $titles[] = $page[search][0][title];
    echo $page[search][0][title];
}
*/


?>