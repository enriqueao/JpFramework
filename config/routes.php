<?php 
class Routes 
{ 
    private $routes; 
 
    function __construct(){ 
        $this->setRoutes(); 
    } 
 
    function getRoutes(): Array 
    { 
        return $this->routes; 
    } 
 
    function setRoutes() 
    { 
        $this->routes = array( 
            'Usuario' => array( 
                'iniciarSesion' => array( 
                    'action' => 'iniciarSesion', 
                    // 'view' => 'algo.html', 
                    // 'public' => true, 
                    // 'method' => 'GET' 
                ), 
                'registrar' => array( 
                    'action' => 'registrar', 
                ), 
                'guardarCambiosPerfil' => array( 
                    'action' => 'guardarCambiosPerfil', 
                ),
                'index' => array(
                    'action' => 'index'
                ),
                'comprobarUsuario' => array(
                    'action' => 'comprobarUsuario'
                ),
                'guardarCambiosPerfil' => array(
                    'action' => 'guardarCambiosPerfil'
                ),
                'upgradeImgProfile' => array(
                    'action' => 'upgradeImgProfile'
                ),
                'deleteAnterior' => array(
                    'action' => 'deleteAnterior'
                ),
                'cerrarSesion' => array(
                    'action' => 'cerrarSesion'
                ),
                'test' => array(
                    'action' => 'test'
                )
            ), 
            'Administrador' => array( 
                'index' => array(
                    'action' => 'index'
                ), 
                'historicoProcesos' => array(
                    'action' => 'historicoProcesos'
                ),
                'asignar' => array(
                    'action' => 'asignar'
                ),
                'cambioPermisosAdministrador' => array(
                    'action' => 'cambioPermisosAdministrador'
                )
            ), 
            'Coordinador' => array( 
                'index' => array(
                    'action' => 'index'
                 ),
                 'listaEvaluadores' => array(
                    'action' => 'listaEvaluadores'
                 ),
                 'listaEditores' => array(
                    'action' => 'listaEditores'
                 ),
                 'evaluadores' => array(
                    'action' => 'evaluadores'
                 ),
                 'categorias' => array(
                    'action' => 'categorias'
                 ),
                 'infoCategoria' => array(
                    'action' => 'infoCategoria'
                 ),
                 'nuevoEvaluador' => array(
                    'action' => 'nuevoEvaluador'
                 ),
                 'nuevoEditor' => array(
                    'action' => 'nuevoEditor'
                 ),
                 'asignarEvaluador' => array(
                    'action' => 'asignarEvaluador'
                 ),
                 'dictaminarArticulo' => array(
                    'action' => 'dictaminarArticulo'
                 ),
                 'iniciarSesion' => array(
                    'action' => 'iniciarSesion'
                 ),
                 'getPaises' => array(
                    'action' => 'getPaises'
                 ),
                 'registrarEvaluador' => array(
                    'action' => 'registrarEvaluador'
                 ),
                 'registrarEditor' => array(
                    'action' => 'registrarEditor'
                 ),
                 'sendKey' => array(
                    'action' => 'sendKey'
                 ),
                 'enviarInvitacion' => array(
                    'action' => 'enviarInvitacion'
                 ),
                 'enviarInvitacionEditor' => array(
                    'action' => 'enviarInvitacionEditor'
                 ),
                 'getCategoriasArticulos' => array(
                    'action' => 'getCategoriasArticulos'
                 ),
                 'asignacionEvaluador' => array(
                    'action' => 'asignacionEvaluador'
                 ),
                 'realizarDictamen' => array(
                    'action'=> 'realizarDictamen'
                 ),
                 'statusArt' => array(
                    'action' => 'statusArt'
                 ),
                 'historialDictamenArticulos' => array(
                    'action' => 'historialDictamenArticulos'
                 ),
                 'infoAsignarArticulo' => array(
                    'action' => 'infoAsignarArticulo'
                 ),
                 'getEvalPrioritarios' => array(
                    'action' => 'getEvalPrioritarios'
                 ),
                 'getEvalSecundarios' => array(
                    'action' => 'getEvalSecundarios'
                 ),
                 'dictaminar' => array(
                    'action' => 'dictaminar'
                 ),
                 'listaArticulosRevision' => array(
                    'action' => 'listaArticulosRevision'
                 ),
                 'infoArticuloRevision' => array(
                    'action' => 'infoArticuloRevision'
                 ),
                 'historialInvestigador' => array(
                    'action' => 'historialInvestigador'
                 ),
                 'cerrarSesion' => array(
                    'action' => 'cerrarSesion'
                 )
            ), 
            'Evaluador' => array( 
                 'index' => array(
                    'action' => 'index'
                 ),
                 'articulosPorEvaluar' => array(
                    'action' => 'articulosPorEvaluar'
                 ),
                 'evaluadorArticulo' => array(
                    'action'=> 'evaluadorArticulo'
                 ),
                 'categoriaSelect' => array(
                    'action' =>'categoriaSelect'
                 ),
                 'historialEval'=> array(
                    'action' => 'historialEval'
                 ),
                 'statusArt'=> array(
                    'action' => 'statusArt'
                 ),
                 'editarInfoArticulo' => array(
                    'action' => 'editarInfoArticulo'
                 ),
                 'getArticulos' => array(
                    'action' => 'getArticulos'
                 ),
                 'getCategoriasArticulos' => array(
                    'action' => 'getCategoriasArticulos'
                 ),
                 'evaluar' => array(
                    'action' => 'evaluar'
                 )
            ), 
            'Investigador' => array( 
                'index' => array( 
                    'action' => 'index' 
                 ), 
                 'misArticulos' => array(
                    'action' => 'misArticulos'
                 ),
                 'articulosPorEvaluar' => array(
                    'action' => 'articulosPorEvaluar'
                 ),
                 'evaluadorArticulo' => array(
                    'action' => 'evaluadorArticulo'
                 ),
                 'editarArticulo' => array(
                    'action' => 'editarArticulo'
                 ),
                 'infoArticulo' => array(
                    'action' => 'infoArticulo'
                 ),
                 'infoAsignarArticulo' => array(
                    'action' => 'infoAsignarArticulo'
                 ),
                 'nuevoArticulo' => array(
                    'action' => 'nuevoArticulo'
                 ),
                 'categoriaSelect' => array(
                    'action' => 'categoriaSelect'
                 ),
                 'historialInvestigador' => array(
                    'action' => 'historialInvestigador'
                 ),
                 'historialEval' => array(
                    'action' => 'historialEval'
                 ),
                 'statusArt' => array(
                    'action' => 'statusArt'
                 ),
                 'editarInfoArticulo'=> array(
                    'action' => 'editarInfoArticulo'
                 ),
                 'editarArticuloInfo' => array(
                    'action' => 'editarArticuloInfo'
                 ),
                 'subirArticulo' => array(
                    'action' => 'subirArticulo'
                 ),
                 'subirArticuloInfo' => array(
                    'action' => 'subirArticuloInfo'
                 ),
                 'subirArchivo' => array(
                    'action' => 'subirArchivo'
                 ),
                 'getArticulos' => array(
                    'action' => 'getArticulos'
                 ),
                 'getCategoriasArticulos' => array(
                    'action' => 'getCategoriasArticulos'
                 )
            ), 
            'Solicitud' => array( 
                 'solicitudRecuperacion' => array(
                    'action' => 'solicitudRecuperacion'
                 ),
                 'establecerContrasena' => array(
                    'action' => 'establecerContrasena'
                 ),
                 'guardarPass' => array(
                    'action' => 'guardarPass'
                 ),
                 'validarFecha' => array(
                    'action' => 'validarFecha'
                 ),
                 'caducarDate' => array(
                    'action' => 'caducarDate'
                 ),
                 'getNumOfResets' => array(
                    'action' => 'getNumOfResets'
                 ),
                 'solicitudRecuperacion' => array(
                    'action' => 'solicitudRecuperacion'
                 ),
                 'misArticulos' => array(
                    'action' => 'misArticulos'
                 ),
                 'getMisArticulos' => array(
                    'action' => 'getMisArticulos'
                 ),
                 'articulosPorEvaluar' => array(
                    'action' => 'articulosPorEvaluar'
                 ),
                 'getArticulosEvaluar' => array(
                    'action'=> 'getArticulosEvaluar'
                 ),
                 'evaluadores' => array(
                    'action' => 'evaluadores'
                 ),
                 'getEvaluadores' => array(
                    'action' => 'getEvaluadores'
                 ),
                 'editores' => array(
                    'action' => 'editores'
                 ),
                 'getEditores' => array(
                    'action' => 'getEditores'
                 ),
                 'getIconStatus' => array(
                    'action' => 'getIconStatus'
                 ),
                 'crearPDF' => array(
                    'action' => 'crearPDF'
                 )
            ), 
            'Index' => array( 
                'index' => array( 
                    'action' => 'index' 
                ), 
                'rendAccesosMenu' => array(
                    'action' => 'rendAccesosMenu'
                ),
                'getPaises' => array(
                    'action' => 'getPaises'
                ),
                'getPaisesSelectUser' => array(
                    'action' => 'getPaisesSelectUser'
                ),
                'getInstituciones' => array(
                    'action'=> 'getInstituciones'
                )
            ) 
        ); 
    } 
} 
?>