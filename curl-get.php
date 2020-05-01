<?php
$url = 'localhost/RW/get.php';

$header = array(
'user: sep',
'token: 314e9e118b3026ce64b768b84a22d816'
);


$data = array (
    'key' => '50'
    );
    
    $params = http_build_query($data);

$ch = curl_init();

//tentukan url tujuan
curl_setopt($ch, CURLOPT_URL, $url.'?'.$params );
//mengabaikan ssl sertification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//untuk masuk ke API atau autentifikasi
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$result = curl_exec($ch);

echo $result;





