<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

    // public function __construct()
    // {
    //     parent::__construct();
    // }

	public function get(string $id, string $sender = null, string $receiver = null)
	{
        header("Access-Control-Allow-Origin: GET");

        if ($sender == null) {
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->messages_model->get((int)$id)));
        } else if ($sender !== null) {
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->messages_model->get((int)$id, $sender)));
        } else {
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->messages_model->get((int)$id, $sender, $receiver)));
        }
    }
    
    public function get_all(string $username, string $receiver = null)
    {
        header("Access-Control-Allow-Origin: GET");

        if ($receiver == null) {
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->messages_model->get_all($username)));
        } else {
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($this->messages_model->get_all($username, $receiver)));
        }
    }

    public function create()
    {
        header("Access-Control-Allow-Origin: POST");

        $record = array(
            "date" => date(DATE_RFC822),
            "time" => unix_to_human(time(), TRUE),
            "receiver" => $this->input->post("receiver", true),
            "message" => $this->input->post("message", true),
            "sender" => $this->input->post("sender", true),
            "read" => false
        );

        if (!$this->messages_model->create($record)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    "status" => "Error"
                )));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    "status" => "OK",
                )));
        };
    }

    public function update(int $id)
    {
        header("Access-Control-Allow-Origin: PUT");

        $data = array(
            "date" => $this->input->post("date"),
            "time" => $this->input->post("time"),
            "receiver" => $this->input->post("receiver"),
            "message" => $this->input->post("message"),
            "sender" => $this->input->post("sender")
        );

        $this->messages_model->update($id, $record);
    }

    public function delete(int $id)
    {
        header("Access-Control-Allow-Origin: DELETE");

        $this->messages_model->delete($id);
    }
}