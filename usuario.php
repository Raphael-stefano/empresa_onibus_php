<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include_once('services/API.php');

    $id = $_SESSION['id_passageiro'] ?? null;
    $nome = $_SESSION['nome'] ?? null;
    $email = $_SESSION['email'] ?? null;
    $cpf = $_SESSION['cpf'] ?? null;
    $telefone = $_SESSION['telefone'] ?? null;
    $cidade = $_SESSION['cidade'] ?? null;

    /*$obter_cidade = mysqli_query($con, "select c.nome
        from cidade c
        join passageiro p 
        on c.id_cidade = p.id_cidade and p.id_passageiro = '$id'");

    $fecth_cidade = mysqli_fetch_assoc($obter_cidade);*/

    //$cidade = $fecth_cidade['nome'];

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
        <h1>Bem vindo, <?php echo $nome; ?>!</h1>
        <h2>Seus dados: </h2>
        <div>
            <h4>E-mail</h4>
            <p><?php echo $email; ?></p>
        </div>
        <div>
            <h4>CPF</h4>
            <p><?php echo $cpf; ?></p>
        </div>
        <div>
            <h4>Telefone</h4>
            <p><?php echo $telefone; ?></p>
        </div>
        <div>
            <h4>Cidade de origem</h4>
            <p><?php echo $cidade; ?></p>
        </div>
        <button onclick="sair()">Sair</button>
    </div>

    <?php include "components/footer.php"; ?>

    <script>
        function sair(){
            if(confirm('Tem certeza de que deseja sair?')){
                fetch('services/sair.php').then(response => {
                    if(response){
                        window.location.href = 'login.php'
                    } else(
                        alert('Erro ao tentar sair.')
                    )
                }).catch(error =>{
                    console.error('Erro: ',error)
                })
            }
        }
    </script>

</body>
</html>
