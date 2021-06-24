<?php

class Dashboard extends Controller
{
    protected $modelMenu;

    public function __construct()
    {
        if(!isset($_SESSION['userdata'])){
            header('location: ' . BASE_URL . 'login');
        }
        $this->modelMenu = $this->model('M_menu');
    }

    public function index()
    {
        
        $this->permission = 'all permissions';
        $data['title'] = 'E-SPPT kabupaten pekalongan';
        $this->view('dashboard/index', $data);
    }
}