<?php
error_reporting(1);
//ini_set('display_error', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct(){
	    parent::__construct();
	    $this->load->model('Admin_model','',TRUE);
	    $this->load->helper('url');
	    $this->load->library('session');
	    $session_data = $this->session->userdata('logged_in');
	    if(!$session_data){
	      redirect('Login');
	    }
	}
	public function template($data=null){
    	$session_data = $this->session->userdata('logged_in');
		$data['name']=$session_data['fullname'];
        $this->load->view('templete/header');
        $this->load->view('templete/headerpage',$data);
        $this->load->view('templete/sidebar');
    }
	public function index(){
		$data1 = $this->Admin_model->dashboard_data();
		$session_data = $this->session->userdata('logged_in');
		$data['name']=$session_data['fullname'];
        $this->load->view('templete/header');
        $this->load->view('templete/headerpage',$data);
        $this->load->view('templete/sidebar',$data1);
		$this->load->view('home');
		$this->load->view('templete/footer');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('Login');
	}
	public function category(){
		$result = $this->Admin_model->select_data('*','tbl_categories');
		foreach($result as $value){
			$value->image = base_url().''.$value->image; 
		}
		// echo "<pre>";print_r($result);die;
		$cat['cat'] = $result;
		$this->template();
		$this->load->view('category',$cat);
		$this->load->view('templete/footer');
	}
	public function updateCat($id){
		if(isset($_POST['updatecat'])){
	    	$config['upload_path'] ='public/img/dashboard_icon';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $config['max_size'] = '5000';
	        $config['max_width'] = '5024';
	        $config['max_height'] = '5068';
	        // $new_name = 'icon_'.time();
        	// $config['file_name'] = $new_name;
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
	        // print_r($image);die;
	        if(empty($data['file_name'])){
	            $data = array(
	            	'upperTitle'=>$this->input->post('uppertitle'),
	                'lowerTitle'=>$this->input->post('lowertitle')
	            );
	            $var = $this->Admin_model->updatcategory($data,$id);
	            if($var == "update"){
	            	$this->session->set_flashdata('cat_error','<p class="succ_msg">successfully updated!</p>');
	            	$this->category();
	            }else{
	            	$this->session->set_flashdata('cat_error','<p class="error_msg">please fill required data</p>');
	            	$this->category();
	            }	            
	        }else{
				$dataa = array(
					'upperTitle'=>$this->input->post('uppertitle'),
					'image'=>$image,
		            'lowerTitle'=>$this->input->post('lowertitle')
				);
				$var = $this->Admin_model->updatecategory($dataa,$id);
				if($var == "update"){
					$this->session->set_flashdata('cat_error','<p class="succ_msg">successfully updated!</p>');
	            	$this->category();
				}else{
					$this->session->set_flashdata('cat_error','<p class="error_msg">something went worng!</p>');
	            	$this->category();
				}
			}
		}else{
			$this->category();
		}
	}
	public function user_list(){
		$data=$this->Admin_model->user_list();
		$list['users'] = $data;
	    $this->template();
		$this->load->view('users',$list);
		$this->load->view('templete/footer');
	}
	public function accountEdit($id){
		if(isset($_POST['edit'])){
			$uid = base64_decode($id);
			$ids = explode('_',$uid);
			$id = $ids[0];
			$data = array(
				'fullname'=>$this->input->post('username')
			);
			if(empty($data['fullname'])){
				$this->session->set_flashdata('msg','<p class="error_msg">Name field empty!</p>');
				$this->user_list();
			}elseif(!preg_match("/^[a-zA-Z ]*$/",$data['fullname'])){
				$this->session->set_flashdata('msg','<p class="error_msg">Only alphabets are allowed!</p>');
				$this->user_list();
			}else{
				$result = $this->Admin_model->accountedit($data,$id);
				if($result == "update"){
					$this->session->set_flashdata('msg','<p class="succ_msg">successfully updated!</p>');
					$this->user_list();
				}
			}
		}else{
			$this->user_list();
		}
	}
	public function accountDelete($id){
		$uid = base64_decode($id);
		$ids = explode('_',$uid);
		$id = $ids[0];
		$result = $this->Admin_model->accountdelete($id);
		if($result == "delete"){
			$this->session->set_flashdata('msg','<p class="succ_msg">successfully deleted!</p>');
			$this->user_list();
		}
	}
	public function accountSuspend(){
		$id = $this->input->get('id');
		$result = $this->Admin_model->accountsuspend($id);
		//print_r($result);die;
		if($result == 1){
			echo "1";
		}else{
			echo "0";
		}
	}
	public function userActivity(){
		$type = 'task';
		$sel['userAct'] = $this->Admin_model->listAllTaskActivity($type);
		$this->template($sel);
		$this->load->view('activity');
		$this->load->view('templete/footer');
	}
	public function workingHour(){
		$type = 'goal';
		$result['data'] = $this->Admin_model->listAllTaskActivity($type);
		$this->template($result);
		$this->load->view('workhour');
		$this->load->view('templete/footer');
	}
	public function userEvent(){
		$type = 'event';
		$result['data'] = $this->Admin_model->listAllTaskActivity($type);
		$this->template($result);
		$this->load->view('events');
		$this->load->view('templete/footer');
	}
	public function chalenge(){
		$type = 'challenge';
		$result['data'] = $this->Admin_model->listAllTaskActivity($type);
		$this->template($result);
		$this->load->view('userChallenge');
		$this->load->view('templete/footer');
	}
	public function taskActivity(){
		$result['taskAct'] = $this->Admin_model->taskactivity();
		$this->template();
		$this->load->view('taskactivity',$result);
		$this->load->view('templete/footer');
	}
	public function addActivity(){
		if(isset($_POST['addTask'])){
			$data = array(
				'taskTitle'=>$this->input->post('title'),
				'date_created'=>date('Y-m-d H:i:s')
			);
			if(empty($data['taskTitle'])){
				$this->session->set_flashdata('errmsg','<p class="error_msg">Empty title field</p>');
				$this->template();
				$this->load->view('addcategory');
				$this->load->view('templete/footer');
			}else{
				$sel = $this->Admin_model->insert_data('tbl_taskActivity',$data);
				$this->template();
				$this->session->set_flashdata('errmsg','<p class="succ_msg">Task Added Successfully</p>');
				$this->load->view('addcategory');
				$this->load->view('templete/footer');
			}
		}else{
			$this->template();
			$this->load->view('addcategory');
			$this->load->view('templete/footer');
		}
	}
	public function updateTaskActivity($id){
		if(isset($_POST['update'])){
			$title = $this->input->post('tasktitle');
			$res = $this->Admin_model->updatetaskact($id,$title);
			if($res == "updated"){
				$this->session->set_flashdata('update','Updated Successfully');
				$this->taskActivity();
			}
		}
	}
	public function activityList($cat_id,$id){
		$uid = base64_decode($id);
		$ids = explode('_',$uid);
		$id = $ids[0];
		$cid = base64_decode($cat_id);
		$catid = explode('_',$cid);
		$cat_id = $catid[0];
		$result['weekList']  = $this->Admin_model->TotalList($cat_id,$id,$helo=6);
		$result['monthList'] = $this->Admin_model->TotalList($cat_id,$id,$helo=30);
		$result['yearList']  = $this->Admin_model->TotalList($cat_id,$id,$helo=365);
		$this->template();
		$this->load->view('taskdetail',$result);
		$this->load->view('templete/footer');
	}

	public function activityDetail($id){
		$uid = base64_decode($id);
		$ids = explode('_',$uid);
		$id = $ids[0];
		$data['details'] = $this->Admin_model->select_data('*','tbl_taskWork',array('userId'=>$id));
		$name['username'] = $this->db->query("SELECT fullname FROM tbl_users WHERE id = '".$id."'")->row()->fullname;
		$this->template($data);
		$this->load->view('activitydetail',$name);
		$this->load->view('templete/footer');
	}
	public function workingDetail($id){
		$uid = base64_decode($id);
		$ids = explode('_',$uid);
		$id = $ids[0];
		$result['detail'] = $this->Admin_model->workdetail($id);
		// echo"<pre>";print_r($result);die;
		$name['username'] = $this->db->query("SELECT fullname FROM tbl_users WHERE id = '".$id."'")->row()->fullname;
		$this->template($result);
		$this->load->view('workdetail',$name);
		$this->load->view('templete/footer');
	}
	public function detailEvents($id){
		$uid = base64_decode($id);
		$ids = explode('_',$uid);
		$id = $ids[0];
		$result['detail'] = $this->Admin_model->select_data('*','tbl_events',array('userId'=>$id));
		$name['username'] = $this->db->query("SELECT fullname FROM tbl_users WHERE id = '".$id."'")->row()->fullname;
		$this->template($result);
		$this->load->view('eventdetails',$name);
		$this->load->view('templete/footer');
	}
	public function detailsChallenge($id){
		$uid = base64_decode($id);
		$ids = explode('_',$uid);
		$id = $ids[0];
		$result['detail'] = $this->Admin_model->select_data('*','tbl_challenge',array('userId'=>$id));
		$name['username'] = $this->db->query("SELECT fullname FROM tbl_users WHERE id = '".$id."'")->row()->fullname;
		$this->template($result);
		$this->load->view('userChallengeDetail',$name);
		$this->load->view('templete/footer');
	}
	public function UsersReport(){
		$sel = $this->Admin_model->select_data('*','tbl_categories');
		$cat_id = $sel[7]->id;
		$data['reports'] = $this->Admin_model->reports();
		$this->template();
		$this->load->view('report',$data);
		$this->load->view('templete/footer');
	}

    public function AllReport($userId){
		$data['result'] = $this->Admin_model->select_dataaa('*','tbl_reports',array("userId"=>$userId));
		$this->template();
		$this->load->view('userreport',$data);
		$this->load->view('templete/footer');
	}
	public function challengeType(){
		$data['list'] = $this->Admin_model->select_data('*','tbl_challenge',array('type'=>2));
		$this->template();
		$this->load->view('challenge2',$data);
		$this->load->view('templete/footer');
	}
	public function challengeEdit(){
		$id = $this->input->post('ejd');
		$data = array(
			'title'=>$this->input->post('title'),
			'description'=>$this->input->post('description')
		);
		$upd = array_filter($data);
		$var = $this->Admin_model->update_data('tbl_challenge',$upd,array('type'=>2,'id'=>$id));
		if($var == 1){
			echo "1";
		}else{
			echo "0";
		}
	}
	public function addChallenge(){
		$this->template();
		$this->load->view('challenge3',$data);
		$this->load->view('templete/footer');
	}
	public function addchlge(){
		// if(!empty($_POST['title'])){
		// 	echo "hello";
		// }
		$data = [
			'type'=>2,
			'title'=>$this->input->post('title'),
			'description'=>$this->input->post('description')
		];
		$result = $this->Admin_model->insert_data('tbl_challenge',$data);
		echo "1";
	}
	public function challengeDelete($id){
		$this->db->where('id',$id);
		$this->db->delete('tbl_challenge');
		$this->session->set_flashdata('errmsg','<p class="succ_msg">successfully deleted!</p>');
		redirect('challenge');
	}

	/* Dashboard */
 //    //category list
	public function category_list(){
		$data['category']=$this->Admin_model->category_list();
	    $this->template();
		$this->load->view('catlist',$data);
	}
	public function quotes(){
		$result['quote'] = $this->Admin_model->select_data('*','tbl_quotes');
		// print_r($result);die;
		$this->template();
		$this->load->view('quotes',$result);
		$this->load->view('templete/footer');
	}
	public function addQuotes(){
		if(isset($_POST['addquote'])){
			$data = [
				'quote'=>$this->input->post('quotetitle'),
				'date_created'=>date('Y-m-d H:i:s')
			];
			if(empty($data['quote'])){
				$this->session->set_flashdata('errorquo','<p class="error_msg">Empty title field</p>');
			}else{
				$result = $this->Admin_model->insert_data('tbl_quotes',$data);
				$this->session->set_flashdata('errorquo','<p class="succ_msg">Quote add sucessfully.</p>');
			}
		}
		
		$this->template();
		$this->load->view('addquote');
		$this->load->view('templete/footer');
	}
	public function updateQuote(){
			$quote = $this->input->post('quote');
			$id = $this->input->post('id');
			$sel = $this->Admin_model->select_data('*','tbl_quotes',array('id'=>$id));
			if(strlen($sel[0]->quote) == strlen($quote)){
				echo "no";
			}else{
				$result = $this->Admin_model->update_data('tbl_quotes',array('quote'=>$quote),array('id'=>$id));
				echo $result;
			}
	}
	public function delete_quote($id){
		$this->db->where('id',$id);
		$this->db->delete('tbl_quotes');
		$this->session->set_flashdata('delquo','<p class="succ_msg">sucessfully deleted!</p>');
		redirect('Dashboard/quotes');

	}
	public function spline($id){
		if($id == 1){
			$table = 'tbl_goalsCalender';$field = 'start_date';
		}
		if($id == 2){
			$table = 'tbl_events';$field = 'startDate';
		}
		if($id == 3){
			$table = 'tbl_taskWork';$field = 'DATE(date_created)';
		}
		if($id == 4){
			$table = 'tbl_challenge';$field = 'startDate';
		}
	    for($i = 0; $i < 30 ; $i++){
	    	$date = date('Y-m-d', strtotime(' -'.$i.' day'));
	    	$s = strtotime($date).'000';
	    	$ss = $this->db->query("SELECT count(id) as id FROM ".$table." WHERE ".$field." = '".$date."'  ")->row()->id;
          $question = array(
            'datee'=>(int)$s,
            'units'=>(int)$ss
            );
          $dataaa[] = json_encode($question);
        }
        $stringg ="[".implode(',',$dataaa)."]";
        echo $stringg;
	}
	// public function spline1(){
	//     for($i = 0; $i < 30 ; $i++){
	//     	$date = date('Y-m-d', strtotime(' -'.$i.' day'));
	//     	$s = strtotime($date).'000';
	//     	$ss = $this->db->query("SELECT count(id) as id FROM tbl_events WHERE startDate = '".$date."'  ")->row()->id;
 //          $question = array(
 //            'datee'=>(int)$s,
 //            'units'=>(int)$ss
 //            );
 //          $dataaa[] = json_encode($question);
 //        }
 //        $stringg ="[".implode(',',$dataaa)."]";
 //        echo $stringg;
	// }
	// // view for addcatgeory
	// // category adding
	// public function addedcat(){
	// 	if (isset($_POST)) {
	// 		if (empty($_POST['name'] && $_POST['hint'] && $_POST['description'])) {
	// 			echo "please fill all fields";
	// 		}
	// 		else{
	// 					$data = array(
	// 					'name' => $_POST['name'] ,
	// 					'hint' => $_POST['hint'] ,
	// 					'description' => $_POST['description'],
	// 					'type' =>'1',
	// 					);

	// 			$result = $this->db->insert('tbl_cat', $data);
	// 			if ($result) {
	// 				 $this->session->set_flashdata('msg4', 'Category Added Sucessfully');
	// 				redirect('Dashboard/category_list');
	// 			}
	// 		 }
	// 	}

	// }
	// //edit category list
	// public function editcatlist(){
	// 	if(isset($_POST)) {
	// 		if(empty($_POST['name']|| $_POST['hint'] || $_POST['description']  )){
	// 			$this->session->set_flashdata('msg1', 'Please fill valid fields');
	//             redirect(base_url()."Dashboard/category_list");
	//         }
	// 	    $id=$_POST['submitid'];
	// 	    $edge = array('name' => $_POST['name'], 'hint' => $_POST['hint'],'description' => $_POST['description']);
 //            $plans=array_filter($edge);
 //            $this->db->where('id', $id);
 //            $result= $this->db->update('tbl_cat', $plans);
 //            if($result){
 //            	$this->session->set_flashdata('msg2', 'Category Updated Sucessfully');
 //                redirect(base_url()."Dashboard/category_list");
 //            }else{
 //               $this->session->set_flashdata('msg3', 'Something Went Wrong');
 //               redirect(base_url()."Dashboard/category_list");
 //            }
	// 	}
	// }
	// public function userdetail(){
	//     $this->template();
	// 	$this->load->view('detail');
	// }

}
