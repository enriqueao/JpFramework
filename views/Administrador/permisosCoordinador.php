<div id="titles">
    <div class="one">Administradores</div>
    <div class="two">País</div>
    <div class="three">Permisos</div>
</div>
<div class="batchArticulos">
    <?php $contador = 0;?>    
    <?php foreach($this->administradores as $user => $val):?>
        <div class="articuloRow coord">
            <div class="tituloRow name" onclick="generarAccion(event, <?=$val["idUsuario"]?>)"><?= $val["nombre"]." ".$val["apellidoPaterno"];?></div>
            <div class="paisRow"><?= $val["nombrePais"] ?></div>
            <div class="verMasRow toggleStatus">
            <div class="toggleWrapper">
                <input type="checkbox" id="dn<?= $val["idUsuario"];?>" class="dn" <?= ($val["idTipoUsuario"] == 4) ? '' : 'checked';?> onclick="cambiarPermiso(<?=$val["idUsuario"] ?>);">
                <label for="dn<?= $val["idUsuario"];?>" class="toggle">
                    <span class="toggle__handler"></span>
                </label>
            </div>
            </div>
        </div>
    <?php endforeach;?> 
</div>
