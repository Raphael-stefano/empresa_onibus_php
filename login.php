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
