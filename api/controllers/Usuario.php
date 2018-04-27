<?php
include_once 'traits/filterWords.php';

class Usuario extends Controller{
    use filterWords;

    function __construct() {
        parent::__construct();

    }

    public function index(){
      if($this->accesos(__METHOD__)){
        header('Location: '.URL);
      } else {
        $this->pageHistoryBack();
      }
    }

    public function iniciarSesion(){
        if(isset($_POST["username"], $_POST["password"]) ){
            echo $this->model->iniciarSesion($_POST["username"], $_POST["password"]);
        }
    }

    //TODO:
    public function registar()
    {
      if(isset($_POST['datosRegistro'])){
        if ($this->matchedWords($_POST['datosRegistro']['institucion'])) {
          echo $this->model->registar($_POST['datosRegistro']);
        } else {
          echo 210; //BadWord
        }
      } else {
        echo 400;
      }
    }
    
    public function comprobarUsuario()
    {
      if(isset($_POST['correo'])){
        if($this->validateEmail($_POST['correo'])){
          echo $this->model->comprobarUsuario($_POST['correo']);
        } else {
          echo '3';
        }
      } else {
        echo "400";
      }
    }

    public function guardarCambiosPerfil()
    {
      if(isset($_POST)){
        $datos = $_POST;
        $request = $this->model->actualizarInfoPerfil($datos);
        if($request){
          Session::setValue('nombre', $datos['nombre']);
          Session::setValue('apellidoPaterno', $datos['apellidoP']);
          Session::setValue('apellidoMaterno', $datos['apellidoM']);
          Session::setValue('idPaisUser', $datos['pais']);
          Session::setValue('correo', $datos['correo']);
          echo $request;
        } else {
          echo 400;
        }
      } else {
        echo 400;
      }
    }

    /**
    * @author Enrique Aguilar Orozco
    *
    */
    public function updateImgPro(){
        if(isset($_FILES['images']) ){
          if ($_FILES['images']['size'] < 16777216) {
            $imagenType = $_FILES['images']['type'];
            if ($imagenType == "image/jpeg" || $imagenType == "image/jpg" || $imagenType == "image/png"){
                $ext     = explode(".", $_FILES['images']['name']);
                $dir     = 'IMG_'.$this->getKeyImg(Session::getValue('idUsuario')).".".end($ext);
                $dirmove = "public/images/dXN1YXJpb3M/".$dir;

                $upload  = $this->comprimirImagenAndUpload($imagenType,$dirmove,$_FILES['images']['tmp_name']);
                if($upload){
                    echo $this->model->actualizarImg($dir);
                    // echo $dir;
                    $this->deleteAnterior(Session::getValue('imagenPerfil'));
                    Session::setValue('imagenPerfil',$dir);
                } else {
                    echo '0';
                }
            } else {
                echo 2; //formato no admitido
            }
           } else {
               echo 'Tamaño Superado'; //tamaño superado
           }
        }
    }

    /**
    * @author Enrique Aguilar Orozco
    *
    */
    private function deleteAnterior($img){
        if(file_exists('./public/images/dXN1YXJpb3M/'.$img)){
            if($img != 'defaultUser.jpg'){
                unlink('./public/images/dXN1YXJpb3M/'.$img);
            }
        }
    }

    public function cerrarSesion(){
        Session::destroy();
        header("location:".URL);
    }

    public function test($req){
      var_dump($req->param("url"));
      echo "string";
    } 

}
?>
