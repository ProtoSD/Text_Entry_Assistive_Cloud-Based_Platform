<?php
error_reporting(0);
$q = urldecode(htmlspecialchars(mb_strtolower(($_GET["q"]))));
$url_google = 'https://suggestqueries.google.com/complete/search?output=toolbar&client=chrome&hl=en&q=' . urlencode($q) . '';
$curl = get_data($url_google);
$array = json_decode($curl, true);
echo $array[1][0];
function get_data($url)
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

?>