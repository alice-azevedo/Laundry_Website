<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css?v=2">
  <title>Tela de login</title>
</head>

<body>
  <div class="login-hero-bg">
    <div class="estilo-login novo-login">
      <h1>Login</h1>
      <div class="login-desc">Por favor, coloque a senha para acessar o sistema</div>
      <form action="teste_login.php" method="post">
        <input type="password" placeholder="Digite sua senha" class="inp-login" name="senha" id="senha" autocomplete="off" required>
        <button class="sub-login" type="submit" name="submit">Entrar</button>
      </form>
    </div>
  </div>
</body>

</html>