<?php

class M_user_permission
{
    protected $db;
    public function __construct()
    {
        $this->db  = new Database;
    }

    public function deleteUserPermission($user_id, $permission_id)
    {
        $query = "DELETE FROM user_permission WHERE user_id = :user_id AND permission_id = :permission_id";

        $this->db->query($query);

        $this->db->bind('user_id', $user_id);
        $this->db->bind('permission_id', $permission_id);

        return $this->db->num_rows();
    }
}