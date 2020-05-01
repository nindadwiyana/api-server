	<?php 
    header('Content-Type: application/json');
	
 		$servername = "localhost";
	    $username = "root";
	    $password = "";
	    $dbname = "gofood";
	
	    $conn = new mysqli($servername, $username, $password, $dbname);
	
	    $smethod = $_SERVER['REQUEST_METHOD'];
	    $headers = apache_request_headers();
	    parse_str(file_get_contents('php://input'), $_PUT);

		if(isset($_PUT['ID_MENU'])==1){
	    $user = $headers['user'];
		$token = $headers['token'];
	    $id_menu = $_PUT['ID_MENU'];
	    $nama_menu = $_PUT['NAMA_MENU'];
		}
	    

	    $result = array();
	
	    if ($smethod=='PUT') {
	            if (empty($user)||empty($token)) {
	                $result['status']['code'] = 400;
	                $result['status']['description'] = 'Masukkan Token';
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
	                    $sql = "UPDATE menu SET NAMA_MENU = '$nama_menu' WHERE ID_MENU = '$id_menu';";
	                    $conn->query($sql);
	                    $result['results'] = 'id'.$id_menu.'name updated';
	            }
	                
	        }
	    }
	        else{
	            $result['status']['code'] = 400;
	            $result['status']['description'] = 'Error Request';

	        }
	
	        echo json_encode($result);
