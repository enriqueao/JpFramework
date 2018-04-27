<h2>Editar Artículo</h2>
<label class="div10" for="nombre">Título del Artículo</label>
<input id="tituloArt" class="div10" type="text" name="nombre" placeholder="Ej. Teoría de la Relatividad*" onblur="checkEmpty(this);" onchange="habitarGuardar()" value="<?= $this->datosArt['titulo']?> ">
<label class="div10" for="categoria">Categoría</label>
<select id="categoria" required class="div10" name="categoria" onblur="checkSelect(this)"onchange="habitarGuardar()">
    <?=$this->categoria;?>
</select>
<label class="div10" for="abstract">Abstract</label>
<textarea name="abstract" id="abstract" class="div10" onblur="checkEmpty(this)" onchange="habitarGuardar()"><?= $this->datosArt['abstract']?></textarea>
<div id="opciones2">
   <label id="btnSubir" for="file" class="option archivo">
        <div>
            <div class="icon"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></div>
            <div class="infoFile">Cambiar</div>
        </div>
    </label>
    <div id="btnEditar" class="option no-visible" onclick="editarArticulo()">
        <div class="icon"><i class="fa fa-cloud-upload fa-lg" aria-hidden="true"></i></div>
        <div class="infoFile">Guardar</div>
    </div>
</div>
<input id="file" type="file" name="file" class="no-visible" accept="application/pdf" onblur="checkEmpty(this)" onchange="habitarGuardar()">
<input id="idArticulo" type="hidden" name="" value="<?= $this->datosArt['idArticulo']?>">
