<?php

// var_dump($sql);
// var_dump($senha);die;

session_start();

if (isset($_POST['submit']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $senha = ($_POST['senha']);

    $sql = "SELECT * FROM login_ao_sistema WHERE senha = '$senha'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['senha']);
        header('Location: login.php');
    } else {
        $_SESSION['senha'] = $senha;
        //  print_r($_SESSION);die;
        header('Location: main.php');
    }
} else {
    header('Location: login.php');
}
