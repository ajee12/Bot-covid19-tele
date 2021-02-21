<?php
$chat_id = 1640488339;
$token = "1616382562:AAGHiFPsuXq8WyyloF63jvH2iSemtJXwQNc";
function get($server)
{
    $country = "id";
    $server = curl_init("https://covid19.mathdro.id/api/countries/$country/confirmed");
    curl_setopt($server, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($server);
    return json_decode($response);
}

//ambil data
$result = get($server);
$data = [
    $update = $result[0]->lastUpdate,
    $negara = $result[0]->countryRegion,
    $positif = $result[0]->confirmed,
    $meninggal = $result[0]->deaths,
    $sembuh = $result[0]->recovered,
];

$result = "Informasi Covid19 $negara " .  " update: $update" . " positif: " . number_format($positif, 0)  .
    "  sembuh: " . number_format($sembuh, 0)  .  " meniggal :" . number_format($meninggal, 0);
$url = ("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$result");
$curl = curl_init($url);
curl_exec($curl);
curl_close($curl);
