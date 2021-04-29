<?php

class Main extends Controller
{
    public function index()
    {
        $data['title'] = 'Welcome to SFMVC';
        $this->view("main", $data);
    }
}