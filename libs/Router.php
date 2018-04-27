<?php
include_once('./config/routes.php');

class Router
{   
    private $routes;
    private $request;
    private $type;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function route()
    {
        $this->routes = (new Routes())->getRoutes();

        $url = (isset($_GET["url"])) ? $_GET["url"] : 'Index/index';
        $url = explode("/", $url);

        $url['controller'] = (isset($url[0])) ? $url[0] : 'Index';
        $url['method']     = (isset($url[1])) ? $url[1] : 'index';
        $url['param']      = (isset($url[2])) ? explode("/", $url[2]) : '';

        if (array_key_exists($url['controller'], $this->routes)) {
            if (array_key_exists($url['method'], $this->routes[$url['controller']])) {
                $action = $this->routes[$url['controller']][$url['method']];
                $this->routing($url, $action);
            }
        } else {
            (new Controller())->pageNotFound();
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $url
     * @param [type] $action
     * @return void
     */
    private function routing($url, $action){
        $path = "./controllers/{$url['controller']}.php";
        $controller = $url['controller'];
        $method = $url['method'];

        $this->request();

        if(file_exists($path)){
            require_once $path;
            $controller = new $controller();
            $controller->{$action['action']}();
            // $controller->{$action['action']}($this);
            $this->view_exists($url, $action);
        } else {
            (new Controller())->pageNotFound();
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $url
     * @param [type] $action
     * @return void
     */
    private function view_exists($url, $action){
        if(array_key_exists('view', $action)){
            $view = $action['view'];
        }
    }
    
    /**
     * Undocumented function
     *
     * @param [type] $param
     * @return void
     */
    public function param($param){
        if(array_key_exists($param, $this->request)){
            return $this->request[$param];
        } else {
            throw new Exception('El valor no existe');
        }
    }

    private function request(){
        $this->type = $_SERVER['REQUEST_METHOD'];
        ($this->type == "GET") ? $this->get() : $this->post();        
    }

    private function get(){
        $this->request = $_GET;
    }

    private function post(){
        $this->request = $_POST;
    }

}
?>