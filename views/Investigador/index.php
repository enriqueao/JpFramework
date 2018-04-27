<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aqua-LAC - Evaluador</title>
    <link rel="stylesheet" href="<?=CSS?>estilosGrid.css">
    <link rel="stylesheet" href="<?=CSS?>estilosIndex.css">
    <link rel="stylesheet" href="<?=CSS?>estilosMenu.css">
    <link rel="stylesheet" href="<?=CSS?>estilosLoading.css">
    <link rel="stylesheet" href="<?=CSS?>estilosListaEvaluadores.css">
    <link rel="stylesheet" href="<?=CSS?>estilosPerfil.css">
    <link rel="stylesheet" href="<?=CSS?>FontAwesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=CSS?>croppie/croppie.css">

    <script defer src="<?=JS?>jQuery/jquery-3.1.1.js"></script>
    <script defer src="<?=JS?>croppie/croppie.js"></script>
    <script src="<?=JS?>config.js"></script>
    <script defer src="<?=JS?>investigadorJS/subirArticulo.js"></script>
    <script defer src="<?=JS?>coordinadorJS/coordinadorAcciones.js"></script>
    <script defer src="<?=JS?>funcionesMenu.js"></script>
    <script defer src="<?=JS?>validarInputs.js"></script>
</head>
<body>
  <div id="background-loading-notification" class="background-loading no-visible">
       <div id="salir"><i class="fa fa-times" aria-hidden="true"></i></div>
  </div>

  <div id="centrar_ventana_notificaciones"></div>
    <div id="header" class="div12">
       <?php $this->render("Default","header",true); ?>
    </div>
    <?=$this->render('Default','editarPerfil',true)?>
    <div id="container" class="div12">
        <div id="tabber" class="div12">
            <div id="tabss" class="div2">
                <?= $this->render("Default/menuTipoUsuario","3",true); ?>
            </div>
        </div>
        <div id="activeTab">
            <!--Animación de loading-->
            <div id="background-loading" class="background-loading no-visible"></div>
            <div id="drop" class="spinner no-visible"></div>
            <!--Animación de loading-->
            <div id="accionPrincipal">

            </div>
            <div id="accionLateral">
                <!--Animación de loading-->
                <div id="background-loadingLateral" class="background-loading no-visible"></div>
                <div id="dropLateral" class="spinner no-visible"></div>
                <!--Animación de loading-->
                <div id="frameLateral" class="div12 no-visible"></div>
                <p id="mensaje">No se ha seleccionado alguna acción</p>
            </div>
        </div>
    </div>
    <div id="footer" class="div12"></div>
</body>
</html>
