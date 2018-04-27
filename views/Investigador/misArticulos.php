<div id="barraOpciones">
    <label for="buscar">Filtro</label>
    <select id="filtro" required name="buscar" onchange="setFiltro()">
        <option value="na" selected hidden disabled>Seleccione un filtro</option>
        <option value="titulo">Título</option>
        <option value="nombreCategoria">Categoría</option>
        <option value="descripcion">Estatus</option>
        <option value="fecha">Fecha</option>
    </select>
    <input id="busquedaVal" type="text" placeholder="Buscar" oninput="validarBusqueda()">
    <button id="btnBuscar" name="misArticulos" onclick="buscador('misArticulos')"><i class="fa fa-search" aria-hidden="true"></i></button>
    <button class="btnOpcion tooltipbottom" onclick="generarForm('Investigador','nuevoArticulo')"><i class="fa fa-cloud-upload"></i><span class="tooltiptextbottom">Subir artículo</span></button>
</div>
 <div id="tablaArticulos">
    <?php if(is_array($this->articulos)): ?>
     <table id="myTable">
      <tr>
        <th onclick="sortTable(0);changeArrow(this)">Título <ar class="down"></ar></th>
        <th onclick="sortTable(1);changeArrow(this)">Categoría<ar class="down"></ar></th>
        <th onclick="sortTable(2);changeArrow(this)">Fecha<ar class="down"></ar></th>
        <!--<th onclick="sortTable(3);changeArrow(this)">Estatus<ar class="down"></ar></th>-->
      </tr>
        <?php foreach($this->articulos as $columna => $valor):?>
          <tr onclick="generarPrevio('Investigador', 'infoArticulo',<?=$valor['idArticulo']?>)">
            <td class="tituloArticulo" style="border-left: 16px solid <?=$valor['colorDistintivo']?>; ">
                <div class="estatus">
                   <div class="tooltipleft">
                        <span class="tooltiptextleft"><?=$valor['descripcion']?></span>
                        <?=($valor['descripcion'] == 'Enviado') ? '<i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                        <?=($valor['descripcion'] == 'Aceptado') ? '<i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                        <?=($valor['descripcion'] == 'Aceptado con cambios menores') ? '<i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                        <?=($valor['descripcion'] == 'Aceptado con cambios mayores') ? '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                        <?=($valor['descripcion'] == 'Rechazado') ? '<i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                        <?=($valor['descripcion'] == 'Editado') ? '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                        <?=($valor['descripcion'] == 'En Revisión') ? '<i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;' : '' ; ?>
                   </div>
                   <?=$valor['titulo']?>
                </div>
            </td>
            <td><p><?=$valor['nombreCategoria']?></p></td>
            <!-- infoArticulo -->
            <td><p><?=date("d M Y", strtotime($valor['fecha']))?></p></td>

            <!--<td class="estatus"><p><?=$valor['descripcion']?></p></td>-->
          </tr>
        <?php endforeach;?>

    </table>
  <?php else:?>
          <p class="avisoSinRegistros">Comencemos subiendo un artículo</p>
      <?php endif;?>
</div>
<!--
    íconos de estado de artículos

    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
    <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
    <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
    <i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;

-->
<!-- <div id="paginas">
    <span class="contador">1 - 10 de 20 artículos</span>
    <span>Página</span>
    <button class="paginaActual">1</button>
    <button>2</button>
    <button>3</button>
    <button>4</button>
    <button>5</button>
    <span>.......</span>
    <button>10</button>
</div> -->
