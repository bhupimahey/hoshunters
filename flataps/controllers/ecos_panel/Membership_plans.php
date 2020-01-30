<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Membership_plans extends CI_Controller
	{
	public
	function __construct()
		{
		parent::__construct();
		$this->auth->admin_restrict();
		$this->load->library(array('form_validation','pagination'));
		$this->load->model(array(admin_folder . 'membership_model','common_model'));
		}

	function index()
		{			
		$plans_list = $this->membership_model->ajax_plans_list();
		
		$data = array('plans_list'=>$plans_list);
		$this->load->view(admin_folder() . 'membership_plans/view',$data);
		}
	
	function add($submit = NULL)
		{
		if ($submit != NULL)
			{
			$rules = array(
				
					array(
						'field' => 'plan_name',
						'label' => 'Plan Title',
						'rules' => 'trim|required|max_length[150]'
					),
					array(
						'field' => 'plan_cost',
						'label' => 'Plan Cost',
						'rules' => 'trim|required'
					)
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run())
				{
				$this->membership_model->addPlanInformation();
				$this->message_output->set_success('Plan information has been added.', TRUE);
				redirect(admin_path() . 'membership_plans');
				}
			  else $this->message_output->set_error($this->form_validation->output_errors());
			}
		$data = array('planvaliditylist'=>$this->config->item('planvaliditylist'),
		              'StatusList'=>$this->config->item('StatusList'),
		              'packages_roles'=>$this->config->item('packages_roles') );
		$this->load->view(admin_folder() . 'membership_plans/add',$data);
		}

	function edit($plan_id, $submit = NULL)
		{
		 if ($submit != NULL)
			{
			$rules = array(
				
					array(
						'field' => 'plan_name',
						'label' => 'Plan Title',
						'rules' => 'trim|required|max_length[150]'
					),
					array(
						'field' => 'plan_cost',
						'label' => 'Plan Cost',
						'rules' => 'trim|required'
					)
			);
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run())
				{
				$this->membership_model->editPlanInformation($plan_id);
				$this->message_output->set_success('Plan information  has been updated.', TRUE);
				redirect(admin_path() . 'membership_plans');
				}
			  else $this->message_output->set_error($this->form_validation->output_errors());
			}
		 $data = array('StatusList'=>$this->config->item('StatusList'),		
                       'planvaliditylist'=>$this->config->item('planvaliditylist'),		 
					   'PlanInfo'=>$this->membership_model->getPlanInformation($plan_id),
					   'packages_roles'=>$this->config->item('packages_roles'),
					   'plan_id'=>$plan_id);
		 $this->load->view(admin_folder() . 'membership_plans/edit',$data);
		
		}
	
   function delete($plan_id)
		{
			if ($plan_id)
			{
			$this->membership_model->deletePlanInformation($plan_id);	
			$this->message_output->set_success('Plab information has been deleted.', TRUE);			
			redirect(admin_path() . 'membership_plans');
			}
		  else
			{
			redirect(admin_path() . 'membership_plans');
			}
		}

	}