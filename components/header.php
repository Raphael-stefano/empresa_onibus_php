<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $nome_usuario = $_SESSION['nome'] ?? "Entrar"; 
    $link = $nome_usuario === "Entrar" ? "formulario.php" : "usuario.php"; 
?>

<header>
    <figure>
        <i id="logo" class="fa-solid fa-bus"></i>
        <figcaption>GoytaBus</figcaption>
    </figure>
    <h2>Bem-vindo!</h2>
    <nav>
        <a href='home.php'>Home</a>
        <a href="<?php echo $link; ?>"><?php echo $nome_usuario; ?></a>
        <a href='#'>Suporte</a>
    </nav>
</header>
