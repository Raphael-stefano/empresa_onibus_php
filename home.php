<?php 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once('services/API.php');

    $request = mysqli_query($con, "select id_cidade, nome from cidade;");
    while ($row = mysqli_fetch_assoc($request)) {
        $cidades[] = $row;
    }

    if(isset($_POST['submit'])){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /*echo $_POST['cidade1'] . "<br>";
        echo $_POST['cidade2'] . "<br>";
        echo $_POST['data_ida'] . "<br>";*/
        $_SESSION['cidade1'] = $_POST['cidade_ida'];
        $_SESSION['cidade2'] = $_POST['cidade_chegada'];
        $_SESSION['horario1'] = $_POST['data_ida'];
        $_SESSION['horario2'] = $_POST['data_volta'] ?? null;

        header("Location: selecionarViagem.php");
        exit;

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mali:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sedan+SC&display=swap" rel="stylesheet">
</head>
<body>

    <?php include "components/header.php"; ?>

    <form method='post' action='home.php' id="selecionar-cidades-form">

        <div class="selecionar-cidades-container">

            <div class="selecionar-cidades-component">
                <label for='cidade_ida'>Cidade de saída</label>
                <select class="cidade" id="cidade_ida" name="cidade_ida" required>
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
                <label for='cidade_chegada'>Cidade de destino</label>
                <select class='cidade' id="cidade_chegada" name="cidade_chegada" required>
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
                <input required id='data_ida' name='data_ida' class='date-input' type='date'>
            </div>
            <div class="selecionar-cidades-component">
                <label for='data_volta'>Data de volta</label>
                <input id='data_volta' name='data_volta' class='date-input' type='date'>               
            </div>
        </div>

        <input type='submit' value='Pesquisar viagens' name='submit'>

    </form>

    <?php include "components/main.php" ?>

    <?php include "components/footer.php"; ?>

</body>
</html>