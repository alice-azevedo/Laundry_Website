<?php
session_start();
include_once('config.php');

if (isset($_POST['submit'])) {
    // Recuperando o CPF e buscando o cliente
    $cpf = $_POST['cpf'];
    $sql = "SELECT Id_cliente FROM cliente WHERE cpf = '$cpf'";
    $result = $conexao->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_cliente = (int)$row['Id_cliente'];
    } else {
        echo "Cliente não encontrado.";
        exit;
    }
    
    $data_e = $_POST['data_e'];
    $data_s = $_POST['data_s'];
    $stts = $_POST['stts'];
    $tipo_uni_met = mysqli_real_escape_string($conexao, $_POST['uni_met']); // se estiver usando como tipo
    $valor_total = str_replace(['R$', ',', ' '], ['', '.', ''], $_POST['preco']);

    $sqlInsertPedido = "INSERT INTO pedido (data_entrega, data_saida, stts, tipo_uni_met, valor_total, id_cliente) 
                        VALUES ('$data_e', '$data_s', '$stts', '$tipo_uni_met', '$valor_total', '$id_cliente')";
    $resultInsertPedido = $conexao->query($sqlInsertPedido);

    if (!$resultInsertPedido) {
        echo "Erro ao inserir o pedido: " . $conexao->error;
        exit;
    }

    $id_pedido = $conexao->insert_id;
    // var_dump($resultInsertPedido);die;
    // Verificando se o cliente possui um pedido
    // $sqlPedidoSelect = "SELECT Id_pedido FROM pedido WHERE id_cliente = $id_cliente ORDER BY Id_pedido DESC LIMIT 1";
    // $resultPedidoSelect = $conexao->query($sqlPedidoSelect);

    // if ($resultPedidoSelect && $resultPedidoSelect->num_rows > 0) {
    //     $row = $resultPedidoSelect->fetch_assoc();
    //     $id_pedido = (int)$row['Id_pedido'];
    // } else {
    //     echo "Pedido não encontrado.";
    //     // exit;
    // }

    // Processando os produtos
    // Processando UM produto
    if (!empty($_POST['descricao']) && !empty($_POST['quantidade']) && !empty($_POST['tipoLavagem'])) {
        $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
        $quantidade = mysqli_real_escape_string($conexao, $_POST['quantidade']); // mesmo sendo texto
        $tipo_lavagem = mysqli_real_escape_string($conexao, $_POST['tipoLavagem']);

        $sqlInsertProduto = "INSERT INTO produtos (descricao, quantidade, tipo_lavagem, id_cliente, id_pedido) 
                         VALUES ('$descricao', '$quantidade', '$tipo_lavagem', '$id_cliente', '$id_pedido')";

        if (!$conexao->query($sqlInsertProduto)) {
            echo "Erro ao inserir produto: " . $conexao->error;
            exit;
        }
    } else {
        echo "Dados do produto incompletos.";
    }

    $_SESSION['msg'] = '<span style="color: green; text-align: center;">"Serviço salvo com sucesso!"</span>';
    header("Location: novo_servico.php");
    exit;
}

// var_dump($_POST);die;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="novo_servico.css?v=1">
    <title>Novo Serviço</title>
</head>

<body>
    <div class="sessao-servicos">
        <a href="main.php"><input class="sub-servico" type="submit" name="submit" value="Voltar"></a>

        <section class="container-servico">
            <form action="novo_servico.php" method="post">
                <div class="form-grid">
                    <!-- Coluna 1 -->
                    <div class="coluna esquerda">
                        <div class="box">
                            <input type="text" name="cpf" placeholder="Digite o CPF" required>
                        </div>
                        <br>
                        <div class="box">
                            <label class="titulo" for="data_e">DATA DE ENTREGA:</label>
                            <input type="text" name="data_e" id="data_e" placeholder="00/00/0000" required>
                        </div>

                        <div class="box">
                            <label class="titulo" for="data_s">DATA DE SAÍDA:</label>
                            <input type="text" name="data_s" id="data_s" placeholder="00/00/0000" required>
                        </div>

                        <div class="box">
                            <label class="titulo">STATUS:</label>
                            <select id="stts" name="stts">
                                <option value="nao_iniciado">Não Iniciado</option>
                                <option value="pendente">Pendente</option>
                                <option value="concluído">Concluído</option>
                            </select>
                        </div>

                        <div class="box">
                            <label class="titulo">PRODUTOS:</label>
                            <label>
                                <input type="text" name="descricao">
                            </label>
                            <label class="titulo">QUANTIDADE:</label>
                            <input type="text" name="quantidade">
                        </div>
                    </div>

                    <!-- Coluna 2 -->
                    <div class="coluna direita">
                        <div class="box">
                            <label class="titulo">TIPO DE LAVAGEM:</label>
                            <input type="text" name="tipoLavagem" placeholder="Ex: Seco">
                        </div>

                        <div class="box">
                            <label class="titulo">POR:</labe>
                        </div>
                        <input type="text" name="uni_met" placeholder="metro/unidade">

                        <div class="box">
                            <label class="titulo">PREÇO:</label>
                            <input name="preco" type="text" placeholder="R$ 0,00">
                        </div>

                        <div class="botao-1">
                            <input class="sub-servico-1" type="submit" name="submit" value="Salvar">
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['msg'])) {
                    echo "<br><div class='mensagem-feedback'>" . $_SESSION['msg'] . "</div>";
                    unset($_SESSION['msg']);
                }
                ?>

            </form>
        </section>

    </div>
</body>

</html>