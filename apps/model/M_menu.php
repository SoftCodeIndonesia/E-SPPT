<?php

class M_menu
{

    protected $db;
    var $column_search = ['m.name', 'm.label', 'm.route', 'm.created_at', 'u.name'];

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getMenuByUser($parent = null)
    {

        if ($parent !== null && $parent == 0) {

            $query = "SELECT *,m.name as menu, m.created_at as created_at, u.name as created_by FROM user_permission up LEFT JOIN user u ON u.user_id = up.user_id LEFT JOIN permission p ON p.permission_id = up.permission_id LEFT JOIN user us ON us.user_id = up.created_by LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE up.user_id = :user_id AND m.parent_id = " . $parent . " GROUP BY m.menu_id ORDER BY m.menu_id ASC";
        } else {
            $query = "SELECT *,m.name as menu, m.created_at as created_at, u.name as created_by FROM user_permission up LEFT JOIN user u ON u.user_id = up.user_id LEFT JOIN permis sion p ON p.permission_id = up.permission_id LEFT JOIN user us ON us.user_id = up.created_by LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE up.user_id = :user_id GROUP BY m.menu_id ORDER BY m.menu_id ASC";
        }



        $this->db->query($query);
        $this->db->bind('user_id', $_SESSION['userdata']['user_id']);
        return $this->db->resultSet();
    }

    public function getMenuByRoute($route)
    {
 
        
        $query = "SELECT * FROM menu WHERE route = :route";

        $this->db->query($query);
        $this->db->bind('route',$route);

        return $this->db->single();
    }

    public function getSubMenuByUser()
    {
        $query = "SELECT *,m.menu_id as menu_id,m.name as menu, m.created_at as created_at, u.name as created_by FROM user_permission up LEFT JOIN user u ON u.user_id = up.user_id LEFT JOIN permission p ON p.permission_id = up.permission_id LEFT JOIN user us ON us.user_id = up.created_by LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE up.user_id = :user_id AND m.parent_id > 0 GROUP BY m.menu_id";

        $this->db->query($query);
        $this->db->bind('user_id', $_SESSION['userdata']['user_id']);

        return $this->db->resultSet();
    }

    public function getMenuDataTable()
    {
        $query = "SELECT *,m.menu_id as menu_id,m.name as menu, m.created_at as created_at, u.name as created_by FROM menu m LEFT JOIN user u ON u.user_id = m.created_by LEFT JOIN permission p ON p.permission_id = m.menu_id ";

        if (strlen($_POST['search']['value']) > 0) {
            $query = $query . 'WHERE ';
            foreach ($this->column_search as $key => $column) {
                $explode = explode('.', $column);
                if ($key + 1 == count($this->column_search) - 1) {
                    $query = $query . " from_unixtime(" . $column . ",'%d %M %Y') LIKE CONCAT(:" . $explode[1] . ") OR ";
                } else {
                    if ($key + 1 == count($this->column_search)) {
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ")";
                    } else {
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ") OR ";
                    }
                }
            }
        }



        $query = $query . "GROUP BY m.menu_id";

        $query = $query . ' ORDER BY m.menu_id ASC ';

        $this->db->query($query);
        if (strlen($_POST['search']['value']) > 0) {
            foreach ($this->column_search as $column) {
                $explode = explode('.', $column);
                $this->db->bind($explode[1], '%' . $_POST['search']['value'] . '%');
            }
        }
        $this->db->bind('user_id', $_SESSION['userdata']['user_id']);

        return $this->db->resultSet();
    }

    public function count_filtered()
    {
        $this->db->query('SELECT * FROM menu');
        return $this->db->num_rows();
    }

    public function delete($menu_id)
    {
        $permission_id = $this->getPermissionByMenuId($menu_id);

        $this->deleteUserPermissionByPermission($permission_id);

        $this->deletePermission($menu_id);

        $query = "DELETE FROM menu WHERE menu_id = :menu_id";

        $this->db->query($query);
        $this->db->bind('menu_id', $menu_id);

        return $this->db->num_rows();
    }

    public function deletePermission($menu_id)
    {


        $query = "DELETE FROM permission WHERE menu_id = :menu_id";

        $this->db->query($query);
        $this->db->bind('menu_id', $menu_id);

        return $this->db->num_rows();
    }

    public function getPermissionByMenuId($menu_id)
    {
        $query = "SELECT * FROM permission WHERE menu_id = :menu_id";

        $this->db->query($query);
        $this->db->bind('menu_id', $menu_id);

        return $this->db->resultSet();
    }

    public function deleteUserPermissionByPermission($userPermission)
    {
        foreach ($userPermission as $key => $value) {
            $query = "DELETE FROM user_permission WHERE permission_id = :permission_id";

            $this->db->query($query);
            $this->db->bind('permission_id', $value['permission_id']);

            return $this->db->num_rows();
        }
    }


    public function checkPermission($menu, $permission_name)
    {
        $query = "SELECT *,p.name as permission_name FROM user_permission up LEFT JOIN permission p ON up.permission_id = p.permission_id LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE m.route = :menu AND p.name = :permission_name AND up.user_id = :user_id";

        $this->db->query($query);
        $this->db->bind('user_id', $_SESSION['userdata']['user_id']);
        $this->db->bind('menu', $menu);
        $this->db->bind("permission_name", $permission_name);

        return $this->db->single();
    }


    public function insertMenu($data)
    {
        $query = "INSERT INTO menu VALUES(null, :parent_id, :name, :label, :description, :route, :icon, :created_at, :created_by)";

        $this->db->query($query);
        $this->db->bind('parent_id', $data['parent_id']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('label', $data['label']);
        $this->db->bind('description', $data['description']);
        $this->db->bind('route', $data['route']);
        $this->db->bind('icon', $data['icon']);
        $this->db->bind('created_at', $data['created_at']);
        $this->db->bind('created_by', $data['created_by']);

        return $this->db->insert_id();
    }

    public function insertPermission($permission)
    {
        $query = "INSERT INTO permission VALUES(null, :menu_id, :name, :description, :created_at, :created_by)";

        $this->db->query($query);
        $this->db->bind('menu_id', $permission['menu_id']);
        $this->db->bind('name', $permission['name']);
        $this->db->bind('description', $permission['description']);
        $this->db->bind('created_at', $permission['created_at']);
        $this->db->bind('created_by', $permission['created_by']);

        return $this->db->num_rows();
    }

    public function getMenuById($idMenu)
    {
        $query = "SELECT *,m.label as label, m.route as route, m.description as description,m.icon as icon,men.name as parent, m.name as name, u.name as user,m.parent_id as parent_id FROM menu m LEFT JOIN user u ON u.user_id = m.created_by LEFT JOIN menu men ON men.menu_id = m.parent_id WHERE m.menu_id = :menu_id";

        $this->db->query($query);

        $this->db->bind('menu_id', $idMenu);
        return $this->db->single();
    }

    public function getPermissionByMenuIdAndUserId($menu_id)
    {
        $query = "SELECT *,IF(up.user_id = :user_id, 1, 0) as checked, p.permission_id as permission_id FROM permission p LEFT JOIN user_permission up ON up.permission_id = p.permission_id WHERE p.menu_id = :menu_id GROUP BY p.permission_id";

        $this->db->query($query);

        $this->db->bind('user_id', $_SESSION['userdata']['user_id']);
        $this->db->bind('menu_id', $menu_id);

        return $this->db->resultSet();
    }

    public function getUserPermission($user_id, $permission_id)
    {
        $query = "SELECT * FROM user_permission up WHERE up.user_id = :user_id AND up.permission_id = :permission_id";

        $this->db->query($query);
        $this->db->bind("user_id", $user_id);
        $this->db->bind("permission_id", $permission_id);

        return $this->db->num_rows();
    }

    public function createUserPermission($permission)
    {
        $query = "INSERT INTO user_permission VALUES(null, :user_id, :permission_id, :created_at, :created_by)";

        $this->db->query($query);

        $this->db->bind('user_id', $permission['user_id']);
        $this->db->bind('permission_id', $permission['permission_id']);
        $this->db->bind('created_at', $permission['created_at']);
        $this->db->bind('created_by', $permission['created_by']);

        return $this->db->num_rows();
    }

    public function deleteUserPermission($user_id, $permission_id)
    {
        $query = "DELETE FROM user_permission WHERE user_id = :user_id AND permission_id = :permission_id";

        $this->db->query($query);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('permission_id', $permission_id);

        return $this->db->num_rows();
    }

    public function updateMenu($dataMenu, $menu_id)
    {
        $query = "UPDATE menu SET parent_id = :parent_id, name = :name, label = :label, description = :description, route = :route, icon = :icon, created_at = :created_at, created_by = :created_by WHERE menu_id = :menu_id";

        $this->db->query($query);
        $this->db->bind('menu_id', $menu_id);
        $this->db->bind('parent_id', $dataMenu['parent_id']);
        $this->db->bind('name', $dataMenu['name']);
        $this->db->bind('label', $dataMenu['label']);
        $this->db->bind('description', $dataMenu['description']);
        $this->db->bind('route', $dataMenu['route']);
        $this->db->bind('icon', $dataMenu['icon']);
        $this->db->bind('created_at', $dataMenu['created_at']);
        $this->db->bind('created_by', $dataMenu['created_by']);

        return $this->db->num_rows();
    }
}