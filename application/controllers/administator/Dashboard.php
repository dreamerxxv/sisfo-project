<?php

class Dashboard extends CI_Controller{
    public function index()
	{
		$this->load->view('templates_administator/header');
		$this->load->view('templates_administator/sidebar');
		$this->load->view('templates_administator/footer');
	}
}
?>