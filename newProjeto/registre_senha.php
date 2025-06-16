
<?php 

if(isset($_POST['submit'])) {
    // print_r($_POST['senha']);

    include_once('config.php');

    $senha = $_POST['senha'];

    $result = mysqli_query($conexao, "INSERT INTO login_ao_sistema(senha) VALUES ('$senha')");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registre_senha.css?v=1">
    <title>Document</title>
</head>
<body>
    <div class="estilo-registre_senha">
        <section>
            <h1>Cadastre sua senha!</h1>
        <form action="registre_senha.php" method="post">
            <input value="" type="password" placeholder="Registre aqui sua senha" name="senha" id="senha">
            <br><br>
            <input class="sub" type="submit" name="submit" value="Enviar">
            <span class="estilo-retorno">Clique aqui para retornar ao login e acessar o sistema</span>
            <a class="voltar" href="login.php">&#128073; VOLTAR</a>
        </form>
        </section>
    </div>
</body>
</html>