<?php

class Index extends Controller{
    function __construct() {
        parent::__construct();
    }

    /*******Render de vistas*********/
    /**
     * [index description]
     * function index()
     *    es encargada de redireccionar a los index de cada usuario por su tipo de usuario.
     *    el tipo de usuario es determinado en una entidad.
     * @return [view] [render de las vistas de los menus]
     */
    //FIXME:
    public function index(){
      if (Session::exist()) {
        $this->view->paisUser = $this->getPaisesSelectUser();
        $this->view->menu = $this->rendAccesosMenu();
        $this->loadOtherModel('Coordinador');
        $this->view->categoriasU = $this->Coordinador->getCategoriasEvaluador(Session::getValue('idUsuario'));
        $this->view->datosU = $this->Coordinador->getDatosEval(Session::getValue('idUsuario'));
        $this->view->render('Principal','index',true);
      } else {
        $this->view->paises = $this->getPaises();
        $this->view->instituciones = $this->getInstituciones();
        $this->view->render($this,'index');
      }

    }

    /************END RENDER*****************/

    public function rendAccesosMenu()
    {
      $accesosMenu = Session::getValue('accesosMenu');
      if (is_array($accesosMenu)) {
        $contador = 0;
        $menu = '';
        foreach ($accesosMenu as $key => $value) {
          $active = ($contador == 0) ? 'tabb tab-activeInside' : 'tabb';
          $controlador = $value['controlador'];
          $metodo = $value['metodo'];
          $titulo = $value['titulo'];
          $menu .= "<div onclick="."crearVista(this,'{$controlador}','{$metodo}')"." class='{$active}'><h4>{$titulo}</h4></div>";
          $contador++;
        }
        return $menu;
      }
    }

    private function getPaises(){
      $paises = $this->model->getPaises();
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

    private function getPaisesSelectUser(){
      $paises = $this->model->getPaises();
      $idPaisUser = Session::getValue('idPaisUser');
      if(is_array($paises)){
        $opcionesPaises = '';
        foreach ($paises as $registro => $columna) {
          $selected = ($columna['idPais'] === $idPaisUser ) ? 'selected' : '';
          $idPais          = $columna['idPais'];
          $nombrePais      = $columna['nombrePais'];
          $opcionesPaises .= "<option value='{$idPais}' {$selected}>{$nombrePais}</option>";
        }
        return $opcionesPaises;
      } else {
        return '<option>No hay Opciones</option>';
      }
    }

    private function getInstituciones(){
      $instituciones = $this->model->getInstituciones();
      if(is_array($instituciones)){
        $opcionesPaises = '';
        foreach ($instituciones as $registro => $columna) {
          $idInstitucion     = $columna['idInstitucion'];
          $nombreInstitucion = $columna['nombreInstitucion'];
          $opcionesPaises   .= "<option value='{$nombreInstitucion}'>";
        }
        return $opcionesPaises;
      } else {
        return '<option>No hay Opciones</option>';
      }
    }
}
?>
