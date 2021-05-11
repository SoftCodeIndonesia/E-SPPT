<?php


class Menu extends Controller
{
    protected $modelMenu;
    protected $modelPermission;
    protected $userPermission;
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper;
        $this->modelMenu = $this->model('M_menu');
        $this->modelPermission = $this->model('M_permission');
        $this->userPermission = $this->model('M_user_permission');
    }

    public function getParent()
    {
        echo json_encode($this->getMenu());
    }

    public function index()
    {
        $this->permission = 'read menu';
        $data['title'] = 'Menu';
        $data['js'] = [
            'menu/index.js'
        ];
        $this->view('menu/index', $data);
    }

    public function create()
    {
        $this->permission = 'create menu';
        $data['title'] = 'Create New Menu';
        $data['js'] = [
            'menu/create.js'
        ];

        $this->view('menu/create', $data);
    }

    public function getAllMenu()
    {

        $menu = $this->modelMenu->getMenuDataTable();
        $data_menu = [];
        $no = 1;
        foreach ($menu as $value) {
            $data = [];

            $linkHapus = '<a href="#" class="text-danger" id="btn-delete" data-id="' . $value['menu_id'] . '">Delete</a>';
            $linkUbah = '<a href="' . BASE_URL . 'menu/update/' . $value['menu_id'] . '" class="text-success" id="btn-ubah" data-id="' . $value['menu_id'] . '">Ubah</a>';
            $linkDetail = '<a href="' . BASE_URL . 'menu/detail/' . $value['menu_id'] . '" class="text-primary" id="btn-detail" data-id="' . $value['menu_id'] . '">Detail</a>';

            $data[] = "<tr><td>" . $value['menu'] . "</td>";
            $data[] = "<td>" . $value['label'] . "</td>";
            $data[] = "<td>" . $value['route'] . "</td>";
            $data[] = "<td>" . date('d M Y', $value['created_at']) . "</td>";
            $data[] = "<td>" . $value['created_by'] . "</td>";
            $data[] = '<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="icon-cog"></span> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>' . $linkHapus . '</li>
                                    <li>' . $linkUbah . '</a></li>
                                    <li>' . $linkDetail . '</li>
                                </ul>
                            </div>
                       </td>';
            $data[] = "</tr>";
            $data_menu[] = $data;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => count($data_menu),
            "recordsFiltered" => $this->modelMenu->count_filtered(),
            "data" => $data_menu,
        );


        echo json_encode($output);
        exit();
    }

    public function deleteMenu()
    {
        $menu_id = $_POST['menu_id'];

        $delete = $this->modelMenu->delete($menu_id);

        echo json_encode($delete);
    }

    public function storeCreated()
    {

        $dataMenu['parent_id'] = $_POST['menu']['parent_id'];
        $dataMenu['name'] = $_POST['menu']['name'];
        $dataMenu['label'] = $_POST['menu']['label'];
        $dataMenu['description'] = $_POST['menu']['description'];
        $dataMenu['route'] = $_POST['menu']['route'];
        $dataMenu['icon'] = $_POST['menu']['icon_menu'];
        $dataMenu['created_at'] = time();
        $dataMenu['created_by'] = $_SESSION['userdata']['user_id'];
        $callbackCreate = $this->modelMenu->insertMenu($dataMenu);
        if ($callbackCreate > 0) {


            foreach ($_POST['permission'] as $key => $value) {
                $permission['menu_id'] = $callbackCreate;
                $permission['name'] = $value['permission_name'];
                $permission['description'] = $value['description_permission'];
                $permission['created_at'] = time();
                $permission['created_by'] = $_SESSION['userdata']['user_id'];
                $this->modelMenu->insertPermission($permission);
            }
        }

        echo json_encode($callbackCreate);
    }

    public function getDetail()
    {
        $menu_id = $_POST['menu_id'];
        $detail = $this->modelMenu->getMenuById($menu_id);
        echo json_encode($detail);
    }

    public function detail($menu_id)
    {
        $this->permission = 'read menu';
        $data['title'] = 'Detail Menu';
        $data['js'] = [
            'menu/detail.js'
        ];


        $this->view('menu/detail', $data);
    }

    public function getPermissionByIdAndMenu()
    {
        $menu_id = $_POST['menu_id'];

        $permission = $this->modelMenu->getPermissionByMenuIdAndUserId($menu_id);

        echo json_encode($permission);
    }

    public function setPermission()
    {
        $callbackCreate = 0;
        $permission['user_id'] = $_SESSION['userdata']['user_id'];
        $permission['permission_id'] = $_POST['permission_id'];
        $permission['created_at'] = time();
        $permission['created_by'] = $_SESSION['userdata']['user_id'];

        if ($this->modelMenu->getUserPermission($permission['user_id'], $permission['permission_id']) > 0) {

            $callbackCreate = $this->modelMenu->deleteUserPermission($permission['user_id'], $permission['permission_id']);
        } else {

            $callbackCreate = $this->modelMenu->createUserPermission($permission);
        }

        echo json_encode($callbackCreate);
    }

    public function add_permission()
    {
        $this->permission = 'create menu';
        $data['title'] = "New permission";
        $data['js'] = [
            'menu/new_permission.js'
        ];

        $this->view('menu/add_permission', $data);
    }

    public function storePermission()
    {
        $permission['menu_id'] = $_POST['menu_id'];
        $permission['name'] = $_POST['permission_name'];
        $permission['description'] = $_POST['description_permission'];
        $permission['created_at'] = time();
        $permission['created_by'] = $_SESSION['userdata']['user_id'];

        echo json_encode($this->modelMenu->insertPermission($permission));
    }

    public function deletePermission()
    {
        $id_permission = $_POST['permission_id'];
        $user_id = $_SESSION['userdata']['user_id'];



        $callbackDelete = 0;

        $this->userPermission->deleteUserPermission($user_id, $id_permission);
        $callbackDelete = $this->modelPermission->deletePermission($id_permission);


        echo json_encode($callbackDelete);
    }
    public function update($menu_id)
    {
        $this->permission = 'update menu';
        $data['title'] = 'Update menu';
        $data['js'] = [
            'menu/update.js'
        ];

        $this->view('menu/update', $data);
    }

    public function storeUpdate()
    {
        $menu_id = $_POST['menu_id'];

        $dataMenu['parent_id'] = $_POST['menu'][0]['value'];
        $dataMenu['name'] = $_POST['menu'][1]['value'];
        $dataMenu['label'] = $_POST['menu'][2]['value'];
        $dataMenu['description'] = $_POST['menu'][4]['value'];
        $dataMenu['route'] = $_POST['menu'][3]['value'];
        $dataMenu['icon'] = $_POST['menu'][5]['value'];
        $dataMenu['created_at'] = time();
        $dataMenu['created_by'] = $_SESSION['userdata']['user_id'];

        echo json_encode($this->modelMenu->updateMenu($dataMenu, $menu_id));
    }
}