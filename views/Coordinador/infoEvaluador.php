<div id="evaluador">
    <div id="informacionGeneral">
        <h2><?=$this->datosEval['nombre']?></h2>
        <h3><?=$this->datosEval['apellidos']?></h3>
    </div>
    <img src="<?=IMG.'dXN1YXJpb3M/'.$this->datosUsuario['imagenUsuario']?>" alt="">
</div>
<h4 class="titulo">Correo</h4>
<div class="informacionEvaluador"><?=$this->datosEval['correo']?></div>
<h4 class="titulo">Institución</h4><div class="informacionEvaluador" style="text-transform: capitalize;"><?=mb_strtolower($this->datosUsuario['nombreInstitucion'], 'UTF-8')." ({$this->datosUsuario['nombrePais']})"?></div>
<h4 class="titulo">Áreas que evalúa</h4>
<div class="informacionEvaluador">
    <ul>
      <?php if(is_array($this->categorias)) {?>
        <?php foreach($this->categorias as $key => $valor){?>
            <li><p><?=$valor['nombreCategoria']?></p></li>
        <?php } ?>
      <?php } else {?>
        <li><p>Sin Categorías</p></li>
      <?php }?>
    </ul>
</div>
<h4 class="titulo">Evaluando desde</h4>
<div class="informacionEvaluador"><?=date("d M Y", strtotime($this->datosEval['fecha']))?></div>
<h4 class="titulo">Actualmente ha evaluado</h4>
<div class="informacionEvaluador"><?=$this->datosEval['revision']?> artículos</div>
<h4 class="titulo">Aceptados / Rechazados</h4>
<div class="informacionEvaluador"><b><?=$this->datosEval['aceptados']?> artículos aceptados</b></div>
<div class="informacionEvaluador"><b><?=$this->datosEval['rechazados']?> artículos rechazados</b></div>
