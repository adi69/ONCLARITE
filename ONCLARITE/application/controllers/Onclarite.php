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
			$rawdata = array(
				"what" => $this->input->post("what"),
				"where" => $this->input->post("where"),
				);

			require APPPATH."\controllers\lists.php";
			$data["what"] = $this->nlp ($rawdata["what"], $listwhat);
			$data["where"] = $this->nlp ($rawdata["where"], $listwhere);

			echo "<font color = 'grey'>";
			print_r($data);
			echo "</font><br>";
			$result = $this->model->get_action($data);
			if(sizeof($result) == 0) { $this->newreq(); }
			else { 
				//$this->send_mail("iit2012107@iiita.ac.in", $rawdata, $data);
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


	public function nlp($data, $lists) {

		$s = $data;
		$s = strtolower($s);
		$q = explode(" ", $s);
		$what = "";
		$flag = false;
		foreach($lists as $head => $list)  {
			foreach($list as $term) {
				if(strstr($s, $term) != false) { 
					$what = $head; 
					$flag = true; 
					break; 
				}
				if($flag == true) break;
			}
			if($flag == true) break;
		}

		$data = $what;
		return $data;
	}

	public function send_mail ($to, $rawdata, $data) {
		@$this->load->library('email');

		@$this->email->from('zxcadi@gmail.com', 'IIIT-A 311');
		@$this->email->to($to);
		@$this->email->cc('iit2012108@iiita.ac.in');

		@$this->email->subject("Request regarding ".$data['what']." at ".$data['where']);
		$msg = "Kindly look into the following matter:    ";
		$msg .= "Report: ".$rawdata['what']." at location ".$rawdata['where'];
		$msg .= '   ~IIIT-A 311';
		@$this->email->message($msg);

		@$this->email->send();
	}
}
