<?php
include "cabecera_registro.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css/register_login.css">
  <link rel="stylesheet" href="../css/cabecera.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Registro</title>
</head>

<body>

  <div class="container_global">
    <div class="container">
      <form id="form" action="" method="post">
        <div class="row">
          <h4>Crear cuenta</h4>
          <div class="input-group input-group-icon">
            <input type="text" placeholder="Nombre" />
            <div class="input-icon"><i class="fa fa-user"></i></div>
          </div>
          <div class="input-group input-group-icon">
            <input type="email" placeholder="Correo electrónico" />
            <div class="input-icon"><i class="fa fa-envelope"></i></div>
          </div>
          <div class="input-group input-group-icon">
            <input type="password" placeholder="Contraseña" />
            <div class="input-icon"><i class="fa fa-key"></i></div>
          </div>
          <div class="input-group input-group-icon">
            <input type="password" placeholder="Repetir contraseña" />
            <div class="input-icon"><i class="fa fa-key"></i></div>
          </div>
        </div>

        <div class="row">
          <h4>Términos y condiciones</h4>
          <div class="input-group">
            <input type="checkbox" id="terms" />
            <label for="terms">He leído y acepto los términos y las condiciones de uso.</label>
          </div>
        </div>
        <div>
          <input type="button" class="btn_reg" value="REGISTRAR">
        </div>
      </form>
    </div>
    <br>

    <!-- LOGIN -->
    <div class="container_login">
      <form id="form" action="" method="post">
        <div class="row">
          <h4>Entrar</h4>
          <div class="input-group input-group-icon">
            <input type="email" placeholder="Correo electrónico" />
            <div class="input-icon"><i class="fa fa-envelope"></i></div>
          </div>
          <div class="input-group input-group-icon">
            <input type="password" placeholder="Contraseña" />
            <div class="input-icon"><i class="fa fa-key"></i></div>
          </div>
        </div>
        <div>
          <input type="button" class="btn_reg" value="ENTRAR">
        </div>
      </form>
    </div>
  </div>
</body>

</html>