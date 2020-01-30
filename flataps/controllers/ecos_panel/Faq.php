<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Faq extends CI_Controller
	{
	public
	function __construct()
		{
		parent::__construct();
		$this->auth->admin_restrict();
		$this->load->library(array('form_validation','pagination'));
		$this->load->model(array(admin_folder . 'faq_model','common_model'));
		}

	function index()
		{			
		$information_list = $this->faq_model->ajax_information_list();
		
		$data = array('information_list'=>$information_list);
		$this->load->view(admin_folder() . 'faq/view',$data);
		}
	
	function add($submit = NULL)
		{
		if ($submit != NULL)
			{
			$rules = array(
				
					array(
						'field' => 'faq_title',
						'label' => 'Faq Name',
						'rules' => 'trim|required'
					)
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run())
				{
				$this->faq_model->addInformation();
				$this->message_output->set_success('Faq has been added.', TRUE);
				redirect(admin_path() . 'faq');
				}
			  else $this->message_output->set_error($this->form_validation->output_errors());
			}
		$data = array('StatusList'=>$this->config->item('StatusList') );
		$this->load->view(admin_folder() . 'faq/add',$data);
		}

	function edit($information_id, $submit = NULL)
		{
		 if ($submit != NULL)
			{
			$rules = array(
				
					array(
						'field' => 'faq_title',
						'label' => 'Faq Name',
						'rules' => 'trim|required'
					)
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run())
				{
				$this->faq_model->editInformation($information_id);
				$this->message_output->set_success('Faq  has been updated.', TRUE);
				redirect(admin_path() . 'faq');
				}
			  else $this->message_output->set_error($this->form_validation->output_errors());
			}
		 $data = array('PageInfo'=>$this->faq_model->getInformation($information_id),
					   'information_id'=>$information_id);
		 $this->load->view(admin_folder() . 'faq/edit',$data);
		
		}
	
   function delete($info_id)
		{
			if ($info_id)
			{
			$this->faq_model->deleteInformation($info_id);	
			$this->message_output->set_success('Faq has been deleted.', TRUE);			
			redirect(admin_path() . 'faq');
			}
		  else
			{
			redirect(admin_path() . 'faq');
			}
		}

	}