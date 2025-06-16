
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('config.php');

// Excluir pedido + pagamento
if (isset($_GET['pedido'])) {
  $id = $_GET['pedido'];

  // Agora apaga o pedido
  $sql = "DELETE FROM pedido WHERE Id_pedido = $id";
  mysqli_query($conexao, $sql);

  header("Location: main.php");
}

// Excluir produto
elseif (isset($_GET['produto'])) {
    $id = $_GET['produto'];
    $sql = "DELETE FROM produtos WHERE Id_produtos = $id";
    mysqli_query($conexao, $sql);
    header("Location: main.php");
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM cliente WHERE Id_cliente = $id";
  $result = mysqli_query($conexao, $sql);
  header('Location: main.php');
}
else {
    echo "Nenhum parâmetro de exclusão recebido.";
}

// DELETE FROM `produtos` WHERE `produtos`.`Id_produtos` = 47;


