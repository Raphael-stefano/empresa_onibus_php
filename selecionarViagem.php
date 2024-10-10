<?php 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


    if (isset($_SESSION['render'])) {
        $strngfy = $_SESSION['render'];

        echo $strngfy;


        //unset($_SESSION['render']);
    } else {
        echo "Nenhuma viagem encontrada.";
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



    <?php include "components/footer.php"; ?>

</body>
</html>