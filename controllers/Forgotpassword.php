<?php
error_reporting(1);
//ini_set('display_error', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {
	function __construct(){
	    parent::__construct();
	    $this->load->model('Api_model','',TRUE);
	    $this->load->helper('url');
	    $this->load->library('session');
	    // $session_data = $this->session->userdata('logged_in');
	    // if(!$session_data){
	    //   redirect('Login');
	    // }
	}
	 public function newpassword($userid=null){
        if ($userid!="") {
            $id = base64_decode($userid);
        }else{
            $id = base64_decode($this->get('id'));
        }
        $id1 = explode("_",$id);
        $id2 = $id1[0];
        $data['user_id'] = $id2;
        $data['title'] = "new Password";
        $this->load->library('session');
        $this->load->view('templete/header');
        $this->load->view('templete/newpassword', $data);
    }
    public function updatepassword(){
        $this->load->library('session');
        $uid = $this->input->post('id');
        $static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
        $id = $uid . "_" . $static_key;
        $id = base64_encode($id);
        $data = ['id' => $this->input->post('id') , 'password' => $this->input->post('password') ,'cpassword' => $this->input->post('cpassword'), 'base64id' => $id];
        if($data['password'] != $data['cpassword']){
            $this->session->set_flashdata('msg', '<span style="color:#f00">Please enter same password</span>');
            redirect("Forgotpassword/newpassword?id=" . $data['base64id']);
        }elseif(empty($data['password'])){
        	$this->session->set_flashdata('msg', '<span style="color:#f00">Please enter password</span>');
            redirect("Forgotpassword/newpassword?id=" . $data['base64id']);
        }else{
            $var = $this->Api_model->updateNewpassword($data);
            $this->session->set_flashdata('msg', '<span style="color:green;">Password updated successfully</span>');
            redirect("Forgotpassword/newpassword?id=" . $data['base64id']);
        }
        $this->load->view('templete/header');
        $this->load->view('templete/successmsg');
    }
}