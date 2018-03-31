<?php
    // Verifica se existe a variável txtnome
    
    // Conexao com o banco de dados
    $server = "localhost";
    $user = "root";
    $senha = "";
    $base = "ind_wise";
    $conexao = mysqli_connect($server, $user, $senha) or die("Erro na conexão!");
    mysqli_select_db($conexao, $base);
    
    $sql = "SELECT production_time FROM producao GROUP BY production_time ";
    sleep(1);
    
    $result = mysqli_query($conexao ,$sql);
    $cont = mysqli_affected_rows($conexao);
    
    // Verifica se a consulta retornou linhas 
    if ($cont > 0) {
       $return = array();
       foreach($result as $item){
            $indice = explode(' ', $item['production_time']);
            if(isset($return[$indice[0]])){
                $return[$indice[0]][] = $item;
            }else{
                 $return[$indice[0]] = [];
                 $return[$indice[0]][] = $item;
            }
        }
        foreach($return as $i => $dia){
            echo json_encode( $a = [$i => sizeof($dia)]).',';
        }
    } else {
       
        echo "Não foram encontrados registros!";
    }
?>