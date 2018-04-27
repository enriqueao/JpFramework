<?php
require_once 'traits/ColoresCategorias.php';

class Coordinador extends Controller{

  use ColoresCategorias;

  function __construct() {
    parent::__construct();
  }
  /********RENDER VIEWS******/
  public function index(){
    if($this->accesos(__METHOD__)){
      header('Location: '.URL);
    } else {
      $this->pageHistoryBack();
    }
  }

  public function listaEvaluadores(){
    if($this->accesos(__METHOD__))
      $evaluadores = $this->model->getListaEvaluadores();
      $this->view->evaluadores = $evaluadores;
      $this->view->colorPrimarioCategoria = $this->getColorPrimarioCategoria($evaluadores);
      $this->view->categoriasEditores = $this->getCategoriasEditores($evaluadores);
      $this->view->render($this,'listaEvaluadoresFrag');
  }

  public function listaEditores(){
    if($this->accesos(__METHOD__))
      $editores = $this->model->getListaEditores();
      $this->view->editores = $editores;
      $this->view->colorPrimarioCategoria = $this->getColorPrimarioCategoria($editores);
      $this->view->categoriasEditores = $this->getCategoriasEditores($editores);
      $this->view->render($this,'listaEditoresFrag');
  }

  public function infoEvaluador(){
    if($this->accesos("Coordinador::listaEvaluadores") or $this->accesos("Administrador::asignar")){
      if(isset($_POST['val'])){
        $idEval = $_POST['val'];
        $this->loadOtherModel("Usuario");
        $this->view->datosUsuario = $this->Usuario->getDatosUsuario($idEval);
        $this->view->categorias = $this->model->getCategoriasEvaluador($idEval);
        $this->view->datosEval = $this->model->getDatosEval($idEval);
        $this->view->render($this,'infoEvaluador');
      }
    }
  }

  public function evaluadores(){
    if($this->accesos(__METHOD__))
      $this->view->render($this,'listaEvaluadores');
  }

  public function categorias(){
    if($this->accesos(__METHOD__))
      $this->view->categorias = $this->model->getCategorias();
      $this->view->render($this,'listaCategoriasFrag');
  }

  public function infoCategoria(){
    if($this->accesos("Coordinador::categorias")){
      if(isset($_POST['val'])){
        $idCat = $_POST['val'];
        $this->view->datosCat = $this->model->getInfoCat($idCat);
        $this->view->render($this,'infoCategoria');
      }
    }
  }

  public function nuevoEvaluador(){
    if($this->accesos("Coordinador::listaEvaluadores") and Session::getValue("tipoUsuario") != "Administrador Visual")
      $this->view->categorias = $this->getCategoriasArticulos();
      $this->view->paises = $this->getPaises();
      $this->view->render($this,'nuevoEvaluador');
  }

  public function nuevoEditor(){
    if($this->accesos("Coordinador::listaEditores") and Session::getValue("tipoUsuario") != "Administrador Visual" ){
      $this->view->paises = $this->getPaises();
      $this->view->render($this,'nuevoEditor');
    }
  }

  public function asignarEvaluador(){
    if($this->accesos(__METHOD__))
      $this->view->articulos = $this->model->geArticulosAsignarEvaluador(Session::getValue('idUsuario'));
      $this->view->render($this,'asignarEvaluador');
  }

  public function dictaminarArticulo() {
    if($this->accesos("Coordinador::realizarDictamen")){
      if(isset($_POST['val'])){
        $idArticulo = $_POST['val'];
        $this->view->articulo = $this->model->getArticulo($idArticulo);
        $this->view->statusArt = $this->statusArt($idArticulo);
        $this->view->getCriterios = $this->model->getCriterios($idArticulo);
        $this->view->historialEval = $this->historialDictamenArticulo($idArticulo);
        $this->view->render($this,'dictaminarArticulo');
      }
    }
  }

  /***********END RENDERS************/

  public function iniciarSesion(){
    if(isset($_POST["username"], $_POST["password"]) ){
      $inicio = $this->model->iniciarSesion($_POST["username"], $_POST["password"]);
      echo $inicio;
      if($inicio == '1' || $inicio == '4'){
        $this->initLog($_POST['username'],1,$_POST['username'],'Inicio de Sesión');
      }
    }
  }

  public function getPaises(){
    $this->loadOtherModel('Index');
    $paises = $this->Index->getPaises();
    if(is_array($paises)){
      $opcionesPaises = '';
      foreach ($paises as $registro => $columna) {
        $idPais          = $columna['idPais'];
        $nombrePais      = $columna['nombrePais'];
        $opcionesPaises .= "<option value='{$idPais}'>{$nombrePais}</option>";
      }
      return $opcionesPaises;
    } else {
      return '<option>No hay Opciones</option>';
    }
  }

  public function registarEvaluador()
  {
    if($this->accesos("Coordinador::listaEvaluadores")){
      if(isset($_POST['datosRegistro'])){
        $this->loadOtherModel('Usuario');
        if($this->Usuario->comprobarPass($_POST['datosRegistro']['pass'])){
          $datos = $_POST['datosRegistro'];
          $datos['asunto'] = 'Revista Aqua-LAC';
          if($this->model->registar($_POST['datosRegistro'])){
            echo $this->sendKey($datos);
          }
        } else {
          echo '3';
        }
      } else {
        echo "404";
      }
    }
  }

  public function registarEditor()
  {
    if($this->accesos("Coordinador::listaEditores")){
      if(isset($_POST['datosRegistro'])){
        $this->loadOtherModel('Usuario');
        if($this->Usuario->comprobarPass($_POST['datosRegistro']['pass'])){
          $datos = $_POST['datosRegistro'];
          $datos['asunto'] = 'Revista Aqua-LAC';
          if($this->model->registarEditor($_POST['datosRegistro'])){
            echo $this->sendKey($datos);
          }
        } else {
          echo '3';
        }
      } else {
        echo "404";
      }
    }
  }

  /**
  * funcion sendKey
  * funcion para enviar email a la cuenta del usuario, para restablecer la contraseña
  * envia la el link con la clave para restablecer
  * @author Enrique Aguilar Orozco
  *
  */
  public function sendKey($datos){
    $this->loadOtherModel('Usuario');
    $datos['clv'] = $this->getKey($datos['correo']);

    if($this->sendEmail($datos,'invitacionEvaluador')){
      echo $this->Usuario->setKey($datos['correo'],$datos['clv']);
    } else {
      echo "E530";
    }
  }

  public function enviarInvitacion()
  {
    if($this->accesos("Coordinador::listaEvaluadores")){
      if(isset($_POST['idUsuario'])){
        $idUsuario = $_POST['idUsuario'];
        $idCategoria = $_POST['idCategoria'];
        $this->loadOtherModel('Usuario');

        $asignarPuesto = $this->model->asignarPuesto($idUsuario, 'Evaluador', $idCategoria);
        if($asignarPuesto){
          $usuario = $this->Usuario->getCuenta($idUsuario);
          echo $this->sendEmail(array(
            'asunto' => 'Revista Aqua-LAC',
            'correo' => $usuario['correo'],
            'nombre' => $usuario['nombre'],
            'apellidoPaterno' => $usuario['apellidoPaterno'],
            'apellidoMaterno' => $usuario['apellidoMaterno']
          ),'asignacionEvaluador');
          
        } else {
          echo $asignarPuesto;
        }
      } else {
        echo 0;
      }
    }
  }

  public function enviarInvitacionEditor()
  {
    if ($this->accesos("Coordinador::listaEditores")) {
      if(isset($_POST['idUsuario'])){
        $idUsuario = $_POST['idUsuario'];
        $this->loadOtherModel('Usuario');

        $asignarPuesto = $this->model->asignarPuestoEditor($idUsuario);
        if($asignarPuesto){
          $usuario = $this->Usuario->getCuenta($idUsuario);
          echo $this->sendEmail(array(
            'asunto' => 'Revista Aqua-LAC',
            'correo' => $usuario['correo'],
            'nombre' => $usuario['nombre'],
            'apellidoPaterno' => $usuario['apellidoPaterno'],
            'apellidoMaterno' => $usuario['apellidoMaterno']
          ),'asignacionEditor');
          
        } else {
          echo $asignarPuesto;
        }
      } else {
        echo 0;
      }
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

  /**
   * Undocumented function
   *
   * @return Boolean
   */
  public function asignacionEvaluador(){
    if ($this->accesos("Coordinador::asignarEvaluador")) {
      if(isset($_POST['idArticulo'])){
        $idArticulo = $_POST['idArticulo'];
        $idEvaluadoruno = $_POST['idEvaluadoruno'];
        $idEvaluadordos = $_POST['idEvaluadordos'];
        $idUsuario = $_POST['idUsuario'];

        $this->loadOtherModel('Usuario');
        $usuario = $this->Usuario->getCuenta($idEvaluadoruno);
        $correoEvaluador = array(
          'asunto' => 'Se te ha asignado un nuevo proyecto para ser evaluado',
          'correo' => $usuario['correo'],
          'nombreCompleto' => $usuario['nombre'].' '.$usuario['apellidoPaterno'].' '.$usuario['apellidoMaterno'],
          'link' => URL
        );
        $this->sendEmail($correoEvaluador,'notificacionUsuarioAsignacionDeEvaluadorToEvaluador');

        $usuario = $this->Usuario->getCuenta($idEvaluadordos);
        $correoEvaluador = array(
          'asunto' => 'Se te ha asignado un nuevo proyecto para ser evaluado',
          'correo' => $usuario['correo'],
          'nombreCompleto' => $usuario['nombre'].' '.$usuario['apellidoPaterno'].' '.$usuario['apellidoMaterno'],
          'link' => URL
        );
        $this->sendEmail($correoEvaluador,'notificacionUsuarioAsignacionDeEvaluadorToEvaluador');

        $datosUsuarioArticulo = $this->Usuario->getCuenta($idUsuario);
        $correoUsuarioArticulo = array(
          'asunto' => 'Tu Articulo esta siendo evaluado, en espera de un resultado. te avisaremos cuando tengas un dictamen.',
          'correo' => $datosUsuarioArticulo['correo'],
          'nombreCompleto' => $datosUsuarioArticulo['nombre'].' '.$datosUsuarioArticulo['apellidoPaterno'].' '.$datosUsuarioArticulo['apellidoMaterno'],
          'link' => URL
        );

        $asignarEvaluador = $this->model->asignarEvaluador($idArticulo, $idUsuario, $idEvaluadoruno, $idEvaluadordos);
        if($asignarEvaluador){
          echo $this->sendEmail($correoUsuarioArticulo,'notificacionUsuarioAsignacionDeEvaluador');
        } else {
          echo $asignarEvaluador;
        }
      } else {
        echo 0;
      }
    }
  }

  public function realizarDictamen() {
    if($this->accesos(__METHOD__)){
      $this->view->articulos = $this->model->getArticulosPorDictaminar();
      $this->view->render($this,'articulosPorDictaminar');
    }
  }

  private function statusArt($idArticulo){
   $status = $this->model->getStatusArticulo();
   $option = "<option value='0' selected disabled hidden>Seleccione...</option>";
   if(is_array($status)){
     foreach ($status as $key => $value) {
       $option .= "<option value='{$value['idStatus']}'>{$value['descripcion']}</option>";
     }
     return $option;
   }
 }

 private function historialDictamenArticulo($idArticulo){
     return $this->model->getHistorialDictamenArticulo($idArticulo);
 }


 public function infoAsignarArticulo() {
   if($this->accesos("Coordinador::asignarEvaluador")){
      if(isset($_POST['val'])){
        $idArticulo = $_POST['val'];
        // $this->view->getUltimoEstatus = $this->model->getUltimoEstatus($idArticulo);
        $articulo = $this->model->getArticulo($idArticulo);
        $this->view->articulo = $articulo;
        $this->view->evalPrioritario = $this->getEvalPrioritarios($idArticulo);
        $this->view->evalSecundario = $this->getEvalSecundario($idArticulo);
        $this->view->statusArt = $this->statusArt($idArticulo);
        $this->view->historialEval = $this->historialDictamenArticulo($idArticulo);
        $this->view->render($this,'infoAsignarArticulo');
      }
    }
  }

  /**
   * AsignarEvaluadores/Articulo
   *  Muestra los evaluadores prioritarios de cada categoria, para ser asignados
   * a un evaluador
   * @param [Integer] $idCategoria
   * @return htmlObjet
   */
  public function getEvalPrioritarios($idArticulo){
    if($this->accesos("Coordinador::asignarEvaluador")){
      $evaluadores = $this->model->getEvaluadoresPrioritarios($idArticulo);
      if (is_array($evaluadores)) {
        $opt = "<option value='0' selected disabled>Seleccione un Evaluador...</option>";
        foreach ($evaluadores as $key => $value) {
          $nombre = $value["apellidoPaterno"]." ".$value["apellidoMaterno"]." ".$value["nombre"];
          $opt .= "<option value='{$value["idUsuario"]}'>{$nombre}</option>";
        }
        return $opt;
      } else {
        return "<option value='0'>Sin Opciones</option>";
      }
    } 
  }

  public function getEvalSecundario($idArticulo){
    if ($this->accesos("Coordinador::asignarEvaluador")) {
      $evaluadores = $this->model->getEvaluadoresSecundarios($idArticulo);
      if (is_array($evaluadores)) {
        $opt = "<option value='0' selected disabled>Seleccione un Evaluador...</option>";
        foreach ($evaluadores as $key => $value) {
          $nombre = $value["apellidoPaterno"]." ".$value["apellidoMaterno"]." ".$value["nombre"];
          $opt .= "<option value='{$value["idUsuario"]}'>{$nombre}</option>";
        }
        return $opt;
      } else {
        return "<option value='0'>Sin Opciones</option>";
      }
    } 
  }

  public function dictaminar(){
    if ($this->accesos("Coordinador::realizarDictamen")) {
      if(isset($_POST)){
        $data = array(
          'idArticulo' => $_POST['idArticulo'],
          'idUsuarioEval' => Session::getValue('idUsuario'),
          'idStatus' => $_POST['estado'],
          'comentario' => $_POST['comentario'],
          'criterios' => $_POST['criterios']
        );
        echo $this->model->setDictamen($data);
      }
    }
  }

  public function listaArticulosRevision(){
    if($this->accesos(__METHOD__)){
      $this->view->articulos = $this->model->getArticulosRevision();
      $this->view->render($this,'ArticulosRevision/articulosEnRevision');
    }
  }

  public function infoArticuloRevision(){
    if($this->accesos("Coordinador::listaArticulosRevision")){
      $idArticulo = $_POST['val'];
      $this->view->articulo = $this->model->getArticulo($idArticulo);
      $this->view->statusArt = $this->statusArt($idArticulo);
      $this->view->historialEval = $this->historialInvestigador($idArticulo);
      $this->view->render($this,'ArticulosRevision/infoArticulo');
    }
  }

  private function historialInvestigador($idArticulo)
  {
    return $this->model->getHistorialDictamenArticulo($idArticulo);
  }

  public function cerrarSesion(){
    Session::destroy();
    header("location:".URL);
  }
    
}
?>
