<?php
include('../banco/connection.php');

$cpfJaCadastrado = false;

if(isset($_POST['cadastro_aluno'])) {
    $nome = mysqli_real_escape_string($connection, $_POST['nome']);
    $Data_nasc = mysqli_real_escape_string($connection, $_POST['data']);
    $CPF = mysqli_real_escape_string($connection, $_POST['cpf']);
    $nomeResp = mysqli_real_escape_string($connection, $_POST['nomeResp']);
    $cpfResp = mysqli_real_escape_string($connection, $_POST['cpfResp']);
    $curso = intval(mysqli_real_escape_string($connection, $_POST['curso']));


    $CPF = preg_replace('/[^0-9]/', '', $CPF);
    $cpfResp = preg_replace('/[^0-9]/', '', $cpfResp);




    $cpfAlunoSQL = "SELECT Matricula FROM TBAluno WHERE CPF = '$CPF'";
    $getCpfAluno = mysqli_query($connection, $cpfAlunoSQL);
    $resultCpfAluno = mysqli_fetch_array($getCpfAluno);

    if ($resultCpfAluno) {
        $cpfJaCadastrado = true;
    } else {
        $cpfJaCadastrado = false;


        $matriculaSQL = "SELECT MAX(Matricula) FROM TBAluno";
        $getMatriculaSQL = mysqli_query($connection, $matriculaSQL);
        $resultMatriculaSQL = mysqli_fetch_array($getMatriculaSQL);
        $Matricula = $resultMatriculaSQL[0] + 1;

        $cpfRespSQL = "SELECT IDResponsavel FROM TBResponsavel WHERE CPF = '$cpfResp'";
        $getCpfResp = mysqli_query($connection, $cpfRespSQL);
        $resultCpfResp = mysqli_fetch_array($getCpfResp);

        if ($resultCpfResp) {
            $IDResp = $resultCpfResp['IDResponsavel'];
        } else {
            $IDRespSQL = "SELECT MAX(IDResponsavel) FROM TBResponsavel";
            $getIDRespSQL = mysqli_query($connection, $IDRespSQL);
            $resultIDRespSQL = mysqli_fetch_array($getIDRespSQL);
            $IDResp = $resultIDRespSQL[0] + 1;

            $sqlInsertResponsavel = "INSERT INTO TBResponsavel (IDResponsavel, Nome, CPF)
                                     VALUES ($IDResp, '$nomeResp', '$cpfResp');";
            $createResponsavel = mysqli_query($connection, $sqlInsertResponsavel);
        }

        $usuario = strstr(strtolower($nome . ' '), ' ', true) . $Matricula;
        $sqlInsertAluno = "INSERT INTO TBAluno (Matricula, Nome, data_nasc, CPF, IDResponsavel, IDTurma, usuario)
                           VALUES ($Matricula, '$nome', '$Data_nasc', '$CPF', $IDResp, $curso, '$usuario');";

        $createAluno = mysqli_query($connection, $sqlInsertAluno);

        if (!$createAluno) {
            echo '<p style="font-size: 18px; color: red;"><b>Error:</b> Não foi possível cadastrar o aluno.</p>';

        } else {
            header("location: ..\login\index.php");
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
        <title>Cadastro</title>
        <link rel="icon" type="image/png" href="assets/Logo.png" sizes="16x16">
        <link rel="stylesheet" href="cadaluno.css">
        <script type="module" src="./script.js" defer></script>
    </head>
    <body>
    <header>
            <a href="../index.html" class="logoenome">
            <img class="logo" src="assets/Logo.png" alt="Logo">
            <h1> Coding Generations </h1>
            </a>

        <div>
            <h1>Cadastro de Aluno</h1>
        </div>
    </header>

    <main>
        <div class="select">
            <div class="selectErro">
                <label for="selectCurso" style="margin-bottom: 5px; display: flex;">
                    Selecione um curso
                </label>
                <select id="selectCurso">
                    <option value="0">Selecionar um curso</option>
                    <option value="1">Curso de Desenvolvimento Front-end 2023</option>
                    <option value="2">Curso de Desenvolvimento Back-end 2023</option>
                    <option value="3">Curso Full Stack 2023</option>
                    <option value="4">Curso de Banco de Dados 2023</option>
                    <option value="5">Curso de Mobile App Development 2023</option>
                    <option value="6">Curso de Inteligência Artificial 2023</option>
                    <option value="7">Curso de Segurança da Informação 2023</option>
                    <option value="8">Curso de Desenvolvimento Ágil 2023</option>
                </select>
                <span>ERRO</span>
            </div>
        </div>
        <div id="FormularioConteiner">

            <div id="formulario">
                <form id="form" action="index.php" method="post" name="cadastro_aluno">
                    <div>
                        <div class="formInput">
                            <label for="nome"> Nome </label>
                            <input type="text" name="nome" id="nome" value="">
                            <span id="nomeErro" class="erro">ERRO</span>
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="cpf"> CPF </label>
                            <input type="text" name="cpf" id="cpf" value="">
                            <?php
                                if($cpfJaCadastrado){echo '<p style="font-size: 25px; color: red;"><b>Aviso:</b> CPF do aluno já cadastrado.</p>';
                                }
                            ?>
                            <span>ERRO</span>
                        </div>
                    </div>
                    <div>
                        <div class="formInput">
                            <label for="data"> Data de Nascimento </label>
                            <input type="date" name="data" id="data" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div>
                        <div class="formInput">
                            <label for="nomeResp"> Nome Responsavel </label>
                            <input type="text" name="nomeResp" id="nomeResp" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div>
                        <div class="formInput">
                            <label for="cpfResp"> CPF Responsavel </label>
                            <input type="text" name="cpfResp" id="cpfResp" value="">
                            <span>ERRO</span>
                        </div>
                    </div>

                    <div style="display: none; visibility: hidden">
                        <div>
                            <label for="curso"> curso</label>
                            <input type="text" name="curso" id="curso" value="">
                        </div>
                    </div>

                    <div id="submmitContainer" class="btn">
                        <button type="submit" id="btn" name="cadastro_aluno">
                            Cadastrar
                            <svg viewBox="0 23 183 15" class="border">
                                <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line"></polyline>
                                <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line"></polyline>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <div>
            © 2023 Coding Generations
        </div>
    </footer>
    </body>
    </html>