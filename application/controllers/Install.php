<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {

    private function create_test_user(array $data)
    {
        $this->users_model->create($data);
    }

    public function index()
    {
        // $record = array(
        //     "role" => $this->input->post("role", true),
        //     "username" => $this->input->post("username", true),
        //     "password" => $this->input->post("password", true),
        //     "name" => $this->input->post("name", true),
        //     "address" => $this->input->post("address", true),
        //     "register_date" => date('%Y-%m-%d'),
        //     "register_time" => time(),
        //     "mobile" => $this->input->post("mobile", true),
        //     "email" => $this->input->post("email", true),
        //     "about" => $this->input->post("about", true),
        //     "photo" => $this->input->post("photo", true)
        // );

        $record = array(
            "role" => "Developer",
            "username" => "edrayel",
            "password" => "edrayel",
            "name" => json_encode(array(
                "fname" => "Edward",
                "mname" => "",
                "lname" => "Rajah"
            )),
            "address" => json_encode(array(
                "street" => "Some unfamiliar street",
                "city" => "Some city",
                "state" => "Some state",
                "country" => "Some country"
            )),
            "register_date" => date(DATE_RFC822),
            "register_time" => unix_to_human(time(), TRUE),
            "mobile" => json_encode(array(
                1 => "2349067787204",
                2 => "2349067606998"
            )),
            "email" => json_encode(array(
                1 => "edward@logicaladdress.com"
            )),
            "about" => json_encode(array("")),
            "photo" => ""
        );

        if (!$this->create_test_user($record)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    "status" => "OK"
                )));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    "status" => "Error",
                )));
        }
    }
}