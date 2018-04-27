<h3 class="commTitulo comm2">Categorías</h3>
<?php if(is_array($this->categorias)){?>
  <div class="batchArticulos" style="margin-top: 30px;">
  <?php foreach($this->categorias as $key => $valor){?>
    <div class="articuloRow" onclick="generarPrevio('Coordinador','infoCategoria',<?=$valor['idCategoria']?>)">
        <div class="tituloRow" style="border-left: 8px solid <?=$valor['colorDistintivo']?>; "><?=$valor['nombreCategoria']?></div>
        <div class="verMasRow" onclick="generarPrevio('Coordinador','infoCategoria',<?=$valor['idCategoria']?>)">Ver más</div>
    </div>
  
  <?php }?>
  </div>
<?php } else {?>
  <tr style="pointer-events: none;">
    <td>No disponible</td>
    <td class="mas"><p onclick="generarPrevio('Coordinador','infoCategoria')">Ver más</p></td>
  </tr>
<?php }?>

