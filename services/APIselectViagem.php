<?php

    $con = mysqli_connect("localhost", "root", "root", "agencia_de_viagens");
    $response = array();
    if($con){
        $sql = "select c1.nome as saida, c2.nome as chegada, v.horario
                    from viagem v
                    join rota r 
                    on v.id_rota = r.id_rota
                    join terminal_rodoviario t1
                    on t1.id_terminal = r.id_terminal_saida
                    join cidade c1
                    on c1.id_cidade = t1.id_cidade
                    join terminal_rodoviario t2
                    on t2.id_terminal = r.id_terminal_chegada
                    join cidade c2
                    on c2.id_cidade = t2.id_cidade;";
        $result = mysqli_query($con, $sql);
        if($result){
            header("Content-Type: application/json");
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]["saida"] = $row["saida"];
                $response[$i]["chegada"] = $row["chegada"];
                $response[$i]["horario"] = $row["horario"];
                $i++;
            }
            echo json_encode($response, JSON_PRETTY_PRINT); 
        }
    } else{
        echo "DB connection failed";
    }

?>