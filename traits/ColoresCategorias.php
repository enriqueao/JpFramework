<?php
trait ColoresCategorias{
        /**
     * se encarga de obtener el color de la categoria que el
     * editor cuanta como primaria
     * @author Enrique Aguilar Orozco <enriqueao96@gmail.com>
     * @param Array $editores
     * @return Array
     */
    public function getColorPrimarioCategoria($editores)
    {
        $colorPrimarioCategoria = array();
        $idUsuario = 0;
        if(is_array($editores)){
            foreach ($editores as $key => $value) {
                if($idUsuario != $value["idUsuario"]){
                    $colorPrimarioCategoria[$value["idUsuario"]] = null;
                    $idUsuario = $value["idUsuario"];
                }
            }
            foreach ($colorPrimarioCategoria as $llave => $val) {
                foreach ($editores as $key => $value) {
                    if($llave == $value['idUsuario'] && $value["prioridad"] == 1){
                        $colorPrimarioCategoria[$llave]["categoriaPrimaria"] = $value["colorDistintivo"];
                    }
                }
            }
            return $colorPrimarioCategoria;
        }
    }

    /**
   * se encarga de agrupar todos los datos del editor, para un mayor manejo de datos
   * se agrupan por idUsuario, en cada posición 
   * @author Enrique Aguilar Orozco <enriqueao96@gmail.com>
   * @param Array $editores
   * @return Array
   */
    public function getCategoriasEditores($editores)
    {
        $categoriasEditor = array();
        $idUsuario = 0;
        if(is_array($editores)){
            foreach ($editores as $key => $value) {
                if($idUsuario != $value["idUsuario"]){
                    $categoriasEditor[$value["idUsuario"]] = null;
                    $idUsuario = $value["idUsuario"];
                }
            }
            foreach ($categoriasEditor as $editor => $valor) {
                foreach ($editores as $keyEdit => $valEdit) {
                    if($editor == $valEdit['idUsuario']){
                        $categoriasEditor[$valEdit['idUsuario']][] = $valEdit;
                    }
                }
            }
            return $categoriasEditor;
        }
    }
}
?>