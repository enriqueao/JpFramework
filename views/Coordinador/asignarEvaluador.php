<!-- <p class="fecha">9 de Septiembre de 2017</p> -->
<h3 class="commTitulo comm2">Categorías</h3>
<div id="categorias">
    <div class="categoriaColor" style="border-left: 20px solid #B39DDB;">Educación y cultura</div>
    <div class="categoriaColor" style="border-left: 20px solid #C5E1A5;">Ecohidrología</div>
    <div class="categoriaColor" style="border-left: 20px solid #80DEEA;">Agua y asentamientos humanos</div>
    <div class="categoriaColor" style="border-left: 20px solid #80CBC4;">Escasez y calidad de agua</div>
    <div class="categoriaColor" style="border-left: 20px solid #EF9A9A;">Desastres hídricos y cambios hidrológicos</div>
</div>
<?php $fecha = ""; $contador = 0; ?>
<?php if(is_array($this->articulos)){?>
<div class="batchArticulos">
  <?php foreach($this->articulos as $key => $valor) {?>
    <?php if(date("d M Y", strtotime($valor['fecha'])) != $fecha && $contador == 0):
        $fechaM = date("d M Y", strtotime($valor['fecha']));
        $contador = 1;
        $fecha = $fechaM;
        echo "<p class='fecha'>{$fechaM}</p>";
    else:?>
       <?php $contador = 0; ?>
    <?php endif;?>
      
          <div class="articuloRow">
              <div class="tituloRow" style="border-left: 10px solid <?=$valor['colorDistintivo']?>; "><?=$valor['titulo']?></div>
              <div class="verMasRow" onclick="generarPrevio('Coordinador', 'infoAsignarArticulo',<?=$valor['idArticulo']?>)">Ver más</div>
          </div>
  <?php }?>
</div>
<?php } else { ?>
    <p class="avisoSinRegistros">Todos los artículos han sido asignados</p>
<?php } ?>
