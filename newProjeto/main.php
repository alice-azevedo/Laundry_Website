<?php
session_start();

if ((!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['senha']);
    header('Location: login.php');
}

$logado_ao_sistema = $_SESSION['senha'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css?v=1.0">
    <title>Controle Lavanderia</title>
</head>

<body>
    <nav>

        <ul class="js-tabMenu">
            <li>Serviços</li>
            <li>Clientes</li>
            <li>Relatório</li>
        </ul>
    </nav>

    <div class="sair">
        <a href="botao_sair.php"><button>Sair</button></a>
    </div>

    <div id="container-sessao">
        <!-- <form action="" method="post"> -->
        <div class="js-tabConteudo sessao_unica">
            <section class="sessoes">
                <div class="flex">
                    <h3>Serviços</h3>
                    <a href="novo_servico.php"><input type="submit" class="sub" value="Novo Serviço"></a>
                </div>
                <!-- Primeira tabela: Pedidos + Pagamento -->
                <div class="table-estilo">
                    <?php
                    include_once('config.php');
                    $sql = "SELECT DISTINCT
                    c.Id_cliente,
                    c.nome,
                    c.cpf,
                    p.Id_pedido,
                    p.data_entrega,
                    p.data_saida,
                    p.stts,
                    p.tipo_uni_met,
                    p.valor_total
                FROM cliente c
                INNER JOIN pedido p ON c.Id_cliente = p.id_cliente
                ORDER BY p.Id_pedido ASC";
                                // print_r($sql);

                    $result = $conexao->query($sql);
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Cliente</th>
                                <th>CPF</th>
                                <th>Data Entrega</th>
                                <th>Data Saída</th>
                                <th>Status</th>
                                <th>Unid/Metro</th>
                                <th>Preço</th>
                                <th>Excluir</th>
                                <th>Alterar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                // print_r($row);
                                echo "<tr>";
                                echo "<td>" . $row['Id_pedido'] . "</td>";
                                echo "<td>" . $row['nome'] . "</td>";
                                echo "<td>" . $row['cpf'] . "</td>";
                                echo "<td>" . $row['data_entrega'] . "</td>";
                                echo "<td>" . $row['data_saida'] . "</td>";
                                echo "<td>" . ucfirst($row['stts']) . "</td>";
                                echo "<td>" . $row['tipo_uni_met'] . "</td>";
                                echo "<td>" . ($row['valor_total']) . "</td>";
                                echo '<td><a class="sub-cliente" href="excluir.php?pedido=' . $row["Id_pedido"] . '">Excluir</a></td>';
                                echo '<td><a class="sub-cliente-2" href="alterar_pedido.php?pedido=' . $row["Id_pedido"] . '">Alterar</a></td>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="table-estilo">
                    <?php
                    include_once('config.php');
                   $sql = "SELECT
                    c.Id_cliente AS id_cliente,
                    c.nome AS nome_cliente,
                    p.Id_pedido,
                    pr.Id_produtos AS id_produtos,
                    pr.descricao,
                    pr.quantidade,
                    pr.tipo_lavagem
                FROM cliente c
                INNER JOIN pedido p ON c.Id_cliente = p.id_cliente
                INNER JOIN produtos pr ON p.Id_pedido = pr.id_pedido
                ORDER BY pr.Id_produtos ASC";
                    $result = $conexao->query($sql);
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Cliente</th>
                                <th>Descrição</th>
                                <th>Quantidade</th>
                                <th>Tipo de Lavagem</th>
                                <th>Alterar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['Id_pedido'] . "</td>";
                                echo "<td>" . $row['nome_cliente'] . "</td>";
                                echo "<td>" . $row['descricao'] . "</td>";
                                echo "<td>" . $row['quantidade'] . "</td>";
                                echo "<td>" . $row['tipo_lavagem'] . "</td>";
                                echo '<td><a class="sub-cliente-2" href="alterar_produtos.php?produto=' . $row["id_produtos"] . '">Alterar</a></td>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </section>
            <section class="sessoes">
                <div class="flex">
                    <h3>Clientes</h3>
                    <a href="novo_cliente.php"><input type="submit" class="sub" value="Novo Cliente"></a>
                </div>
                <div class="table-estilo">
                    <?php
                    include_once('config.php');

                    $sql = "SELECT * FROM cliente ORDER BY Id_cliente ASC";

                    $result = $conexao->query($sql);
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <!-- <th scope="col">#</th> -->
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">CPF</th>
                                <th scope="col">Alterar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user_data = mysqli_fetch_assoc($result)) {
                                echo "<tr> ";
                                // echo "<td>" . $user_data['#'] . "</td>";
                                echo "<td>" . $user_data['Id_cliente'] . "</td>";
                                echo "<td>" . $user_data['nome'] . "</td>";
                                echo "<td>" . $user_data['telefone'] . "</td>";
                                echo "<td>" . $user_data['cpf'] . "</td>";
                                echo '<td><a class="sub-cliente-2" href="alterar_cliente.php?cliente=' . $user_data["Id_cliente"] . '">Alterar</a></td>';
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="sessoes">
                <div class="flex">
                    <h3>Relatório</h3>
                </div>
                <div class="table-estilo">
                    <?php
                    include_once('config.php');

                    $sql = "SELECT 
                    c.Id_cliente AS id_cliente,
                    p.Id_pedido AS id_pedido,
                    p.Id_pedido AS id_cliente,
                    p.data_entrega,
                    p.data_saida,
                    p.stts 
                    FROM cliente as c
                    INNER JOIN pedido as p 
                    on c.Id_cliente = p.id_cliente";

                    $result = $conexao->query($sql);
                    ?>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Data de Entrada</th>
                                <th scope="col">Data de Saída</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($user_data = mysqli_fetch_assoc($result)) {
                                echo "<tr> ";
                                echo "<td>" . $user_data['data_entrega'] . "</td>";
                                echo "<td>" . $user_data['data_saida'] . "</td>";
                                echo "<td>" . $user_data['stts'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>


    <script src="ativaPopUp.js"></script>
</body>

</html>