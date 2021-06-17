<?php

    class Esppt extends Controller
    {
        protected $modelOwner;
        protected $modelObject;
        protected $modelSppt;
        protected $helper;
        public function __construct()
        {
            $this->helper = new Helper;
            $this->modelOwner = $this->model('M_owner');
            $this->modelObject = $this->model("M_object");
            $this->modelSppt = $this->model("M_sppt");
        }

        public function index()
        {
            $this->permission = 'read all sppt';
            $data['title'] = 'E - SPPT';
            $data['js'] = [
                'esppt/index.js'
            ];
            $this->view('esppt/index', $data);
        }

        public function getAllSppt()
        {

            $sppt = $this->modelSppt->getDataTable();
            
            $data_sppt = [];
            $no = 1;
            foreach ($sppt as $value) {
                $data = [];

                $ul = '<ul class="dropdown-menu">';
                if($_SESSION['userdata']){
                    if($this->helper->checkPermission('delete sppt')){
                        $linkHapus = '<a href="#" class="text-danger" id="btn-delete" data-id="' . $value['sppt_id'] . '">Delete</a>';
                        $ul = $ul . '<li>' . $linkHapus . '</li>';
                        
                    }
                    if($this->helper->checkPermission('update sppt')){
                        $linkUbah = '<a href="' . BASE_URL . 'esppt/ubah/' . $value['sppt_id'] . '" class="text-success" id="btn-ubah" data-id="' . $value['sppt_id'] . '">Ubah</a>';
                        $ul = $ul . '<li>' . $linkUbah . '</li>';
                    }
                }else{
                    $linkLogin = '<a href="#" class="text-danger">Login</a>';
                    $ul = $ul . '<li>' . $linkLogin . '</li>';
                }
                $ul = $ul . '</ul>';
                $data[] = '<tr><td><a href="'. BASE_URL .'esppt/detail/'. $value['sppt_id'] .'" data-id="'.$value['sppt_id'].'" class="list-group-condensed name-title">' .$value['unique_id'] . '</></td>';
                $data[] = "<td>" . $value['owner'] . "</td>";
                $data[] = "<td>" . $value['payment'] . "</td>";
                $data[] = "<td>" . $value['nop'] . "</td>";
                $data[] = "<td>" . date("d M Y", $value['due_date']) . "</td>";
              
                $data[] = '<td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon-cog"></span> <span class="caret"></span>
                                    </button>
                                    '. $ul .'
                                </div>
                        </td>';
                $data[] = "</tr>";
                $data_sppt[] = $data;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($data_sppt),
                "recordsFiltered" => $this->modelSppt->count_filtered(),
                "data" => $data_sppt,
            );

            // var_dump($output);
            echo json_encode($output);
            exit();
        }

        public function create()
        {
            $this->permission = 'create sppt';
            $data['title'] = 'Buat E-SPPT';
            $data['js'] = [
                'esppt/create.js'
            ];
            $this->view('esppt/create', $data);
        }
        public function ubah($id)
        {
            $this->permission = 'update sppt';
            $data['title'] = 'Update E-SPPT';
            $data['js'] = [
                'esppt/ubah.js'
            ];
            $this->view('esppt/ubah', $data);
        }

        public function getById()
        {
            $e_sppt = $_POST['e_sppt'];
            echo json_encode($this->modelSppt->getSpptById($e_sppt));

        }

        public function getAllOwner()
        {
            $owner = $this->modelOwner->getAllOwner();
            echo json_encode($owner);
        }

        public function getAddress()
        {
            $address_id = $_POST['address_id'];

            echo json_encode($this->modelOwner->getAddressById($address_id));
        }

        public function searchObject()
        {
            $keyword = $_POST['keyword'];
            $object = $this->modelObject->searchObject($keyword);
            // var_dump($object);
            $output = '<div class="list-group" style="z-index: 99999">';
                                    
            if($object > 0){
                foreach ($object as $key => $value) {
                    $output .= '<a href="#" class="list-group-item list-object">'. $value['name'] .'</a> ';  
                }
            } else {
                $output .= '<a href="#" class="list-group-item list-object">Data kosong</a> ';  
            }  
            $output .= '</div>';
            echo json_encode($output);
        }

        public function getPayment()
        {
            $payment = $this->model('M_payment')->getAllPayment();

            echo json_encode($payment);
        }

        public function streCreated()
        {
            // var_dump($_POST);
            $sppt['unique_id'] = 'E-SPPT' . time();
            $sppt['owner_id'] = $_POST['owner'];
            $sppt['payment_id'] = $_POST['payment_bank'];
            $sppt['nop'] = $_POST['nop'];
            $sppt['pbb_terhutang'] = $_POST['pbb_terhutang'];
            $sppt['due_date'] = strtotime($_POST['due_date']);
            $sppt['created_at'] = time();
            $sppt['created_by'] = $_SESSION['userdata']['user_id'];
            $sppt_id = $this->modelSppt->insert($sppt);
            
            foreach ($_POST['nama_object_pajak'] as $key => $value) {
            

                $object['name'] = strtolower($value);
                $object['created_at'] = time();
                $object['created_by'] = $_SESSION['userdata']['user_id'];
                
                $object_id = $this->modelObject->getObjectByName($object['name']);

                if($object_id){
                    $object_tax['sppt_id'] = $sppt['unique_id'];
                    $object_tax['object_id'] = $object_id['object_id'];
                    $object_tax['luas'] = $_POST['luas'][$key];
                    $object_tax['kelas'] = $_POST['kelas'][$key];
                    $object_tax['njop_value'] = $_POST['njop'][$key];
                    $object_tax['total_njop'] = $_POST['total_njop'][$key];
                    
                    $this->modelObject->insert_object_tax($object_tax);
                }else{
                    $object_id = $this->modelObject->insert($object);
                    $object_tax['sppt_id'] = $sppt['unique_id'];
                    $object_tax['object_id'] = $object_id;
                    $object_tax['luas'] = $_POST['luas'][$key];
                    $object_tax['kelas'] = $_POST['kelas'][$key];
                    $object_tax['njop_value'] = $_POST['njop'][$key];
                    $object_tax['total_njop'] = $_POST['total_njop'][$key];
                    
                    $this->modelObject->insert_object_tax($object_tax);
                }
            }
            
            $this->helper->redirect(BASE_URL + 'esppt');
        }

        public function getObjectTax()
        {
            $sppt_id = $_POST['sppt_id'];

            

            $sppt = $this->modelObject->getObjectTaxBySpptId($sppt_id);
            
            $data_sppt = [];
            $no = 1;
            foreach ($sppt as $key => $value) {
                $data = [];

                $data[] = '<tr role="row" class="odd">';
                $data[] = '<td class=""><button type="button" class="btn btn-default btn-icon btn-danger text-white"><span class="icon-trash2 color-white"></span></button></td>';
                $data[] = '<td class=""><input type="text" value="'.$value['name'].'" name="nama_object_pajak['.$key.']" data-index="'.$key.'" id="fild_object_pajak_'.$key.'" class="form-control nama-object-pajak" placeholder="Nama object pajak" autocomplete="off"><div id="nama_object_pajak_0"></div> </td>';
                $data[] = '<td class="sorting_1"><input type="text" value="'.$value['luas'].'" name="luas['.$key.']" id="luas_0" data-index="'.$key.'" class="form-control luas" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" value="'.$value['kelas'].'" name="kelas['.$key.']" id="kelas_'.$key.'" data-index="'.$key.'" class="form-control kelas" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" value="'.$value['njop_value'].'" name="njop['.$key.']" id="njop_'.$key.'" data-index="'.$key.'" class="form-control njop" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" value="'.$value['total_njop'].'" name="total_njop['.$key.']" id="total_njop_'.$key.'" data-index="'.$key.'" class="form-control total_njop" placeholder="0" autocomplete="off"></td>';
                $data[] = '</tr>';
                $data_sppt[] = $data;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($data_sppt),
                "recordsFiltered" => count($data_sppt),
                "data" => $data_sppt,
            );

            
            echo json_encode($output);
            exit();
        }
    }
    