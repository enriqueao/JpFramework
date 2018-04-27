<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio | UNESCO</title>
    <?=$this->render('Default','headDependencies',true);?>
    <script defer src="<?=JS?>funcionesIndex.js"></script>
    <script defer src="<?=JS?>usuarioJS/iniciarSesion.js"></script>
    <script defer src="<?=JS?>usuarioJS/registro.js"></script>
    <script defer src="<?=JS?>usuarioJS/solicitudDeRecuperacion.js"></script>
    <script defer src="<?=JS?>validarInputs.js"></script>
</head>

<body>
    <div id="background-loading-notification" class="background-loading no-visible"></div>
    <div id="centrar_ventana_notificaciones"></div>
    <div id="modalRecuperarPass" class="no-visible">
       <div id="editarPerfil-back" class="background-loading"></div>
       <div  onclick="mostrarRecuperacion()" id="salir"><i class="fa fa-times fro" aria-hidden="true"></i></div>
        <div id="recuperarPass">
            <div>
                <h4>Recuperación de Contraseña</h4>
            </div>
            <label class="div10" for="correoSolicitud">Correo</label>
            <input class="div10" id="correoSolicitud" type="text" name="correo" placeholder="algo@example.com" onblur="validateMail(this)">
            <button type="button" name="button" id="btnSolicitud">Solicitar</button>
        </div>
    </div>
    <div id="header" class="div12">
        <div class="logosUnesco">
            <img src="<?=IMG?>logoUN2.png" alt="UnescoLogo">
            <span>Revista Aqua-LAC</span>
        </div>
        <!--<div class="logosPHI">
            <img src="<?=IMG?>PHI.png" alt="UnescoLogo">
            <p>Programa Hidrológico Internacional</p>
        </div>
        <div class="logosAqua">
            <img src="<?=IMG?>aqua-lac.png" alt="aqua-lac">
        </div>-->
    </div>
    <div id="container" class="div12">
        <div id="noticias">
            <div id="msjBi">
                <h1>¡Bienvenido, futuro investigador!</h1><br>
                <p>Dentro de este sistema podrás subir tus artículos de investigación científica para que estos puedan ser evaluados y posteriormente aprobados dentro de la revista científica AQUALAC. <br><br> Si es la primera vez que utilizas el sistema, te invitamos a ver el vídeo introductorio al sistema dándo clic <a onclick="showVid()" id="showVid">aquí</a>, una vez que lo veas te invitamos a registrarte y hacer uso del mismo sistema.</p>
            </div>
            <div id="logosCr">
                <h1>Esta plataforma es un esfuerzo conjunto de</h1>
                <div id="colabs">
                    <img id="imgOne" src="<?=IMG?>unphi.jpg" alt="">
                    <img id="imgTwo" src="<?=IMG?>aqualac.png" alt="">
                    <div><img src="<?=IMG?>uaq.png" alt=""><p>Universidad Autónoma de Querétaro</p></div>
                    <div><img src="<?=IMG?>fi.png" alt=""><p>Facultad de Informática</p></div>
                </div>
            </div>
        </div>
        <div id="forms">
            <div id="tabs" class="div12">
                <div onclick="cambiarForm(this, 'login')" class="tab div6 tab-active" id="loginTab">
                    <h4>Entrar</h4>
                </div>
                <div onclick="cambiarForm(this, 'registro')" class="tab div6" id="registroTab">
                    <h4>Registrarse</h4>
                </div>
            </div>
            <div id="login" class="div12 activo">
                <div><img src="<?=IMG?>logoUN2.png" alt="UnescoLogo"></div>
                <span>Revista Aqua-LAC</span>
                <!--Animación de loading-->
                <div id="background-loadingLogin" class="background-loading no-visible"></div>
                <div id="spinner-login" class="spinner no-visible"></div>
                <!--Animación de loading-->
                <label class="div10" for="correo">Correo</label>
                <input id="username" class="div10" type="text" name="correo" placeholder="algo@example.com" onblur="validateMail(this)">
                <label class="div10" for="pass">Contraseña</label>
                <input id="password" class="div10" type="password" name="pass" placeholder="*******" onblur="checkEmpty(this)">
                <button id="btnIniciarSesion">Entrar</button>
                <label class="div10" for="pass" style="text-align:center;font-size:.8em;">
                <a onclick="mostrarRecuperacion()" href="#">¿Olvidaste tu contraseña?</a></label>
            </div>

            <div id="registro" class="div12 no-visible">
                <!--Animación de loading-->
                <div id="background-loadingRegistro" class="background-loading no-visible"></div>
                <div id="spinner-registro" class="spinner no-visible"></div>
                <!--Animación de loading-->
                <label class="div10" for="nombre">Nombre(s)</label>
                <input id="nombre" class="div10" type="text" name="nombre" placeholder="Nombre*" onblur="checkEmpty(this)" onkeypress="return words(event)">
                <label class="div10" for="apellido">Apellido(s)</label>
                <input id="apellidoP" class="div5" type="text" name="apellidoP" placeholder="Primer Apellido*" onblur="checkEmpty(this)" onkeypress="return words(event)">
                <!--<div class="div1 espacio"></div>-->
                <input id="apellidoM" class="div5" type="text" name="apellidoM" placeholder="Segundo Apellido" onkeypress="return words(event)">
                <label class="div10" for="correo">Correo</label>
                <input id="correo" class="div10" type="text" name="correo" placeholder="algo@example.com*" onblur="checkEmpty(this),validateMail(this)">
                <label class="div10" for="confCorreo">Confirmar correo</label>
                <input id="confCorreo" class="div10" type="text" name="confCorreo" placeholder="algo@example.com*" onblur="checkEmpty(this),validateMail(this)">
                <label class="div5" for="pass">Contraseña</label>
                <label class="div5" for="confPass">Confirmar contraseña</label>
                <input id="pass" class="div5" type="password" name="pass" placeholder="*******" onblur="checkEmpty(this)">
                <input id="confPass" class="div5" type="password" name="confPass" placeholder="*******" onblur="checkEmpty(this)">
                <label class="div10" for="pais">País</label>
                <select required id="pais" class="div10" name="pais" onchange="checkSelect(this)">
                    <option value="0" hidden selected disabled>Seleccione...</option>
                    <?=$this->paises;?>
                </select>
                <label class="div10" for="pais">Institución Educativa</label>
                <input id="inEdu" class="div10" list="instituciones" type="text" placeholder="UNIVERSIDAD AUTÓNOMA DE QUERÉTARO" style="text-transform: uppercase;">
                <datalist id="instituciones">
                    <?= $this->instituciones; ?>
                </datalist>
                <button id="btnRegistro">Registrarse</button>
            </div>
        </div>
    </div>
    <div id="footer" class="div12">
    </div>
</body>

</html>
