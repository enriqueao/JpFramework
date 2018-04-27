<h2 class=tituloCat>Nuevo Editor</h2>
<label class="div10 labelNuevoEval" for="correo">Correo</label>
<input id="correoRegistroe" class="div10" type="text" name="correo" placeholder="algo@example.com*" onblur="validateMail(this)" onchange="comprobarRegistro(2)" autocomplete="off">
<label class="div10 labelNuevoEval" for="confCorreo">Confirmar correo</label>
<input id="confCorreoRegistroe" class="div10 animated" type="text" name="confCorreo" placeholder="algo@example.com*" onblur="validateMail(this)" onchange="comprobarRegistro(2)" oninput="comprobarRegistro(2)" autocomplete="off">
<label class="div10 labelNuevoEval" for="nombre">Nombre(s)</label>
<input id="nombree" class="div10" type="text" name="nombre"  onblur="checkEmpty(this)" onkeypress="validateText(event)" placeholder="Nombre*">
<label class="div10 labelNuevoEval" for="apellido">Apellido(s)</label>
<input id="apellidoPe" class="div5" type="text" name="apellidoP" onblur="checkEmpty(this)" onkeypress="validateText(event)" placeholder="Primer apellido*">
<div class="div1 espacio"></div>
<input id="apellidoMe" class="div5" type="text" name="apellidoM" onblur="checkEmpty(this)" onkeypress="validateText(event)" placeholder="Segundo apellido">

<label class="div10 labelNuevoEval" for="pais">País</label>
<select required id="paise" class="div10" name="pais">
  <option value="0" hidden selected disabled>Seleccione...</option>
  <?=$this->paises;?>
</select>

<!-- <label class="div10 labelNuevoEval" for="cate">Categoría</label>
<select required id="cate" class="div10" name="cate">
  <option value="0" hidden selected disabled>Seleccione...</option>
  <?=$this->categorias;?>
</select> -->

<button id="btnRegistrar" onclick="registrarEditor()">Agregar</button>
