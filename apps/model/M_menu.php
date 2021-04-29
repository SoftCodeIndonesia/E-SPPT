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

            $query = "SELECT *,m.name as menu, m.created_at as created_at, u.name as created_by FROM user_permission up LEFT JOIN user u ON u.user_id = up.user_id LEFT JOIN permission p ON p.permission_id = up.permission_id LEFT JOIN user us ON us.user_id = up.created_by LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE up.user_id = :user_id AND m.parent_id = " . $parent . " GROUP BY m.menu_id";
        } else {
            $query = "SELECT *,m.name as menu, m.created_at as created_at, u.name as created_by FROM user_permission up LEFT JOIN user u ON u.user_id = up.user_id LEFT JOIN permission p ON p.permission_id = up.permission_id LEFT JOIN user us ON us.user_id = up.created_by LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE up.user_id = :user_id GROUP BY m.menu_id";
        }



        $this->db->query($query);
        $this->db->bind('user_id', $_SESSION['userdata']['user_id']);
        return $this->db->resultSet();
    }

    public function getSubMenuByUser()
    {
        $query = "SELECT * FROM user_permission up LEFT JOIN user u ON u.user_id = up.user_id LEFT JOIN permission p ON p.permission_id = up.permission_id LEFT JOIN user us ON us.user_id = up.created_by LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE up.user_id = :user_id AND m.parent_id > 0 GROUP BY m.menu_id";

        $this->db->query($query);
        $this->db->bind('user_id', $_SESSION['userdata']['user_id']);

        return $this->db->resultSet();
    }

    public function getMenuDataTable()
    {
        $query = "SELECT *,m.menu_id as menu_id,m.name as menu, m.created_at as created_at, u.name as created_by FROM user_permission up LEFT JOIN user u ON u.user_id = up.user_id LEFT JOIN permission p ON p.permission_id = up.permission_id LEFT JOIN user us ON us.user_id = up.created_by LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE up.user_id = :user_id ";

        if (strlen($_POST['search']['value']) > 0) {
            $query = $query . " AND ";
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
        $query = "SELECT *,p.name as permission_name FROM user_permission up LEFT JOIN permission p ON up.permission_id = p.permission_id LEFT JOIN menu m ON m.menu_id = p.menu_id WHERE m.name = :menu AND p.name = :permission_name AND up.user_id = :user_id";

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

        return $this->db->num_rows();
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
}