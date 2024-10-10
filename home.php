<?php 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once('services/API.php');

    $request = mysqli_query($con, "select id_cidade, nome from cidade;");
    while ($row = mysqli_fetch_assoc($request)) {
        $cidades[] = $row;
    }

    $response = array();
    if(isset($_POST['submit'])){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $cidade1 = $_POST['cidade1'];
        $cidade2 = $_POST['cidade2'];

        $dataIda = $_POST['data_ida'];
        $dataVolta = isset($_POST['data_volta']) ? $_POST['data_volta'] : null;
    
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

                $strngfy = "";

                $viagem = $response;
                foreach($viagem as $item){
                    $saida = $item['saida'];
                    $chegada = $item['chegada'];
                    $horario = $item['horario'];
        
                    ob_start(); 
                    include "components/viagem.php"; 
                    $strngfy .= ob_get_clean();
                }
                echo $strngfy;
                $_SESSION['render'] = $strngfy;
                header("Location: selecionarViagem.php");
                exit;
            }
        } else{
            echo "DB connection failed";
        }

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

    <form method='post' action='selecionarViagem.php' id="selecionar-cidades-form">

        <div class="selecionar-cidades-container">

            <div class="selecionar-cidades-component">
                <label for='cidade1'>Cidade de saída</label>
                <select class="cidade" name="cidade1" required>
                    <option value="" disabled selected>Selecione uma cidade</option>
                    <?php
                        if($request){
                            foreach($cidades as $cidade){
                                $id = $cidade["id_cidade"];
                                $nome = $cidade["nome"];
                                echo "<option value='$id'>$nome</option>";
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="selecionar-cidades-component">
                <label for='cidade2'>Cidade de destino</label>
                <select id="class" name="cidade2" required>
                    <option value="" disabled selected>Selecione uma cidade</option>
                    <?php
                        if($request){
                            foreach($cidades as $cidade){
                                $id = $cidade["id_cidade"];
                                $nome = $cidade["nome"];
                                echo "<option value='$id'>$nome</option>";
                            }
                        }
                    ?>
                </select>
            </div>        

        </div>

        <div class="selecionar-cidades-container">
            <div class="selecionar-cidades-component">
                <label for='data_ida'>Data de ida</label>
                <input required name='data_ida' class='date-input' type='date'>
            </div>
            <div class="selecionar-cidades-component">
                <label for='data_volta'>Data de volta</label>
                <input name='data_volta' class='date-input' type='date'>               
            </div>
        </div>

        <input type='submit' value='Pesquisar viagens' name='submit'>

    </form>

    <?php include "components/main.php" ?>

    <?php include "components/footer.php"; ?>

</body>
</html>