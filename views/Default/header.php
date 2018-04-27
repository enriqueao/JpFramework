<div class="logosUnesco">
    <img src="<?=IMG?>logoUN2.png" alt="UnescoLogo">
    <span>Revista Aqua-LAC</span>
</div>
<div id="userInfo" class="div4">
    <span id="nombreUsuario"><?=Session::getValue('nombre').' '.Session::getValue('apellidoPaterno').' '.Session::getValue('apellidoMaterno')?></span>
    <img id="perfilUsuarioImg" src="<?=IMG.'dXN1YXJpb3M/'.Session::getValue('imagenPerfil')?>">
    <div id="opcionesUsuario">
      <a href="<?=URL?>Usuario/cerrarSesion"><div class="opcion div12 tooltipright"><i class="fa fa-sign-in fa-lg"></i><span class="tooltiptextright">Salir</span></div></a>
      <div onclick="mostrarPerfil()" class="opcion div12 tooltipright"><i class="fa fa-cog fa-lg"></i><span class="tooltiptextright">Perfil</span></div>
    </div>
</div>

<!--<div class="logosUnesco">
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
    <span id="nombreUsuario"><?=Session::getValue('nombre').' '.Session::getValue('apellidoPaterno').' '.Session::getValue('apellidoMaterno')?></span>
    <img id="perfilUsuarioImg" src="<?=IMG.'dXN1YXJpb3M/'.Session::getValue('imagenPerfil')?>">
    <div id="opcionesUsuario">
      <a href="<?=URL?>Usuario/cerrarSesion"><div class="opcion div12 tooltipright"><i class="fa fa-sign-in fa-lg"></i><span class="tooltiptextright">Salir</span></div></a>
      <div onclick="mostrarPerfil()" class="opcion div12 tooltipright"><i class="fa fa-cog fa-lg"></i><span class="tooltiptextright">Perfil</span></div>
    </div>
</div>-->
