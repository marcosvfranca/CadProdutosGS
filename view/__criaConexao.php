<?php
if (is_file(__DIR__ . "/../dao/class.conecta.php")) {
    header("Location: ../index.php");
}
?>
<style>html,body {height: 100%;}body {display: -ms-flexbox;display: flex;-ms-flex-align: center;align-items: center;  padding-top: 40px;padding-bottom: 40px;background-color: #f5f5f5;}.form-signin {  width: 100%;  max-width: 330px;  padding: 15px; margin: auto;}.form-signin .checkbox {font-weight: 400;}.form-signin .form-control {position: relative;box-sizing: border-box;height: auto;padding: 10px;font-size: 16px;}.form-signin .form-control:focus {z-index: 2;}.form-signin input[type="text"] {  margin-bottom: -1px;  border-bottom-right-radius: 0;border-bottom-left-radius: 0;}</style>
<body class="text-center">
    <form method="POST" role="form" action="<?= $GLOBALS['serverPath'] ?>controller/criaConexao.php" id="criaConexao" class="form-signin formCadastro" enctype="multipart/form-data">
        <input type="hidden" value="criaConexao" name="metodo">
        <h1 class="h3 mb-3 font-weight-normal">Informe os dados de conexão com o banco de dados</h1>
        <label class="sr-only">Host</label>
        <input type="text" name="host" class="form-control" placeholder="Host"autofocus>
        <label class="sr-only">Usuário</label>
        <input type="text" name="user" class="form-control" placeholder="Usuário">
        <label class="sr-only">Senha</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Senha">
        <label class="sr-only">Repita a Senha</label>
        <input type="password" name="password_again" class="form-control" placeholder="Repita a senha">
        <label class="sr-only">Nome do BD</label>
        <input type="text" name="schema" class="form-control" placeholder="Nome do BD">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar dados</button>
    </form>
</body>