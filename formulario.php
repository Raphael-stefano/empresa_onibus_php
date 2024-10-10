<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST['submit'])){

        include_once('services/API.php');

        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $id_cidade = $_POST['cidade'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $senhaConf = $_POST['senhaConf'];

        if($senha != $senhaConf){
            echo "As senhas não coincidem.";
            exit; 
        }

        $result = mysqli_query($con, "insert into passageiro (nome, cpf, telefone, id_cidade, email, senha) 
        values ('$nome', '$cpf', '$telefone', '$id_cidade', '$email', '$senha');");

        $_SESSION['nome'] = $nome;
        $_SESSION['cpf'] = $cpf;
        $_SESSION['email'] = $emial;
        $_SESSION['telefone'] = $telefone;
        $_SESSION['cidade'] = $cidade;

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

    <?php include 'components/header.php'; ?>
    
    <div class="container">
        <h2><a href='login.php'>Já tenho cadastro?</a></h2>
        <h1>Cadastro de Usuário</h1>
        <form action="formulario.php" id="cadastroUsuario" method="POST">
            <div>
                <label for="nome">Nome completo</label>
                <input id="nome" type="text" name="nome" required />
            </div>
            <div>
                <label for="cpf">CPF</label>
                <input id="cpf" type="text" name="cpf" required />
            </div>
            <div>
                <label for="telefone">Telefone</label>
                <input id="telefone" type="tel" name="telefone" required />
            </div>
            <div>
                <label for="cidade">Cidade</label>
                <select id="cidade" name="cidade" required>
                    <option value="" disabled selected>Selecione uma cidade</option>
                    <option value="1">Campos dos Goytacazes</option>
                    <option value="2">Macaé</option>
                    <option value="3">Rio das Ostras</option>
                    <option value="4">Nova Friburgo</option>
                    <option value="5">Cabo Frio</option>
                    <option value="6">Petrópolis</option>
                    <option value="7">Niterói</option>
                    <option value="8">Rio de Janeiro</option>
                    <option value="9">Nova Iguaçu</option>
                    <option value="10">Angra dos reis</option>
                </select>
            </div>
            <div>
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" required />
            </div>
            <div>
                <label for="senha">Senha</label>
                <input id="senha" type="password" name="senha" required />
            </div>
            <div>
                <label for="senhaConf">Confirmar senha</label>
                <input id="senhaConf" type="password" name="senhaConf" required />
            </div>
            <input id="input_submit" name="submit" type="submit" value="Confirmar dados" />
        </form>
    </div>

    <?php include "components/main.php" ?>
    
    <?php include "components/footer.php" ?>

</body>
</html>
