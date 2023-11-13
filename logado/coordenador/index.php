<?php
include('../../banco/connection.php');

session_start();

if(isset($_SESSION['user'])){
    if($_SESSION['user']!='admin'){
        header("location: ../index.php");
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="../../Imagens/Logo CG.png">
    <title>Coding Generations</title>
</head>
<body>
<header>
    <div class="home">
        <button class="hamburger-button" style="visibility: hidden">&#9776;Menu</button>
        <div style="width: 30%">
            <img class= logo src="../../Imagens/Logo CG.png" alt="Logo da Coding Generations">
            <h1>Coding Generations</h1>
        </div>
        <div style="visibility: hidden">oi</div>
    </div>
</header>

<h2> Seja bem vindo ao Painel de Coordenador</h2>
<div class="container">
    <table>
        <tr>
            <th>Matricula</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>CPF</th>
            <th>ID Responsavel</th>
            <th>ID Turma</th>
            <th>Usuario</th>
            <th></th>
        </tr>
        <?php
        $sql = "SELECT * FROM TBAluno";
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['Matricula'] .'</td>';
                echo '<td>' . $row['Nome'] .'</td>';
                echo '<td>' .$row['data_nasc'] .'</td>';
                echo '<td>' .$row['CPF'] .'</td>';
                echo '<td>' .$row['IDResponsavel'] .'</td>';
                echo '<td>' .$row['IDTurma'] .'</td>';
                echo '<td>' .$row['usuario'] .'</td>';
                echo '
              <td>
                <div class="buttons">
                  <a href="updateForm.php?id=' .$row['Matricula']. '" class="edit">Editar</a>
                  <a href="delete.php?id=' .$row['Matricula']. '" class="delete">Delete</a>
                </div>
              </td>';
                echo '<tr>';
            }
        }
        ?>
    </table>
</div>



<footer>
    <div class="rodape">©Todos os direitos reservados a Coding Generations</div>
</footer>
</body>
</html>