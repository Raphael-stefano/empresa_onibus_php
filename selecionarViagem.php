<?php 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /*echo $_SESSION['cidade1'] . "<br>";
    echo $_SESSION['cidade2'] . "<br>";
    echo $_SESSION['horario1'] . "<br>";*/

    $cidade1 = $_SESSION['cidade1'];
    $cidade2 = $_SESSION['cidade2'];
    $dataIda = $_SESSION['horario1'];

    include_once('services/API.php');

    $stringfy = "";
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
                    on c2.id_cidade = t2.id_cidade
                    where c1.id_cidade = '$cidade1' and c2.id_cidade = '$cidade2' and v.horario like '$dataIda%';";
        $result = mysqli_query($con, $sql);
        if($result && mysqli_num_rows($result) > 0){
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]["saida"] = $row["saida"];
                $response[$i]["chegada"] = $row["chegada"];
                $response[$i]["horario"] = $row["horario"];
                $i++;
            }

            
            foreach($response as $item){
                $saida = $item['saida'];
                $chegada = $item['chegada'];
                $horario = $item['horario'];
    
                ob_start(); 
                include "components/viagem.php"; 
                $stringfy .= ob_get_clean();
            }
            //echo $stringfy;
        } else{
            $stringfy = 'Nao há viagens marcadas para esse dia';
        }
    } else{
        echo 'Falha ao conectar com o banco de dados';
    }

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <?php include "components/header.php"; ?>

    <div class='exibir-viagens'>
        <?php echo $stringfy; ?>
    </div>

    <?php include "components/footer.php"; ?>

</body>
</html>