<?php 

class M_payment 
{
    protected $db;
    var $column_search = ['p.name', 'p.created_at', 'u.name'];


    public function __construct()
    {
        $this->db = new Database;
    }

    public function getDataTable()
    {
        $query = "SELECT *,p.created_at as created_at,p.name as name,p.name as name, u.name as created_by FROM payment_bank p LEFT JOIN user u ON u.user_id = p.created_by ";

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



        $query = $query . "GROUP BY p.payment_id";

        $query = $query . ' ORDER BY p.payment_id ASC ';
        $this->db->query($query);
        if (strlen($_POST['search']['value']) > 0) {
            foreach ($this->column_search as $column) {
                $explode = explode('.', $column);
                $this->db->bind($explode[1], '%' . $_POST['search']['value'] . '%');
            }
        }
        return $this->db->resultSet();
    }

    public function count_filtered()
    {
        $this->db->query('SELECT * FROM payment_bank');
        return $this->db->num_rows();
    }

    public function getAllPayment()
    {
        $query = "SELECT * FROM payment_bank";

        $this->db->query($query);

        return $this->db->resultSet();
    }


    public function insert($data)
    {
        $query = "INSERT INTO payment_bank VALUES(null, :name, :created_at, :created_by)";

        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('created_at', $data['created_at']);
        $this->db->bind('created_by', $data['created_by']);


        return $this->db->insert_id();
    }

    public function paymentById($payment_id)
    {
        $query = "SELECT *,p.created_at as created_at,p.name as name,p.name as name, u.name as created_by FROM payment_bank p LEFT JOIN user u ON u.user_id = p.created_by WHERE p.payment_id = :payment_id";

        $this->db->query($query);
        $this->db->bind('payment_id', $payment_id);

        return $this->db->single();
    }

    public function delete($payment_id)
    {
        $query = "DELETE FROM payment_bank WHERE payment_id = :payment_id";
        $this->db->query($query);
        $this->db->bind('payment_id',$payment_id);

        return $this->db->num_rows();
    }

    public function ubah($data)
    {
        $query = "UPDATE payment_bank SET name = :name, created_at = :created_at, created_by = :created_by WHERE payment_id = :payment_id";

        $this->db->query($query);
        $this->db->bind('payment_id', $data['payment_id']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('created_at', $data['created_at']);
        $this->db->bind('created_by', $data['created_by']);

        return $this->db->num_rows();
    }

    public function searchPayment($keyword)
    {
        $name = "%$keyword%";
        $query = "SELECT * FROM payment_bank WHERE name LIKE :name";
        $this->db->query($query);
        $this->db->bind("name", $name);
        return $this->db->resultSet();
    }

    public function getPaymentByName($name)
    {
        $query = "SELECT * FROM payment_bank WHERE name = :name";
        $this->db->query($query);
        $this->db->bind("name", $name);
        return $this->db->single();
    }

}