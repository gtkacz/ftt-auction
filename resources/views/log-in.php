<?php

require_once("../../vendor/autoload.php");

include("partials/head.php");

use App\models\User;

if (isset($_GET["error"])){
    echo '<script>alert("Senha incorreta.")</script>';
}

if (isset($_GET["index"])){
    echo '<script>alert("Você deve estar logado para utilizar o site.")</script>';
}

if (isset($_GET["success"])){
    echo '<script>alert("Usuário criado com suecesso.")</script>';
}

$allUsers = User::getUsers();
$results = "";

foreach ($allUsers as $row) {
    $results .= '<option value="' . $row->USERNAME . '">' . $row->USERNAME . '</option>';
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
                
                <!-- <input type="text" maxlength="30" id="username" name="username" placeholder="Digite seu nome de usuário" oninvalid="this.setCustomValidity('Please, submit required data')" oninput="this.setCustomValidity('')" required><br> -->

                <label for="username">Nome de usuário</label>
                <select id="username" name="username" class="div-toggle" required>
                    <?= $results ?>
                </select><br>
                
                <label for="password">Senha</label>
                <input type="password" maxlength="30" id="password" name="password" placeholder="Digite sua senha" oninvalid="this.setCustomValidity('Por favor digite sua senha.')" oninput="this.setCustomValidity('')" required><br>
            </div>
        </div>
    </form>
</div>
<?php include("partials/footer.php"); ?>