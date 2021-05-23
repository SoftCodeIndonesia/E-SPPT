<?php
error_reporting(0);
class Controller
{

    protected $menu;
    protected $submenu;
    protected $js;
    protected $permission;
    protected $icons;
    protected $param1;

    public function view($view, $data = [])
    {

        if(isset($_SESSION['userdata'])){
            $this->menu = $this->getMenu();
            $this->submenu = $this->getSubMenu();
        }


        $this->js = $data['js'];

        $folder = explode('/', $view);
        if ($folder[0] == 'login') {
            require_once '../apps/views/' . $view . '.php';
        } else {
            $helper = new Helper;
            $this->param1 = $helper->uriSegment(0);
            $this->icons = $helper->getIcons();
            
            if ($helper->checkPermission($this->permission)) {

                require_once '../apps/views/templates/header.php';
                require_once '../apps/views/' . $view . '.php';
                require_once '../apps/views/templates/footer.php';
            } else {
                require_once '../apps/views/templates/404.php';
            }
        }
    }


    public function model($model)
    {
        require_once '../apps/model/' . $model . '.php';
        return new $model;
    }

    public function redirect($url)
    {
        header('location: ' . $url);
    }

    public function getMenu()
    {
        $menu = $this->model('M_menu')->getMenuByUser(0);
        return $menu;
    }

    public function getSubMenu()
    {
        $subMenu = $this->model('M_menu')->getSubMenuByUser();
        return $subMenu;
    }
}