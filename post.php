<?php 
    header('Content-Type: application/json');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gofood";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $smethod = $_SERVER['REQUEST_METHOD'];
    $headers = apache_request_headers();
    

    if(isset($_POST['NAMA_MENU'])==1){
        $user = $headers['user'];
        $token = $headers['token'];
        $id_restaurant = $_POST['ID_RESTAURANT'];
        $nama_menu = $_POST['NAMA_MENU'];
        $jenis_makanan = $_POST['JENIS_MAKANAN'];
        $jumlah_makanan = $_POST['JUMLAH_MAKANAN'];
        $harga = $_POST['HARGA'];
    }


    $result = array();


    if ($smethod=='POST') {
            if (empty($user)||empty($token)) {
                $result['status']['code'] = 400;
                $result['status']['description'] = 'Masukkan token dan user';
            }
            else {
                    $sql = "SELECT COUNT(user) as token FROM `api-users` where user = '$user' and token = '$token' ";
                    $result1 = $conn->query($sql);
                    $cek = $result1->fetch_assoc();
    
                    if ($cek['token'] == 0) {
                            $result['status']['code'] = 400;
                            $result['status']['description'] = 'wrong user or token';               
                }
                else
                {   

                    $result['status']['code'] = 'success';
                    $result['status']['description'] = 'Request OK';
                    $sql = "INSERT INTO menu (ID_RESTAURANT,NAMA_MENU,JENIS_MAKANAN,JUMLAH_MAKANAN,HARGA) VALUES ( '$id_restaurant', '$nama_menu','$jenis_makanan','$jumlah_makanan','$harga');";
                    $conn->query($sql);
                    $result['results'] ='menu ' .$nama_menu.' inserted';
            }
                
        }
    }
        else{
            $result['status']['code'] = 400;
            $result['status']['description'] = 'Error Request';
        }

        echo json_encode($result);
