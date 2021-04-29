<?php
class M_login
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getByEmail($email)
    {
        $query = "SELECT *, r.name as rule, u.name as username FROM user u LEFT JOIN rule r ON r.rule_id = u.rule_id WHERE email = :email";

        $this->db->query($query);

        $this->db->bind('email', $email);

        return $this->db->single();
    }
}