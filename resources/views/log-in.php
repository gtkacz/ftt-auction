<?php

require_once("../../vendor/autoload.php");

include("partials/head.php");

if (isset($_GET["error"])){
    echo '<script>alert("Senha incorreta.")</script>';
}
?>
<body>
<div class="container">
    <form method="post" action="log-in.inc" autocomplete="off" id="login_form">
        <div class="title">
            <h2>Fazer login</h2>
            <div>
                <button type="submit" class="btn btn-success btn-size">Entrar</button>
                <button type="button" class="btn btn-danger btn-size" onclick="window.location.href='index'">Cancelar</button>
            </div>
        </div>

        <hr>

        <div class="form">
            <div class="form-item">
                <label for="username">Nome de usuário</label>
                <input type="text" maxlength="30" id="username" name="username" placeholder="Digite seu nome de usuário" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="this.setCustomValidity('')" required><br>
                
                <label for="password">Senha</label>
                <input type="password" maxlength="30" id="password" name="password" placeholder="Digite sua senha" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="this.setCustomValidity('')" required><br>
            </div>
        </div>
    </form>
</div>
<?php include("partials/footer.php"); ?>