<?php

class Messages_model extends CI_Model {

    public function create(array $fields): bool
    {
        $this->db->trans_start();
        $this->db->insert("messages", $fields);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get(int $id, string $sender = null, string $receiver = null): array
    {
        if ($sender == null) {
            $this->db->get_where("messages", array(
                "id" => $id,
                "sender" => $sender
            ))->row_array();
        } else if ($reciever !== null) {
            $this->db->get_where("messages", array(
                "id" => $id,
                "sender" => $sender,
                "receiver" => $receiver
            ))->row_array();
        } else {
            $this->db->get_where("messages", array(
                "id" => $id
            ))->row_array();
        }
    }

    public function get_all(string $sender, string $receiver = null): array
    {
        if ($receiver == null) {
            return $this->db->get_where("messages", array(
                "sender" => $sender
            ))->result_array();
        } else {
            $this->db->from('messages');
            $where = "(sender='" . $sender . "' AND receiver='" . $receiver . "') OR (sender='" . $receiver . "' AND receiver='" . $sender . "')";
            $this->db->where($where);
            return $this->db->get()->result_array();
        }
        // if ($receiver == null) {
        //     return $this->db->get_where("messages", array(
        //         "sender" => $sender
        //     ))->result_array();
        // } else {
        //     return $this->db->get_where("messages", array(
        //         "sender" => $sender,
        //         "receiver" => $receiver
        //     ))->result_array();
        // }
    }

    public function update(int $id, array $fields): bool
    {
        $this->db->trans_start();
        $this->db->where("id", $id);
        $this->db->update("messages", $fields);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete(int $id): bool
    {
        $this->db->trans_start();
        $this->db->delete("messages", array(
            "id" => $id
        ));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}