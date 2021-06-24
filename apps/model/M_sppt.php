<?php

class M_sppt
{

    protected $db;
    var $column_search = ['o.name', 'p.name', 's.nop', 's.due_date', 'u.name', 's.created_at'];

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDataTable()
    {
        $query = "SELECT *,s.created_at as created_at,s.sppt_id as unique_id,o.name as owner, p.name as payment, u.name as created_by FROM sppt s LEFT JOIN owner o ON o.owner_id = s.owner_id LEFT JOIN payment_bank p ON p.payment_id = s.payment_id LEFT JOIN user u ON u.user_id = s.created_by ";
        
        if (strlen($_POST['search']['value']) > 0) {
            $query = $query . 'WHERE ';
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



        $query = $query . "GROUP BY s.sppt_id";

        $query = $query . ' ORDER BY s.sppt_id ASC ';
        // var_dump($query);
        $this->db->query($query);
        if (strlen($_POST['search']['value']) > 0) {
            foreach ($this->column_search as $column) {
                $explode = explode('.', $column);
                $this->db->bind($explode[1], '%' . $_POST['search']['value'] . '%');
            }
        }
        // var_dump($query);
        return $this->db->resultSet();
    }

    public function count_filtered()
    {
        $this->db->query('SELECT * FROM sppt');
        return $this->db->num_rows();
    }

    public function insert($data)
    {
        
        $query = "INSERT INTO sppt VALUES(:sppt_id, :owner_id, :payment_id, :nop, :pbb_terhutang, :due_date, :created_at, :created_by, :lat, :lng)";
        
        $this->db->query($query);

        $this->db->bind("sppt_id", $data['unique_id']);
        $this->db->bind('owner_id', $data['owner_id']);
        $this->db->bind('payment_id', $data['payment_id']);
        $this->db->bind('nop', $data['nop']);
        $this->db->bind('pbb_terhutang', $data['pbb_terhutang']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('created_at', $data['created_at']);
        $this->db->bind('created_by', $data['created_by']);
        $this->db->bind('lat', $data['lat']);
        $this->db->bind('lng', $data['lng']);

        
        return $this->db->num_rows();
    }

    public function getSpptById($id)
    {
        $query = "SELECT *,s.created_at as created_at,s.sppt_id as unique_id,o.name as owner, p.name as payment, u.name as created_by FROM sppt s LEFT JOIN owner o ON o.owner_id = s.owner_id LEFT JOIN payment_bank p ON p.payment_id = s.payment_id LEFT JOIN user u ON u.user_id = s.created_by WHERE s.sppt_id = :sppt_id";

        $this->db->query($query);

        $this->db->bind('sppt_id', $id);

        return $this->db->single();
    }

    public function updateSppt($data, $sppt_id)
    {
        $query = "UPDATE sppt SET owner_id = :owner_id, payment_id = :payment_id, nop = :nop, pbb_terhutang = :pbb_terhutang, due_date = :due_date, created_at = :created_at, created_by = :created_by, lat = :lat, lng = :lng WHERE sppt_id = :sppt_id";
        
        $this->db->query($query);

        $this->db->bind("sppt_id", $sppt_id);
        $this->db->bind('owner_id', $data['owner_id']);
        $this->db->bind('payment_id', $data['payment_id']);
        $this->db->bind('nop', $data['nop']);
        $this->db->bind('pbb_terhutang', $data['pbb_terhutang']);
        $this->db->bind('due_date', $data['due_date']);
        $this->db->bind('created_at', $data['created_at']);
        $this->db->bind('created_by', $data['created_by']);
        $this->db->bind('lat', $data['lat']);
        $this->db->bind('lng', $data['lng']);

        
        return $this->db->num_rows();
    }

    public function deleteById($sppt_id)
    {
        $query = "DELETE FROM sppt WHERE sppt_id = :sppt_id";
        $this->db->query($query);
        $this->db->bind('sppt_id',$sppt_id);

        return $this->db->num_rows();

    }

}