<?php 
    header('Content-Type: application/json');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gofood";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    $smethod = $_SERVER['REQUEST_METHOD'];
    $headers = apache_request_headers();

    if(isset($_GET['key'])==1){
    $user = $headers['user'];
    $token = $headers['token'];
    $key = $_GET['key'];
    }
    
    if ($smethod=='GET') {
            if (empty($user)||empty($token)) {
                $result['status']['code'] = 400;
                $result['status']['description'] = 'Masukkan token';
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
                        
                    $sql = "SELECT NAMA_MENU, HARGA FROM menu where ID_MENU='$key'";
                    $q = $conn->query($sql);
                    $result['results'] =  $q->fetch_all(MYSQLI_ASSOC);
            }
                
        }
    }
        else{
            $result['status']['code'] = 400;
            $result['status']['description'] = 'Error Request';
        }

        echo json_encode($result);
