<?php
  include('banco/connection.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="icon" type="image/png" href="assets/Logo.png" sizes="16x16">
    <link rel="stylesheet" href="cadaluno.css">
</head>
<body>
    <header class="cabeca">
        <div>
            <h1> Coding Generations </h1>
            <img class="logo" src="assets/Logo.png" alt="Logo">
        </div>
    </header>
    
    <main>
        <div id="FormularioConteiner">
            <div id="titulo">
                Cadastro de Aluno 
            </div>
            <div id="formulario">
                <form action="index.php" method="post" id="form">
                    <div id="Nome">
                        <div class="formImput">
                            <label for="nome"> Nome </label>
                            <input type="text" name="nome" id="nome" value="">
                            
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="cpf">
                        <div class="formImput">
                            <label for="cpf"> CPF </label>
                            <input type="text" name="CPF" id="cpf" value="">
                            <span>ERRO</span>
                        </div>
                    </div>
                    

                    <div id="dataNasc">
                        <div class="formImput">
                            <label for="dataNasc"> Data de Nascimento </label>
                            <input type="date" name="data" id="data" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="nomeResp">
                        <div class="formImput">
                            <label for="nomeResp"> Nome Responsavel </label>
                            <input type="text" name="nomeResp" id="nomeResp" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="docResp">
                        <div class="formImput">
                            <label for="docResp"> Documento Responsavel </label>
                            <input type="text" name="docResp" id="docResp" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div id="submmitContainer">
                            <button type="submit" id="btn" name="cadastro_aluno"> Cadastrar </button>
                        </div>

                </form>

                
            </div>
        </div>

    </main>


    <footer>
        <div>
         © 2023 Coding Genereations
        </div>
    </footer>
</body>
</html>

<?php

if(isset($_POST['cadastro_aluno'])) {
    $nome = mysqli_real_escape_string($connection, $_POST['nome']);
    $Data_nasc = mysqli_real_escape_string($connection, $_POST['data']);
    $CPF = mysqli_real_escape_string($connection, $_POST['cpf']);
    
    $Matricula = "select Matricula from projetocg.tbaluno order by Matricula desc limit 1";
    $getMatricula = mysqli_query($connection, $IDResponsavel);

    $Matricula = mysqli_fetch_assoc($getMatricula);



    $nomeResp = mysqli_real_escape_string($connection, $_POST['nome']);
    $docResp = mysqli_real_escape_string($connection, $_POST['nome']);


    $sqlCreateResponsavel = "INSERT INTO TBResponsavel (IDResponsavel, Nome, CPF)
                              VALUES ('$Matricula['Matricula'] + 1', '$nomeResp', '$docResp')";

    $sqlCreateAluno = "INSERT INTO TBAluno (Matricula, Nome, data_nasc, CPF, IDResponsavel, IDTurma) 
                        VALUES ('$Matricula['Matricula'] + 1', '$Nome', '$Data_nasc', '$CPF', '$Matricula['Matricula'] + 1', '1');";




    $createAluno = mysqli_query($connection, $sqlCreateAluno);
    $createResponsavel = mysqli_query($connection, $sqlCreateResponsavel);

    if (!$createAluno and !$createResponsavel ) {
        echo '<b>Error</b>';
    }
}
mysqli_close($connection);


?>