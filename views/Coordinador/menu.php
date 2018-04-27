<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú | UNESCO</title>
    <link rel="stylesheet" href="<?=CSS?>estilosGrid.css">
    <link rel="stylesheet" href="<?=CSS?>estilosIndex.css">
    <link rel="stylesheet" href="<?=CSS?>estilosMenu.css">
    <link rel="stylesheet" href="<?=CSS?>estilosLoading.css">
    <link rel="stylesheet" href="<?=CSS?>FontAwesome/css/font-awesome.min.css">
    <script src="<?=JS?>config.js"></script>
    <script defer src="<?=JS?>funcionesMenu.js"></script>
</head>
<body>
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
       <div id="userInfo" class="div4">
           <span>Nombre Nombre</span>
           <div id="opcionesUsuario">
               <div class="opcion div12"><i class="fa fa-sign-in fa-lg"></i></div>
               <div class="opcion div12"><i class="fa fa-cog fa-lg"></i></div>
           </div>
           <img src="<?=IMG?>defaultUser.jpg" alt="DefaultUser">
       </div>
    </div>
    <div id="container" class="div12">
        <div id="tabber" class="div12">
            <div id="tabss" class="div2">
                <div class="opciones"><h4>Opciones</h4></div>

                <div onclick="crearVista(this)" class="tabb tab-activeInside"><h4>Listado de Evaluadores</h4></div>

                <div onclick="crearVista(this)" class="tabb"><h4>Categorías</h4></div>

                <div onclick="crearVista(this)" class="tabb"><h4>Historial de Descargas</h4></div>

                <div onclick="crearVista(this)" class="tabb"><h4>Gráficas</h4></div>
            </div>
        </div>
        <div id="activeTab">
                <!--Animación de loading-->
                    <div id="background-loadingLateral" class="background-loading no-visible"></div>
                    <div class="spinner no-visible"></div>
                <!--Animación de loading-->
                <div id="accionPrincipal"></div>
                <div id="accionLateral">
                    <!--Animación de loading-->
                        <div id="background-loadingLateral" class="background-loading no-visible"></div>
                        <div class="spinner no-visible"></div>
                    <!--Animación de loading-->
                    <p id="mensaje">No se ha seleccionado alguna acción</p>
                </div>
            </div>
    </div>
    <div id="footer" class="div12"></div>
</body>
</html>
