<?php

class M_object
{

    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function searchObject($keyword)
    {
        $name = "%$keyword%";
        $query = "SELECT * FROM object WHERE name LIKE :name";
        $this->db->query($query);
        $this->db->bind("name", $name);
        return $this->db->resultSet();
    }

    public function getObjectByName($name)
    {
        $query = "SELECT * FROM object WHERE name = :name";
        $this->db->query($query);
        $this->db->bind("name", $name);
        return $this->db->single();
    }

    public function insert($data)
    {
        $query = "INSERT INTO object VALUES(null, :name, :created_at, :created_by)";

        $this->db->query($query);
        $this->db->bind('name',$data['name']);
        $this->db->bind('created_at',$data['created_at']);
        $this->db->bind('created_by',$data['created_by']);

        return $this->db->insert_id();

    }

    public function insert_object_tax($data)
    {
        $query = "INSERT INTO object_tax VALUES(null, :sppt_id, :object_id, :luas, :kelas, :njop_value, :total_njop)";

        $this->db->query($query);

        $this->db->bind("sppt_id", $data['sppt_id']);
        $this->db->bind("object_id", $data['object_id']);
        $this->db->bind("luas", $data['luas']);
        $this->db->bind("kelas", $data['kelas']);
        $this->db->bind("njop_value", $data['njop_value']);
        $this->db->bind("total_njop", $data['total_njop']);

        return $this->db->num_rows();
    }

    public function getObjectTaxBySpptId($sppt_id)
    {
        $query = "SELECT * FROM object_tax ot LEFT JOIN object o ON o.object_id = ot.object_id WHERE ot.sppt_id = :sppt_id GROUP BY ot.tax_id ORDER BY ot.tax_id ASC";

        $this->db->query($query);
        $this->db->bind('sppt_id', $sppt_id);

        return $this->db->resultSet();
    }


}