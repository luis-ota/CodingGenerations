<?php
include('../banco/connection.php');


if(isset($_POST['login'])) {
    $usuario = mysqli_real_escape_string($connection, $_POST['usuario']);
    $senha = mysqli_real_escape_string($connection, $_POST['senha']);
// Verifica se o usuário do aluno já está cadastrado
    $usuarioSQL = "SELECT usuario, CPF FROM TBAluno WHERE usuario = '$usuario'";
    $getUsuario = mysqli_query($connection, $usuarioSQL);

    if (!$getUsuario) {
        // Verifica se houve erro na consulta
        die("Erro na consulta: " . mysqli_error($connection));
    }else{
        echo '<p style="font-size: 18px; color: red;"> usuario ou senha incorretos</p>';
    }

    if (mysqli_num_rows($getUsuario) > 0) {
        $linha = mysqli_fetch_assoc($getUsuario);
        $cpfAluno = $linha['CPF'];

        if ($senha == $cpfAluno) {
            header("location: ../logado/index.html");
        }else{
            echo '<p style="font-size: 18px; color: red;"> <b>Aviso: </b>usuario ou senha incorretos</p>';
        }
    }

}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" type="image/png" href="../Imagens/Logo%20CG.png">
    <title>Coding Generations: Login</title>
</head>
<body>
<header>
    <div class="home">
        <a href="../index.html">
            <img class= logo src="../Imagens/Logo%20CG.png" alt="Logo da Coding Generations">
            <h1>Coding Generations</h1>
        </a>
    </div>
</header><br><br><br><br>

<div id="formulario">
    <form id="login" name="login" action="#" method="post" >
        <h3>Faça seu login:</h3>
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <button type="submit" id="btnEntrar" name="login">Entrar</button>
    </form>
</div>


<br>
<footer>
    <span class="rodape">©Todos os direitos reservados a Coding Generations</span>
</footer>

<script src="script.js"></script>
</body>
</html>


