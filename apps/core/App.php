<?php

class App
{

    protected $controller = MAIN_CONTROLLER;
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (file_exists('../apps/controllers/' . ucfirst($url[0]) . '.php')) {

            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once '../apps/controllers/' . $this->controller . '.php';
        $this->setBackword($this->controller);
        $this->controller = new $this->controller;



        // method
        if (isset($url[1])) {

            if (method_exists($this->controller, $url[1])) {

                $this->method = $url[1];
                $this->setCurrentState($this->method);
                unset($url[1]);
            }
        }

        // params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {


            $url = $_GET['url'];
            $url = trim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

    public function setBackword($url)
    {
        $_SESSION['backword'] = $url;
        unset($_SESSION['current_state']);
    }

    public function setCurrentState($urlMethod)
    {
        $_SESSION['current_state'] = $urlMethod;
    }
}