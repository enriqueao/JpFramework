<h2 class="tituloCat cat"><?=$this->datosCat['nombreCategoria']?></h2>
<h2 class="tituloCat">Categoría creada el:</h2>
<div class="contenidoInformacion"><?=date("d M Y", strtotime($this->datosCat['fechaCreacion']))?></div>
<h2 class="tituloCat">Evaluadores:</h2>
<div class="contenidoInformacion"><?=$this->datosCat['numEval']?> Evaluadores</div>
<h2 class="tituloCat">Artículos:</h2>
<div class="contenidoInformacion"><?=$this->datosCat['numArticulos']?> artículos</div>
<h2 class="tituloCat">Aceptados / Rechazados</h2>
<div class="contenidoInformacion"><b><?=$this->datosCat['aceptados']?> artículos aceptados</b></div>
<div class="contenidoInformacion"><b><?=$this->datosCat['rechazados']?> artículos rechazados</b></div>
