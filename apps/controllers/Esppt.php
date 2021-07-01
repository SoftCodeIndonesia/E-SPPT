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

        public function detail($sppt_id)
        {
        
            $this->permission = 'read detail sppt';
            $data['title'] = 'Detail SPPT';
            $data['js'] = [
                'esppt/detail.js'
            ];
            $this->view('esppt/detail', $data);
        }

        public function toLocation($sppt_id)
        {
            $sppt = $this->modelSppt->getSpptById($sppt_id);

            $_SESSION['lat'] = $sppt['lat'];
            $_SESSION['lng'] = $sppt['lng'];

            $this->permission = 'read detail sppt';
            $data['title'] = 'Lokasi - SPPT';
            
            $this->view('esppt/location', $data);
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
                    $linkViewLocation = '<a href="'.BASE_URL.'esppt/toLocation/'.$value['sppt_id'].'" class="text-info">Lihat lokasi</a>';
                    $ul = $ul . '<li>' . $linkViewLocation . '</li>';
                }else{
                    $linkLogin = '<a href="#" class="text-danger">Login</a>';
                    $linkViewLocation = '<a href="'.BASE_URL.'esppt/toLocation/'.$value['sppt_id'].'" class="text-info">Lihat lokasi</a>';
                    $ul = $ul . '<li>' . $linkLogin . '</li>';
                    $ul = $ul . '<li>' . $linkViewLocation . '</li>';
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

        public function searchPayment()
        {
            $keyword = $_POST['keyword'];
            $payment = $this->model('M_payment')->searchPayment($keyword);
            $output = '<div class="list-group" style="z-index: 99999">';
                                    
            if($payment > 0){
                foreach ($payment as $key => $value) {
                    $output .= '<a href="#" class="list-group-item list-payment">'. $value['name'] .'</a> ';  
                }
            } else {
                $output .= '<a href="#" class="list-group-item list-payment">Data kosong</a> ';  
            }  
            $output .= '</div>';
            echo json_encode($output);
        }

        public function streCreated()
        {
            // var_dump($_POST);
            $payment_id = 0;
            $payment = $this->model('M_payment')->getPaymentByName($_POST['payment_bank']);
            if($payment){
                $payment_id = $payment['payment_id'];
            }else{
                $paymentInsert['name'] = $keyword;
                $paymentInsert['created_at'] = time();
                $paymentInsert['created_by'] = $_SESSION['userdata']['user_id'];

                $payment_id = $this->model('M_payment')->insert($paymentInsert);
            }

            $sppt['unique_id'] = 'E-SPPT' . time();
            $sppt['owner_id'] = $_POST['owner'];
            $sppt['payment_id'] = $payment_id;
            $sppt['nop'] = $_POST['nop'];
            $sppt['pbb_terhutang'] = $_POST['pbb_terhutang'];
            $sppt['njkp'] = str_replace('.', '', $_POST['njkp']);
            $sppt['due_date'] = strtotime($_POST['due_date']);
            $sppt['created_at'] = time();
            $sppt['created_by'] = $_SESSION['userdata']['user_id'];
            $sppt['lat'] = $_POST['lat'];
            $sppt['lng'] = $_POST['lng'];
            
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

                $data[] = '<tr role="row" class="odd"><td><a href="" data-id="'.$value['tax_id'].'" class="btn btn-default btn-delete-object btn-icon btn-danger text-white"><span class="icon-trash2 color-white"></span></a></td>';
                $data[] = '<td class=""><input type="text" value="'.$value['name'].'" name="nama_object_pajak['.$key.']" data-index="'.$key.'" id="fild_object_pajak_'.$key.'" class="form-control nama-object-pajak" placeholder="Nama object pajak" autocomplete="off"/><input type="hidden" value="'.$value['tax_id'].'" name="tax_id['.$key.']" class="form-control"><div id="nama_object_pajak_0"></div> </td>';
                $data[] = '<td class="sorting_1"><input type="text" value="'.$value['luas'].'" name="luas['.$key.']" id="luas_0" data-index="'.$key.'" class="form-control luas" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" value="'.$value['kelas'].'" name="kelas['.$key.']" id="kelas_'.$key.'" data-index="'.$key.'" class="form-control kelas" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" value="'.$value['njop_value'].'" name="njop['.$key.']" id="njop_'.$key.'" data-index="'.$key.'" class="form-control njop" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" value="'.$value['total_njop'].'" name="total_njop['.$key.']" id="total_njop_'.$key.'" data-index="'.$key.'" class="form-control total_njop" placeholder="0" autocomplete="off"></td></tr>';
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

        public function getObjectTaxForDetail()
        {
            $sppt_id = $_POST['sppt_id'];

            

            $sppt = $this->modelObject->getObjectTaxBySpptId($sppt_id);
            
            $data_sppt = [];
            $no = 1;
            foreach ($sppt as $key => $value) {
                $data = [];

                
                $data[] = '<td class=""><input type="text" readonly value="'.$value['name'].'" name="nama_object_pajak['.$key.']" data-index="'.$key.'" id="fild_object_pajak_'.$key.'" class="form-control nama-object-pajak" placeholder="Nama object pajak" autocomplete="off"/><input type="hidden" value="'.$value['tax_id'].'" name="tax_id['.$key.']" class="form-control"><div id="nama_object_pajak_0"></div> </td>';
                $data[] = '<td class="sorting_1"><input readonly type="text" value="'.$value['luas'].'" name="luas['.$key.']" id="luas_'.$key.'" data-index="'.$key.'" class="form-control luas" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" readonly value="'.$value['kelas'].'" name="kelas['.$key.']" id="kelas_'.$key.'" data-index="'.$key.'" class="form-control kelas" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" readonly value="'.$value['njop_value'].'" name="njop['.$key.']" id="njop_'.$key.'" data-index="'.$key.'" class="form-control njop" placeholder="0" autocomplete="off"></td>';
                $data[] = '<td><input type="text" readonly value="'.$this->rupiah($value['total_njop']).'" name="total_njop['.$key.']" id="total_njop_'.$key.'" data-index="'.$key.'" class="form-control total_njop" placeholder="0" autocomplete="off"></td></tr>';
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

        function rupiah($angka){
	
            $hasil_rupiah = number_format($angka,2,',','.');
            return $hasil_rupiah;
         
        }

        public function getCountObjectTax()
        {
            $sppt_id = $_POST['sppt_id'];

            

            $sppt = $this->modelObject->getObjectTaxBySpptId($sppt_id);

            echo json_encode(count($sppt));
        }

        public function storeUpdate()
        {
            
            
           
            $payment_id = 0;

            $keyword = $_POST['payment_bank'];
            $payment = $this->model('M_payment')->getPaymentByName($keyword);
            if($payment){
                $payment_id = $payment['payment_id'];
            }else{
                $paymentInsert['name'] = $keyword;
                $paymentInsert['created_at'] = time();
                $paymentInsert['created_by'] = $_SESSION['userdata']['user_id'];

                $payment_id = $this->model('M_payment')->insert($paymentInsert);
            }


            $sppt_id = $_POST['sppt_id'];
            $sppt['owner_id'] = $_POST['owner'];
            $sppt['payment_id'] = $payment_id;
            $sppt['nop'] = $_POST['nop'];
            $sppt['pbb_terhutang'] = $_POST['pbb_terhutang'];
            $sppt['njkp'] = str_replace('.', '', $_POST['njkp']);
            $sppt['due_date'] = strtotime($_POST['due_date']);
            $sppt['created_at'] = time();
            $sppt['created_by'] = $_SESSION['userdata']['user_id'];
            $sppt['lat'] = $_POST['lat'];
            $sppt['lng'] = $_POST['lng'];
            
            $sppt_id = $this->modelSppt->updateSppt($sppt,$sppt_id);
            
            foreach ($_POST['nama_object_pajak'] as $key => $value) {
            

                $object['name'] = strtolower($value);
                $object['created_at'] = time();
                $object['created_by'] = $_SESSION['userdata']['user_id'];
                
                $object_id = $this->modelObject->getObjectByName($object['name']);
                $tax_id = $_POST['tax_id'][$key];
               
                
                if($object_id){
                    
                    
                    
                    $object_tax['object_id'] = $object_id['object_id'];
                    $object_tax['luas'] = $_POST['luas'][$key];
                    $object_tax['kelas'] = $_POST['kelas'][$key];
                    $object_tax['njop_value'] = $_POST['njop'][$key];
                    $object_tax['total_njop'] = $_POST['total_njop'][$key];
                    
                    if($tax_id){
                        $this->modelObject->update_object_tax($object_tax, $tax_id);
                    }else{
                        
                        $object_tax['sppt_id'] = $_POST['sppt_id'];
                        
                        $this->modelObject->insert_object_tax($object_tax);
                    }
                }else{
                    $object_id = $this->modelObject->insert($object);
                    
                    $object_tax['object_id'] = $object_id;
                    $object_tax['luas'] = $_POST['luas'][$key];
                    $object_tax['kelas'] = $_POST['kelas'][$key];
                    $object_tax['njop_value'] = $_POST['njop'][$key];
                    $object_tax['total_njop'] = $_POST['total_njop'][$key];
                    
                    
                    if($tax_id){
                        $this->modelObject->update_object_tax($object_tax, $tax_id);
                    }else{
                       
                        $object_tax['sppt_id'] = $_POST['sppt_id'];
                        $this->modelObject->insert_object_tax($object_tax);
                    }
                }
            }
            
            $this->helper->redirect(BASE_URL + 'esppt');
        }

        public function delete_tax()
        {
            $tax_id = $_POST['tax_id'];

            echo json_encode($this->modelObject->delete_tax($tax_id));
        }

        public function delete_sppt()
        {
            $sppt_id = $_POST['sppt_id'];
            $callback = 0;
            if($this->modelObject->deleteBySpptId($sppt_id) > 0){
                $callback = $this->modelSppt->deleteById($sppt_id);
            }

            echo json_encode($callback);
        }

        public function getTotalNjop()
        {
            $sppt_id = $_POST['sppt_id'];

            $tax = $this->modelObject->totalNjop($sppt_id);
            
            echo json_encode($tax);
        }
    }
    