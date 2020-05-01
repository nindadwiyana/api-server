<?php
$url = 'localhost/RW/post.php';

$header = array(
'user: sep',
'token: 314e9e118b3026ce64b768b84a22d816'
);

$data = array(

'ID_RESTAURANT' =>'10'
 /*id restaurant yang tersedia 
8 (KFC),
9(rumah makan oke),
10(Mie TITI),
11(Coto Paraikatte),
12(Rumah makan Bravo),
13(rumah makan ulu juku),
14(New diner seafood)*/ ,
'NAMA_MENU' =>'kolak pisang' /*contoh nama menu nasi goreng gila*/,
'JENIS_MAKANAN' =>'Dessert' /*jenis makanan contoh "nasi goreng"*/,
'JUMLAH_MAKANAN' =>'20',
'HARGA' =>'10000'  /*contoh format harga "15000"*/ ,

);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//menggunakan method post
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);

echo $result;