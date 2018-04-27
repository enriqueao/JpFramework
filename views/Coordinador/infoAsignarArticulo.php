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
    </div>
    <div id="abstract">
        <h3>Abstract</h3>
        <div id="actualAbstract"><?=$this->articulo['abstract']?></div>
    </div>
    <?php if(strlen($this->articulo['abstract'])> 390){?>
    <div id="expand" class="shadowText">--------------------------------<ar id="expandArrow" class="down" onclick="expandirResumen()"></ar> --------------------------------</div>
    <?php }?>
    <div id="opciones2">
       <a class="infoFile option" href="<?=URL.'public/VVBMT0FE/YXJjaGl2b3M/'.$this->articulo['archivo']?>" target="_blank">
            <div>
                <div class="icon"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></div>
                <div class="infoFile">Descargar</div>
            </div>
        </a>
        <?php if($this->articulo['idUsuario'] === Session::getValue('idUsuario') && $this->articulo['descripcion'] == 'Rechazado'){ ?>
        <div class="option" onclick="generarPrevio('Investigador', 'editarArticulo', <?=$this->articulo['idArticulo']?>)">
            <div class="icon"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></div>
            <div class="infoFile">Editar</div>
        </div>
        <?php }?>
    </div>
    <div id="asignacion">
        <h3>Asignar a:</h3>
        <label>Evaluador 1</label>
        <select id="first">
            <?=$this->evalPrioritario?>
        </select>
        <label>Evaluador 2</label>
        <select id="second">
            <?=$this->evalSecundario?>
        </select>
        <div class="option" onclick="asignar(<?=$this->articulo['idUsuario'].",".$this->articulo['idArticulo']?>)">
            <div class="icon"><i class="fa fa-users" aria-hidden="true"></i></div>
            <div class="infoFile">Asignar</div>
        </div>
    </div>
</div>

<div id="historial" class="no-visible">
    <?php if(is_array($this->historialEval)){ ?>
      <?php foreach($this->historialEval as $fila => $columna){?>
        <div class="observacion observacion">
            <div class="comentario  observacionNo" disabled><?=$columna['comentario']?></div>
            <div><p>Estado: <?=$columna['descripcion']?></p><p><?=date("d M Y H:m", strtotime($columna['fecha']))?></p></div>
        </div>
      <?php }?>
    <?php } else {?>
      <div class="observacion observacion">
          <div><p>Estado: Sin Comentarios</p><p>No disponible</p></div>
      </div>
    <?php }?>
</div>


