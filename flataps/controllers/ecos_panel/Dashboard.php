<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->auth->admin_restrict();
        $this->load->library('form_validation');
        $this->load->model('common_model');
    }
    function index() {
        $data = array('total_listing'=>$this->common_model->total_listing(),
					  'total_users'=>$this->common_model->total_users(),
					  'total_pages'=>$this->common_model->total_pages(),
					  'total_messages'=>$this->common_model->total_messages(),
					  'latest_messages'=>$this->common_model->admin_latest_messages(),
					  'latest_listing'=>$this->common_model->admin_latest_listings());
        $this->load->view(admin_folder() . 'dashboard', $data);
    }
    function logout() {
        $this->auth->admin_logout('admin');
        $this->message_output->set_success('You are now logged out from admin panel.', TRUE);
        redirect(admin_path());
    }
    function change_password($submit = NULL) {
        if ($submit != NULL) {
			
            $rules = array(array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'trim|required'), 
			         array('field' => 'confirm_password', 'label' => 'Confirm Password', 'rules' => 'trim|required|matches[new_password]'));
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) {
                $change_password = $this->common_model->change_password($this->session->userdata('s_admin_id'), 'admin');
                $this->message_output->set_success('Password has been changed.', TRUE);
                redirect(admin_path() . 'change_password');
            } else $this->message_output->set_error($this->form_validation->output_errors());
        }
        $this->load->view(admin_folder() . "change_password");
    }
}
