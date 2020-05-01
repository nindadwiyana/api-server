	<?php 
	    header('Content-Type: application/json');
	
	    $servername = "localhost";
	    $username = "root";
	    $password = "";
	    $dbname = "gofood";
	
	    $conn = new mysqli($servername, $username, $password, $dbname);
	
	    $smethod = $_SERVER['REQUEST_METHOD'];
	    $headers = apache_request_headers();
	    parse_str(file_get_contents('php://input'), $_DELETE);
	    

		if(isset($_DELETE['ID_MENU'])==1){
  	 	$user = $headers['user'];
    	$token = $headers['token'];
    	$id_menu = $_DELETE['ID_MENU'];
    	
    	}
	
	    $result = array();
	    $text = array_keys($_DELETE);
	
	    if ($smethod=='DELETE') {
	          if (empty($user)||empty($token)) {
				$result['status']['code'] = 400;
			    $result['status']['description'] = 'masukkan user dan token';
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
	
	                    $result['status']['code'] = $id_menu;
	                    $result['status']['description'] = 'Request OK';
	                    $sql = "DELETE FROM menu WHERE ID_MENU='$id_menu';";
	                    $conn->query($sql);
	                    $result['results'] = 'delete menu dengan id : '.$id_menu.' from database';
	            }
	                
	        }
	    }
	        else{
	            $result['status']['code'] = 400;
	            $result['status']['description'] = 'Error Request';
	        }
	
	        echo json_encode($result);
