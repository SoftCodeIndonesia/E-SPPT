<?php

    class M_owner 
    {
        protected $db;
        var $column_search = ['o.name', 'a.address', 'o.created_at', 'u.name'];
        public function __construct()
        {
            $this->db = new Database;
        }

        public function insertAddress($data)
        {
            $query = "INSERT INTO address VALUES(null, :district_id, :village_id, :rt, :rw, :address, :created_at, :created_by)";

            $this->db->query($query);
            $this->db->bind("district_id", $data['district_id']);
            $this->db->bind("village_id", $data['village_id']);
            $this->db->bind("rt", $data['rt']);
            $this->db->bind("rw", $data['rw']);
            $this->db->bind("address", $data['address']);
            $this->db->bind("created_at", $data['created_at']);
            $this->db->bind("created_by", $data['created_by']);
            return $this->db->insert_id();
        }

        public function getAllOwner()
        {
            $query = "SELECT *,o.created_at as created_at,o.name as name,u.name as created_by,a.address as address FROM owner o LEFT JOIN address a ON o.address_id = a.address_id LEFT JOIN user u ON u.user_id = o.created_by GROUP BY o.owner_id ORDER BY o.owner_id ASC";

            $this->db->query($query);
            return $this->db->resultSet();
        }
        public function insertOwner($data)
        {
            $query = "INSERT INTO owner VALUES(null, :address_id, :name, :created_at, :created_by)";

            $this->db->query($query);
            $this->db->bind("address_id", $data['address_id']);
            $this->db->bind("name", $data['name']);
            $this->db->bind("created_at", $data['created_at']);
            $this->db->bind("created_by", $data['created_by']);

            return $this->db->insert_id();
        }

        public function getDataTable()
        {
            $query = "SELECT *,o.created_at as created_at,o.name as name,u.name as created_by,a.address as address FROM owner o LEFT JOIN address a ON o.address_id = a.address_id LEFT JOIN user u ON u.user_id = o.created_by ";

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



            $query = $query . "GROUP BY o.owner_id";

            $query = $query . ' ORDER BY o.owner_id ASC ';

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
            $this->db->query('SELECT * FROM owner');
            return $this->db->num_rows();
        }

        public function getOwner($owner_id)
        {
            $query = "SELECT * FROM owner o LEFT JOIN address a ON o.address_id = a.address_id WHERE o.owner_id = :owner_id";

            $this->db->query($query);
            $this->db->bind("owner_id",$owner_id);

            return $this->db->single();
        }

        public function deleteOwner($owner_id)
        {
            $callback = 0;
            $owner = $this->getOwner($owner_id);

            if($this->deleteAddress($owner['address_id']) > 0){
                $query = "DELETE FROM owner WHERE owner_id = :owner_id";
                $this->db->query($query);
                $this->db->bind('owner_id',$owner_id);

                $callback = $this->db->num_rows();
            }

            return $callback;

            
        }

        public function deleteAddress($address_id)
        {
            $query = "DELETE FROM address WHERE address_id = :address_id";

            $this->db->query($query);
            $this->db->bind('address_id',$address_id);

            return $this->db->num_rows();
        }

        public function updateAddress($data)
        {
            $query = "UPDATE address SET district_id = :district_id, village_id = :village_id, rt = :rt, rw = :rw, address = :address, created_at = :created_at, created_by = :created_by WHERE address_id = :address_id";

            $this->db->query($query);
            $this->db->bind('address_id', $data['address_id']);
            $this->db->bind("district_id", $data['district_id']);
            $this->db->bind("village_id", $data['village_id']);
            $this->db->bind("rt", $data['rt']);
            $this->db->bind("rw", $data['rw']);
            $this->db->bind("address", $data['address']);
            $this->db->bind("created_at", $data['created_at']);
            $this->db->bind("created_by", $data['created_by']);
            return $this->db->num_rows();
        }

        public function updateOwner($data)
        {
            $query = "UPDATE owner SET address_id = :address_id, name = :name, created_at = :created_at, created_by = :created_by WHERE owner_id = :owner_id";

            $this->db->query($query);
            $this->db->bind("owner_id", $data['owner_id']);
            $this->db->bind("address_id", $data['address_id']);
            $this->db->bind("name", $data['name']);
            $this->db->bind("created_at", $data['created_at']);
            $this->db->bind("created_by", $data['created_by']);

            return $this->db->num_rows();
        }

        public function getAddressById($address_id)
        {
            $query = "SELECT * FROM address where address_id = :address_id";
            $this->db->query($query);
            $this->db->bind("address_id",$address_id);
            return $this->db->single();
        }
    }