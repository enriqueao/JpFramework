<?php
class Administrador extends Controller{
    function __construct() {
        parent::__construct();
    }

    /*******Render de vistas*********/
    public function index(){
      $this->pageHistoryBack();
    }
    /************END RENDER*****************/

    //TODO: Funcion por confirmar detalles
    public function historicoProcesos()
    {
        echo __METHOD__;
    }

    //TODO:
    public function asignar()
    {
      if($this->accesos(__METHOD__)){
        $this->view->administradores = $this->model->getListaAdministradores();
        $this->view->render($this, 'permisosCoordinador');
      }
    }

    //TODO:
    public function cambioPermisosAdministrador() 
    {
        if($this->accesos('Administrador::asignar') and isset($_POST)){
            $idUsuario = $_POST['idUsuario'];
            echo $this->model->cambioPermisosAdministrador($idUsuario);
        }
    }
}
?>
