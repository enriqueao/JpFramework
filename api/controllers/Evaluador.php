<?php

class Evaluador extends Controller {
  function __construct() {
    parent::__construct();
  }

  public function index() {
    header('Location: '.URL);
  }

  public function articulosPorEvaluar() {
    if($this->accesos(__METHOD__))
      $this->view->articulos = $this->getArticulos(Session::getValue('idUsuario'), 2);
      $this->view->render($this,'articulosPorEvaluar');
  }

  public function evaluadorArticulo() {
    if($this->accesos(__METHOD__)){
      if(isset($_POST['val'])){
        $idArticulo = $_POST['val'];
        $this->view->articulo = $this->model->getArticulo($idArticulo);
        $this->view->statusArt = $this->statusArt($idArticulo);
        $this->view->historialEval = $this->historialEval($idArticulo);
        $this->view->render($this,'evaluadorArticulo');
      }
    }
  }

 /**********************************************/

private function categoriaSelect($idArticulo)
{
  $selectCategoria = $this->model->getArticulo($idArticulo);
  $categorias = $this->model->getCategoriasArticulos();
  $opt = '';
  foreach ($categorias as $key => $value) {
    $idCategoria = $value['idCategoria'];
    $nombreCategoria = $value['nombreCategoria'];
    $selected = ($value['idCategoria'] == $selectCategoria['idCategoria']) ? 'selected' : '' ;
    $opt .= "<option  value='{$idCategoria}' {$selected}>{$nombreCategoria}</option>";
  }
  return $opt;
}

 private function historialEval($idArticulo)
 {
   if($this->accesos(__METHOD__)){
     return $this->model->getHistorialEvalArt($idArticulo);
   }
 }

 private function statusArt($idArticulo)
 {
   $statusArt = $this->model->statusArt($idArticulo);
   $status = $this->model->getStatusArticulo();
   $option = '';
   if(is_array($statusArt)){
     foreach ($status as $key => $value) {
       $selected = ($value['idStatus'] == $statusArt['idStatus']) ? 'selected' : '';
       $option .= "<option value='{$value['idStatus']}' {$selected}>{$value['descripcion']}</option>";
     }
     return $option;
   }
 }

 public function editarInfoArticulo() {
   if($this->accesos(__METHOD__)){
     if(isset($_POST)){
       $archivo = (isset($_FILES['file'])) ? $_FILES['file'] : 0 ;
       echo $this->editarArticuloInfo($_POST,$archivo);
     }
   }
 }

 private function getArticulos($idUsuario, $tipo)
 {
   if($tipo == 1){
     return $this->model->getArticulosUsuario($idUsuario);
   }
   if($tipo == 2){
     return $this->model->getArticulosUsuarioEval($idUsuario);
   }
 }

 private function getCategoriasArticulos(){
   $categorias = $this->model->getCategoriasArticulos();
   if(is_array($categorias)){
     $opcionesCategorias = '';
     foreach ($categorias as $registro => $columna) {
       $idCategoria     = $columna['idCategoria'];
       $nombreCategoria = $columna['nombreCategoria'];
       $opcionesCategorias .= "<option value='{$idCategoria}'>{$nombreCategoria}</option>";
     }
     return $opcionesCategorias;
   } else {
     return '<option>No hay Opciones</option>';
   }
 }

 public function evaluar()
 {
   if ($this->accesos("Investigador::articulosPorEvaluar")) {
     if(isset($_POST)){
      $data = array(
        'idArticulo' => $_POST['idArticulo'],
        'idUsuarioEval' => Session::getValue('idUsuario'),
        'idStatus' => $_POST['estado'],
        'comentario' => $_POST['comentario'],
        'criterios' => $_POST['criterios']
      );
      echo $this->model->setEvaluacion($data);
    }
   }
 }


}
?>
