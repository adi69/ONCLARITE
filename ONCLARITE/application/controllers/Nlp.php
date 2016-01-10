<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onclarite extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper("url");
        $this->load->helper("form");
        $this->load->library("form_validation");
        $this->load->library("RDF");
        $this->load->model("Onclarite_model", "model");
	}

	private $template = "includes/template";

	public function index() {

		$data["main_content"] = "requestservice";
		$this->load->view($this->template, $data);
	}

	public function result() {
		
		$this->form_validation->set_rules("what", "subject", "required");
		$this->form_validation->set_rules("where", "place", "required");

		if ($this->form_validation->run() === FALSE) {
			$data["main_content"] = "requestservice";
			$this->load->view($this->template, $data);
		}  
		else {
			$data = array(
				"what" => $this->input->post("what"),
				"where" => $this->input->post("where"),
				);

			$result = $this->model->get_action($data);

			if(sizeof($result) == 0) { $this->newreq(); }
			else { 
				$data["result"] = $result;
				$data["main_content"] = "result";
				$this->load->view($this->template, $data);
			}
		}
		//$this->output->enable_profiler(TRUE);
	}

	public function newreq() {
		$this->form_validation->set_rules("email", "E-Mail", "trim|required|valid_email");
		if ($this->form_validation->run() === FALSE) {
			$data["main_content"] = "newreq";
		}  
		else {
			$data = array(
				"email" => $this->input->post("email"),
				);
			//$result = $this->model->get_action($data);
			echo "<script>alert('Thank you. Please check your email.');</script>";
			$data["main_content"] = "requestservice";
		}
		$this->load->view($this->template, $data);
	}
}
