<?php

include('../../banco/connection.php');

session_start();

if (isset($_SESSION['user'])) {
    if ($_SESSION['user'] != 'admin') {
        header("location: ../index.php");
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $del_query_TBaa = "DELETE FROM TBAluno_Avaliacao WHERE Matricula = '$id'";
    $del_query_TBa = "DELETE FROM TBAluno WHERE Matricula = '$id'";
    $result_delete = mysqli_query($connection, $del_query_TBaa);
    $result_delete = mysqli_query($connection, $del_query_TBa);
    header("location: ./index.php");
    exit();  
}
?>
