<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    include_once('config.php');

    $Id_cliente = $user_data['Id_cliente'];
    // var_dump($user_data);die;
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    $result = mysqli_query($conexao, "INSERT INTO cliente(nome, telefone, cpf) VALUES ('$nome', '$telefone', '$cpf')");


    if ($result) {
        $_SESSION['msg'] = "<span style='color: green;'>Cliente cadastrado com sucesso!</span>";
    } else {
        $_SESSION['msg'] = "<span style='color: red;'>Erro ao cadastrar cliente.</span>";
    }

    // Redireciona após o POST para evitar duplicações e manter a mensagem
    header("Location: novo_cliente.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="novo_cliente.css">
        <title>Novo Cliente</title>
    </head>
    
    <body>
        <div class="sessao-clientes">
        <a href="main.php"><input class="sub-cliente" type="submit" name="submit" value="Voltar"></a></span></a>

        <section class="container-cliente">
            <form action="novo_cliente.php" method="post">
                <div class="box box-1">
                    <span class="titulo">Nome: </span>
                    <br>
                    <input type="text" name="nome" id="nome" class="user" required>
                </div>
                <br>
                <div class="box box-2">
                    <span class="titulo">Telefone: </span>
                    <br>
                    <input type="text" placeholder="00 00000-0000" name="telefone" id="telefone" class="user" required>
                </div>
                <br>
                <div class="box box-3">
                    <span class="titulo">CPF: </span>
                    <br>
                    <input type="text" placeholder="000.000.000-00" name="cpf" id="cpf" class="user" required>
                </div>
                <br><br>
                                
                <?php
                    if (isset($_SESSION['msg'])) {
                        echo "<div class='mensagem-feedback'>" . $_SESSION['msg'] . "</div><br>";
                        unset($_SESSION['msg']);
                    }
                ?>

                <div class="botao-centralizado">
                    <input class="btn-cliente" type="submit" name="submit" value="Salvar"></a></span>
                    </div>
            </form>
        </section>
    </div>
</body>

</html>