<!--Traer de investigador-->
 <div id="tablaArticulos">
    <?php if(is_array($this->articulos)){?>
     <table id="myTable">
      <tr>
        <th onclick="sortTable(0);changeArrow(this)">Título <ar class="down"></ar></th>
        <th onclick="sortTable(1);changeArrow(this)">Categoría<ar class="down"></ar></th>
        <th onclick="sortTable(2);changeArrow(this)">Fecha<ar class="down"></ar></th>
      </tr>
        <?php foreach($this->articulos as $columna => $valor){?>
          <?php if(true){ ?>
            <tr onclick="generarPrevio('Coordinador', 'infoArticuloRevision',<?=$valor['idArticulo']?>)">
              <td style="border-left: 16px solid <?=$valor['colorDistintivo']?>;" class="tituloArticulo">
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
              <td><p><?=date("d M Y", strtotime($valor['fecha']))?></p></td>
              <!--<td class="estatus"><p><?=$valor['descripcion']?></p></td>-->
            </tr>
          <?php } ?>
        <?php  }?>
    </table>
     <?php } else {?>
          <p class="avisoSinRegistros">Por el momento sin artículos en Revisión</p>
      <?php }?>
</div>