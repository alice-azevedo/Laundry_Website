<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("config.php");

if (!empty($_GET['pedido'])) {
    $id_pedido = $_GET['pedido'];

    $sql = "SELECT * FROM pedido WHERE Id_pedido = $id_pedido";
    $result = $conexao->query($sql);
    $pedido = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data_e = $_POST['data_e'];
        $data_s = $_POST['data_s'];
        $stts = $_POST['stts'];
        $uni_met = $_POST['uni_met'];
        $valor = str_replace(['R$', ',', ' '], ['', '.', ''], $_POST['preco']);

        $update = "UPDATE pedido SET 
            data_entrega='$data_e',
            data_saida='$data_s',
            stts='$stts',
            tipo_uni_met='$uni_met',
            valor_total='$valor'
            WHERE Id_pedido = $id_pedido";

        if ($conexao->query($update)) {
            header("Location: main.php");
            exit;
        } else {
            echo "Erro ao atualizar pedido: " . $conexao->error;
        }
    }
} else {
    echo "ID do pedido não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="alterar_pedido.css?v=1">
    <title>Alterar Serviço</title>
</head>

<body>
<div class="sessao-pedidos">
    <a href="main.php"><input class="btn-pedido" type="button" value="Voltar"></a>

    <section class="container-pedido">
        <form action="" method="post">
            <div class="form-grid">
                <!-- Coluna 1 -->
                <div class="coluna esquerda">
                    <div class="box">
                        <label class="titulo">DATA DE ENTREGA:</label>
                        <input type="text" name="data_e" value="<?= $pedido['data_entrega'] ?>" required>
                    </div>
                    <div class="box">
                        <label class="titulo">DATA DE SAÍDA:</label>
                        <input type="text" name="data_s" value="<?= $pedido['data_saida'] ?>" required>
                    </div>
                    <div class="box">
                        <label class="titulo">STATUS:</label>
                        <select name="stts">
                            <option value="nao_iniciado" <?= $pedido['stts'] == 'nao_iniciado' ? 'selected' : '' ?>>Não Iniciado</option>
                            <option value="pendente" <?= $pedido['stts'] == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                            <option value="concluído" <?= $pedido['stts'] == 'concluído' ? 'selected' : '' ?>>Concluído</option>
                        </select>
                    </div>
                </div>
                
                <!-- Coluna 2 -->
                <div class="coluna direita">
                    <div class="box">
                        <label class="titulo">POR:</label>
                        <input type="text" name="uni_met" value="<?= $pedido['tipo_uni_met'] ?>">
                    </div>
                    <div class="box">
                        <label class="titulo">PREÇO:</label>
                        <input type="text" name="preco" value="R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?>">
                    </div>
                    <div class="btn-ajuste">
                        <input class="btn-pedido" type="submit" name="submit" value="Salvar Alterações">
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
</body>
</html>