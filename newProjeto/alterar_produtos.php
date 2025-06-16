<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("config.php");

if (!empty($_GET['produto'])) {
    $id_produtos = $_GET['produto'];

    $sql = "SELECT * FROM produtos WHERE Id_produtos = $id_produtos";
    $result = $conexao->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $produto = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $descricao = $conexao->real_escape_string($_POST['descricao']);
        $quantidade = $conexao->real_escape_string($_POST['quantidade']);
        $tipoLavagem = $conexao->real_escape_string($_POST['tipoLavagem']);

        $update = "UPDATE produtos SET 
            descricao='$descricao',
            quantidade='$quantidade',
            tipo_lavagem='$tipoLavagem'
            WHERE Id_produtos = $id_produtos";

        if ($conexao->query($update)) {
            $_SESSION['msg'] = "Produto atualizado com sucesso!";
            header("Location: main.php");
            exit;
        } else {
            echo "Erro ao atualizar produto: " . $conexao->error;
        }
    }
} else {
    echo "ID do produto não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="alterar_pr.css?v=1">
    <title>Alterar Produto</title>
</head>

<body>
    <div class="sessao-produtos">
        <a href="main.php"><input class="but-produtos" type="button" value="Voltar"></a>

        <section class="container-produtos">
            <form action="" method="post">
                <div class="form-grid">
                    <!-- Coluna 1 -->
                    <div class="coluna esquerda">
                        <div class="box">
                            <label class="titulo">DESCRIÇÃO:</label>
                            <input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>" required>
                        </div>
                        <div class="box">
                            <label class="titulo">QUANTIDADE:</label>
                            <input type="text" name="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" required>
                        </div>
                    </div>
                    
                    <!-- Coluna 2 -->
                    <div class="coluna direita">
                        <div class="box">
                            <label class="titulo">TIPO DE LAVAGEM:</label>
                            <input type="text" name="tipoLavagem" value="<?= htmlspecialchars($produto['tipo_lavagem']) ?>" required>
                        </div>
                        <div class="btn-ajuste">
                            <input class="btn-produtos" type="submit" name="submit" value="Salvar Alterações">
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</body>
</html>