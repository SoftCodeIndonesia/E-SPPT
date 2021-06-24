<?php

class M_object
{

    protected $db;
    var $column_search = ['o.name', 'ot.luas', 'ot.kelas', 'ot.njop_value', 'ot.total_njop'];
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
        $query = "SELECT * FROM object_tax ot LEFT JOIN object o ON o.object_id = ot.object_id WHERE ot.sppt_id = :sppt_id ";

        if (strlen($_POST['search']['value']) > 0) {
            $query = $query . 'AND ';
            foreach ($this->column_search as $key => $column) {
                $explode = explode('.', $column);
                if ($key + 1 == count($this->column_search) - 1) {
                    $query = $query . " from_unixtime(" . $column . ",'%d %M %Y') LIKE CONCAT(:" . $explode[1] . ") OR ";
                } else {
                    if ($key + 1 == count($this->column_search)) {
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ") ";
                    } else {
                        $query = $query . $column . " LIKE CONCAT(:" . $explode[1] . ") OR ";
                    }
                }
            }
        }



        $query = $query . "GROUP BY ot.tax_id";

        $query = $query . ' ORDER BY ot.tax_id ASC';

     
        $this->db->query($query);
        if (strlen($_POST['search']['value']) > 0) {
            foreach ($this->column_search as $column) {
                $explode = explode('.', $column);
                $this->db->bind($explode[1], '%' . $_POST['search']['value'] . '%');
            }
        }
        $this->db->bind('sppt_id', $sppt_id);

        return $this->db->resultSet();
    }

    public function delete_tax($tax_id)
    {
        $query = "DELETE FROM object_tax WHERE tax_id = :tax_id";

        $this->db->query($query);
        $this->db->bind('tax_id',$tax_id);

        return $this->db->num_rows();
    }

    public function update_object_tax($object, $tax_id)
    {

        $query = 'UPDATE object_tax SET object_id = :object_id, luas = :luas, kelas = :kelas, njop_value = :njop_value, total_njop = :total_njop WHERE tax_id = :tax_id';
        $this->db->query($query);
        
        $this->db->bind("tax_id", $tax_id);
        $this->db->bind("object_id", $object['object_id']);
        $this->db->bind("luas", $object['luas']);
        $this->db->bind("kelas", $object['kelas']);
        $this->db->bind("njop_value", $object['njop_value']);
        $this->db->bind("total_njop", $object['total_njop']);

        return $this->db->num_rows();
    }


    public function deleteBySpptId($sppt_id)
    {
        $query = "DELETE FROM object_tax WHERE sppt_id = :sppt_id";
        $this->db->query($query);
        $this->db->bind('sppt_id',$sppt_id);

        return $this->db->num_rows();

    }


}