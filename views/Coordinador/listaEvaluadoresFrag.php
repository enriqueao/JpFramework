<div id="barraOpciones">
    <label for="buscar">Filtro</label>
    <select id="filtro" required name="buscar" onchange="setFiltro()">
        <option value="na" selected hidden disabled>Seleccione un filtro</option>
        <option value="u.nombre">Nombre</option>
        <option value="apellidos">Apellidos</option>
        <option value="cat.nombreCategoria">Área Principal</option>
    </select>
    <input id="busquedaVal" type="text" placeholder="Buscar" oninput="validarBusqueda()">
    <button id="btnBuscar" name="evaluadores" onclick="buscador('evaluadores')"><i class="fa fa-search" aria-hidden="true"></i></button>
    <?php if(Session::getValue("tipoUsuario") != "Administrador Visual"){?>
      <button class="btnOpcion tooltipbottom" onclick="generarForm('Coordinador', 'nuevoEvaluador')"><i class="fa fa-user-plus" aria-hidden="true"><span class="tooltiptextbottom">Agregar Evaluador</span></i></button>
    <?php } ?>
</div>
<div id="categorias" class="categoriasInfo">
    <div class="categoriaColor" style="border-left: 20px solid #B39DDB;">Educación y cultura</div>
    <div class="categoriaColor" style="border-left: 20px solid #C5E1A5;">Ecohidrología</div>
    <div class="categoriaColor" style="border-left: 20px solid #80DEEA;">Agua y asentamientos humanos</div>
    <div class="categoriaColor" style="border-left: 20px solid #80CBC4;">Escasez y calidad de agua</div>
    <div class="categoriaColor" style="border-left: 20px solid #EF9A9A;">Desastres hídricos y cambios hidrológicos</div>
</div>
<div id="tablaArticulos" class="tablaArticulosInfo">
        <?php if(is_array($this->evaluadores)):?>
       <table id="myTable">
        <tr>
          <th onclick="sortTable(0);changeArrow(this)">Nombre <ar class="down"></ar></th>
          <th onclick="sortTable(1);changeArrow(this)">Apellido<ar class="down"></ar></th>
          <th onclick="sortTable(2);changeArrow(this)" colspan="5">Áreas de investigación<!--<ar class="down"></ar>--></th>
        </tr>
        
          <?php $color = "";$idUsuario = "";?>
          <?php foreach($this->evaluadores as $key => $valor):?>
            <?php if( $idUsuario != $valor['idUsuario']): ?>
              <tr onclick="generarPrevio('Coordinador','infoEvaluador',<?=$valor['idUsuario']?>)">
                <?php $color = ($this->colorPrimarioCategoria[$valor['idUsuario']]["categoriaPrimaria"] != null) ? "solid ".$this->colorPrimarioCategoria[$valor['idUsuario']]["categoriaPrimaria"] : null ?>

                <td style="border-left: 16px <?= $color?>; "><p><?=$valor['nombre']?></p></td>
                <td><p><?=$valor['apellidoPaterno'].' '.$valor['apellidoMaterno']?></p></td>
                <td style="background-color: <?= (in_array(1,array_column($this->categoriasEditores[$valor['idUsuario']], 'idCategoria'))) ? '#B39DDB' : '' ;?>;" class="catColor"></td>
                <td style="background-color: <?= (in_array(2,array_column($this->categoriasEditores[$valor['idUsuario']], 'idCategoria'))) ? '#C5E1A5' : '' ;?>;" class="catColor"></td>
                <td style="background-color: <?= (in_array(3,array_column($this->categoriasEditores[$valor['idUsuario']], 'idCategoria'))) ? '#80DEEA' : '' ;?>;" class="catColor"></td>
                <td style="background-color: <?= (in_array(4,array_column($this->categoriasEditores[$valor['idUsuario']], 'idCategoria'))) ? '#80CBC4' : '' ;?>;" class="catColor"></td>
                <td style="background-color: <?= (in_array(5,array_column($this->categoriasEditores[$valor['idUsuario']], 'idCategoria'))) ? '#EF9A9A' : '' ;?>;" class="catColor"></td>
              </tr>
            <?php $idUsuario = $valor['idUsuario'];?>
            <?php endif;?>
          <?php endforeach;?>
        <?php else: ?>
            <p class="avisoSinRegistros">Sin Editores</p>
        <?php endif;?>
      </table>
</div>