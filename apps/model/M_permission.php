<?php

class M_permission
{
    protected $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function deletePermission($id_permission)
    {
        $query = "DELETE FROM permission WHERE permission_id = :permission_id";

        $this->db->query($query);

        $this->db->bind('permission_id', $id_permission);

        return $this->db->num_rows();
    }
}