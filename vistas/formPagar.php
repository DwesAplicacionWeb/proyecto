<?php 
  // Proyecto Grupal DWES
  // @author Isa Kapov, Jonathan López, Álvaro Colás
  // Titulo: Tienda camisetas NBA
  // Fecha de inicio de proyecto: 5/12/2019
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/registro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Registro</title>
</head>
<body>

<div class="container">
  <form id="form" action="" method="post">
    <div class="row">
      <h4>Cuenta</h4>
      <div class="input-group input-group-icon">
        <input type="text" placeholder="Nombre"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="email" placeholder="Correo electrónico"/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="password" placeholder="Contraseña"/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
    </div>
    <div class="row">
      <div class="col-half">
        <h4>Fecha de nacimiento</h4>
        <div class="input-group">
          <div class="col-third">
            <input type="text" placeholder="DD"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="MM"/>
          </div>
          <div class="col-third">
            <input type="text" placeholder="YYYY"/>
          </div>
        </div>
      </div>
      <div class="col-half">
        <h4>Sexo</h4>
        <div class="input-group">
          <input type="radio" name="gender" value="male" id="gender-male"/>
          <label for="gender-male">Hombre</label>
          <input type="radio" name="gender" value="female" id="gender-female"/>
          <label for="gender-female">Mujer</label>
        </div>
      </div>
    </div>
    <div class="row">
      <h4>Método de pago</h4>
      <div class="input-group">
        <input type="radio" name="payment-method" value="card" id="payment-method-card" checked="true"/>
        <label for="payment-method-card"><span><i class="fa fa-cc-visa"></i>Tarjeta de crédito</span></label>

        <input type="radio" name="payment-method" value="paypal" id="payment-method-paypal"/>
        <label for="payment-method-paypal"> <span><i class="fa fa-cc-paypal"></i>Paypal</span></label>
      </div>
      <div class="input-group input-group-icon">
        <input type="text" placeholder="Número de la tarjeta"/>
        <div class="input-icon"><i class="fa fa-credit-card"></i></div>
      </div>
      <div class="col-half">
        <div class="input-group input-group-icon">
          <input type="text" placeholder="CVC"/>
          <div class="input-icon"><i class="fa fa-user"></i></div>
        </div>
      </div>
      <div class="col-half">
        <div class="input-group">
          <select>
            <option>01 Jan</option>
            <option>02 Jan</option>
          </select>
          <select>
            <option>2019</option>
            <option>2020</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <h4>Términos y condiciones</h4>
      <div class="input-group">
        <input type="checkbox" id="terms"/>
        <label for="terms">He leído y acepto los términos y las condiciones de uso.</label>
      </div>
    </div>
    <div>
        <input type="button" class="btn_reg" value="REGISTRAR">
    </div>
  </form>
</div>
</body>
</html>