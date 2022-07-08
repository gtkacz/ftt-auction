<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="icon" type="image/png" href="resources/images/favico.ico"/>
<link rel="stylesheet" type="text/css" href="resources/css/main.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
<script type="text/javascript" src="resources/js/main.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fantasy Trash Talk</title>
</head>

<nav class="navbar bg-dark title-nav" style="padding: 1.5ch !important;">
    <div class="site-title-container">
        <img src="resources/images/logo.png" style="height: 5ch; cursor: default;">
        <h1 class="site-title">Fantasy Trash Talk</h1>
    </div>
    <?php
    session_start();

    if (!isset($_SESSION["username"])){
        echo <<<LOGSIGN
        <div class="site-title-container">
            <button type="button" style="background-color:transparent; color:#FF9000;" class="btn" onclick="window.location.href='resources/views/sign-up'">Signup</button>
            <button type="button" style="background-color:#FF9000;" class="btn" onclick="window.location.href='resources/views/log-in'">Login</button>
        </div>
        LOGSIGN;
    }
    else{
        ?>
        <div class="site-title-container">
            <span style="color:white;" class="btn">Bem vindo, <span style="color:#FF9000; cursor:pointer;"><?= $_SESSION['username'] ?></span></span>
            <button type="button" style="background-color:#FF9000;" class="btn" onclick="window.location.href='resources/views/log-out.inc'">Logout</button>
        </div>
        <?php
    }
    ?>
    
</nav>