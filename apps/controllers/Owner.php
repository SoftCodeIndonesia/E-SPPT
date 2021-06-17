<?php 

    class Owner extends Controller
    {
        protected $modelOwner;
        protected $helper;
        public function __construct()
        {
            $this->helper = new Helper;
            $this->modelOwner = $this->model('M_owner');
        }

        public function index()
        {
            $this->permission = 'read all owner';
            $data['title'] = 'Owner';
            $data['js'] = [
                'owner/index.js'
            ];
            $this->view('owner/index', $data);
        }

        public function create()
        {
            $this->permission = 'create owner';
            $data['title'] = 'Create owner';
            $data['js'] = [
                'owner/create.js'
            ];
            $this->view('owner/create',$data);
        }


        public function storeCreated()
        {
            $address['district_id'] = $_POST['district_id'];
            $address['village_id'] = $_POST['village_id'];
            $address['rt'] = $_POST['rt'];
            $address['rw'] = $_POST['rw'];
            $address['address'] = $_POST['address'];
            $address['created_at'] = time();
            $address['created_by'] = $_SESSION['userdata']['user_id'];

            $address_id = $this->modelOwner->insertAddress($address);
            if($address_id > 0)
            {
                $owner['address_id'] = $address_id;
                $owner['name'] = $_POST['name'];
                $owner['created_at'] = time();
                $owner['created_by'] = $_SESSION['userdata']['user_id'];

                $owner_id = $this->modelOwner->insertOwner($owner);
                if($owner_id > 0)
                {
                    echo json_decode($owner_id);
                }
            }
        }
        public function getAllOwner()
        {

            $owner = $this->modelOwner->getDataTable();
            $data_owner = [];
            $no = 1;
            foreach ($owner as $value) {
                $data = [];

                $ul = '<ul class="dropdown-menu">';
                if($_SESSION['userdata']){
                    if($this->helper->checkPermission('delete owner')){
                        $linkHapus = '<a href="#" class="text-danger" id="btn-delete" data-id="' . $value['owner_id'] . '">Delete</a>';
                        $ul = $ul . '<li>' . $linkHapus . '</li>';
                        
                    }
                    if($this->helper->checkPermission('update owner')){
                        $linkUbah = '<a href="' . BASE_URL . 'owner/ubah/' . $value['owner_id'] . '" class="text-success" id="btn-ubah" data-id="' . $value['owner_id'] . '">Ubah</a>';
                        $ul = $ul . '<li>' . $linkUbah . '</li>';
                    }
                }else{
                    $linkLogin = '<a href="#" class="text-danger">Login</a>';
                    $ul = $ul . '<li>' . $linkLogin . '</li>';
                }
                $ul = $ul . '</ul>';
                $data[] = '<tr><td><a href="'. BASE_URL .'owner/detail/'. $value['owner_id'] .'" data-id="'.$value['owner_id'].'" class="list-group-condensed name-title">' .$value['name'] . '</></td>';
                $data[] = "<td>" . $value['address'] . "</td>";
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
                $data_owner[] = $data;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => count($data_owner),
                "recordsFiltered" => $this->modelOwner->count_filtered(),
                "data" => $data_owner,
            );

            // var_dump($output);
            echo json_encode($output);
            exit();
        }

        public function deleteOwner()
        {
            $owner_id = $_POST['owner_id'];

            echo json_encode($this->modelOwner->deleteOwner($owner_id));
        }

        public function getDetail()
        {
            $owner_id = $_POST['owner_id'];
            echo json_encode($this->modelOwner->getOwner($owner_id));
        }

        public function ubah($id)
        {
            $this->permission = 'update owner';
            $data['title'] = 'Ubah';
            $data['js'] = [
                'owner/update.js'
            ];
            $this->view('owner/ubah', $data);
        }

        public function storeUpdated()
        {
            $address['address_id'] = $_POST['address_id'];
            $address['district_id'] = $_POST['district_id'];
            $address['village_id'] = $_POST['village_id'];
            $address['rt'] = $_POST['rt'];
            $address['rw'] = $_POST['rw'];
            $address['address'] = $_POST['address'];
            $address['created_at'] = time();
            $address['created_by'] = $_SESSION['userdata']['user_id'];


            if($this->modelOwner->updateAddress($address) > 0)
            {
                $owner['owner_id'] = $_POST['owner_id'];
                $owner['address_id'] = $_POST['address_id'];
                $owner['name'] = $_POST['name'];
                $owner['created_at'] = time();
                $owner['created_by'] = $_SESSION['userdata']['user_id'];

                $owner_id = $this->modelOwner->updateOwner($owner);
                if($owner_id > 0)
                {
                    echo json_decode($owner_id);
                }
            }
        }

        public function detail($owner_id)
        {
            $this->permission = 'detail owner';
            $data['title'] = 'Detail owner';
            $data['js'] = [
                'owner/detail.js'
            ];
            $this->view('owner/detail',$data);
        }
    }

    
    