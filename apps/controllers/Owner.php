<?php 

    class Owner extends Controller
    {
        public function index()
        {
            $this->permission = 'read all owner';
            $data['title'] = 'Owner';
            $this->view('owner/index', $data);
        }
    }
    