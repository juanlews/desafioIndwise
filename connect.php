<?php
    $user = 'root';
    $password = '';
    $db = 'ind_wise';
    
    $conn = new mysqli('localhost', $user, $password, $db) or die("Não rolou");
    echo "DB conectado <br>";
    $str = file_get_contents('producao.json');
    $json = json_decode($str, true);
           
    echo sizeof($json);
    //add novos itens ao banco (extraidos do arquivo producao.json)      
    for ($i = (0); $i < sizeof($json); $i++){
        $item = $json[$i];
                
        $item['createdAt'] = str_replace(array('Z'), '', $item['createdAt']);
        $item['createdAt'] = str_replace(array('T'), ' ', $item['createdAt']);
        $item['createdAt'] = str_replace(array('.'), ':', $item['createdAt']);
        $item['createdAt'] = substr($item['createdAt'], 0, -4);
               
        $item['updatedAt'] = str_replace(array('Z'), '', $item['updatedAt']);
        $item['updatedAt'] = str_replace(array('T'), ' ', $item['updatedAt']);
        $item['updatedAt'] = str_replace(array('.'), ':', $item['updatedAt']);
        $item['updatedAt'] = substr($item['updatedAt'], 0, -4);
                
        $item['pt'] = str_replace(array('Z'), '', $item['pt']);
        $item['pt'] = str_replace(array('T'), ' ', $item['pt']);
        $item['pt'] = str_replace(array('.'), ':', $item['pt']);
        $item['pt'] = substr($item['pt'], 0, -4);
                
        //print_r
        ( $timeCreAt = DateTime::createFromFormat('Y-m-d H:i:s', $item['createdAt']));
        //print_r
        ( $updatedAt = DateTime::createFromFormat('Y-m-d H:i:s', $item['updatedAt']));
        //print_r
        ( $pTime = DateTime::createFromFormat('Y-m-d H:i:s',$item['pt']));
        
        ($queryFind = "SELECT * FROM producao WHERE mongo_id=\"".$item['id']."\" ");
        ($result = $conn->query($queryFind));
        if ($result->num_rows > 0) {
        
        } else {
            $query = "INSERT INTO producao(unique_id, mongo_id, speed_in_sec, radio_id, production_time, created_at, updated_at)
            VALUES(\"".$item['uuid']."\" , \"".$item['id']."\" , \"".$item['sis']."\" , \"".$item['ri']."\" , \"".$pTime->format('Y-m-d H:i:s')."\" , \"".$timeCreAt->format('Y-m-d H:i:s')."\" , \"".$updatedAt->format('Y-m-d H:i:s')."\")";
            $insert_row = $conn->query($query);
                    
            if($insert_row){
            //print 'Success! ID of last inserted record is : ' .$conn->insert_id .'<br />'; 
            } else {
                die('Error : ('. $conn->error .') '. $conn->error); exit;
            }    
        }
    }
    //header("Location: localhost:8080/desafiowise/index.php");
?>