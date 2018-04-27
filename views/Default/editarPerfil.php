<div id="perfil" class="no-visible">
   <!--Animación de loading-->
   <div id="editarPerfil-back" class="background-loading no-visible"></div>
   <div id="editarPerfil-spinner" class="spinner no-visible"></div>
   <!--Animación de loading-->
   <div id="foto">
       <div>Perfil</div>
       <img id="imgPerfil" src="<?=IMG.'dXN1YXJpb3M/'.Session::getValue('imagenPerfil');?>" alt="">
       <div id="labelbutton"><label id="labelMsg" for="file1">Cambiar Foto</label></div>
       <input id="file1" type="file" name="input" value="" class="no-visible">
   </div>
    <div id="barraPerfil">
        <div class="opcPerf selected" onclick="cambiarInfoPerfil(this, 'tablaDatos', 'tablaDatos2')"><p>Información Personal</p></div>
        <div class="opcPerf" onclick="cambiarInfoPerfil(this, 'tablaDatos2', 'tablaDatos')"><p>Información Académica</p></div>
    </div>
   <div id="datosPerfil">
     <div id="tablaDatos">
         <div class="dataRow"><label for="" class="labelT">Nombre</label><input id="nombrePerfil" class="inputT" type="text" value="<?=Session::getValue('nombre');?>"></div>
         <div class="dataRow"><label for="" class="labelT">Apellidos</label><input class="inputT" id="apellidoPperfil" type="text" value="<?=Session::getValue('apellidoPaterno');?>"><input id="apellidoMperfil" class="inputT" type="text" value="<?=Session::getValue('apellidoMaterno');?>"></div>
         <div class="dataRow"><label for="" class="labelT">Correo</label><input  id="correoPerfil" class="inputT" type="text" value="<?=Session::getValue('correo');?>" autocomplete="off"></div>
         <div class="dataRow"><label for="" class="labelT">País</label><select  id="paisPerfil" class="inputT"><?=$this->paisUser?></select></div>
         <div class="dataRow"><label for="" class="labelT">Contraseña</label><input  id="passPerfilO" class="inputT" type="password" placeholder="********" autocomplete="off"></div>
         <div class="dataRow"><label for="" class="labelT">Confirmar contraseña</label><input  id="passPerfilC" class="inputT" type="password"  placeholder="********" autocomplete="off"></div>
         <div class="dataRow"><button class="buttonT disabled" onclick="guardarCambiosPerfil()">Guardar cambios</button></div>
     </div>
     
     <div id="tablaDatos2" class="invis">
         <div class="dataRow lmb"><label for="" class="labelT2">Institución</label><input style="text-transform: capitalize;" type="text" class="inputT2" value="<?=mb_strtolower($this->datosU['nombreInstitucion'], 'UTF-8')?>"></div>
         <div class="dataRow lmb"><label for="" class="labelT2">Evaluando desde</label><input type="text" value="<?=($this->datosU['fecha'] != "") ? date("d M Y", strtotime($this->datosU['fecha'])) : "No disponible" ;?>" class="inputT2"></div>
         <div class="dataRow lmb"><label for="" class="labelT2">Articulos Evaluados</label><input type="text" class="inputT2" value="<?=$this->datosU['revision']?>"></div>
         <div class="dataRow lmb"><label for="" class="labelT2">Aceptados</label><input type="text" class="inputT2" value="<?=$this->datosU['aceptados']?>"></div>
         <div class="dataRow lmb"><label for="" class="labelT2">Rechazados</label><input type="text" class="inputT2" value="<?=$this->datosU['rechazados']?>"></div>
          <?php if(is_array($this->categoriasU)):?>
            <?php $cont = 0; $title = "Categorías";?>
            <?php foreach($this->categoriasU as $key => $valor):?>
                <?php $titulo = ($cont == 0) ? "Categorías" : '' ;?>
                  <div class="dataRow lmb">
                  <label for="" class="labelT2"><?php echo $title; ?></label>
                  <input type="text" class="inputT2" value="<?=$valor['nombreCategoria']?>">
                  </div>
                <?php $cont = 1;  $title = "";?>
            <?php endforeach; ?>
        <?php else:?>
            <div class="dataRow lmb">
                <label class="labelT2">Categorías</label>
                <input type="text" class="inputT2" value="Sin Categorías">
            </div>
        <?php endif;?>
     </div>
   </div>
</div>
