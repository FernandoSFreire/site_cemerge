<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model("hospital_model");
		$hospital = $this->hospital_model->show_hospital();

		$this->load->model("time_model");
		$time = $this->time_model->show_time();

		$this->load->model("comunicado_model");
		$comunicado = $this->comunicado_model->show_comunicado();

		$data = array(
			"scripts" => array(
				"owl.carousel.min.js",
				"theme-scripts.js"
			),
			"hospital" => $hospital,
			"time" => $time,
			"comunicado" => $comunicado
			
		);

		$this->template->show("home.php", $data);

	}
}
