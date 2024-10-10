<?php

    $con = mysqli_connect("localhost", "root", "root", "agencia_de_viagens");
    $response = array();
    if($con){
        $sql = "select * from passageiro";
        $result = mysqli_query($con, $sql);
        if($result){
            header("Content-Type: application/json");
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]["id_passageiro"] = $row["id_passageiro"];
                $response[$i]["nome"] = $row["nome"];
                $response[$i]["cpf"] = $row["cpf"];
                $response[$i]["id_cidade"] = $row["id_cidade"];
                $response[$i]["sexo"] = $row["sexo"];
                $response[$i]["telefone"] = $row["telefone"];
                $response[$i]["email"] = $row["email"];
                $response[$i]["senha"] = $row["senha"];
                $i++;
            }
            echo json_encode($response, JSON_PRETTY_PRINT); 
        }
    } else{
        echo "DB connection failed";
    }

?>