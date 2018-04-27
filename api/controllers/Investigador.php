<?php

class Investigador extends Controller {
  function __construct() {
    parent::__construct();
  }

  public function index() {
    if($this->accesos(__METHOD__)){
      header('Location: '.URL);
    } else {
      $this->pageHistoryBack();
    }
  }

  public function misArticulos() {
    if($this->accesos(__METHOD__))
      $this->view->articulos = $this->getArticulos(Session::getValue('idUsuario'),1);
      $this->view->render($this,'misArticulos');
  }

  public function articulosPorEvaluar() {
    if($this->accesos(__METHOD__))
      $this->view->articulos = $this->getArticulos(Session::getValue('idUsuario'), 2);
      $this->view->render($this,'articulosPorEvaluar');
  }

  public function evaluadorArticulo() {
    if($this->accesos("Investigador::articulosPorEvaluar")){
      if(isset($_POST['val'])){
        $idArticulo = $_POST['val'];
        $this->view->articulo = $this->model->getArticulo($idArticulo);
        $this->view->statusArt = $this->statusArt($idArticulo);
        $this->view->historialEval = $this->historialEval($idArticulo);
        $this->view->render($this,'evaluadorArticulo');
      }
    }
  }

  public function editarArticulo()
  {
    if(isset($_POST['val'])){
      $idArticulo = $_POST['val'];
      $this->view->categoria = $this->categoriaSelect($idArticulo);
      $this->view->datosArt = $this->model->getArticulo($idArticulo);
      $this->view->render($this,'editarArticulo');
    }
  }

  public function infoArticulo() {
    if($this->accesos("Investigador::misArticulos")){
      if(isset($_POST['val'])){
        $idArticulo = $_POST['val'];
        $this->view->articulo = $this->model->getArticulo($idArticulo);
        $this->view->statusArt = $this->statusArt($idArticulo);
        $this->view->historialEval = $this->historialInvestigador($idArticulo);
        $this->view->render($this,'infoArticulo');
      }
    }
  }

 public function infoAsignarArticulo() {
    if($this->accesos("Investigador::misArticulos")){
      if(isset($_POST['val'])){
        $idArticulo = $_POST['val'];
        // $this->view->getUltimoEstatus = $this->model->getUltimoEstatus($idArticulo);
        $this->view->articulo = $this->model->getArticulo($idArticulo);
        $this->view->statusArt = $this->statusArt($idArticulo);
        $this->view->historialEval = $this->historialEval($idArticulo);
        $this->view->render($this,'infoAsignarArticulo');
      }
    }
  }

  public function nuevoArticulo() {
    if($this->accesos("Investigador::misArticulos"))
      $this->view->categorias = $this->getCategoriasArticulos();
      $this->view->render($this,'nuevoArticulo');
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

 private function historialInvestigador(String $idArticulo)
 {
   return $this->model->gethistorialInvestigador($idArticulo);
 }

 private function historialEval($idArticulo)
 {
   return $this->model->getHistorialEvalArt($idArticulo);
 }

 private function statusArt($idArticulo)
 {
   $status = $this->model->getStatusArticulo();
   $option = "<option value='0' selected disabled hidden>Seleccione...</option>";
   if(is_array($status)){
     foreach ($status as $key => $value) {
       $option .= "<option value='{$value['idStatus']}'>{$value['descripcion']}</option>";
     }
     return $option;
   }
 }

 public function editarInfoArticulo() {
   if($this->accesos("Investigador::misArticulos")){
     if(isset($_POST)){
       $archivo = (isset($_FILES['file'])) ? $_FILES['file'] : 0 ;
       echo $this->editarArticuloInfo($_POST,$archivo);
     }
   }
 }

 private function editarArticuloInfo($datos, $archivo)
 {
   if($archivo != 0){
    $arh = $this->subirArchivo($archivo, $datos);
   }
   $data = array(
     'titulo'      => $datos['nombreArt'],
     'idCategoria' => $datos['idCategoria'],
     'abstract'    => $datos['abstrac']
   );
   $idArticulo = $_POST['idArticulo'];

   $correo = $this->model->getDatosEval($idArticulo);

   if ($archivo != 0) {
     if ($arh['status'] == 1) {
       $data['archivo'] = $arh['dir'];
      //  $this->sendEmail($correo,'notificacionCambio');
       return $this->model->editarArticuloInfo($data, $idArticulo);
     } else {
       return $arh['status'];
     }
   } else {
    //  $this->sendEmail($correo,'notificacionCambio');
     return $this->model->editarArticuloInfo($data, $idArticulo);
   }
 }

 public function subirArticulo() {
   if($this->accesos("Investigador::misArticulos")){
     if(isset($_POST)){
       if(isset($_FILES['file'])){
         echo $this->subirArticuloInfo($_POST, $_FILES['file']);
       }
     }
   }
 }

 private function subirArticuloInfo($datos, $archivo)
 {
   $arh = $this->subirArchivo($archivo, $datos);
   if($arh['status'] === 1){
     $data = array(
       'idUsuario'   => Session::getValue('idUsuario'),
       'titulo'      => $datos['nombreArt'],
       'idCategoria' => $datos['idCategoria'],
       'abstract'    => $datos['abstrac'],
       'archivo'     => $arh['dir']
     );
     return $this->model->subirArticuloInfo($data);
   } else {
     return $arh['status'];
   }
 }

 /**
 * @author Enrique Aguilar Orozco
 *
 */
 private function subirArchivo($archivo, $datos)
 {
   if ($archivo['size'] < 10485760) {
     $imagenType = $archivo['type'];
     if ($imagenType == "application/pdf"){
         $ext     = explode(".", $archivo['name']);
         $dir     = "UNESCO_".utf8_encode($datos['nombreArt'])."_".Session::getValue('idUsuario').'_'.date("Ymis").'.'.end($ext);
         $dir     = str_replace(' ', '_', $dir);
         $dirmove = "public/VVBMT0FE/YXJjaGl2b3M/".$dir;
         $upload  = move_uploaded_file($archivo['tmp_name'],$dirmove);
         if($upload){
             return array(
               'status' => 1,
               'dir'    => $dir
             );
         } else {
             return array('status' => 0);
         }
     } else {
         return array('status' => 2); //formato no admitido
     }
    } else {
        return array('status' => 3); //tamaño superadoaaa
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


}
?>
