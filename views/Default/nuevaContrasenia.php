<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Establecer Contraseña</title>
    <link rel="stylesheet" href="<?=CSS?>estilosGrid.css">
    <link rel="stylesheet" href="<?=CSS?>estilosEstablecerContrasenia.css">

    <script defer src="<?=JS?>jQuery/jquery-3.1.1.js"></script>
    <script defer src="<?=JS?>config.js"></script>
    <script defer src="<?=JS?>usuarioJS/establecerContrasena.js"></script>
</head>

<body>
   <div id="background" class="background-loading no-visible"></div>
   <div id="drop" class="spinner no-visible"></div>
    <div id="centrar_ventana_notificaciones"></div>
    <div id="header" class="div12">
        <div class="logosUnesco">
            <img src="<?=IMG?>logo.png" alt="UnescoLogo">
            <p>Organización de las Naciones Unidas para la Educación, la Ciencia y la Cultura</p>
        </div>
        <div class="logosPHI">
            <img src="<?=IMG?>PHI.png" alt="UnescoLogo">
            <p>Programa Hidrológico Internacional</p>
        </div>
        <div class="logosAqua">
            <img src="<?=IMG?>aqua-lac.png" alt="aqua-lac">
        </div>
    </div>
    <div id="recuperarPass" class="div3">
        <div>
            <h4>Establecimiento de Contraseña</h4>
        </div>
        <label class="div10" for="pass">Contraseña</label>
        <input class="div10" id="pass" type="password" name="pass" placeholder="********">
        <label class="div10" for="confPass">Confirmar Contraseña</label>
        <input class="div10" id="confPass" type="password" name="confPass" placeholder="*********">
        <button type="button" name="button" id="establecerContrasena">Establecer</button>
    </div>
    <div id="footer" class="div12">
    </div>
</body>

</html>
