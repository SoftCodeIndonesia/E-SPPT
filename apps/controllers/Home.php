<?php

class Home extends Controller
{
    protected $modelMenu;

    public function __construct()
    {
        $this->modelMenu = $this->model('M_menu');
    }

    public function index()
    {
        $data['title'] = 'E-SPPT kabupaten pekalongan';
        $this->view('home/index', $data);
    }
}