<?php

    class Esppt extends Controller
    {
        public function index()
        {
            $this->permission = 'read all sppt';
            $data['title'] = 'E - SPPT';
            $this->view('esppt/index', $data);
        }
    }
    