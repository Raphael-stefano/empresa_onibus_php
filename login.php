<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST['submit'])){

        include_once('services/API.php');

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $result = mysqli_query($con, "select * from passageiro where email = '$email' and senha = '$senha'");

        if(!$result){
            $error_message = mysqli_error($con);
            echo "Erro na consulta: " . $error_message;
            exit;
        }

        $retorno = mysqli_fetch_assoc($result);

        $_SESSION['id_passageiro'] = $retorno['id_passageiro'];
        $_SESSION['nome'] = $retorno['nome'];
        $_SESSION['cpf'] = $retorno['cpf'];
        $_SESSION['telefone'] = $retorno['telefone'];
        $_SESSION['email'] = $retorno['email'];

        $_SESSION['id_passageiro'] = $retorno['id_passageiro'];
        $id = $_SESSION['id_passageiro'];

        $obter_cidade =mysqli_query($con, "select c.nome
        from cidade c
        join passageiro p 
        on c.id_cidade = p.id_cidade and p.id_passageiro = '$id'");

        $fecth_cidade = mysqli_fetch_assoc($obter_cidade);

        $_SESSION['cidade'] = $fecth_cidade['nome'];

        header("Location: home.php");

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

    <div class="container">
        <h1>Login de usuário</h1>
        <form id="cadastroUsuario" method="post">
            <div>
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" required />
            </div>
            <div>
                <label for="senha">Senha</label>
                <input id="senha" type="password" name="senha" required />
            </div>
            <input id="input_submit" name="submit" type="submit" value="Fazer login" />
        </form>
    </div>

    <?php include "components/footer.php"; ?>

</body>
</html>
