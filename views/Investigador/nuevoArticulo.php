<h2>Nuevo Artículo</h2>
<label class="div10" for="nombre">Título del Artículo</label>
<input id="tituloArt" class="div10" type="text" name="nombre" placeholder="Ej. Teoría de la Relatividad*" onblur="checkEmpty(this);habilitarSubida()">
<label class="div10" for="categoria">Categoría</label>
<select id="categoria" required class="div10" name="categoria" onblur="checkSelect(this)" onchange="habilitarSubida()">
    <option selected hidden disabled value="0">Seleccione</option>
    <?=$this->categorias;?>
</select>
<label class="div10" for="abstract">Abstract</label>
<textarea name="abstract" id="abstract" class="div10" onblur="checkEmpty(this)"></textarea>
<div id="opciones2">
   <label for="file" id="btnSubir" class="option option2 archivo no-visible">
        <div>
            <div class="icon"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></div>
            <div class="infoFile">Seleccionar</div>
        </div>
    </label>
    <div class="option option2 subir" onclick="subirArticulo()">
        <div class="icon"><i class="fa fa-cloud-upload fa-lg" aria-hidden="true"></i></div>
        <div class="infoFile">Subir</div>
    </div>
</div>
<input id="file" type="file" name="file" class="no-visible" accept="application/pdf" onblur="checkEmpty(this)" onchange="cambiarColor()">
