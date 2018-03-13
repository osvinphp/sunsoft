<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(E_ALL);ini_set('display_errors', 1); 

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Rinkesh Kumar
 */
class User extends REST_Controller {

	function __construct(){
        // Construct the parent class
		parent::__construct();
		$this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->load->model('Api_model');
        $this->load->helper('date');
        $this->load->helper(array('form','url'));
        $config = Array(
            'protocol' => 'sendmail',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        date_default_timezone_set("UTC");
        $this->load->library('form_validation');
        $this->load->library('Pdf');
        $this->load->database();
    }

//////////////////////////////////////////////////////////////////////////// Profile ////////////////////////////////////////////////////////////////////////////
    public function signup_post(){
        $data = array(
            'fullname'=>$this->input->post('username'),
            'email'=>$this->input->post('email'),
            'password'=>md5($this->input->post('password')),
            'fb_id'=>$this->input->post('fb_id'),
            'google_id'=>$this->input->post('google_id'),
            'loginType'=>$this->input->post('logintype'),
            'profile_pic'=>$this->input->post('profile_pic'),
            'device_id'=>$this->input->post('device_id'),
            'unique_deviceId'=>$this->input->post('unique_deviceId'),
            'token_id'=>$this->input->post('token_id')
        );
        if(empty($data['fullname'])){
        	$result = array(
                "controller"=>"User",
                "action"=>"signUp",
                "ResponseCode" => false,
                "MessageWhatHappen" => "username empty"
            );
		}else{
	        if($data['loginType'] == 1){
	        	$var = $this->Api_model->signup($data);
	        	if($var == "error"){
	        		$result = array(
		                "controller"=>"User",
		                "action"=>"signUp",
		                "ResponseCode" => false,
		                "MessageWhatHappen" => "Email already exist!"
		            );
	        	}else{

            $body = "<!DOCTYPE html>
            <head>
            <meta content=text/html; charset=utf-8 http-equiv=Content-Type />
            <title>Registration</title>
            <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
            </head>
            <body>
            <table width=60% border=0 bgcolor=#53CBE6 style=margin:0 auto; float:none;font-family: 'Open Sans', sans-serif; padding:0 0 10px 0;>
                <tr>
                    <th width=20px></th>
                    <th width=20px  style=padding-top:30px;padding-bottom:30px;><img style='width:35%' src='".base_url()."public/img/logo.png'></th>
                    <th width=20px></th>
                </tr>
                <tr>
                    <td width=20px></td>
                    <td bgcolor=#fff style=border-radius:10px;padding:20px;>
                    <table width=100%;>
                <tr>
                    <th style=font-size:20px; font-weight:bolder; text-align:right;padding-bottom:10px;border-bottom:solid 1px #ddd;> SignUp Successful</th>
                </tr>
                <tr>
                    <td style=font-size:16px;>
                    <p> Congratulations ".$this->input->post('username')." you are now registered with Gan</p>
                  
                    </td>
                </tr>
                <tr>
                    <td style=text-align:center; padding:20px;>
                        <h2 style=margin-top:50px; font-size:29px;>Best Regards,</h2>
                        <h3 style=margin:0; font-weight:100;>Customer Support</h3>
                    </td>
                </tr>
            </table>
            </td>
            <td width=20px></td>
            </tr>
            <tr>
            <td width=20px></td>
            <td style=text-align:center; color:#fff; padding:10px;> Copyright © GAN All Rights Reserved</td>
            <td width=20px></td>
            </tr>
            </table>
            </body>";
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from('osvinphp@gmail.com', 'GAN');
            $this->email->to($email);
            $this->email->subject('Signup succesfull');
            $this->email->message($body);
            $this->email->send();


	        		$result = array(
		                "controller"=>"User",
		                "action"=>"signUp",
		                "ResponseCode" => true,
		                "MessageWhatHappen" => "Successfully registered",
		                "signUpResponse"=>$var
		            );
	        	}
	        }elseif($data['loginType'] == 2 || $data['loginType'] == 3){
	        	$var = $this->Api_model->logsign($data);
	        	if($var['signup'] == "success"){
	        		$result = array(
		                "controller"=>"User",
		                "action"=>"signUp",
		                "ResponseCode" => true,
                        // "emailExist"=>$var['type'],
		                "MessageWhatHappen" => "Login success",
		                "signUpResponse"=>$var['response']
		            );
	        	}elseif($var == "suspend"){
	        		$result = array(
		                "controller"=>"User",
		                "action"=>"signUp",
		                "ResponseCode" => true,
		                "MessageWhatHappen" => "Account suspended."
		            );
	        	}
	        }	        
	    }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function login_post(){
        $data = array(
            'fullname'=>$this->input->post('username'),
            'email'=>$this->input->post('email'),
            'password'=>md5($this->input->post('password')),
            'fb_id'=>$this->input->post('fb_id'),
            'google_id'=>$this->input->post('google_id'),
            'loginType'=>$this->input->post('logintype'),
            'profile_pic'=>$this->input->post('profile_pic'),
            'device_id'=>$this->input->post('device_id'),
            'unique_deviceId'=>$this->input->post('unique_deviceId'),
            'token_id'=>$this->input->post('token_id')
        );
        if($data['loginType'] == 1 && empty($data['fullname'])){
        	$var = $this->Api_model->login($data);
        	if($var == "empty"){
        		$result = array(
	                "controller"=>"User",
	                "action"=>"signUp",
	                "ResponseCode" => false,
	                "MessageWhatHappen" => "Email or password does not exist!"
	            );
        	}elseif($var == "suspend"){
        		$result = array(
	                "controller"=>"User",
	                "action"=>"signUp",
	                "ResponseCode" => false,
	                "MessageWhatHappen" => "Account suspended."
	            );
        	}else{
        		$result = array(
	                "controller"=>"User",
	                "action"=>"signUp",
	                "ResponseCode" => true,
	                "MessageWhatHappen" => "Login success",
	                "loginResponse"=>$var['send']
	            );
        	}
        }elseif($data['loginType'] == 2 || $data['loginType'] == 3){
        	$var = $this->Api_model->logsign($data);
        	if($var['signup'] == "success"){
        		$result = array(
	                "controller"=>"User",
	                "action"=>"signUp",
	                "ResponseCode" => true,
	                "MessageWhatHappen" => "Login success",
	                "loginResponse"=>$var['response']
	            );
        	}elseif($var == "suspend"){
        		$result = array(
	                "controller"=>"User",
	                "action"=>"signUp",
	                "ResponseCode" => true,
	                "MessageWhatHappen" => "Account suspended."
	            );
        	}
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function getQuckId_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'quickBlockId'=>$this->input->post('quickblockid'),
            'date_created'=>date('Y-m-d H:i:s')
        ];
        $user = $this->Api_model->select_data('*','tbl_users',array('id'=>$data['userId']));
        if(!empty($user)){
            $select1 = $this->Api_model->select_data('*','tbl_quickBlock',array('userId'=>$data['userId']));
            if(empty($select1)){
                $insert = $this->Api_model->insert_data('tbl_quickBlock',$data);
                $select = $this->Api_model->select_data('*','tbl_quickBlock',array('id'=>$insert));
            }else{
                $select = $this->Api_model->select_data('*','tbl_quickBlock',array('userId'=>$data['userId']));
            }        
            $result = array(
                "controller"=>"User",
                "action"=>"getQuckId",
                "ResponseCode" => true,
                "quickResponse"=>$select[0]
            );
        }else{
            $result = array(
                "controller" => "User",
                "action" => "getQuckId",
                "ResponseCode" => false,
                "MessageWhatHappen" => "Something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function changepassword_post(){
        $data = array(
            'id'=>$this->input->post('userid'),
            'oldpassword'=>md5($this->input->post('oldpassword')),
            'newpassword'=>md5($this->input->post('newpassword'))
        );
        $var = $this->Api_model->changepassword($data);
        if($var == "error"){
            $result = array(
                "controller" => "User",
                "action" => "changepassword",
                "ResponseCode" => false,
                "MessageWhatHappen" => "Incorrect old password."
            );
        }else{
            $result = array(
                "controller" => "User",
                "action" => "changepassword",
                "ResponseCode" => true,
                "MessageWhatHappen" => "Password changed successfully."
            );
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function forgotpassword_post(){        
        $email = $this->input->post('email');
        $var = $this->Api_model->forgotpassword($email);
        if($var == "error"){
            $result = array(
                "controller"=> "User",
                "action"=> "forgotpassword",
                "ResponseCode" => false,
                "MessageWhatHappen"=> "Email does not exist in our database."
            );
        }else{
            $body = "<!DOCTYPE html>
            <head>
            <meta content=text/html; charset=utf-8 http-equiv=Content-Type />
            <title>Feedback</title>
            <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
            </head>
            <body>
            <table width=60% border=0 bgcolor=#53CBE6 style=margin:0 auto; float:none;font-family: 'Open Sans', sans-serif; padding:0 0 10px 0;>
                <tr>
                    <th width=20px></th>
                    <th width=20px  style=padding-top:30px;padding-bottom:30px;><img style='width:35%' src='".base_url()."public/img/logo.png'></th>
                    <th width=20px></th>
                </tr>
                <tr>
                    <td width=20px></td>
                    <td bgcolor=#fff style=border-radius:10px;padding:20px;>
                    <table width=100%;>
                <tr>
                    <th style=font-size:20px; font-weight:bolder; text-align:right;padding-bottom:10px;border-bottom:solid 1px #ddd;> Hello " . $var['name'] . "</th>
                </tr>
                <tr>
                    <td style=font-size:16px;>
                    <p> You have requested a password retrieval for your user account at GAN.To complete the process, click the link below.</p>
                    <p><a href=" . base_url('api/User/newpassword/' . $var['b_id']) . ">Change Password</a></p>
                    </td>
                </tr>
                <tr>
                    <td style=text-align:center; padding:20px;>
                        <h2 style=margin-top:50px; font-size:29px;>Best Regards,</h2>
                        <h3 style=margin:0; font-weight:100;>Customer Support</h3>
                    </td>
                </tr>
            </table>
            </td>
            <td width=20px></td>
            </tr>
            <tr>
            <td width=20px></td>
            <td style=text-align:center; color:#fff; padding:10px;> Copyright © GAN All Rights Reserved</td>
            <td width=20px></td>
            </tr>
            </table>
            </body>";
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from('osvinphp@gmail.com', 'GAN');
            $this->email->to($email);
            $this->email->subject('Forgot Password');
            $this->email->message($body);
            $this->email->send();

            $result = array(
                "controller"=> "User",
                "action"=> "forgotpassword",
                "ResponseCode" => true,
                "MessageWhatHappen"=> "Mail sent successfully."
            );
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function newpassword_get($userid=null){
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
    public function updatepassword_post(){
        $this->load->library('session');
        $uid = $this->input->post('id');
        $static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
        $id = $uid . "_" . $static_key;
        $id = base64_encode($id);
        $data = ['id' => $this->input->post('id') , 'password' => $this->input->post('password') ,'cpassword' => $this->input->post('cpassword'), 'base64id' => $id];
        if($data['password'] != $data['cpassword']){
            $this->session->set_flashdata('msg', '<span style="color:#f00">Please enter same password</span>');
            redirect("api/User/newpassword?id=" . $data['base64id']);
        }elseif(empty($data['password'])){
        	$this->session->set_flashdata('msg', '<span style="color:#f00">Please enter password</span>');
            redirect("api/User/newpassword?id=" . $data['base64id']);
        }else{
            $var = $this->Api_model->updateNewpassword($data);
            $this->session->set_flashdata('msg', '<span style="color:green;">Password updated successfully</span>');
            redirect("api/User/newpassword?id=" . $data['base64id']);
        }
        $this->load->view('templete/header');
        $this->load->view('templete/successmsg');
    }
    public function viewprofile_post(){
        $data = array(
            'userid'=>$this->input->post('userid')
        );
        $var = $this->Api_model->viewprofile($data);
        if($var == "error"){
            $result = array(
                "controller"=> "User",
                "action"=> "viewprofile",
                "ResponseCode" => false,
                "MessageWhatHappen"=> "Email does not exist in our database."
            );
        }else{
            $result = array(
                "controller"=> "User",
                "action"=> "viewprofile",
                "ResponseCode" => true,
                "MessageWhatHappen"=> "view profile data",
                "viewResponse"=>$var
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function myquery1($table,$email){
        if(!empty($email)){
          $email = "Where email = '".$email."' ";     
        }else{
          $email = '';
        }
        $result = $this->db->query("SELECT * FROM ".$table." ".$email." ");
        return $result;      
    }
    public function upload($path,$name,$imagename){
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|png|jpg|jpeg';
        $config['max_size'] = '5000';
        $config['max_width'] = '5024';
        $config['max_height'] = '5068';
        $new_name = $name.'_'.time();
        $config['file_name'] = $new_name;
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload($imagename)){
            $error = array(
                'error' => $this->upload->display_errors()
            );
            $image = "";
        }else{
            $data = $this->upload->data();
            $image = $path.'/'.$data['file_name'];
        }
        return $image;
    }
    public function updateprofile_post(){
        $upload_data = $this->upload('public/profile_pic','IMG','profile_pic');
        if(empty($upload_data)){
            $dataa = array(
                'fullname'=>$this->input->post('name'),
                'id'=>$this->input->post('userid')
            );
            $mov = $this->Api_model->updateprofile($dataa);
            if($mov == "error"){
                $result = array(
                    "controller"=> "User",
                    "action"=> "updateprofile",
                    "ResponseCode" => false,
                    "MessageWhatHappen"=> "User does not exist"
                );
            }else{
                $result = array(
                    "controller"=> "User",
                    "action"=> "updateprofile",
                    "ResponseCode" => true,
                    "MessageWhatHappen"=> "Account update successfully.",
                    "updateResponse"=>$mov
                );
            }
        }else{
            $data1 = array(
              'fullname'=>$this->input->post('name'),
              'id'=>$this->input->post('userid'),
              'profile_pic'=> base_url().''.$upload_data
            );
            $mov = $this->Api_model->updateprofilepic($data1);
            if($mov == "error"){
                $result = array(
                    "controller"=> "User",
                    "action"=> "updateprofile",
                    "ResponseCode" => false,
                    "MessageWhatHappen"=> "Email does not exist in our database."
                );
            }else{
                $result = array(
                    "controller"=> "User",
                    "action"=> "updateprofile",
                    "ResponseCode" => true,
                    "MessageWhatHappen"=> "Account update successfully.",
                    "updateResponse"=>$mov
                );
            }
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function logout_post(){
        $id = $this->input->post('userid');
        $device = $this->input->post('unique_deviceId');
        $var = $this->Api_model->logout($id,$device);
        if($var == 0) {
            $result = array(
                "controller" => "User",
                "action" => "Logout",
                "ResponseCode" => false,
                "MessageWhatHappen" => "Something went wrong."
            );
        }else{
            $result = array(
                "controller" => "User",
                "action" => "Logout",
                "ResponseCode" => true,
                "MessageWhatHappen" => "Logged out successfully.",
                "logoutResponse"=>$var
            );
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function pushNotification_post(){
        $data = array(
            'id'=>$this->input->post('userid'),
            'status'=>$this->input->post('pushstatus')
        );
        $var = $this->Api_model->notification($data);
        if($var == 0){
            $result = array(
                "controller"=>"User",
                "action"=>"pushNotification",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Notification enabled."
            );
        }elseif($var == 1){
            $result = array(
                "controller"=>"User",
                "action"=>"pushNotification",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Notification disabled."
            );
        }else{
            $result = array(
                "controller"=>"User",
                "action"=>"pushNotification",
                "ResponseCode"=> false,
                "MessageWhatHappen"=> "Something went wrong."
            );
        }        
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function notificationList_post(){
        $userid = $this->input->post('userid');
        $var = $this->Api_model->select_data('*','tbl_notifications',array('to_id'=>$userid),'date_created DESC');
        foreach ($var as $key => $value) {
            // $this->db->where('id',$value->id);
            // $this->db->update('tbl_notifications',array('msg_read'=>1));
            $info = $this->db->query("SELECT fullname FROM tbl_users WHERE id='".$value->from_id."'")->row()->fullname;
            $book = $this->db->query("SELECT count(id) as count FROM tbl_bookResource WHERE userId = '".$value->to_id."' AND status = 0 ")->row()->count;
            if($value->type == 1){
                $value->message = "You have a new Friend Request";
            }elseif($value->type == 2){
                $value->message = $info." has accepted your Friend Request.";
            }elseif($value->type == 3){
                $value->message = "You have a new challenge request.";
            }elseif($value->type == 4){
                $value->message = "You have a new goal request";
            }elseif($value->type == 5){
                $value->message = "You have a new event request.";
            }elseif($value->type == 6){
                $cn = $this->getconvert($book);
                $value->message = "You have ".$cn."pending book tasks.";
            }
        }
        $result = array(
            "controller"=>"User",
            "action"=>"notificationList",
            "ResponseCode"=> true,
            "notificationResponse"=>$var
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    function getconvert(float $number){
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $text = implode('', array_reverse($str));
        return $text;
    }
    public function notificationDelete_post(){
        $to_id = $this->input->post('userid');
        $var = $this->Api_model->notidelete($to_id);
        $result = array(
            "controller"=>"User",
            "action"=>"notificationDelete",
            "ResponseCode"=> true,
            "MessageWhatHappen"=>"Successfully deleted."
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
/////////////////////////////////////////////////////////////// Dashboard Activity /////////////////////////////////////////////////////////////////////////////
    public function dashboardCategory_post(){
    	$config['upload_path'] ='public/img/dashboard_icon';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '5000';
        $config['max_width'] = '5024';
        $config['max_height'] = '5068';
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('profile_pic')){
            $error = array(
                'error' => $this->upload->display_errors()
            );
            $image = "";
        }else{
            $data = $this->upload->data();
            $image = "public/img/dashboard_icon/".$data['file_name'];
        }
		$dataa = array(
			'upperTitle'=>$this->input->post('uppertitle'),
			'image'=>$image,
            'lowerTitle'=>$this->input->post('lowertitle'),
			'date_created'=>date('Y-m-d H:i:s')
		);
		$var = $this->Api_model->insert_data('tbl_categories',$dataa);
		$result = array(
			"controller"=> "User",
            "action"=> "dashboardCategory",
            "ResponseCode" => true,
            "MessageWhatHappen"=> "Added Successfully",
            "updateResponse"=>$var
		);
		$this->set_response($result,REST_Controller::HTTP_OK);
	}
    public function categoryList_get(){
        $var = $this->Api_model->categoryList();
        $result = array(
            "controller"=> "User",
            "action"=> "categoryList",
            "ResponseCode" => true,
            "MessageWhatHappen"=> "Listing",
            "quoteMessage"=>$var['quote'],
            "categoryResponse"=>$var['dashboard']
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function categoryList11a_get(){
    	$data = $this->input->post('date');
        $var = $this->Api_model->categoryList112();
        $this->set_response($var,REST_Controller::HTTP_OK);
    }
/////////////////////////////////////////////////////////////////////////// Hours //////////////////////////////////////////////////////////////////////////////
    public function addSubWorkHour_post(){
        $data = array(
            'category_Id'=>$this->input->post('cat_id'),
            'userId'=>$this->input->post('userid'),
            'taskId'=>$this->input->post('taskid'),
            'taskDescription'=>$this->input->post('workdescrip'),
            'date_created'=>date('Y-m-d H:i:s')
        );
        $var = $this->Api_model->addsubworkhour($data);
        if($var['msgg'] == 'update'){
            $result = array(
                "controller"=> "User",
                "action"=> "addSubWorkHour",
                "ResponseCode" => true,
                "MessageWhatHappen"=> "Updated successfully.",
                "taskUpdateResponse"=>$var['update_item']
            );
        }elseif($var['msgg'] == 'insert'){
            $result = array(
                "controller"=> "User",
                "action"=> "addSubWorkHour",
                "ResponseCode" => true,
                "MessageWhatHappen"=> "Add task item successfully.",
                "taskInsertResponse"=>$var['insert_item']
            );
        }else{
            $result = array(
                "controller"=> "User",
                "action"=> "addSubWorkHour",
                "ResponseCode" => false,
                "MessageWhatHappen"=> "Something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function dateWiseList_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'category_Id'=>$this->input->post('cat_id'),
            'dateWise'=>$this->input->post('datewise'),
            'taskId'=>$this->input->post('taskid')
        );
        if(empty($data['taskId'])){
            $var1 = $this->Api_model->listdatewise($data);
            if($var1 == "empty"){
                $result = array(
                    "controller"=> "User",
                    "action"=> "dateWiseList",
                    "ResponseCode" => false,
                    "MessageWhatHappen"=> "No record found."
                );
            }else{
                $result = array(
                    "controller"=> "User",
                    "action"=> "dateWiseList",
                    "ResponseCode" => true,
                    "taskListResponse"=>$var1
                );
            }
        }else{
            $var = $this->Api_model->select_data('*','tbl_taskActivityItem',array('userId'=>$data['userId'],'category_Id'=>$data['category_Id'],'taskId'=>$data['taskId']));
            $result = array(
                "controller"=> "User",
                "action"=> "dateWiseList",
                "ResponseCode" => true,
                "taskWorkResponse"=>$var[0]
            ); 
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
///////////////////////////////////////////////////////////////////////////// Goals /////////////////////////////////////////////////////////////////////////////
    public function addWeeklyGoal_post(){
        $data = 
            array(
                'id'=>$this->input->post('goalid'),
                'userId'=>$this->input->post('userid'),
                'goal1'=>$this->input->post('goal1'),
                'goalDate1'=>empty($this->input->post('goal1'))?'':date('Y-m-d H:i:s'),
                'goal2'=>empty($this->input->post('goal2'))?'':$this->input->post('goal2'),
                'goalDate2'=>empty($this->input->post('goal2'))?'':date('Y-m-d H:i:s'),
                'goal3'=>empty($this->input->post('goal3'))?'':$this->input->post('goal3'),
                'goalDate3'=>empty($this->input->post('goal3'))?'':date('Y-m-d H:i:s'),        
                'toDoList'=>$this->input->post('todolist'),
                'notToDoList'=> $this->input->post('nottodolist'),
                'date_created'=>date('Y-m-d H:i:s')
            );
        if(empty($data['id'])){
            $var = $this->Api_model->addweekgoal($data);
        }elseif(!empty($data['id'])){
            $var = $this->Api_model->updateweekgoal($data);
        }
        if($var == 1){
            $result = array(
                "controller"=>"User",
                "action"=>"addWeeklyGoal",
                "ResponseCode"=>true,
                "MessageWhatHappen"=>"Weekly goals added successfully."
            );
        }elseif($var == "empty"){
            $result = array(
                "controller"=>"User",
                "action"=>"addWeeklyGoal",
                "ResponseCode"=>false,
                "MessageWhatHappen"=>"You have already set this week goal."
            );
        }elseif($var == "update"){
            $result = array(
                'controller'=>"User",
                "action"=>"addWeeklyGoal",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Weekly goals updated."
            );
        }elseif($var == "insert"){
            $result = array(
                'controller'=>"User",
                "action"=>"addWeeklyGoal",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"No goal set."
            );
        }else{
            $result = array(
                "controller"=>"User",
                "action"=>"addWeeklyGoal",
                "ResponseCode"=>falese,
                "MessageWhatHappen"=>"something went wrong"
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function checkWeeklyGoal_post(){
        $data = array(
            'id'=>$this->input->post('goalid'),
            'userId'=>$this->input->post('userid'),
            'type'=>$this->input->post('type'),
            'date_created'=>$this->input->post('goaldate')
        );
        $var = $this->Api_model->checkweekgoal($data);
        if($var == "empty"){
             $result = array(
                'controller'=>"User",
                "action"=>"checkWeeklyGoal",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"No weekly goals set"
            );
        }elseif($var == "error"){
            $result = array(
                'controller'=>"User",
                "action"=>"checkWeeklyGoal",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }else{
            $result = array(
                'controller'=>"User",
                "action"=>"checkWeeklyGoal",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"listing weekly goals.",
                "weeklyGoalResponse"=>$var
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }    
//////////////////////////////////////////////////////////////////////////////// Chanlenges /////////////////////////////////////////////////////////////////////
    public function adminChallenge_get(){
        $var = $this->Api_model->select_data('id,type,title,description,date_created','tbl_challenge',array('type'=>2));
        $result = array(
            "controller"=>"User",
            "action"=>"adminChallenge",
            "ResponseCode"=>true,
            "adminChallengeResponse"=>$var
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function createChallenge_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'type'=>$this->input->post('type'),   // 0->with bet , 1->without bet
            // 'challengeType_Id'=>$this->input->post('challengetypeid'),
            'title'=>$this->input->post('title'),
            // 'challengeType'=>$this->input->post('challengetype'),
            'description'=>$this->input->post('description'),
            'startDate'=>$this->input->post('startdate'),
            'endDate'=>$this->input->post('enddate'),
            // 'status'=>$this->input->post('status'),
            // 'startTime'=>$this->input->post('starttime'),
            'date_created'=>date('Y-m-d H:i:s')
        );
        // $invite = $this->input->post('invitefriend');
        $var = $this->Api_model->createchallenge($data);
        if($var['response'] == "insert"){
            $result = array(
                'controller'=>'User',
                'action'=>'createChallenge',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>'Challenge create successfully.',
                'challengeResponse'=>$var['data']
            );
        }else{
            $result = array(
                'controller'=>"User",
                'action'=>"createChallenge",
                'ResponseCode'=> false,
                'MessageWhatHappen'=>"something went wrong."
            ); 
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function editChallenge_post(){
        $data = array(
            'id'=>$this->input->post('chalngeid'),
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'),
            'startDate'=>$this->input->post('startdate'),
            'endDate'=>$this->input->post('enddate')
        );
        $var = $this->Api_model->editchalenege($data);
        if($var == "error"){
            $result = array(
                'controller'=>"User",
                'action'=>"editChallenge",
                'ResponseCode'=> false,
                'MessageWhatHappen'=>"something went wrong."
            );
        }else{
            $result = array(
                'controller'=>"User",
                'action'=>"editChallenge",
                'ResponseCode'=> true,
                'editChallengeResponse'=>$var
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function deleteChallenge_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'id'=>$this->input->post('chalngeid')
        );
        $var = $this->Api_model->deleteChallenge($data);
        if($var == "error"){
            $result = array(
                'controller'=>"User",
                'action'=>"deleteChallenge",
                'ResponseCode'=> false,
                'MessageWhatHappen'=>"something went wrong."
            );
        }else{
            $result = array(
                'controller'=>"User",
                'action'=>"deleteChallenge",
                'ResponseCode'=> true,
                'MessageWhatHappen'=>"Deleted successfully."
            );
        }
        $this->set_response($var,REST_Controller::HTTP_OK);
    }
    public function cancelChallenge_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'id'=>$this->input->post('chalngeid')            
        ];
        $var = $this->Api_model->cancelChallenge($data);
        if($var == "error"){
            $result = array(
                'controller'=>"User",
                'action'=>"cancelChallenge",
                'ResponseCode'=> false,
                'MessageWhatHappen'=>"something went wrong."
            );
        }else{
            $result = array(
                'controller'=>"User",
                'action'=>"cancelChallenge",
                'ResponseCode'=> true,
                'MessageWhatHappen'=>"cancelled successfully."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function challengeInvite_post(){
        $userid = $this->input->post('userid');
        $var = $this->Api_model->chalengerequest($userid);
        $result = array(
            'controller'=>'User',
            'action'=>'listChallengeReq',
            'ResponseCode'=>true,
            'listChallengeResponse'=>$var
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function acceptChallenge_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'id'=>$this->input->post('chalngeid'),
            'status'=>$this->input->post('status')
        );
        $var = $this->Api_model->acceptchallenge($data);
        if($var == "acp"){
            $result = array(
                'controller'=>'User',
                'action'=>'acceptChallenge',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>"Accepted Successfully."
            );
        }elseif($var == "del"){
            $result = array(
                'controller'=>'User',
                'action'=>'acceptChallenge',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>"Decline Successfully."
            );
        }elseif($var == "quit"){
            $result = array(
                'controller'=>'User',
                'action'=>'acceptChallenge',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>"Challenge quit Successfully."
            );
        }else{
            $result = array(
                'controller'=>'User',
                'action'=>'acceptChallenge',
                'ResponseCode'=>false,
                'MessageWhatHappen'=>"something went wrong."
            );
        }
        $this->set_response($result ,REST_Controller::HTTP_OK);
    }
    public function challenges_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'type'=>$this->input->post('type')              //// 0 -> upcoming , 1 -> Past
        );
        $var = $this->Api_model->challengelist($data);
        foreach ($var as $key => $value) {
            if($value->status == 3 && empty($value->detail)){
                $this->db->select('fullname,tbl_challenge.id,userId,title,description,startDate,endDate,tbl_challenge.type');
                $this->db->from('tbl_challenge');
                $this->db->join('tbl_users','tbl_users.id = tbl_challenge.userId');
                $this->db->where('tbl_challenge.userId',$value->from_Id);
                $this->db->where('tbl_challenge.id',$value->chalnge_Id);
                $this->db->order_by('tbl_challenge.startDate','asc');
                $query = $this->db->get()->row();  
                $query->ids = $query->id;              
                $value->detail = empty($query)?'':$query;
            }
        }

        $result = array(
            'controller'=>'User',
            'action'=>'challenges',
            'ResponseCode'=>true,
            'myChallengeResponse'=>$var
        );
        $this->set_response($result ,REST_Controller::HTTP_OK);
    }
    public function challengeDetail_post(){
        $id = $this->input->post('chalngeid');
        $userid = $this->input->post('userid');
        $var = $this->Api_model->challengedeltl($id,$userid);
        if($var == "error"){
            $result = array(
                'controller'=>'User',
                'action'=>'challengeDetail',
                'ResponseCode'=>false,
                'MessageWhatHappen'=>"something went wrong"
            );
        }else{
            $result = array(
                'controller'=>'User',
                'action'=>'challengeDetail',
                'ResponseCode'=>true,
                'chalengeDetailResponse'=>$var
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function challengeProof_post(){
        $upload_data = $this->upload('public/proof_pic','PROOF','proof_image');
        $data = [
            'challenge_id'=>$this->input->post('chalngeid'),
            'userId'=>$this->input->post('userid'),
            'image'=>$upload_data,
            'description'=>$this->input->post('description'),
            'is_winner'=>$this->input->post('is_winner'),
            'date_created'=>date('Y-m-d H:i:s')
        ];
        $select = $this->Api_model->select_data('*','tbl_challenge',array('id'=>$data['challenge_id']));
        if(!empty($select)){
            $var = $this->Api_model->insert_data('tbl_challengeProof',$data);
            $result = array(
                'controller'=>'User',
                'action'=>'challengeProof',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>"Successfully submited."
            );
        }else{
            $result = array(
                'controller'=>'User',
                'action'=>'challengeProof',
                'ResponseCode'=>false,
                'MessageWhatHappen'=>"something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function challengeVote_post(){
        $data = [
            'proof_id'=>$this->input->post('proof_id'),
            'userId'=>$this->input->post('userid'),
            'vote'=>$this->input->post('vote'),
            'date_created'=>date('Y-m-d H:i:s')
        ];
        $select = $this->Api_model->select_data('*','tbl_challengeProof',array('id'=>$data['proof_id']));
        if(!empty($select)){
            $check = $this->Api_model->select_data('*','tbl_challengeVote',array('proof_id'=>$data['proof_id'],'userId'=>$data['userId']));
            if(empty($check)){
                $var = $this->Api_model->insert_data('tbl_challengeVote',$data);
                $slt = $this->Api_model->select_data('*','tbl_challengeVote',array('id'=>$var));
                $count = $this->db->query("SELECT count(id) as count FROM tbl_challengeVote WHERE proof_id = '".$data['proof_id']."' AND vote = 1 ")->row()->count;
                $slt[0]->is_voted = $slt[0]->vote;
                $slt[0]->total_voted = $count;
                unset($slt[0]->vote);
                $result = array(
                    'controller'=>'User',
                    'action'=>'challengeVote',
                    'ResponseCode'=>true,
                    'MessageWhatHappen'=>"Successfully voted.",
                    'voteResponse'=>$slt[0]
                );
            }else{
                $this->db->where('proof_id',$data['proof_id']);
                $this->db->where('userId',$data['userId']);
                $this->db->update('tbl_challengeVote',array('vote'=>$data['vote']));
                $slt = $this->Api_model->select_data('*','tbl_challengeVote',array('proof_id'=>$data['proof_id'],'userId'=>$data['userId']));
                $count = $this->db->query("SELECT count(id) as count FROM tbl_challengeVote WHERE proof_id = '".$data['proof_id']."' AND vote = 1 ")->row()->count;
                $slt[0]->is_voted = $slt[0]->vote;
                $slt[0]->total_voted = $count;
                unset($slt[0]->vote);
                if($slt[0]->is_voted == 0){
                    $msg = "Successfully unvoted.";
                }else{
                    $msg = "Successfully voted.";
                }
                $result = array(
                    'controller'=>'User',
                    'action'=>'challengeVote',
                    'ResponseCode'=>true,
                    'MessageWhatHappen'=>$msg,
                    'voteResponse'=>$slt[0]
                ); 
            }
        }else{
            $result = array(
                'controller'=>'User',
                'action'=>'challengeVote',
                'ResponseCode'=>false,
                'MessageWhatHappen'=>"something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function challengeNotification_post(){
        $data = [
            'id'=>$this->input->post('chalngeid'),
            'notification'=>$this->input->post('notification')
        ];
        $var = $this->Api_model->challengenoti($data);
        if($var == "on"){
            $result = array(
                'controller'=>'User',
                'action'=>'challengeNotification',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>"Notification enabled!"
            );
        }else{
            $result = array(
                'controller'=>'User',
                'action'=>'challengeNotification',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>"Notification disabled!"
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function reportType_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'type'=>$this->input->post('type'),
            'startdate'=>$this->input->post('startdate'),
            'enddate'=>$this->input->post('enddate'),
            'name'=>$this->input->post('title')
        ];
        $time_zone=$this->input->post('time_zone');
        $static_key = "2@sdsd20lzswqswqs!jbkwwljewded904@!";
        $static_key1 = "lo2kmknd2wqs%qs@nj!jb1nnj2ede40&23s";
        $userid = $data['userId'] . "_" . $static_key;
        $type = $data['type'] . "_" . $static_key1;
        $title = $data['name'] . "_" . $static_key1;
        $tittl = base64_encode($title);
        $uid = base64_encode($userid);
        $utype = base64_encode($type);
        $response =base_url()."share/".$utype."/".$tittl."/".$uid."/".$data['startdate']."/".$data['enddate']."/".$time_zone;
        // print_r($response);die;
        $var = $this->Api_model->taskreportlisting($data);
        $result = array(
            "controller" => "User",
            "action" => "reportType",
            "ResponseCode" => true,
            "pdfLinkResponse"=>$response,
            $var['name']."Response"=>$var['reponse']
        );
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function getExcel_get($type,$title,$userid,$start,$end,$time_zone,$dd){



        // print_r($time_zone);die;
    	$utype = base64_decode($type);
		$utyp = explode('_',$utype);
		$type = $utyp[0];
		$uid = base64_decode($userid);
		$ids = explode('_',$uid);
		$userid = $ids[0];
        $tti = base64_decode($title);
        $utti = explode('_', $tti);
        $title = $utti[0];
        // $this->load->library('Pdf');
        $data = [
            'userId'=>$userid,
            'type'=>$type,
            'startdate'=>$start,
            'enddate'=>$end,
            'name'=>$title,
            'time_zone'=>$time_zone.'/'.$dd
        ];
        // print_r($data);die;
        // $send = $this->Api_model->getReportpdf1($data);
        $send = $this->Api_model->excel($data);
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
////////////////////////////////////////////// profile ////////////////////////////////////////////////////////////
    public function resume_post(){
        $id = $this->input->post('userid');
        $var['skill'] = $this->Api_model->resume($id,0);
        $var['certificate'] = $this->Api_model->resume($id,1);
        $var['employment'] = $this->Api_model->resume($id,2);
        $var['project'] = $this->Api_model->resume($id,3);
        $var['education'] = $this->Api_model->resume($id,4);
        $result = array(
            "controller" => "User",
            "action" => "resume",
            "ResponseCode" => true,
            "resumeResponse"=>$var
        );
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function addResume_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'type'=>$this->input->post('type'),
            'startDate'=>$this->input->post('startdate'),
            'endDate'=>$this->input->post('enddate'),
            'description'=>$this->input->post('description'),
            'date_created'=>date('Y-m-d H:i:s')
        );
        $filter = array_filter($data);
        $var = $this->Api_model->insert_data('tbl_resume',$filter);
        $result = array(
            "controller" => "User",
            "action" => "addResume",
            "ResponseCode" => true,
            "MessageWhatHappen" => "Item added successfully."
            //"reportResponse"=>$var
        );
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function updateResume_post(){
        $data = array(
            'id'=>$this->input->post('id'), 
            'userId'=>$this->input->post('userid'),
            'type'=>$this->input->post('type'),
            'startDate'=>$this->input->post('startdate'),
            'endDate'=>$this->input->post('enddate'),
           // 'check'=>$this->input->post('check'),
            'description'=>$this->input->post('description')
        );
        // $filter = array_filter($data);
        $var = $this->Api_model->updateresume($data);
        if($var['response'] == "update"){
            $result = array(
                "controller" => "User",
                "action" => "updateResume",
                "ResponseCode" => true,
                "MessageWhatHappen" => "Resume update successfully.",
                "resumeUpdateResponse"=>$var['send']
            );
        }else{
            $result = array(
                "controller" => "User",
                "action" => "updateResume",
                "ResponseCode" => false,
                "MessageWhatHappen" => "something went wrong."
            );
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function deleteResume_post(){
        $userid = $this->input->post('id');
        $var = $this->Api_model->deleteresume($userid);
        $result = array(
            "controller" => "User",
            "action" => "deleteResponse",
            "ResponseCode" => true,
            "MessageWhatHappen" => "Deleted successfully."
        );
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
	public function searchFriend_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'fullname'=>$this->input->post('username')
        );
        $var = $this->Api_model->searchfriend($data);
        $result = array(
            "controller" => "User",
            "action" => "searchFriend",
            "ResponseCode" => true,
            "searchResponse"=>$var
        );   
        $this->set_response($result, REST_Controller::HTTP_OK);
    }  
    public function friendList_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'status'=>$this->input->post('listtype')
        );
        if($data['status'] == 1){
        	$var = $this->Api_model->friendlist('from_Id,to_Id','tbl_friend'," ( to_Id = '".$data['userId']."' AND is_block = 0 AND status = '".$data['status']."') ",$data);
        }else{
        	$var = $this->Api_model->friendlist('from_Id,to_Id','tbl_friend',"(from_Id = '".$data['userId']."' AND is_block = 0 AND status = '".$data['status']."') OR (to_Id = '".$data['userId']."' AND is_block = 0 AND status = '".$data['status']."')",$data);
        }
        $result = array(
            "controller" => "User",
            "action" => "friendList",
            "ResponseCode" => true,
            "friendListResponse"=>$var
        );        
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function addFriend_post(){
    	$data = array(
            'from_Id'=>$this->input->post('userid'),
            'to_Id'=>$this->input->post('friendid'),
            'status'=>$this->input->post('action'),
            'date_updated'=>date('Y-m-d H:i:s'),
            'date_created'=>date('Y-m-d H:i:s')
        );

        if($data['status'] == 0){
        	$var = $this->Api_model->unfriend($data);
        	if($var == "ok"){
	        	$result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => true,
	                "MessageWhatHappen" => "Friend removed."
	            );
	        }else{
	        	$result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => false,
	                "MessageWhatHappen" => "something went worng."
	            );
	        }
        }
        elseif($data['status'] == 1){
        	$var = $this->Api_model->addfriend($data);
        	if($var == "reqsend"){
	            $result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => true,
	                "MessageWhatHappen" => "Friend request sent."
	            );
	        }elseif($var == "exist"){
	            $result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => false,
	                "MessageWhatHappen" => "You have already sent friend request."
	            );
	        }elseif($var == "List"){
                $result = array(
                    "controller" => "User",
                    "action" => "addFriend",
                    "ResponseCode" => false,
                    "MessageWhatHappen" => "You have already sent friend request."
                );
            }else{
	        	$result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => false,
	                "MessageWhatHappen" => "something went worng."
	            );
	        }
        }
        elseif($data['status'] == 2){
        	$var = $this->Api_model->commomaction($data);
        	if($var == "success"){
	            $result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => true,
	                "MessageWhatHappen" => "Friend added."
	            );
	        }elseif($var == "error"){
	            $result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => false,
	                "MessageWhatHappen" => "something went worng."
	            );
        	}
        }
        elseif($data['status'] == 3){
        	$var = $this->Api_model->commomaction($data);
        	if($var == "success"){
	        	$result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => true,
	                "MessageWhatHappen" => "successfully decline."
	            );
	        }elseif($var == "error"){
	        	$result = array(
	                "controller" => "User",
	                "action" => "addFriend",
	                "ResponseCode" => false,
	                "MessageWhatHappen" => "something went worng."
	            );
	        }
        }
        else{
        	$result = array(
                "controller" => "User",
                "action" => "addFriend",
                "ResponseCode" => false,
                "MessageWhatHappen" => "something went worng."
            );
        }       
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function blockFriend_post(){
        $data = array(
            'from_Id'=>$this->input->post('userid'),
            'to_Id'=>$this->input->post('friendid'),
            'is_block'=>$this->input->post('blocktype')
        );
        $var = $this->Api_model->blockuser($data);
        if($data['is_block'] == 1){
        	$msg = "block successfully.";
        }else{
        	$msg = "unblock successfully.";
        }
        if($var == "block"){
            $result = array(
                "controller" => "User",
                "action" => "blockFriend",
                "ResponseCode" => true,
                "MessageWhatHappen" => $msg
            );
        }else{
            $result = array(
                "controller" => "User",
                "action" => "blockFriend",
                "ResponseCode" => false,
                "MessageWhatHappen" => "something went wrong."
            );
        }        
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function friendProfile_post(){
    	$userid = $this->input->post('userid');
    	$var = $this->Api_model->select_data('profile_pic,fullname','tbl_users',array('id'=>$userid));
    	$result = array(
            "controller" => "User",
            "action" => "friendProfile",
            "ResponseCode" => true,
            "profileResponse"=>$var[0]
        );       
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function blockList_post(){
    	$userid = $this->input->post('userid');
    	$var = $this->Api_model->blocklist($userid);
    	$result = array(
            "controller" => "User",
            "action" => "blockList",
            "ResponseCode" => true,
            "blockResponse"=>$var
        ); 
    	$this->set_response($result, REST_Controller::HTTP_OK);
    }   
////////////////////////////////////////////////////// Track your work with hour ////////////////////////////////////////////////////////////
    public function addTask_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'task_name'=>$this->input->post('taskname'),
            'date_created'=>date('Y-m-d H:i:s')
        ];
        $var = $this->Api_model->insert_data('tbl_taskWork',$data);
        $varResult = $this->Api_model->select_data('*','tbl_taskWork',array('id'=>$var,'userId'=>$data['userId']));
        if($var == true){
            $result = array(
                "controller" => "User",
                "action" => "addTask",
                "ResponseCode" => true,
                "MessageWhatHappen" => "Task add successfully.",
                "addTaskResponse"=>$varResult
            );
        }else{
            $result = array(
                "controller" => "User",
                "action" => "addTask",
                "ResponseCode" => false,
                "MessageWhatHappen" => "something went wrong."
            );
        }        
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function updateTask_post(){           //// for mannual case update
        $data = [
            'id'=>$this->input->post('taskid'),
            'userId'=>$this->input->post('userid'),
            'task_name'=>$this->input->post('taskname'),
            'description'=>$this->input->post('description')
            // 'start_date'=>$this->input->post('startdate'),
            // 'end_date'=>$this->input->post('enddate'),
            // 'time_devoted'=>$this->input->post('timedevoted'),
            // 'status'=>$this->input->post('status')
        ];
        // $var = $this->Api_model->updatetask($data);
        $var = $this->Api_model->updatetaskk($data);
        if($var == "error"){
            $result = array(
                "controller" => "User",
                "action" => "updateTask",
                "ResponseCode" => false,
                "MessageWhatHappen" => "something went wrong."
            );
        }
        // elseif($var == "exceed"){
        //     $result = array(
        //         "controller" => "User",
        //         "action" => "updateTask",
        //         "ResponseCode" => false,
        //         "MessageWhatHappen" => "Maximum number of hours excceds."
        //     );
        // }
        else{
            $result = array(
                "controller" => "User",
                "action" => "updateTask",
                "ResponseCode" => true,
                "MessageWhatHappen" => "Update task successfully.",
                "updateTaskResponse"=>$var
            );
        }        
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function deleteTask_post(){
        $id = $this->input->post('taskid');
        $var = $this->Api_model->taskDeleteData($id);
        if($var == "delete"){
            $result = array(
                "controller" => "User",
                "action" => "deleteTask",
                "ResponseCode" => true,
                "MessageWhatHappen" => "Deleted successfully."
            );
        }else{
            $result = array(
                "controller" => "User",
                "action" => "deleteTask",
                "ResponseCode" => false,
                "MessageWhatHappen" => "something went wrong."
            );
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function taskList_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'page'=>$this->input->post('pageno')
        ];
        $var = $this->Api_model->detailalltask($data);
        $result = array(
            "controller" => "User",
            "action" => "taskList",
            "ResponseCode" => true,
            "totalrecord"=>$var['total'],
            // "currentTotalTime"=>$var['time'],
            "taskListResponse"=>$var['record']
        );
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
    public function markTaskCompleted_post(){
        $data = [
            'id'=>$this->input->post('taskid'),
            'status'=>$this->input->post('status'),
            'end_date'=>date('Y-m-d H:i:s')
        ];
        $var = $this->Api_model->marktaskcompleted($data);
        if($var == "update"){
            $result = array(
                "controller" => "User",
                "action" => "markTaskCompleted",
                "ResponseCode" => true,
                "MessageWhatHappen" => "Task completed."
            );
        }else{
            $result = array(
                "controller" => "User",
                "action" => "markTaskCompleted",
                "ResponseCode" => false,
                "MessageWhatHappen" => "something went wrong."
            );
        }
        $this->set_response($result, REST_Controller::HTTP_OK);
    }
/////////////////////////////////// Goals and events ///////////////////////////////////////////////////////////////////////////////////////
    public function addGoals_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'title'=>$this->input->post('title'),
            'start_date'=>$this->input->post('startdate'),
            'end_date'=>$this->input->post('enddate'),
            'total_time'=>$this->input->post('totaltime'),
            //'rule_name'=>$this->input->post('rulename'),
            'date_created'=>date('Y-m-d H:i:s')
        ];
        $invite = $this->input->post('invitefriend');
        $rules = $this->input->post('rulename');
       // $select = $this->Api_model->select_data('*','tbl_goalsCalender',array('UserId'=>$data['userId']));
        $var = $this->Api_model->addgoals($data,$invite,$rules);
        if($var['msg'] == "insert"){
            $result = array(
                "controller"=>"User",
                "action"=>"addGoals",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Add goals successfully.",
                "goalsResponse"=>$var['sel']
            );
        }elseif($var == "already"){
        	$result = array(
                "controller"=>"User",
                "action"=>"addGoals",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"You have already set goals for this date."
            );
        }elseif($var == "exceed"){
            $result = array(
                "controller"=>"User",
                "action"=>"addGoals",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"You can set 3 goals per week."
            );
        }elseif($var == "greater"){
        	 $result = array(
                "controller"=>"User",
                "action"=>"addGoals",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"Error."
            );
        }else{
        	$result = array(
                "controller"=>"User",
                "action"=>"addGoals",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function addGoalRules_post(){
        $data = [
            'goalId'=>$this->input->post('goalid'),
            'rule_name'=>$this->input->post('rulename'),
            'date_created'=>date('Y-m-d H:i:s')
        ];
        $var = $this->Api_model->addgoalrules($data);
        if($var['resposne'] == "insert"){
            $result = array(
                "controller"=>"User",
                "action"=>"addGoalRules",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Add rules successfully.",
                "ruleResponse"=>$var['data'][0]
            );
        }else{
            $result = array(
                "controller"=>"User",
                "action"=>"addGoalRules",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function goalDetail_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'id'=>$this->input->post('goalid')
        ];
        $var = $this->Api_model->detailgoalsdata($data);
        $result = array(
            "controller"=>"User",
            "action"=>"detailGoals",
            "ResponseCode"=> true,
            "detailGoalsResponse"=>$var
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function updateGoals_post(){
        $data = [
            'id'=>$this->input->post('id'),
            'userId'=>$this->input->post('userid'),
            'title'=>$this->input->post('title'),
            'start_date'=>$this->input->post('startdate'),
            'end_date'=>$this->input->post('enddate'),
            'total_time'=>$this->input->post('totaltime')
        ];
        $filter = array_filter($data);
        $var = $this->Api_model->updategoal($filter,$data);
        if($var['resposne'] == "update"){
        	$result = array(
                "controller"=>"User",
                "action"=>"updateGoals",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Updated successfully.",
                "goalsResponse"=>$var['data'][0]
            );
        }elseif($var == "already"){
        	$result = array(
                "controller"=>"User",
                "action"=>"updateGoals",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"You have already set goals for this date."
            );
        }elseif($var == "greater"){
        	$result = array(
                "controller"=>"User",
                "action"=>"updateGoals",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"Error."
            );
        }elseif($var == "error"){
        	$result = array(
                "controller"=>"User",
                "action"=>"updateGoals",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"You can't update this goal as you're not the creater."
            );
        }else{
        	$result = array(
                "controller"=>"User",
                "action"=>"updateGoals",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function updateGoalRules_post(){
    	$data = array(
    		'id'=>$this->input->post('ruleid'),
            'rule_name'=>$this->input->post('rulename'),
    		'user_id'=>$this->input->post('user_id')
    	);
    
        $check = $this->Api_model->select_data('*','tbl_goalsCalenderRules',array('id'=>$data['id']));
        $data['goal_id']=$check[0]->goalId;
    	$var = $this->Api_model->updaterules($data);

        if ($var=="not") {
            $result = array(
                "controller"=>"User",
                "action"=>"updateGoalRules",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"you can't update the rule as you are not the creator.."
            );  
        }
        else{
        	$result = array(
                "controller"=>"User",
                "action"=>"updateGoalRules",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"updated successfully.",
                "ruleResponse"=>$var
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function goalRulesDelete_post(){
    	$data = [
            'id'=>$this->input->post('ruleid'),
    		'user_id'=>$this->input->post('user_id'),
    	];


    	$check = $this->Api_model->select_data('*','tbl_goalsCalenderRules',array('id'=>$data['id']));
        // print_r($this->db->last_query());die;
        $data['goal_id']=$check[0]->goalId;
    	if(empty($check)){
    		$var = "error";
    	}else{
	    	$var = $this->Api_model->deleterule($data);
	    }

        // print_r($var);die;
    
    	if($var == "del"){
    		$result = array(
                "controller"=>"User",
                "action"=>"goalRulesDelete",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Deleted successfully."
            );
    	}
        elseif($var == "not"){
            $result = array(
                "controller"=>"User",
                "action"=>"goalRulesDelete",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"you cannot delete the rule as you are not the creator."
            );
        }
        else{
    		$result = array(
                "controller"=>"User",
                "action"=>"goalRulesDelete",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"something went wrong."
            );
    	}
    	$this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function goalEventDelete_post(){
    	$data = [
    		'id'=>$this->input->post('id'),
    		'userId'=>$this->input->post('userid'),
    		'type'=>$this->input->post('type')
    	];
    	if($data['type'] == 0){
    		$var = $this->Api_model->commondelete('tbl_goalsCalender',$data['id'],$data['type'],$data['userId']);
    	}else{
    		$var = $this->Api_model->commondelete('tbl_events',$data['id'],$data['type'],$data['userId']);
    		// $name = "You can't delete this event as you're not the creater.";
    	}

    	if($var == "delete"){
    		$result = array(
                "controller"=>"User",
                "action"=>"goalEventDelete",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Deleted successfully."
            );
    	}else{
    		$result = array(
                "controller"=>"User",
                "action"=>"goalEventDelete",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"You can't delete as you're not the creater."
            );
    	}
    	$this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function commonInvitations_post(){
        $data = [
            "userId"=>$this->input->post('userid'),
            "id"=>$this->input->post('id'),
            "invite"=>$this->input->post('invitefriend'),
            "type"=>$this->input->post('type')
        ];
        $decode1 = json_decode($data['invite']);

        	$var = $this->Api_model->invitegoals($data);

                if($data['type'] == 0){
                
                    $name = "Goal";
                }elseif($data['type'] == 1){

                    $name = "Event";
                }elseif($data['type'] == 2){
                    $name = "Challenge";
                }

             if (in_array(1, $var, true)) {
                           $result = array(
                            "controller"=>"User",
                            "action"=>"invitesGoals",
                            "ResponseCode"=> true,
                            "MessageWhatHappen"=> $name." invitation sent successfully."
                        );
             }else{
                        $result = array(
                            "controller"=>"User",
                            "action"=>"invitesGoals",
                            "ResponseCode"=> false,
                            "MessageWhatHappen"=> $name." invitation not sent"
                        );  
             }
     
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function addEvents_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'eventTitle'=>$this->input->post('title'),
            'startDate'=>$this->input->post('startdate'),
            'endDate'=>$this->input->post('enddate'),
            'eventPlace'=>$this->input->post('place'),
            'eventComment'=>$this->input->post('comment'),
            'reminder'=>empty($this->input->post('reminder'))?'':$this->input->post('reminder').':00',
            'date_created'=>date('Y-m-d H:i:s')
        ];
        $invite = $this->input->post('invitefriend');
        $var = $this->Api_model->addevents($data,$invite);
        if($var['resposne'] == "insert"){
            $result = array(
                "controller"=>"User",
                "action"=>"addevents",
                "ResponseCode"=> true,
                "MessageWhatHappen"=>"Event added successfully.",
                "eventResponse"=>$var['data'][0]
            );
        }else{
            $result = array(
                "controller"=>"User",
                "action"=>"addevents",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function myGoalEventInvites_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'type'=>$this->input->post('type')
        ];
        if($data['type'] == 1){
        	$var = $this->Api_model->eventinvite($data);
        	$response = 'eventInviteResponse';
        }else{
        	$var = $this->Api_model->goalinvite($data);
        	$response = 'goalInviteResponse';
        }
        $result = array(
            'controller'=>'User',
            'action'=>'eventInvite',
            'ResponseCode'=>true,
            $response=>$var
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function acceptEventGoalInvite_post(){
        $data = array(
            'userId'=>$this->input->post('userid'),
            'id'=>$this->input->post('id'),
            'status'=>$this->input->post('status'), /* 1-accept, 2-decline*/
            'type'=>$this->input->post('type') /* 0-goal, 1-event */
        );
        $var = $this->Api_model->accepteventgoalinvite($data);

        $resVar = ($data['type'] == 0)?'Goal':'Event';
        $resTYpe = ($data['status'] == 1)?'accepted successfully':'declined';
        if($var == 3){
            $result = array(
                'controller'=>'User',
                'action'=>'acceptEventGoalInvite',
                'ResponseCode'=>false,
                'MessageWhatHappen'=> $resVar." id does not exists."
            );
        }else if($var == 2){
            $result = array(
                'controller'=>'User',
                'action'=>'acceptEventGoalInvite',
                'ResponseCode'=>false,
                'MessageWhatHappen'=>$resVar." invitation does not exists."
            );
        }else if($var == 1 && $data['status'] == 1 ){
            $result = array(
                'controller'=>'User',
                'action'=>'acceptEventGoalInvite',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>$resVar." invitation accepted successfully"
            );
        }else if($var == 0){
            $result = array(
                'controller'=>'User',
                'action'=>'acceptEventGoalInvite',
                'ResponseCode'=>false,
                'MessageWhatHappen'=>$resVar." invitation declined."
            );
        }
        $this->set_response($result ,REST_Controller::HTTP_OK);
    }

     public function getSorted_Friends_post(){
        $data = array(

            'userId'=>$this->input->post('userid'),
            'id'=>$this->input->post('id'),
            'type'=>$this->input->post('type') /* 0-goal, 1-event, 2-challenge*/            
        );
          $resVar = $this->Api_model->getSorted_Friends($data);


     if(empty($resVar)){
            $result = array(
                'controller'=>'User',
                'action'=>'getSorted_Friends',
                'ResponseCode'=>false,
                'MessageWhatHappen'=>"No user found",
                'friendListResponse'=>''
            );
        }else {
            $result = array(
                'controller'=>'User',
                'action'=>'getSorted_Friends',
                'ResponseCode'=>true,
                'MessageWhatHappen'=>"Friends without invitations",
                'friendListResponse'=> $resVar
            );
        }
        $this->set_response($result ,REST_Controller::HTTP_OK);

     }

    public function eventDetail_post(){
        $data = [
            'id'=>$this->input->post('eventid')
        ];
        $var = $this->Api_model->eventdetail($data);
        if($var == "empty"){
            $result = array(
                "controller"=>"User",
                "action"=>"eventDetail",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }else{
            $result = array(
                "controller"=>"User",
                "action"=>"eventDetail",
                "ResponseCode"=> true,
                "eventDetailResponse"=>$var
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function goalEventListing_post(){
        $data = [
            "userId"=>$this->input->post('userid'),
            "date"=>$this->input->post('date'),
            "type"=>$this->input->post('type')
        ];

        // function custom_sort($a,$b) {
        //     return strtotime($b->date_created)>strtotime($a->date_created);
        // }


        if($data['type'] == 0){
        	$var = $this->Api_model->goaleventlisting($data,"tbl_events.startDate = '".$data['date']."'","tbl_goalsCalender.start_date = '".$data['date']."'");
        }elseif($data['type'] == 1){
        	$signupweek = $data['date'];
		    for($i = 0; $i < 7 ; $i++){
			    $date = date('Y-m-d', strtotime("-".$i."days", strtotime($signupweek)));
			    $dayName = date('D', strtotime($date));
			    if($dayName == "Mon"){
			       $startdate = $date;
			    }
		    }
		 	for($i = 0; $i < 7 ; $i++){
		        $date = date('Y-m-d', strtotime("+".$i."days", strtotime($signupweek)));
		        $dayName = date('D', strtotime($date));
		     	if($dayName == "Sun"){
		       		$enddate = $date;
		     	}
		    }
        	$var = $this->Api_model->goaleventlisting($data,"YEARWEEK(startDate) = YEARWEEK('".$data['date']."')","start_date >='".$startdate."' AND end_date <='".$enddate."'");
        }elseif($data['type'] == 2){
        	$var = $this->Api_model->goaleventlisting($data,"( YEAR(tbl_events.startDate) = YEAR('".$data['date']."%') and MONTH(tbl_events.startDate) = MONTH('".$data['date']."%'))","( YEAR(tbl_goalsCalender.start_date) = YEAR('".$data['date']."%') and MONTH(tbl_goalsCalender.start_date) = MONTH('".$data['date']."%'))");
        }else{
        	$var = "error";
        }



        


        // print_r($var);die;
        if($var == "error"){
            $result = array(
                "controller"=>"User",
                "action"=>"goalEventListing",
                "ResponseCode"=> false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }else{
        //     usort($var, "custom_sort");
        // print_r($var);die;
            
            $result = array(
                "controller"=>"User",
                "action"=>"goalEventListing",
                "ResponseCode"=> true,
                "eventGoalListingResponse"=>$var
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function eventUpdate_post(){
        $data = [
            'id'=>$this->input->post('eventid'),
            'userId'=>$this->input->post('userid'),
            'eventTitle'=>$this->input->post('title'),
            'eventPlace'=>$this->input->post('place'),
            'eventComment'=>$this->input->post('comment'),
            'startDate'=>$this->input->post('startdate'),
            'endDate'=>$this->input->post('enddate'),
            'reminder'=>empty($this->input->post('reminder'))?'':$this->input->post('reminder').':00'
        ];
        // print_r($data);die;
        $slect = $this->Api_model->select_data('*','tbl_events',array('id'=>$data['id']));
        if(empty($slect)){
            $result = array(
                "controller"=>"User",
                "action"=>"eventUpdate",
                "ResponseCode"=>false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }else{
            $var = $this->Api_model->updateevent($data);
            if($var == "error"){
            	$result = array(
	                "controller"=>"User",
	                "action"=>"eventUpdate",
	                "ResponseCode"=>false,
	                "MessageWhatHappen"=>"You can't update this event as you're not the creater."
	            );
            }else{
	            $result = array(
	                "controller"=>"User",
	                "action"=>"eventUpdate",
	                "ResponseCode"=>true,
	                "MessageWhatHappen"=>"Event updated successfully.",
	                "eventResponse"=>$var[0]
	            );
	        }
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
//////////////////////////////////////////////////////////// Books & Resoures ///////////////////////////////////////////////////////////////////////////////////
    public function addUpdateBook_post(){
        $upload_data = $this->upload('public/books_img','BOOK','file');
        $data = [
            'userId'=>$this->input->post('userid'),
            'title'=>$this->input->post('title'),
            'description'=>$this->input->post('description'),
            'file'=>$upload_data,
            'status'=>$this->input->post('status'),
            'completeDate'=>$this->input->post('completedate'),
            'date_created'=>date('Y-m-d H:i:s')
        ];
        $id = $this->input->post('id');
        $var = $this->Api_model->addbook($data,$id);
        if($var == "insert"){
            $result = array(
                "controller"=>"User",
                "action"=>"addBook",
                "ResponseCode"=>true,
                "MessageWhatHappen"=>"Added successfully."
            );
        }else{
            $result = array(
                "controller"=>"User",
                "action"=>"addBook",
                "ResponseCode"=>true,
                "MessageWhatHappen"=>"Updated successfully."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function bookShare_post(){
        $bookid = $this->input->post('book_id');
        $share = $this->input->post('share_id');
        $var = $this->Api_model->bookshare($bookid,$share); 
        if($var == "insert"){
            $result = array(
                "controller"=>"User",
                "action"=>"bookShare",
                "ResponseCode"=>true,
                "MessageWhatHappen"=>"Request sent successfully."
            );
        }elseif($var == "already"){
            $result = array(
                "controller"=>"User",
                "action"=>"bookShare",
                "ResponseCode"=>false,
                "MessageWhatHappen"=>"You have already sent a request to this person."
            );
        }else{
            $result = array(
                "controller"=>"User",
                "action"=>"bookShare",
                "ResponseCode"=>false,
                "MessageWhatHappen"=>"something went wrong."
            );
        }
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function bookListing_post(){
        $data = [
            'userId'=>$this->input->post('userid'),
            'type'=>$this->input->post('type') /// 0-> all , 1->shared tab
        ];
        if($data['type'] == 0){
            $sell = $this->Api_model->select_data('*','tbl_bookResource',array('userId'=>$data['userId']),'date_created DESC');
        }else{
            $this->db->select('tbl_bookResource.*');
            $this->db->from('tbl_bookResource');
            $this->db->join('tbl_bookRequest','tbl_bookRequest.book_id = tbl_bookResource.id',LEFT);
            $this->db->where("tbl_bookRequest.to_id = '".$data['userId']."' AND tbl_bookRequest.status = 0");
            //$this->db->or_where("tbl_bookResource.userId = '".$data['userId']."'");
            $this->db->order_by('date_created DESC');
            $sell = $this->db->get()->result();
        }
        foreach ($sell as $key => $value) {
        	$value->ids = $value->id;
            if(!empty($value->file)){
                $value->file = base_url().''.$value->file;
            }
        }
        $result = array(
            "controller"=>"User",
            "action"=>"bookListing",
            "ResponseCode"=>true,
            "bookListingResponse"=>$sell
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function bookHide_post(){
        $data = [
            'to_id'=>$this->input->post('userid'),
            'book_id'=>$this->input->post('book_id')
            // 'status'=>$this->input->post('status') //// 0->unhide , 1->hide
        ];
        $var = $this->Api_model->select_data('*','tbl_bookRequest',array('book_id'=>$data['book_id'],'to_id'=>$data['to_id']));
        if(!empty($var)){
           $this->db->where('book_id',$var[0]->book_id);
           $this->db->where('to_id',$var[0]->to_id);
           $this->db->delete('tbl_bookRequest');
        }
        if(!empty($var)){
            $response = "hide";
            $code = true;
        }else{
            $response = "something went wrong.";
            $code = false;
        }
        $result = array(
            "controller"=>"User",
            "action"=>"bookHide",
            "ResponseCode"=>$code,
            "MessageWhatHappen"=>$response
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function markBookCompeleted_post(){
        $data = [
            'id'=>$this->input->post('id'),
            'status'=>$this->input->post('status'),
            'completeDate'=>$this->input->post('completedate')
        ];
        $sel = $this->Api_model->markbookcomplete($data);
        $result = array(
            "controller"=>"User",
            "action"=>"markBookCompeleted",
            "ResponseCode"=>true,
            "MessageWhatHappen"=>"Book marked as completed."
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
    public function deleteBook_post(){
        $id = $this->input->post('id');
        $var = $this->Api_model->deletebook($id);
        $result = array(
            "controller"=>"User",
            "action"=>"deleteBook",
            "ResponseCode"=>true,
            "MessageWhatHappen"=>"Deleted successfully."
        );
        $this->set_response($result,REST_Controller::HTTP_OK);
    }
   
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // public function reverse_get(){
    //     $name = "Rinkesh";
    //     $dd = implode(',',$name);
    //     print_r($dd);
    // }
    public function date_post(){
        // $minutes = $this->input->post('date');
        // $hours = floor($minutes / 60);
        // $min = $minutes - ($hours * 60);
        // if($hours == 0){
        //     $date1 = $minutes. " Minutes";
        // }else{
        //     $date1 =  $hours." Hours ".$min." Minutes";
        // }
        //$minutes = 250;
        // $zero    = new DateTime('@0');
        // $offset  = new DateTime('@' . $minutes * 60);
        // $diff    = $zero->diff($offset);
        // $date1 =  $diff->format('%h Hours, %i Minutes');
        // $result = array(
        //     "controller"=>"User",
        //     "action"=>"createevents",
        //     "ResponseCode"=>true,
        //     "eventsResponse"=>$date1
        // );
        // $af = array_flip($data);
            // $af['date_created'] = 'date_updated';
            // $arr = array_flip($af);
            // $arr['date_updated'] = date('Y-m-d H:i:s');
        // $this->set_response($result,REST_Controller::HTTP_OK);
    }
    // public function push_post(){
    //     $id = $this->input->post('userid');
    //     $selectRes = $this->db->select('*')->from('tbl_users')->where('id', $id)->get()->row();
    //     $selectPreviousUsers = $this->db->select('*')
    //                                      ->from('tbl_login')
    //                                      ->where('user_id',$selectRes->id)
    //                                      ->where('status',1)
    //                                      ->limit(1,'DESC')
    //                                      ->get()->row(); 
    //     $pushData['message'] = "hello,how are you";
    //     $pushData['action'] = "friendRequest";
    //     $pushData['token'] = $selectPreviousUsers->token_id;
    //     if($selectPreviousUsers->device_id == 1){
    //         $this->Api_model->iosPush($pushData);
    //     }else if($selectPreviousUsers->device_id == 0){
    //         $this->Api_model->androidPush($pushData);
    //     }  
    //     $this->set_response($result, REST_Controller::HTTP_OK); 
    // }
    // public function utc_post(){
    //     $date1 = $this->input->post('date');
    //    $date =  date('Y-m-d H:i:s',strtotime($date1));
    //     $cc = date('Y-m-d H:i:s');
    //     // print_r($cc);
    //     // echo "<br>";
    //     // print_r($date);
    //     $this->set_response($date,REST_Controller::HTTP_OK);
    // }
    // public function replace_get(){
    //     $bar = "http://phphosting.osvin.net/sunSoft";
    //    $this->db->query("UPDATE tbl_bookResource SET file = replace(file, 'http://phphosting.osvin.net/sunSoft/', '') WHERE file LIKE '".$bar."%' ");
    //     $var = $this->db->query("SELECT * FROM tbl_bookResource WHERE file LIKE '".$bar."%'")->result();
    //     $this->set_response($var,REST_Controller::HTTP_OK);
    // }

}

?>