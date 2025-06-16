<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("config.php");

if (!empty($_GET['cliente'])) {
    $id_cliente = $_GET['cliente'];

    $sql = "SELECT * FROM cliente WHERE Id_cliente = $id_cliente";
    $result = $conexao->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    } else {
        echo "Cliente não encontrado.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $conexao->real_escape_string($_POST['nome']);
        $cpf = $conexao->real_escape_string($_POST['cpf']);
        $telefone = $conexao->real_escape_string($_POST['telefone']);

        $update = "UPDATE cliente SET 
            nome='$nome',
            cpf='$cpf',
            telefone='$telefone'
            WHERE Id_cliente = $id_cliente";

        if ($conexao->query($update)) {
            $_SESSION['msg'] = "Cliente atualizado com sucesso!";
            header("Location: main.php");
            exit;
        } else {
            echo "Erro ao atualizar cliente: " . $conexao->error;
        }
    }
} else {
    echo "ID do cliente não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="alterar_cliente.css">
    <title>Alterar Cliente</title>
</head>

<body>
    <div class="sessao-clientes">
        <a href="main.php"><input class="but-cliente" type="button" value="Voltar"></a>

        <section class="container-cliente">
            <form action="" method="post">
                <div class="form-grid">
                    <!-- Coluna 1 -->
                    <div class="coluna esquerda">
                        <div class="box">
                            <label class="titulo">ID:</label>
                            <input type="text" value="<?= htmlspecialchars($cliente['Id_cliente']) ?>" disabled>
                        </div>
                        <div class="box">
                            <label class="titulo">NOME:</label>
                            <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
                        </div>
                    </div>
                    
                    <!-- Coluna 2 -->
                    <div class="coluna direita">
                        <div class="box">
                            <label class="titulo">CPF:</label>
                            <input type="text" name="cpf" value="<?= htmlspecialchars($cliente['cpf']) ?>" required>
                        </div>
                        <div class="box">
                            <label class="titulo">TELEFONE:</label>
                            <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>
                        </div>
                    </div>
                    <div class="btn-ajuste">
                        <input class="btn-cliente" type="submit" name="submit" value="Salvar Alterações">
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>