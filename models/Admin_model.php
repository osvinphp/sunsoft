<?php
class Admin_model extends CI_Model {

	function login($email, $password) {
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$this->db->where('type','2');
		// $this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	public function dashboard_data(){
		$sel = $this->db->query("SELECT id FROM tbl_categories")->result();
		$task = $this->db->query("SELECT count(id) as task FROM tbl_taskWork")->row()->task;
		$challenge = $this->db->query("SELECT count(id) as chalenge FROM tbl_challenge WHERE userId != 0 ")->row()->chalenge;
		//$work = $this->db->query("SELECT * FROM tbl_task WHERE category_Id = '".$sel[1]->id."' ")->num_rows();
		//$goal = $this->db->query("SELECT * FROM tbl_weeklyGoals  ")->num_rows();
		// $report = $this->db->query("SELECT * FROM tbl_reports ")->num_rows();
		///print_r($task);
		//print_r($work);
		//print_r($report);die;
		
	//	$total = $this->db->query("SELECT * FROM tbl_task WHERE type = 1 ")->num_rows();
		//$login = $this->db->query("SELECT * FROM tbl_login WHERE status = 1 ")->num_rows();
		$total = $this->db->query("SELECT count(id) as total FROM tbl_users WHERE type = 1 ")->row()->total;
		//echo "<pre>";print_r($total);die;
		$logi = $this->db->query("SELECT distinct user_id FROM tbl_login WHERE status = 1 ")->result();
		$login = count($logi);
		$suspnd = $this->db->query("SELECT * FROM tbl_users WHERE type = 1 and is_suspend = 1")->num_rows();
		$data1 = array(
			'total'=>$total,
			'login'=>$login,
			'suspend'=>$suspnd,
			'work'=>$work,
			'goal'=>$goal,
			'task'=>$task,
			'report'=>$report,
			'challenge'=>$challenge
		);
		return $data1;
	}
	public function updatcategory($data,$id){
		$sel = $this->db->query("SELECT * FROm tbl_categories Where id='".$id."'")->row();
		if(empty($sel)){
			return "empty";
		}else{
			switch($data){
				case (empty($data['upperTitle']) && empty($data['lowerTitle'])):
						return "error";
						break;
				case (!empty($data['upperTitle']) && empty($data['lowerTitle'])):						
						$upd = array('upperTitle'=>$data['upperTitle']);
						break;
				case (empty($data['upperTitle']) && !empty($data['lowerTitle'])):
						$upd = array('lowerTitle'=>$data['lowerTitle']);
						break;
				default:
					$upd = $data;
					break;
			}
			$this->db->where('id',$sel->id);
			$this->db->update('tbl_categories',$upd);
			return "update";
		}
	}
	public function updatecategory($dataa,$id){
		$sel = $this->db->query("SELECT * From tbl_categories Where id='".$id."'")->row();
		if(empty($sel)){
			return "empty";
		}else{
			$image = str_replace("public/img/dashboard_icon", '', $sel->image);
			$path = 'public/img/dashboard_icon'.$image;
			unlink($path);
			switch($dataa){
				case (empty($dataa['upperTitle']) && empty($dataa['lowerTitle'])):
						$upd = array('image'=>$dataa['image']);
						break;
				case (!empty($dataa['upperTitle']) && empty($dataa['lowerTitle'])):						
						$upd = array('upperTitle'=>$dataa['upperTitle'],'image'=>$dataa['image']);
						break;
				case (empty($dataa['upperTitle']) && !empty($dataa['lowerTitle'])):
						$upd = array('image'=>$dataa['image'],'lowerTitle'=>$dataa['lowerTitle']);
						break;
				default:
					$upd = $dataa;
					break;
			}
			$this->db->where('id',$sel->id);
			$this->db->update('tbl_categories',$upd);
			return "update";
		}
	}
	public function select_data1($tbl_name,$id){
        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where('id',$id);
        $sel1 = $this->db->get()->row();
        return $sel1;
    }
    public function select_data($select,$tbl_name,$where=null,$order=null){
        if(empty($where)&&empty($order)){
	        $this->db->select($select);
	        $this->db->from($tbl_name);
	        $query = $this->db->get()->result();
	    }elseif(empty($order)){
		    $this->db->select($select);
			$this->db->from($tbl_name);
			$this->db->where($where);
			$query = $this->db->get()->result();
		}else{
		    $this->db->select($selection);
            $this->db->from($tbl_name);
            $this->db->where($where);
            $this->db->order_by($order);
            $query = $this->db->get()->result();
		}
    	return $query;
    }
	public function user_list(){
		$sel = $this->db->query("SELECT * FROM tbl_users Where type= 1 ORDER BY id ASC")->result();
		// foreach($sel as $value){
		// 	// $query = $this->db->query("SELECT sum(taskHour) as workhour FROM tbl_task WHERE userId = '".$value->id."'")->row()->workhour;
		// 	// $value->workhour = empty($query)?'':$query;
		// }
		return $sel;	
	}
	public function accountedit($data,$id){
		$update = array('fullname'=>$data['fullname']);
		$this->db->where('id',$id);
		$this->db->update('tbl_users',$update);
		return "update";
	}
	public function accountdelete($id){
		$sel = $this->db->query("SELECT * From tbl_users Where id = '".$id."'")->row();
		$this->db->where('id',$id);
	    $this->db->delete('tbl_users');
		if(empty($sel->profile_pic)){
			return "delete";
		}else{
			$image = str_replace("public/profile_pic/", '', $sel->profile_pic);
			//print_r($image);die;
			$path = 'public/profile_pic/'.$image;
			unlink($path);
			return "delete";
		}
		
	}
	public function accountsuspend($id){
		$sel = $this->db->query("SELECT is_suspend From tbl_users Where id = '".$id."'")->row()->is_suspend;
		//print_r($sel);die;
		if($sel == 0){
			$upd = array('is_suspend'=>1);
			$this->db->where('id', $id);
			$this->db->update('tbl_users',$upd);
			return "1";
		}else{
			$upd = array('is_suspend'=>0);
			$this->db->where('id', $id);
			$this->db->update('tbl_users',$upd);
			return "0";
		}
	}
	public function insert_data($tbl_name,$data){
        $this->db->insert($tbl_name,$data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
	public function taskactivity(){
		$sel = $this->db->query("SELECT * FROM tbl_taskActivity")->result();
		return $sel;
	}
	public function updatetaskact($id,$title){
		$this->db->where('id',$id);
		$this->db->update('tbl_taskActivity',array('taskTitle'=>$title));
		return "updated";
	}
	public function listAllTaskActivity($type){
		if($type == "task"){
			$table = 'tbl_taskWork';
		}elseif($type == "goal"){
			$table = 'tbl_goalsCalender';
		}elseif($type == "event"){
			$table = 'tbl_events';
		}elseif($type == "challenge"){
			$table = 'tbl_challenge';
		}
		$sel = $this->db->query("SELECT DISTINCT userId FROM ".$table." ORDER BY date_created DESC ")->result();
		foreach($sel as $key => $value){
			$count = $this->db->query("SELECT count(id) as id FROM ".$table." WHERE userId = '".$value->userId."'")->row()->id;
			if($type == "goal"){
				$sum = $this->db->query("SELECT sum(total_time) as total FROM ".$table." WHERE userId = '".$value->userId."'")->row()->total;
			}
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('id',$value->userId);
			$query = $this->db->get()->row();
			$user_id = $query->id;
			$fullname = $query->fullname;
			if(empty($query)){
				unset($sel[$key]);
			}elseif(empty($query) && empty($count)){
				unset($sel[$key]);
			}else{
				$value->fullname = $fullname;
				$value->total = $count;
				if($type == "goal"){
					$value->sum = $sum;
				}
			}
		}
		return $sel;
	}
	public function TotalList($cat_id,$id,$days){
		if($days == 6){
			$sel = $this->db->query("SELECT * FROM tbl_task WHERE userId='".$id."' and category_Id='".$cat_id."' and YEARWEEK(date_created) = YEARWEEK(NOW()) ORDER BY date_created DESC")->result();
		}elseif($days == 30){
			$sel = $this->db->query("SELECT * FROM tbl_task WHERE userId='".$id."' and category_Id='".$cat_id."' and YEAR(date_created) = YEAR(CURRENT_DATE()) and MONTH(date_created) = MONTH(CURRENT_DATE()) ORDER BY date_created DESC")->result();
		}elseif($days == 365){
			$sel = $this->db->query("SELECT * FROM tbl_task WHERE userId='".$id."' and category_Id='".$cat_id."' and YEAR(date_created) = YEAR(CURRENT_DATE()) ORDER BY date_created DESC")->result();
		}
		foreach($sel as $value){
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('id',$value->userId);
			$query = $this->db->get()->row()->fullname;
			$value->fullname = empty($query)?'':$query;
		}
		return $sel;
	}
	public function activitydetail($id,$taskid){
		$this->db->select('fullname,tbl_users.id as userId,tbl_task.category_Id,tbl_task.taskTitle as TaskTitle,tbl_taskActivity.taskTitle as ActivityTitle,tbl_taskActivityItem.taskId as taskId,tbl_taskActivityItem.taskDescription,tbl_taskActivityItem.date_created');
		$this->db->from('tbl_taskActivityItem');
		$this->db->where('tbl_taskActivityItem.userId',$id);
		$this->db->where('tbl_taskActivityItem.taskId',$taskid);
		$this->db->join('tbl_taskActivity','tbl_taskActivity.id = tbl_taskActivityItem.subTaskId','left');
		$this->db->join('tbl_task','tbl_task.id = tbl_taskActivityItem.taskId');
		$this->db->join('tbl_users','tbl_users.id = tbl_taskActivityItem.userId');
		$sel = $this->db->get()->result();
		$ssl = $this->db->query("SELECT userId,category_Id,(select fullname from tbl_users where id='".$id."') as fullname FROM tbl_task where id ='".$taskid."' and userID = '".$id."'")->result();
		$data = array(
			'back'=>$ssl,
			'data'=>$sel
		);
		return $data;
	}
	public function workdetail($id){
	    $this->db->select('*');
        $this->db->from('tbl_goalsCalender');
        $this->db->where('userId',$id);
        $this->db->order_by('start_date','desc');
        $sel = $this->db->get()->result();
		foreach($sel as $value){
			$this->db->select('*');
			$this->db->from('tbl_goalsCalenderRules');
			$this->db->where('goalId',$value->id);
			$query = $this->db->get()->result();
			$value->workDes = empty($query)?'':$query;
		}
		return $sel;
	}
	// public function select_data($data,$table){
	//     $this->db->select($data);
	//     $this->db->from($table);
	//     $query = $this->db->get();
	//     if ( $query->num_rows() > 0 )
	//     {
	//       $row = $query->result();
	//       return $row;
	//     }
	// }
  	public function select_dataaa($data,$table,$where){
	    $getData = $this->db->select($data)
	                        ->from($table)
	                        ->where($where)
	                        ->get()->result();
	        foreach($getData as $value){
				$this->db->select('*');
				$this->db->from('tbl_users');
				$this->db->where('id',$value->userId);
				$query = $this->db->get()->row()->fullname;
				$value->fullname = empty($query)?'':$query;
			}
	    return $getData;
  	}
  	public function update_data($table,$data,$where){
	    $this->db->where($where);
	    $this->db->update($table, $data);
	    $rows= $this->db->affected_rows();
	    if($rows){
	      return 1;
	    }else{
	      return 0;
	    }
  	}
  function delete($table_name,$where){
    if(count($where)>0){
      $this->db->where($where);
    }
    $this->db->delete($table_name);
  }
  public function reports(){
  	$this->db->distinct();
	$this->db->select('userId, tbl_users.fullname as name');
	$this->db->from('tbl_reports');
	$this->db->join('tbl_users','tbl_users.id = tbl_reports.userId');
	$sel = $this->db->get()->result();
	foreach ($sel as $value) {
		$query = $this->db->query("SELECT * from tbl_reports Where userId = '".$value->userId."' ")->num_rows();
   		$value->totalReport = empty($query)?'':$query;
	}
	return $sel;
  }
 //  public function reports($data,$table){     
 //  	$this->db->distinct();
	// $this->db->select('userId, tbl_users.fullname as name');
	// $this->db->from('tbl_reports');
	// $this->db->join('tbl_users','tbl_users.id = tbl_reports.userId');
	// $sel = $this->db->get()->result();
	// return $sel;
 //  }

	/* Dashboard */
	// function dashboard_details(){
	// 	$select_user = $this->db->get_where('user');
	// 	$get_user = count($select_user->result());
	// 	return $get_user;
	// }
	// public function view_data(){
	// 	$res = $this->db->select('tbl_users.id,tbl_users.fullname,tbl_users.email,tbl_users.fb_id,tbl_addpark.add,tbl_booking.booked_id,tbl_booking.check_in_time,tbl_booking.check_out_time')
	// 	->from('tbl_users')
	// 	->Join('tbl_addpark','tbl_users.id = tbl_addpark.user_id','left')
	// 	->join('tbl_booking','tbl_users.id=tbl_booking.user_id','left')
	// 	->get()->result();
	// 	return $res;
	// }
	// public function edit_data(){
	// 	$query=$this->db->select('*')
	// 	->from('tbl_users')
	// 	->get()->result();
	// 	return $query;
	// 	//print_r($query);die;
	// }
	// public function update_data($table,$data,$where){
	// 	$this->db->where($where);
 //        $result=$this->db->update($table, $data);                          //to update data in the table
	// 	$updated_status = $this->db->affected_rows(); 
	// 	if($updated_status){   
	// 		return 1; 
	// 	}else{    
	// 		return 0; 
 //        }
	// }	
	// public function category_list(){
	// 	$data=$this->db->get_where('tbl_categories')->result();
	// 	return $data;
	// }
	

}




