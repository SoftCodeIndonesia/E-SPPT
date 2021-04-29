<?php

class Login extends Controller
{
    protected $modelLogin;

    public function __construct()
    {
        $this->modelLogin = $this->model('M_login');
    }

    public function index()
    {
        $data['title'] = 'E-SPPT kabupaten pekalongan - Login';
        $data['js'] = [
            'login/auth.js'
        ];
        $this->view('login/login', $data);
    }

    public function storeLogin()
    {
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];

        $user = $this->modelLogin->getByEmail($data['email']);

        echo json_encode($user);
    }

    public function checkHash()
    {
        $hash = $_POST['hash'];
        $password = $_POST['password'];
        $pass = md5($hash);

        if ($pass == $password) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function setSession()
    {
        $_SESSION['userdata'] = $_POST['data'];
        echo json_encode($_SESSION['userdata']);
    }

    public function logOut()
    {
        $this->helper->session_destroy(['userdata']);

        $this->redirect('Login');
    }
}