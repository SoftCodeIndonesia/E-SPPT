<?php


class Menu extends Controller
{
    protected $modelMenu;
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper;
        $this->modelMenu = $this->model('M_menu');
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
            $linkUbah = '<a href="#" class="text-success" id="btn-ubah" data-id="' . $value['menu_id'] . '">Ubah</a>';
            $linkDetail = '<a href="#" class="text-primary" id="btn-detail" data-id="' . $value['menu_id'] . '">Detail</a>';

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
        $menu = $_POST['menu'];
        $permission = $_POST['permission'];

        array_splice($menu, 5, 0, ['created_at' => time()]);
        array_splice($menu, 6, 0, ['created_by' => $_SESSION['userdata']['user_id']]);
        var_dump($menu);
        var_dump($permission);
    }
}