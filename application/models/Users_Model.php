<?php

class Users_Model extends CI_Model {

    public function create(array $data): bool
    {
        return $this->db->insert("users", $data);
    }

}