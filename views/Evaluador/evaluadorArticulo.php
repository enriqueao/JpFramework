<div id="barrOp">
    <div id="a" class="optab selectedOp" onclick="cambiarMenu('articuloEval')"><p>Artículo</p></div>
    <div id="h" class="optab" onclick="cambiarMenu('historial')"><p>Historial</p></div>
</div>

<div id="articuloEval">
    <div id="infoPrincipal">
       <div class="estadoArticuloEval">
           <div class="tooltipleft">
                <span class="tooltiptextleft"><?=$this->articulo['descripcion']?></span>
                <?=($this->articulo['descripcion'] == 'Enviado') ? '<i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                <?=($this->articulo['descripcion'] == 'Aceptado') ? '<i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                <?=($this->articulo['descripcion'] == 'Aceptado con cambios menores') ? '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                <?=($this->articulo['descripcion'] == 'Aceptado con cambios mayores') ? '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                <?=($this->articulo['descripcion'] == 'Rechazado') ? '<i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                <?=($this->articulo['descripcion'] == 'Editado') ? '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                <?=($this->articulo['descripcion'] == 'En Revisión') ? '<i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
           </div>
        </div>
        <h3><?=$this->articulo['titulo']?></h3>
        <div><?=date("d M Y H:s", strtotime($this->articulo['fecha']))?></div>
        <!--<div><?=$this->articulo['descripcion']?></div>-->
    </div>
    <div id="abstract">
        <h3>Abstract</h3>
        <div id="actualAbstract"><?=$this->articulo['abstract']?></div>
    </div>
    <?php if(strlen($this->articulo['abstract'])> 390){?>
    <div id="expand" class="shadowText">--------------------------------<ar id="expandArrow" class="down" onclick="expandirResumen()"></ar> --------------------------------</div>
    <?php }?>
    <div id="opciones2">
        <div class="option">
            <div class="icon"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></div>
            <a class="infoFile" href="<?=URL.'public/VVBMT0FE/YXJjaGl2b3M/'.$this->articulo['archivo']?>" target="_blank"><div class="infoFile">Descargar</div></a>
        </div>
    </div>
    <h3 class="commTitulo">Comentario</h3>
    <textarea id="comentario" class="comentario" oninput="counter()" maxlength="150"></textarea>
    <div id="counter">0 / 150</div>
    
    <h3 class="commTitulo">Criterios</h3>
    <p class="criterio">Originalidad</p>
     <div class="radio-group">
       <input type="radio" id="option-one" name="originalidad" value="1">
       <label class="labelRadio" for="option-one">Malo</label>
       <input type="radio" id="option-two" name="originalidad" value="2">
       <label class="labelRadio" for="option-two">Regular</label>
       <input type="radio" id="option-three" name="originalidad" value="3">
       <label class="labelRadio" for="option-three">Bueno</label>
     </div>
     <p class="criterio">Lenguaje</p>
     <div class="radio-group">
       <input type="radio" id="option-four" name="lenguaje" value="1">
       <label class="labelRadio" for="option-four">Malo</label>
       <input type="radio" id="option-five" name="lenguaje" value="2">
       <label class="labelRadio" for="option-five">Regular</label>
       <input type="radio" id="option-six" name="lenguaje" value="3">
       <label class="labelRadio" for="option-six">Bueno</label>
     </div>
     <p class="criterio">Claridad</p>
     <div class="radio-group">
       <input type="radio" id="option-seven" name="claridad" value="1">
       <label class="labelRadio" for="option-seven">Malo</label>
       <input type="radio" id="option-eigth" name="claridad" value="2">
       <label class="labelRadio" for="option-eigth">Regular</label>
       <input type="radio" id="option-nine" name="claridad" value="3">
       <label class="labelRadio" for="option-nine">Bueno</label>
     </div>
     <p class="criterio">Contenido científico</p>
     <div class="radio-group">
       <input type="radio" id="option-ten" name="contenido" value="1">
       <label class="labelRadio" for="option-ten">Malo</label>
       <input type="radio" id="option-eleven" name="contenido" value="2">
       <label class="labelRadio" for="option-eleven">Regular</label>
       <input type="radio" id="option-twelve" name="contenido" value="3">
       <label class="labelRadio" for="option-twelve">Bueno</label>
     </div>
     
    <h3 class="commTitulo rec">Recomendación</h3>
    <select name="" id="estado">
        <?=$this->statusArt?>
    </select>

    <div id="opciones2">
        <div class="option" onclick="evaluar()">
            <div class="icon"><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i></div>
            <a class="infoFile"><div class="infoFile">Enviar</div></a>
        </div>
    </div>
</div>

<div id="historial" class="no-visible">
    <?php if(is_array($this->historialEval)){ ?>
      <?php foreach($this->historialEval as $fila => $columna){?>
        <div class="observacion">
            <div class="comentario  observacionNo" disabled><?=$columna['comentario']?></div>
            <div><p>Estado: <?=$columna['descripcion']?></p><p><?=date("d M Y", strtotime($columna['fecha']))?></p></div>
        </div>
      <?php }?>
    <?php } else {?>
      <div class="observacion observacion">
          <div><p>Estado: Sin Comentarios</p><p>No disponible</p></div>
      </div>
    <?php }?>
</div>
<input type="hidden" id="idArticulo" value="<?=$this->articulo['idArticulo']?>">
