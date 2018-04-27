<?php

class Controller {

    function __construct(){
        Session::init();
        $this->view = new View();
        $this->loadModel();
        // $this->accesos = (Session::existVar('accesos') ) ? Session::getValue('accesos') : null ;
        // $this->loadOtherModel('Log');
    }

    function loadModel() {
        $model = get_class($this) . '_model';
        $path = 'api/models/' . $model . '.php';

        if (file_exists($path)) {
            require_once($path);
            $this->model = new $model();
        }
    }

    function loadOtherModel($model) {
        $nameModel = $model;
        $model = $model. '_model';
        $path = 'api/models/' . $model . '.php';

        if (file_exists($path)) {
            require_once($path);
            $this->$nameModel = new $model;
        }
    }

    function pageNotFound(){
        $this->view->render('Default', 'errorSitio', true);
    }

    function pageHistoryBack(){
        $this->view->render('Default','pageHistoryBack',true);
    }

    /**
    * Funcion para controlar el acceso a los metodos de cada controlador.
    * @param {String} $metodo: metodo el cual se tiene acceso ej. 'Nutricion::RealizarPrueba'.
    *
    * @author Enrique Aguilar Orozco
    *
    */
    function accesos($metodo){
        if (Session::exist()) {
            return (array_search($metodo, array_column(Session::getValue('accesosTipoUsuario'), 'descripcion')) > -1) ? true : $this->pageHistoryBack();
        } else {
            header('location:'.URL);
        }
    }

    function clienteIP(){
        return $_SERVER['REMOTE_ADDR'];
    }

    /** 
     * @author Enrique Aguilar
     *   initLog Tiene como finalidad registrar cualquier cambio dentro del sistema, generando un log.
     * @param  [integer] $idUsurio          [usuario que esta realizando la acción]
     * @param  [integer] $idUsuarioAfectado [usuario que esta siendo afectado por el primer usuario]
     * @param  string $descripcion       [descripcion del log]
     * @return [DB DML]                    [valor de éxito 1: correcto  0: error]
     */
    function initLog($idUsurio, $idUsuarioAfectado, $descripcion = ''){
        $log = array(
          'idUsurio'=>$idUsurio,
          'idUsuarioAfectado'=>$idUsuarioAfectado,
          'ip'=>$this->clienteIP(),
          'descripcion'=>$descripcion,
        );
        return $this->Log->setLog($log,'logs');
    }

    function validateEmail($email) {
       return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
    * @author Enrique Aguilar Orozco
    *
    */
    function sessionExist(){
        if(Session::exist()){return true; } else {header('location:'.URL); }
    }

    /**
    * function getkey
    * funcion para generar la llave para la recuperacion de contraseña me diante correo
    * obtien la fecha actual mas la cuenta del usuario, para generar una llave unica para la recuperacion
    * llave genera en base64.
    * @author Enrique Aguilar
    * @param $cuenta
    *
    * @return String: $key(20) llave generada en base64
    */
    public function getKey($cuenta){
        $key = implode(getDate());
        $key.=$cuenta;
        $ran = rand(1,5);
        for ($i=0; $i < $ran; $i++) {
            $key = base64_encode($key);
        }
        return substr($key,0,25);
    }

    /**
    *
    * @var array data
    *   arreglo el cual contine los datos del correo, obligatorio $data['asunto'],$data['correo'],
    *    las demas posiones son opcionales, las cuales serán incrustadas en el correo
    * @var string correoDestino, correo de destino
    * @var string template, template de correo a enviar este es almacenado
    *       en las vistas ruta: Views/Default/correos/...
    * @since agosto 2017
    * @author Enrique Aguilar Orozco
    *
    */
    function sendEmail($data, $template){
        require_once './libs/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer();
        ob_start();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Host = "smtp.gmail.com";
        $mail->Username = "noreplysaluduaq@gmail.com";
        $mail->Password = "@saluduaq";
        $mail->Port = 587;

        $mail->FromName = "Revista Aqua-LAC";
        $mail->AddAddress($data['correo']);
        $mail->IsHTML(true);
        $mail->Subject = utf8_decode($data['asunto']);
        $mail->addReplyTo('noreply@UNESCO.com', 'NoReply');
        $email = include ("./views/Default/correo/{$template}.php");
        $email = ob_get_clean();
        $mail->Body = utf8_decode($email);

        return $mail->Send();
    }

    /**
     * @author Enrique Aguilar Orozco
     * [comprimirImagenAndUpload description]
     * @param  [string] $tipo       [description]
     * @param  [string] $destino    [description]
     * @param  [object] $Archivotmp [description]
     * @return [boolean]             [description]
     */
     /**
     * @author Enrique Aguilar Orozco
     *
     */
     // public function comprimirImagenAndUpload($tipo,$destino,$Archivotmp){
     //     if ($Archivotmp != ''){
     //         //Imagen original
     //         $rtOriginal = $Archivotmp;
     //         //Crear variable
     //         if($tipo == "image/jpeg" || $tipo == 'image/jpg'){
     //             $original = imagecreatefromjpeg($rtOriginal);
     //         } elseif($tipo == 'image/png') {
     //             $original = imagecreatefrompng($rtOriginal);
     //         }
     //         //Ancho y alto máximo
     //         $max_ancho = 400; $max_alto = 200;
     //
     //         list($ancho,$alto)=getimagesize($rtOriginal);
     //
     //         $x_ratio = $max_ancho / $ancho;
     //         $y_ratio = $max_alto / $alto;
     //
     //         if(($ancho <= $max_ancho) && ($alto <= $max_alto) ){
     //             $ancho_final = $ancho;
     //             $alto_final = $alto;
     //         }
     //         else if(($x_ratio * $alto) < $max_alto){
     //             $alto_final = ceil($x_ratio * $alto);
     //             $ancho_final = $max_ancho;
     //         }
     //         else {
     //             $ancho_final = ceil($y_ratio * $ancho);
     //             $alto_final = $max_alto;
     //         }
     //
     //         $lienzo=imagecreatetruecolor($ancho_final,$alto_final);
     //
     //         imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
     //         imagedestroy($original);
     //
     //         if($tipo == "image/jpeg" || $tipo == 'image/jpg'){
     //             imagejpeg($lienzo,$destino);
     //         } elseif($tipo == 'image/png'){
     //             imagepng($lienzo,$destino);
     //         }
     //         return true;
     //     } else {
     //         return false;
     //     }
     //
     // }

     public function comprimirImagenAndUpload($tipo,$destino,$Archivotmp){
         if ($Archivotmp != ''){
             //Imagen original
             $filename = $Archivotmp;
             //Crear variable
             list($w, $h, $type, $attr) = getimagesize($filename);

             if($tipo == "image/jpeg" || $tipo == 'image/jpg'){
                 $src_im = imagecreatefromjpeg($filename);
             } elseif($tipo == 'image/png') {
                 $src_im = imagecreatefrompng($filename);
             }

             if($h > $w){
               $src_x = '0';   // comienza x
               $src_y = $h/4;   // comienza y
               $src_w = $w; // ancho
               $src_h = $w; // alto
               $dst_x = '0';   // termina x
               $dst_y = '0';   // termina y
             } else if($h < $w) {
               $src_x = $w/4;   // comienza x
               $src_y = '0';   // comienza y
               $src_w = $h; // ancho
               $src_h = $h; // alto
               $dst_x = '0';   // termina x
               $dst_y = '0';   // termina y
             } else {
               $src_x = '0';   // comienza x
               $src_y = '0';   // comienza y
               $src_w = $w; // ancho
               $src_h = $h; // alto
               $dst_x = '0';   // termina x
               $dst_y = '0';   // termina
             }

             $dst_im = imagecreatetruecolor($src_w, $src_h);
             $white = imagecolorallocate($dst_im, 255, 255, 255);
             imagefill($dst_im, 0, 0, $white);

             imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h);

             if($tipo == "image/jpeg" || $tipo == 'image/jpg'){
                 header("Content-type: image/jpeg");
                 imagejpeg($dst_im,$destino);
             } elseif($tipo == 'image/png'){
                 header("Content-type: image/png");
                 imagepng($dst_im,$destino);
             }
             imagedestroy($dst_im);
             return true;
         } else {
             return false;
         }

     }

     /**
     * @author Enrique Aguilar Orozco
     *
     */
     public function getKeyImg($cuenta){
         $key = implode(getDate());
         $key.=$cuenta;
         $ran = rand(1,6);
         for ($i=0; $i < $ran; $i++) {
             $key = base64_encode($key);
         }
         $key = substr($key,5,40);
         return $key;
     }
}

?>
