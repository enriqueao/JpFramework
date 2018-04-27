<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aqua-LAC - Evaluador</title>
    <?=$this->render('Default/menuTipoUsuario','headGral',true);?>
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
                <?= $this->render("Default/menuTipoUsuario","1",true); ?>
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