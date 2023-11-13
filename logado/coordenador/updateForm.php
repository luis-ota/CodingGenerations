<?php
include('../../banco/connection.php');
$cpfJaCadastrado = false;
if (false) {
    echo '<p style="font-size: 18px; color: red;"> <b>Aviso: </b>usuario ou senha incorretos</p>';
}else{
    $Matricula = $_GET['id'];
    $usuarioSQL = "SELECT * FROM TBAluno WHERE Matricula = '$Matricula'";
    $getUsuario = mysqli_query($connection, $usuarioSQL);
    $linha = mysqli_fetch_assoc($getUsuario);
    $nomeAlunoBanco = $linha['Nome'];
    $dataNascAlunoBanco = $linha['data_nasc'];
    $cpfAlunoBanco = $linha['CPF'];
    //    Nome, data_nasc, CPF, usuario
    $matriculaAlunoBanco = $linha['Matricula'];

}

if(isset($_POST['editar-perfil'])) {
    $nomeAlunoNovo = mysqli_real_escape_string($connection, $_POST['nome']);
    $dataNascAlunoNovo = mysqli_real_escape_string($connection, $_POST['data']);
    $cpfAlunoNovo = preg_replace('/[^0-9]/', '', mysqli_real_escape_string($connection, $_POST['cpf']));

    // Verifica se o CPF do aluno já está cadastrado (exceto para o aluno atual)
    $cpfAlunoSQL = "SELECT Matricula FROM TBAluno WHERE CPF = '$cpfAlunoNovo' AND Matricula != '$matriculaAlunoBanco'";
    $getCpfAluno = mysqli_query($connection, $cpfAlunoSQL);

    if (mysqli_num_rows($getCpfAluno) > 0) {
        // CPF já cadastrado para outro aluno
        $cpfJaCadastrado = true;
    }else {
        // CPF não cadastrado para outro aluno, pode prosseguir com a atualização
        $cpfJaCadastrado = false;
        $query = "UPDATE TBAluno SET Nome = '$nomeAlunoNovo', CPF = '$cpfAlunoNovo', data_nasc = '$dataNascAlunoNovo' WHERE Matricula = '$Matricula'";

        // Executar a query
        if ($connection->query($query) === TRUE) {
            $usuarioAtualizado = true;
            header("location: index.php");

        } else {
            echo "Erro na atualização: " . $connection->error;
            $usuarioAtualizado = false;

        }
    }



}else{ $usuarioAtualizado = false;}
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../perfil/perfil.css">
    <script type="module" src="../perfil/script.js"></script>
    <link rel="shortcut icon" type="image/png" href="../../Imagens/Logo CG.png">
    <title>Coding Generations</title>
</head>
<body>
<header>
    <div class="home">
        <button class="hamburger-button">&#9776;Menu</button>

        <a href="../index.html">
            <img class= logo src="../../Imagens/Logo CG.png" alt="Logo da Coding Generations">
            <h1>Coding Generations</h1></a>
        <div style="visibility: hidden">oi</div>
    </div>


    <div class="sidebar">
        <ul>
            <li><a href="../index3-1.html">Faltas</a></li>
            <li><a href="../index3-1.html">Notas</a></li>
            <li><a href="../index3-1.html">Avisos</a></li>
            <li><a href="../index3-1.html">Metas</a></li>
            <li><a href="../perfil/index.php"><u>Perfil</u></a></li>
        </ul>
    </div>
</header>

<h2>Atualizar dados do Aluno</h2>
<div class="editarr">

    <div id="formulario">
        <form id="editar" action="index.php" method="post" name="editar-perfil">
            <?php
            echo "
                <div class='formInput'>
                    <label for='nome'> Nome </label>
                    <input type='text' name='nome' id='nome' value='$nomeAlunoBanco'>
                    <span>ERRO</span>
                </div>
                
                
                <div>
                    <label for='cpf'> CPF </label>
                    <input type='text' name='cpf' id='cpf' value='$cpfAlunoBanco'>
                    "?>
            <?php
            if($cpfJaCadastrado){echo '<p style="font-size: 20px; color: red;"><b>Aviso:</b> CPF do aluno já cadastrado.</p>';}
            echo "    
                    <span>ERRO</span>
                </div>

                <div class='formInput'>
                    <label for='data'> Data de Nascimento </label>
                    <input type='date' name='data' id='data' value='$dataNascAlunoBanco'>
                    <span>ERRO</span>
                </div>
                    "
            ?>

            <div id="submmitContainer" class="btn">
                <button type="submit" id="btn" name="editar-perfil">
                    Atualizar dados
                </button>
            </div>
        </form>
    </div>

</div>

<footer>
    <div class="rodape">©Todos os direitos reservados a Coding Generations</div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerButton = document.querySelector('.hamburger-button');
        const sidebar = document.querySelector('.sidebar');

        hamburgerButton.addEventListener('click', function() {
            if(sidebar.style.visibility === 'visible'){
                sidebar.classList.toggle('show-sidebar');
                sidebar.style.visibility = 'hidden';}else{sidebar.style.visibility = 'visible'}
        });
    });
</script>
</body>
</html>