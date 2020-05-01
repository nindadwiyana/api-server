<?php
$url = 'localhost/RW/put.php';

$header = array(
'user: sep',
'token: 314e9e118b3026ce64b768b84a22d816'
);

$data = array(
'ID_MENU' => '50',
'NAMA_MENU' => 'PUDING LAPI'
);

$ch = curl_init();
//tentukan url tujuan $url(berisikan URL yg ingin dituju)
curl_setopt($ch, CURLOPT_URL, $url);
//mengabaikan ssl sertification /masuk tanpa mempedulikan sertifikat
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//didefinisikan menggunakan customreqs karena PUT merupakan bukan variabel global
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
//untuk masuk ke API atau autentifikasi karena kalau tidak server bisa down
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//berisi body atau data dalam array
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//jalankan semua fungsi curl 
$result = curl_exec($ch);

echo $result;