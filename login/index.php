<?php
include('../banco/connection.php');


if(isset($_POST['login'])) {
    $usuario = mysqli_real_escape_string($connection, $_POST['usuario']);
    $senha = mysqli_real_escape_string($connection, $_POST['senha']);
// Verifica se o usuário do aluno já está cadastrado
    $usuarioSQL = "SELECT usuario, CPF FROM TBAluno WHERE usuario = '$usuario'";
    $getUsuario = mysqli_query($connection, $usuarioSQL);

    if (!$getUsuario) {
        echo '<p style="font-size: 18px; color: red;"> <b>Aviso: </b>usuario ou senha incorretos</p>';
    }else{
        if (mysqli_num_rows($getUsuario) > 0) {
            $linha = mysqli_fetch_assoc($getUsuario);
            $cpfAluno = $linha['CPF'];
            $usuarioAluno = $linha['usuario'];
            if ($senha == $cpfAluno and $usuario!=null) {
                header("location: ../logado/index.html");
            }else{
                $senhaIncorreta = true;
                $usuarioInexistente = false;
            }
        }else {
            $usuarioInexistente = true;
            $senhaIncorreta = false;
        }
    }


}else{
    $senhaIncorreta = false;
    $usuarioInexistente = false;
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
    <form id="login" name="login" action="index.php" method="post" >
        <h3>Faça seu login:</h3>
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required>
        <?php if ($usuarioInexistente) {
            echo '<p style="font-size: 18px; color: red;"> <b>Usuario não encontrado</b></p>';
        }?>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <?php if ($senhaIncorreta) {
            echo '<p style="font-size: 18px; color: red"> <b>Senha incorreta</b></p>';
        }?>
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


