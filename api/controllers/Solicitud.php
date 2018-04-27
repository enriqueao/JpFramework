<?php
require_once 'traits/ColoresCategorias.php';

class Solicitud extends Controller
{
  use ColoresCategorias;

  function __construct()
  {
    parent::__construct();
  }
  /***RENDER VIEWS****/
  public function index()
  {
      $this->pageHistoryBack();
  }

  public function solicitudRecuperacion()
  {
    $this->view->render('Default','solicitudRecuperacion',true);
  }

  /****END RENDER VIEWS**/


  /**
   * [establecerContrasena description]
   * @param  [type] $key [description]
   * @return [type]      [description]
   */
  public function establecerContrasena($key=''){
    if($key != ''){
        $this->loadOtherModel('Usuario');
        $llave = $this->Usuario->getKey($key);
        if(is_array($llave)){
            if($llave['status'] == 1){
               if($this->validarFecha($key) == 0) {
                    $this->view->render('Default','nuevaContrasenia',true);
               } else {
                    $this->view->mensaje = 'El enlace ha caducado';
                    $this->view->render('Default','notificacionRestablecerContrasenia',true);
               }
            } else {
                $this->view->mensaje = 'El enlace ya ha sido usado';
                $this->view->render('Default','notificacionRestablecerContrasenia',true);
            }
        } else {
            $this->view->mensaje = 'El enlace no es valido';
            $this->view->render('Default','notificacionRestablecerContrasenia',true);
        }
      } else {
        header('location:'.URL);
      }
  }

  /**
  * @author Enrique Aguilar Orozco
  *
  */
  public function guardarPass(){
      $pass = $_POST['pass'];
      $clv = $_POST['clv'];
      if (isset($pass,$clv)){
          $this->loadOtherModel('Usuario');
          if($this->Usuario->updatePass($clv,$pass)){
            echo $this->Usuario->updateKey($clv);
          } else {
            echo "2";
          }
      } else {
          echo '0';
      }
  }


  /**
  * funcion vadidar fecha
  *
  * @param string(11) clave de la cual se comprobara la fecha.
  * @author Enrique Aguilar Orozco
  * @return integer(11) diferencia en días,entre las fecha actual y la fecha de la llave.
  */
  private function validarFecha($key){
      $this->loadOtherModel('Usuario');
      $get = $this->Usuario->getKey($key);
      if(is_array($get)){
          $fech = $get['fecha'];
          $segundos = strtotime('now') - strtotime($fech);
          return intval($segundos/60/60/24);
      }
  }

  /**
  * funcion caducarDate
  * @param $idUsuario
  * se obtienen todas las llaves las cuales no hayan sido usadas, posteriormente se
  * verifican las fechas, y establecer si han caducado o no.
  * @author Enrique Aguilar Orozco
  *
  */
  private function caducarDate($correo){
      $this->loadOtherModel('Usuario');
      $get = $this->Usuario->getKeysActive($correo);
      if (is_array($get)){
          foreach ($get as $llave => $valor){
              if($this->validarFecha($valor['clv']) >= 1){
                  $this->Usuario->updateKey($valor['clv']);
              }
          }
      }
  }

  /**
   * [getNumOfResets description]
   * @param  [type] $cuenta [description]
   * @return [type]         [description]
   */
  private function getNumOfResets($cuenta){
      $this->loadOtherModel('Usuario');
      return $this->Usuario->getNumOfResets($cuenta);
  }

  /**
   * [solitudRecuperacion description]
   * @author Enrique Aguilar Orozco
   * @return [type] [description]
   */
  public function solitudRecuperacion(){
      if(isset($_POST['correo'])){
          $correo = $_POST['correo'];
          $this->loadOtherModel('Usuario');
          $usuario = $this->Usuario->getCuenta($correo);
          if(is_array($usuario)){
              $this->caducarDate($correo);
              if($this->getNumOfResets($correo) < 1){
                  $clv = $this->getKey($correo);
                  $data = array(
                    'asunto' => 'Recuperar Contraseña Plataforma Investigadores UNESCO',
                    'correo' => $correo,
                    'nombreCompleto' => $usuario['nombre'].' '.$usuario['apellidoPaterno'].' '.$usuario['apellidoMaterno'],
                    'clv' => $clv,
                  );
                  if($this->Usuario->setKey($correo,$clv) && $this->sendEmail($data,'solicitudCambioDeContrasenia')){
                    echo "1";
                  } else {
                    // $this->Usuario->deleteKey($clv);
                    echo "4"; //no se ha insertado la clave en la BD
                  }
              } else {
                  echo '3'; //ya ha solicitado más de 3 claves en un día
              }
          } else {
              echo '2'; //No exite el usuario
          }
      } else {
        echo "5";
      }
  }

  /********************BUSCADOR*********/

  public function misArticulos()
  {
    if (isset($_POST)) {
      switch ($_POST['filtro']) {
        case 'fecha':
           echo $this->getMisArticulos($_POST['filtro'],$_POST['valor']);
          break;
        case 'descripcion':
           echo $this->getMisArticulos($_POST['filtro'],$_POST['valor']);
          break;
        case 'titulo':
           echo $this->getMisArticulos($_POST['filtro'],$_POST['valor']);
          break;
        case 'nombreCategoria':
           echo $this->getMisArticulos($_POST['filtro'],$_POST['valor']);
          break;
        default:
          echo '<p class="avisoSinRegistros">Error, Contacte con el administrador</p>';
          break;
      }
    }

  }

  private function getMisArticulos($filtro, $valor){
    if ($this->accesos("Investigador::misArticulos")) {
      $this->loadOtherModel('Usuario');
      $head = '<table><tr><th>Título<ar class="down"></ar></th><th>Categoría<ar class="down"></ar></th><th>Fecha<ar class="down"></ar></th></tr>';
      $articulos = $this->Usuario->getArticulosUsuario($filtro, $valor);
      if(is_array($articulos)){
        foreach ($articulos as $key => $value) {
          $fecha = date("d M Y", strtotime($value['fecha']));
          $idArticulo = $value['idArticulo'];
          $fn = 'generarPrevio("Investigador", "infoArticulo",'.$idArticulo.')';
          $color = $value['colorDistintivo'];
          $head .= 
          "<tr onclick='generarPrevio('Investigador', 'evaluadorArticulo',{$idArticulo})'>
            <td class='tituloArticulo' style='border-left: 16px solid {$color};'>
            <div class='estatus'>
                <div class='tooltipleft'>
                    <span class='tooltiptextleft'>".$value['descripcion']."</span>
                    ".$this->getIconStatus($value['descripcion'])."
                </div>
                ".$value['titulo']."
            </div>
            </td>
            <td><p>".$value['nombreCategoria']."</p></td>
            <td><p>{$fecha}</p></td>
          </tr>";
        }
        return $head."</table>";
      } else {
        return '<p class="avisoSinRegistros">Sin resultados</p>';
      }
    }
  }

  public function articulosPorEvaluar()
  {
    if (isset($_POST)) {
      switch ($_POST['filtro']) {
        case 'art.fecha':
           echo $this->getArticulosEvaluar($_POST['filtro'],$_POST['valor']);
          break;
        case 'sta.descripcion':
           echo $this->getArticulosEvaluar($_POST['filtro'],$_POST['valor']);
          break;
        case 'art.titulo':
           echo $this->getArticulosEvaluar($_POST['filtro'],$_POST['valor']);
          break;
        case 'cat.nombreCategoria':
           echo $this->getArticulosEvaluar($_POST['filtro'],$_POST['valor']);
          break;
        default:
          echo '<p class="avisoSinRegistros">Error, Contacte con el administrador</p>';
          break;
      }
    }
  }

  private function getArticulosEvaluar($filtro, $valor)
  {
    if ($this->accesos("Investigador::articulosPorEvaluar")) {
      $this->loadOtherModel('Usuario');
      $head = "<table> <tr> <th>Título <ar class='down'></ar></th> <th>Categoría<ar class='down'></ar></th> <th>Fecha<ar class='down'></ar></th></tr>";
      $articulos = $this->Usuario->getArticulosEvaluar($filtro, $valor);
      if(is_array($articulos)){
        foreach ($articulos as $key => $value) {
          $fecha = date("d M Y", strtotime($value['fecha']));
          $idArticulo = $value['idArticulo'];
          $fn = 'generarPrevio("Investigador", "evaluadorArticulo",'.$idArticulo.')';
          $head .=
            "<tr onclick='generarPrevio('Investigador', 'evaluadorArticulo',{$idArticulo})'>
              <td class='tituloArticulo'>
              <div class='estatus'>
                  <div class='tooltipleft'>
                      <span class='tooltiptextleft'>".$value['descripcion']."</span>
                      ".$this->getIconStatus($value['descripcion'])."
                  </div>
                  ".$value['titulo']."
              </div>
              </td>
              <td><p>".$value['nombreCategoria']."</p></td>
              <td><p>{$fecha}</p></td>
            </tr>";
        }
        return $head."</table>";
      } else {
        return '<p class="avisoSinRegistros">Sin resultados</p>';
      }
    }
  }

  public function evaluadores()
  {
    if (isset($_POST)) {
      switch ($_POST['filtro']) {
        case 'u.nombre':
           echo $this->getEvaluadores("us.nombre",$_POST['valor']);
          break;
        case 'apellidos':
           echo $this->getEvaluadores($_POST['filtro'],$_POST['valor']);
          break;
        case 'cat.nombreCategoria':
           echo $this->getEvaluadores($_POST['filtro'],$_POST['valor']);
          break;
        default:
          echo '<p class="avisoSinRegistros">Error, Contacte con el administrador</p>';
          break;
      }
    }
  }

  /**
   * Editada el 22/02/2018
   * Genera la vista al buscar evaluadores con sus áreas de investigación
  */
  private function getEvaluadores($filtro, $valor){
    if ($this->accesos("Coordinador::listaEvaluadores")) {
      $this->loadOtherModel('Usuario');
      $head = "<table> <tr> <th>Nombre <ar class='down'></ar></th> <th>Apellido<ar class='down'></ar></th> <th colspan='5'>Áreas de Investigación<ar class='down'></ar></th> </tr>";
      $articulos = $this->Usuario->getEvaluadores($filtro, $valor);
      if(is_array($articulos)){
        $this->ColorCategoria = $this->getColorPrimarioCategoria($articulos);
        $this->CategoriasEvaluadores = $this->getCategoriasEditores($articulos);
        $idUsuario = '';
        foreach ($articulos as $key => $value) {
          if($idUsuario != $value['idUsuario']){
            $idUsuario = $value['idUsuario'];
            $fn = 'generarPrevio("Coordinador", "infoEvaluador",'.$idUsuario.')';
            $color = ($this->ColorCategoria[$value['idUsuario']]["categoriaPrimaria"] != null) ? 'solid '.$this->ColorCategoria[$value['idUsuario']]["categoriaPrimaria"] : null;
            $head .=
              "<tr onclick='{$fn}'>
                <td style='border-left: 16px {$color}'><p>{$value['nombre']}</p></td>
                <td><p>".$value['apellidoPaterno']." ".$value['apellidoMaterno']."</p></td>
                <td style='background-color: ".((in_array(1, array_column($this->CategoriasEvaluadores[$value['idUsuario']], 'idCategoria'))) ? '#B39DDB' : '')."' class='catColor'></td>
                <td style='background-color: ".((in_array(2, array_column($this->CategoriasEvaluadores[$value['idUsuario']], 'idCategoria'))) ? '#C5E1A5' : '')."' class='catColor'></td>
                <td style='background-color: ".((in_array(3, array_column($this->CategoriasEvaluadores[$value['idUsuario']], 'idCategoria'))) ? '#80DEEA' : '')."' class='catColor'></td>
                <td style='background-color: ".((in_array(4, array_column($this->CategoriasEvaluadores[$value['idUsuario']], 'idCategoria'))) ? '#80CBC4' : '')."' class='catColor'></td>
                <td style='background-color: ".((in_array(5, array_column($this->CategoriasEvaluadores[$value['idUsuario']], 'idCategoria'))) ? '#EF9A9A' : '')."' class='catColor'></td>
              </tr>";
          }
        }
        return $head."</table>";
      } else {
        return '<p class="avisoSinRegistros">Sin resultados</p>';
      }
    }
  }

  public function editores(){
    if (isset($_POST)) {
      switch ($_POST['filtro']) {
        case 'us.nombre':
           echo $this->getEditores($_POST['filtro'],$_POST['valor']);
          break;
        case 'apellidos':
           echo $this->getEditores($_POST['filtro'],$_POST['valor']);
          break;
        case 'cat.nombreCategoria':
           echo $this->getEditores($_POST['filtro'],$_POST['valor']);
          break;
        default:
          echo '<p class="avisoSinRegistros">Error, Contacte con el administrador</p>';
          break;
      }
    }
  }


  /**
   * Editada el 22/02/2018
   * Genera la vista al buscar editores con sus áreas de investigación
  */
  private function getEditores($filtro, $valor){
    if ($this->accesos("Coordinador::listaEditores")) {
      $this->loadOtherModel('Usuario');
      $head = "<table> <tr> <th>Nombre <ar class='down'></ar></th> <th>Apellido<ar class='down'></ar></th> <th colspan='5'>Áreas de Investigación<ar class='down'></ar></th> </tr>";
      $articulos = $this->Usuario->getEditores($filtro, $valor);
      if(is_array($articulos)){
        $this->ColorCategoria = $this->getColorPrimarioCategoria($articulos);
        $this->CategoriasEditores = $this->getCategoriasEditores($articulos);
        $idUsuario = '';
        foreach ($articulos as $key => $value) {
          if($idUsuario != $value['idUsuario']){
            $idUsuario = $value['idUsuario'];
            $fn = 'generarPrevio("Coordinador", "infoEvaluador",'.$idUsuario.')';
            $color = ($this->ColorCategoria[$value['idUsuario']]["categoriaPrimaria"] != null) ? 'solid '.$this->ColorCategoria[$value['idUsuario']]["categoriaPrimaria"] : null;
            $head .=
              "<tr onclick='{$fn}'>
                <td style='border-left: 16px {$color}'><p>{$value['nombre']}</p></td>
                <td><p>".$value['apellidoPaterno']." ".$value['apellidoMaterno']."</p></td>
                <td style='background-color: ".((in_array(1, array_column($this->CategoriasEditores[$value['idUsuario']], 'idCategoria'))) ? '#B39DDB' : '')."' class='catColor'></td>
                <td style='background-color: ".((in_array(2, array_column($this->CategoriasEditores[$value['idUsuario']], 'idCategoria'))) ? '#C5E1A5' : '')."' class='catColor'></td>
                <td style='background-color: ".((in_array(3, array_column($this->CategoriasEditores[$value['idUsuario']], 'idCategoria'))) ? '#80DEEA' : '')."' class='catColor'></td>
                <td style='background-color: ".((in_array(4, array_column($this->CategoriasEditores[$value['idUsuario']], 'idCategoria'))) ? '#80CBC4' : '')."' class='catColor'></td>
                <td style='background-color: ".((in_array(5, array_column($this->CategoriasEditores[$value['idUsuario']], 'idCategoria'))) ? '#EF9A9A' : '')."' class='catColor'></td>
              </tr>";
          }
        }
        return $head."</table>";
      } else {
        return '<p class="avisoSinRegistros">Sin resultados</p>';
      }
    }
  }


  public function getIconStatus($status){
    switch ($status) {
      case 'Enviado':
        return '<i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;';
        break;
      case 'Aceptado':
        return '<i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;';
        break;
      case 'Aceptado con cambios menores':
        return '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;';
        break;
      case 'Aceptado con cambios mayores':
        return '<i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;';
        break;
      case 'Rechazado':
        return '<i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;';
        break;
      case 'Editado':
        return '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;';
        break;
      default:
        return '<i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;';
        break;
    }
  }

//Crea el PDF de los artículos
  public function crearPDF($titulos, $categorias, $fechas, $estatuses){
    require_once(__DIR__.'/../libs/FPDF/fpdf.php');
    //require(LIB.'PlantillaPDF.php');
    require(__DIR__.'/../views/PlantillaPDF/PlantillaPDF.php?');
  
  }

//Obtiene datos de los artículos
  /*public function getArticulosXCategoria($idCat){
    $this->loadOtherModel('Usuario');
    $articulos = $this->Usuario->getArticulosXCategoria($idCat);
    if(is_array($articulos)){
      $titulos = new array();
      $categorias = new array();
      $fechas = new array();
      $estatuses = new array();
      foreach ($articulos as $articulo) {
        $titulos[] = $articulo['titulo'];
        $categorias[] = $articulo['categorias'];
        $fechas[] = $articulo['fecha'];
        $estatuses[] = $articulo['estatus'];
      }

      $this->crearPDF($titulos, $categorias, $fechas, $estatuses);
    }
  }*/

  /********************END*************/



}
?>
