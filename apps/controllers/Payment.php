<?php

class Payment extends Controller
{
    protected $modelPayment;
    protected $helper;
    public function __construct()
    {
        $this->helper = new Helper;
        $this->modelPayment = $this->model('M_payment');
    }

    public function index()
    {
        
        $this->permission = 'read all payment';
        $data['title'] = 'E-SPPT - Payment method';
        $data['js'] = [
            'payment/index.js'
        ];
        $this->view('payment/index', $data);
    }


    public function create()
    {
        $this->permission = 'create payment';
        $data['title'] = 'E-SPPT - Create payment';
        
        $this->view('payment/create', $data);
    }

    public function storeCreated()
    {
        $data['name'] = $_POST['name'];
        $data['created_at'] = time();
        $data['created_by'] = $_SESSION['userdata']['user_id'];

        $callback = $this->modelPayment->insert($data);

        echo json_encode($callback);

        
    }


    public function getAll()
    {

        $payment = $this->modelPayment->getDataTable();
        $payment_data = [];
        $no = 1;
        foreach ($payment as $value) {
            $data = [];

            $ul = '<ul class="dropdown-menu">';
            if($_SESSION['userdata']){
                if($this->helper->checkPermission('delete payment')){
                    $linkHapus = '<a href="#" class="text-danger" id="btn-delete" data-id="' . $value['payment_id'] . '">Delete</a>';
                    $ul = $ul . '<li>' . $linkHapus . '</li>';
                    
                }
                if($this->helper->checkPermission('update payment')){
                    $linkUbah = '<a href="' . BASE_URL . 'payment/ubah/' . $value['payment_id'] . '" class="text-success" id="btn-ubah" data-id="' . $value['payment_id'] . '">Ubah</a>';
                    $ul = $ul . '<li>' . $linkUbah . '</li>';
                }
            }else{
                $linkLogin = '<a href="#" class="text-danger">Login</a>';
                $ul = $ul . '<li>' . $linkLogin . '</li>';
            }
            $ul = $ul . '</ul>';
            $data[] = '<tr><td>' . $no . '</td>';
            $data[] = '<td>' .$value['name'] . '</td>';
            $data[] = "<td>" . date('d M Y', $value['created_at']) . "</td>";
            $data[] = "<td>" . $value['created_by'] . "</td>";
            $data[] = '<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-cog"></span> <span class="caret"></span>
                                </button>
                                '. $ul .'
                            </div>
                    </td>';
            $data[] = "</tr>";
            $payment_data[] = $data;
            $no++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($payment_data),
            "recordsFiltered" => $this->modelPayment->count_filtered(),
            "data" => $payment_data,
        );

        // var_dump($output);
        echo json_encode($output);
        exit();
    }

    public function delete()
    {
        $payment_id = $_POST['payment_id'];

        $callback = $this->modelPayment->delete($payment_id);

        echo json_encode($callback);
    }

    public function storeUpdate()
    {   
        $data['payment_id'] = $_POST['payment_id'];
        $data['name'] = $_POST['name'];
        $data['created_at'] = time();
        $data['created_by'] = $_SESSION['userdata']['user_id'];

        $callback = $this->modelPayment->ubah($data);

        echo json_encode($callback);

        
    }

    public function getDetail()
    {
        $payment_id = $_POST['payment_id'];
        
        $payment = $this->modelPayment->paymentById($payment_id);

        echo json_encode($payment);
    }

    
}