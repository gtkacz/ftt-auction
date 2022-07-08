<?php

require_once("../../vendor/autoload.php");

include("partials/head.php");
?>
<body>
<div class="container">
    <form method="post" action="sign-up.inc" autocomplete="off" id="signup_form">
        <div class="title">
            <h2>Criar uma conta</h2>
            <div>
                <button type="submit" class="btn btn-success btn-size">Criar</button>
                <button type="button" class="btn btn-danger btn-size" onclick="window.location.href='index'">Cancelar</button>
            </div>
        </div>

        <hr>

        <div class="form">
            <div class="form-item">
                <label for="username">Nome de usuário</label>
                <input type="text" maxlength="30" id="username" name="username" placeholder="Escolha seu nome de usuário" oninvalid="this.setCustomValidity('Por favor escolha seu nome de usuário.')" oninput="this.setCustomValidity('')" required><br>
                
                <label for="password">Senha</label>
                <input type="password" maxlength="30" id="password" name="password" placeholder="Escolha sua senha" oninvalid="this.setCustomValidity('Por favor escolha sua senha.')" oninput="this.setCustomValidity('')" required><br>

                <label for="teamname">Nome do time</label>
                <input type="text" maxlength="30" id="teamname" name="teamname" placeholder="Escolha o nome do seu time" oninvalid="this.setCustomValidity('Por favor escolha o nome do seu time.')" oninput="this.setCustomValidity('')" required><br>
            </div>
        </div>
    </form>
</div>
<?php include("partials/footer.php"); ?>