<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Information extends CI_Controller
	{
	public
	function __construct()
		{
		parent::__construct();
		$this->auth->admin_restrict();
		$this->load->library(array('form_validation','pagination'));
		$this->load->model(array(admin_folder . 'information_model','common_model'));
		}

	function index()
		{			
		$information_list = $this->information_model->ajax_information_list();
		
		$data = array('information_list'=>$information_list);
		$this->load->view(admin_folder() . 'informations/view',$data);
		}
	
	function add($submit = NULL)
		{
		if ($submit != NULL)
			{
			$rules = array(
				
					array(
						'field' => 'information_name',
						'label' => 'Information Name',
						'rules' => 'trim|required'
					)
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run())
				{
				$this->information_model->addInformation();
				$this->message_output->set_success('Information has been added.', TRUE);
				redirect(admin_path() . 'information');
				}
			  else $this->message_output->set_error($this->form_validation->output_errors());
			}
		$data = array('StatusList'=>$this->config->item('StatusList') );
		$this->load->view(admin_folder() . 'informations/add',$data);
		}

	function edit($information_id, $submit = NULL)
		{
		 if ($submit != NULL)
			{
			$rules = array(
				
					array(
						'field' => 'information_name',
						'label' => 'Information Name',
						'rules' => 'trim|required'
					)
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run())
				{
				$this->information_model->editInformation($information_id);
				$this->message_output->set_success('Information  has been updated.', TRUE);
				redirect(admin_path() . 'information');
				}
			  else $this->message_output->set_error($this->form_validation->output_errors());
			}
		 $data = array('StatusList'=>$this->config->item('StatusList'),		            
					   'PageInfo'=>$this->information_model->getInformation($information_id),
					   'information_id'=>$information_id);
		 $this->load->view(admin_folder() . 'informations/edit',$data);
		
		}
	
   function delete($info_id)
		{
			if ($info_id)
			{
			$this->information_model->deleteInformation($info_id);	
			$this->message_output->set_success('Information has been deleted.', TRUE);			
			redirect(admin_path() . 'information');
			}
		  else
			{
			redirect(admin_path() . 'information');
			}
		}

	}