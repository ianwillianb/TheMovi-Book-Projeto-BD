<?php
/**
 * Created by PhpStorm.
 * User: jcsan
 * Date: 30/05/2017
 * Time: 22:20
 */



$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?include_adult=false&page=1&query=Titanic&language=pt-BR&api_key=a5e0117d90378221c479b5fef9891b17",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $array = json_decode($response, true);

    foreach ($array['results'] as $a => $a_value)
    {
        echo $a_value['title'];
        echo "\n";
    };
}




