<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QueCotejo</title>
    <style>
        body{font-family: "Roboto", Helvetica, Arial, sans-serif}
        .bor { border: 1px solid lightgrey;margin: 5px;border-radius: 5px; padding: 10px;width: 35%}
        .max{max-width: 60px}
        .P-ten{color: #5a92f2; font-size: 18px}
        .btn-ten{background-color: #5a92f2; text-decoration:none; border: 1px solid #5a92f2;border-radius: 0;color: white;padding: 8px }
        .ten{border-top: 1px solid #5a92f2}
        .footer{color: darkgrey !important;}
        .text-center{text-align: center}
    </style>
</head>
<body>
<div class="container bor">
    <div class="row">
        <div class="col-md-12"></div>
        <div class="col-md-12">
            <img src="http://www.hbc333.com/data/out/19/46706024-ball.png"  class="max" alt="">
        </div>
        <div class="col-md-12">
            <h3><strong>Bienvenido {{ $user->name }}</strong></h3><br>
        </div>
        <div class="col-md-12">
            <p>Tu codigo de verificaci&oacute;n:</p><br>
        </div>
        <div class="col-md-12 text-center">
            <p class="P-ten">{{$user->codeActive}}</p><br>
            <a class="btn-ten" href="{{ url('/#/verify?code='.$user->codeActive) }}">ACTIVAR CODIGO</a>
        </div>
        <div class="col-md-12">
            <br>
            <p> Si usted no solicit&oacute; esto, simplemente ignore o elimine este mensaje.</p><br>
            <p><strong>Gracias!</strong></p>
        </div>
        <div class="col-md-12 text-center">
            <hr class="ten">
            <p class="footer">Este correo no puede recibir respuestas, por favor, no responda.</p>
        </div>
    </div>
</div>
</body>
</html>
