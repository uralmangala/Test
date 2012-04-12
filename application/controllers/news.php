<?php
class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}

	public function index()
	{
		$data['news'] = $this->news_model->get_news();
	}

	public function view()
	{
		$data['news'] = $this->news_model->get_news();
	$data['title'] = 'News archive';

	$this->load->view('templates/header', $data);
	$this->load->view('news/index', $data);
	$this->load->view('templates/footer');
		
	}
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Create a news item';
		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'text', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);	
			$this->load->view('news/create');
			$this->load->view('templates/footer');
			
		}
		else
		{
			$this->news_model->set_news();
			$this->load->view('news/success');
		}
	}
	
}