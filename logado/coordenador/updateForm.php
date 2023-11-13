<?php
include('../../banco/connection.php');

// Função para validar CPF
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) !== 11) {
        return false;
    }

    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += intval($cpf[$i]) * (10 - $i);
    }
    $digito1 = 11 - ($soma % 11);
    if ($digito1 > 9) {
        $digito1 = 0;
    }

    if (intval($cpf[9]) !== $digito1) {
        return false;
    }

    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += intval($cpf[$i]) * (11 - $i);
    }
    $digito2 = 11 - ($soma % 11);
    if ($digito2 > 9) {
        $digito2 = 0;
    }

    if (intval($cpf[10]) !== $digito2) {
        return false;
    }

    return true;
}

$Matricula = $_GET['id'];

$cpfError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $cpf = preg_replace('/[^0-9]/', '', mysqli_real_escape_string($connection, $_POST['cpf']));
    $data = mysqli_real_escape_string($connection, $_POST['data']);

    if (empty($name) || empty($cpf) || empty($data)) {
        echo '<script type="text/javascript">
                alert("Por favor, preencha todos os campos.");
              </script>';
    } else {
        if (!validarCPF($cpf)) {
            $cpfError = '<p style="color: red;">CPF inválido. Por favor, insira um CPF válido.</p>';
        } else {
            $cpfError = '';

            $sql = "UPDATE TBAluno SET Nome = '$name', cpf = '$cpf', data_nasc = '$data' WHERE Matricula='$Matricula'";

            if (mysqli_query($connection, $sql) or die($connection->error)) {
                mysqli_close($connection);
                header('Location: index.php');
            } else {
                echo '<script type="text/javascript">
                        alert("Error: ' . $sql . ". " . $connection->error . '");
                      </script>';
            }
        }
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
<div class="container">
    <div class="box">
        <h1>Alteração de Cadastro</h1>
        <form method="post">
            <!-- input de login -->
            <div class="user-info">
                <label>Nome:</label>
                <?php
                $sql = "SELECT Nome FROM TBAluno WHERE Matricula='$Matricula'";
                $result = mysqli_query($connection, $sql);
                $data = mysqli_fetch_assoc($result);
                if ($connection->query($sql)) {
                    echo '<input type="text" name="name" value="' . $data['Nome'] . '" required>';
                }
                ?>
            </div>

            <div class="cpf-info">
                <label>CPF:</label>
                <?php
                $sql = "SELECT CPF FROM TBAluno WHERE Matricula='$Matricula'";
                $result = mysqli_query($connection, $sql);
                $data = mysqli_fetch_assoc($result);
                if ($connection->query($sql)) {
                    echo '<input id="cpfInput" type="text" name="cpf" value="' . $data['CPF'] . '" required oninput="maskCPF(this); validarCPF(this.value);">' . $cpfError;
                }
                ?>
            </div>

            <div class="data-info">
                <label>Data de Nascimento:</label>
                <?php
                $sql = "SELECT data_nasc FROM TBAluno WHERE Matricula='$Matricula'";
                $result = mysqli_query($connection, $sql);
                $data = mysqli_fetch_assoc($result);
                if ($connection->query($sql)) {
                    echo '<input type="date" name="data" value="' . $data['data_nasc'] . '" required>';
                }
                ?>
            </div>

            <input type="submit" class="edit-button" name="edit" value="Concluir">
        </form>
    </div>
</div>

<script>
    function maskCPF(input) {
        let cpf = input.value;
        cpf = cpf.replace(/\D/g, "");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        input.value = cpf;
        input.setAttribute('maxlength', '14');
    }

    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]/g, '');

        if (cpf.length !== 11) {
            return false;
        }

        if (/^(\d)\1{10}$/.test(cpf)) {
            return false;
        }

        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let digito1 = 11 - (soma % 11);
        if (digito1 > 9) {
            digito1 = 0;
        }

        if (parseInt(cpf.charAt(9)) !== digito1) {
            return false;
        }

        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        let digito2 = 11 - (soma % 11);
        if (digito2 > 9) {
            digito2 = 0;
        }

        if (parseInt(cpf.charAt(10)) !== digito2) {
            return false;
        }

        return true;
    }
</script>

<footer style="bottom: 0">
    <div class="rodape">©Todos os direitor reservados a Coding Generations</div>
</footer>
</body>
</html>
