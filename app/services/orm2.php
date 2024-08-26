<?php

class Orm {
    protected $id;
    protected $table;
    protected $db;

    public function __construct($id, $table, mysqli $conn) {
        $this->id = $id;
        $this->table = $table;
        $this->db = $conn;
    }

    // CREATE
    public function insert($data) {
    }

    // READ
    public function getAll($select = "*", $inner_join = "", $custom_query = "") {
    }
    
    public function getById($id, $select = "*", $inner_join = "", $custom_query = "") {
    }

    // UPDATE    
    public function updateById($id, $data, $inner_join = "") {
    }

    // DELETE
    public function deleteById($id) {
    }

    // PAGINATE
    public function paginate($page, $limit, $select = "*", $inner_join = "", $customQueryRows = "", $customQuery = "" ) {
    }

}