<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Api_model extends CI_Model{

	public function signup($data){
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->where('email',$data['email']);
		$sel = $this->db->get()->row();
		if(empty($sel)){
			$ins_data = array(
				'fullname'=>$data['fullname'],
				'email'=>$data['email'],
				'password'=>$data['password'],
				'loginType'=>$data['loginType'],    
				'type'=>1,
				'date_created'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_users',$ins_data);
			$last_id = $this->db->insert_id();
			$log_data = array(
				'user_id'=>$last_id,
				'unique_deviceId'=>$data['unique_deviceId'],
				'device_id'=>$data['device_id'],
				'token_id'=>$data['token_id'],
				'status'=> 1,
				'date_created'=>date('Y-m-d H:i:s')
				);
			$this->db->insert('tbl_login',$log_data);
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('id',$last_id);
			$slct = $this->db->get()->row();
			return $slct;
		}else{
			return "error";
		}
	}
		public function logsign($data){                /////// fb/google(sign/login)
			if($data['loginType'] == 2){
				$this->db->select('*');
				$this->db->from('tbl_users');
				$this->db->where('email',$data['email']);
				$sel1 = $this->db->get()->row();
				if(empty($sel1)){
					$ins_data = array(
						'fullname'=>$data['fullname'],
						'email'=>$data['email'],
						'fb_id'=>$data['fb_id'],
						'loginType'=>$data['loginType'],
						'type'=>1,
						'profile_pic'=>$data['profile_pic'],
						'date_created'=>date('Y-m-d H:i:s')
						);
					$this->db->insert('tbl_users',$ins_data);
					$last_id = $this->db->insert_id();
					$log_data = array(
						'user_id'=>$last_id,
						'unique_deviceId'=>$data['unique_deviceId'],
						'device_id'=>$data['device_id'],
						'token_id'=>$data['token_id'],
						'status'=> 1,
						'date_created'=>date('Y-m-d H:i:s')
						);
					$this->db->insert('tbl_login',$log_data);
					$this->db->select('*');
					$this->db->from('tbl_users');
					$this->db->where('id',$last_id);
					$slct = $this->db->get()->row();
					$slct->emailExist = 'new';
					$msg = array(
						// 'type'=>'new',
						'signup'=>'success',
						'response'=>$slct
						);
					return $msg;
				}else{
					if($sel1->is_suspend == 1){
						return "suspend";
					}else{
						if(empty($sel1->profile_pic)){
							$this->db->where('email',$data['email']);
							$ss = $this->db->update('tbl_users',array('fb_id'=>$data['fb_id'],'loginType'=>$data['loginType'],'profile_pic'=>$data['profile_pic']));
							if($ss = true){
								$log_data = array(
									'user_id'=>$sel1->id,
									'unique_deviceId'=>$data['unique_deviceId'],
									'device_id'=>$data['device_id'],
									'token_id'=>$data['token_id'],
									'status'=> 1,
									'date_created'=>date('Y-m-d H:i:s')
									);
								$this->db->insert('tbl_login',$log_data);
								$send = $this->db->query("SELECT * FROM tbl_users where email ='".$data['email']."'")->row();
								$send->emailExist = 'exist';
								$msg = array(
									'signup'=>'success',
									'response'=>$send
									);
								return $msg;
							}else{
								echo "2";
							}
						}else{
							$this->db->where('email',$data['email']);
							$ss = $this->db->update('tbl_users',array('fb_id'=>$data['fb_id'],'loginType'=>$data['loginType']));
							if($ss = true){
								$log_data = array(
									'user_id'=>$sel1->id,
									'unique_deviceId'=>$data['unique_deviceId'],
									'device_id'=>$data['device_id'],
									'token_id'=>$data['token_id'],
									'status'=> 1,
									'date_created'=>date('Y-m-d H:i:s')
									);
								$this->db->insert('tbl_login',$log_data);
								$send = $this->db->query("SELECT * FROM tbl_users where email ='".$data['email']."'")->row();
								$send->emailExist = 'exist';
								$msg = array(
									'signup'=>'success',
									'response'=>$send
									);
								return $msg;
							}else{
								echo "2";
							}
						}
					}
				}
			}elseif($data['loginType'] == 3){
				$this->db->select('*');
				$this->db->from('tbl_users');
				$this->db->where('email',$data['email']);
				// $this->db->where('google_id',$data['google_id']);
				$sel2 = $this->db->get()->row();
				if(empty($sel2)){
					$ins_data = array(
						'fullname'=>$data['fullname'],
						'email'=>$data['email'],
						'google_id'=>$data['google_id'],
						'loginType'=>$data['loginType'],
						'type'=>1,
						'profile_pic'=>$data['profile_pic'],
						'date_created'=>date('Y-m-d H:i:s')
						);
					$this->db->insert('tbl_users',$ins_data);
					$last_id = $this->db->insert_id();
					$log_data = array(
						'user_id'=>$last_id,
						'unique_deviceId'=>$data['unique_deviceId'],
						'device_id'=>$data['device_id'],
						'token_id'=>$data['token_id'],
						'status'=> 1,
						'date_created'=>date('Y-m-d H:i:s')
						);
					$this->db->insert('tbl_login',$log_data);
					$this->db->select('*');
					$this->db->from('tbl_users');
					$this->db->where('id',$last_id);
					$slct = $this->db->get()->row();
					$slct->emailExist = 'new';
					$msg = array(
						'signup'=>'success',
						'response'=>$slct
						);
					return $msg;
				}else{
					if($sel2->is_suspend == 1){
						return "suspend";
					}else{
						if(empty($sel2->profile_pic)){
							$this->db->where('email',$data['email']);
							$ss = $this->db->update('tbl_users',array('google_id'=>$data['google_id'],'loginType'=>$data['loginType'],'profile_pic'=>$data['profile_pic']));
							if($ss = true){
								$log_data = array(
									'user_id'=>$sel2->id,
									'unique_deviceId'=>$data['unique_deviceId'],
									'device_id'=>$data['device_id'],
									'token_id'=>$data['token_id'],
									'status'=> 1,
									'date_created'=>date('Y-m-d H:i:s')
									);
								$this->db->insert('tbl_login',$log_data);
								$send = $this->db->query("SELECT * FROM tbl_users where email ='".$data['email']."'")->row();
								$send->emailExist = 'exist';
								$msg = array(
									// 'type'=>'exist',
									'signup'=>'success',
									'response'=>$send
									);
								return $msg;
							}else{
								echo "2";
							}
						}else{
							$this->db->where('email',$data['email']);
							$ss = $this->db->update('tbl_users',array('google_id'=>$data['google_id'],'loginType'=>$data['loginType']));
							if($ss = true){
								$log_data = array(
									'user_id'=>$sel2->id,
									'unique_deviceId'=>$data['unique_deviceId'],
									'device_id'=>$data['device_id'],
									'token_id'=>$data['token_id'],
									'status'=> 1,
									'date_created'=>date('Y-m-d H:i:s')
									);
								$this->db->insert('tbl_login',$log_data);
								$send = $this->db->query("SELECT * FROM tbl_users where email ='".$data['email']."'")->row();
								$send->emailExist = 'exist';
								$msg = array(
									// 'type'=>'exist',
									'signup'=>'success',
									'response'=>$send
									);
								return $msg;
							}else{
								echo "2";
							}
						}
					}
				}
			}else{
				echo "error";
			}
		}
		public function login($data){
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('email',$data['email']);
			$this->db->where('password',$data['password']);
			$this->db->where('type',1);
			$qury = $this->db->get()->row();
			if(empty($qury)){
				return "empty";
			}else{
				if($qury->is_suspend == 1){
					return "suspend";
				}else{
				 	// $sel = $this->db->query("SELECT user_id from tbl_login Where user_id = '".$qury->id."' ORDER BY id desc")->row()->user_id;
				  //   $update = array(
				  //       'status'=>0
				  //   );
				  //   $this->db->where('user_id',$sel);
				  //   $upd = $this->db->update('tbl_login',$update);
				  //   if($upd == true){
					$logintype = array('loginType'=>1);
					$this->db->where('id',$qury->id);
					$this->db->update('tbl_users',$logintype);
					$log_data = array(
						'user_id'=>$qury->id,
						'unique_deviceId'=>$data['unique_deviceId'],
						'device_id'=>$data['device_id'],
						'token_id'=>$data['token_id'],
						'status'=> 1,
						'date_created'=>date('Y-m-d H:i:s')
						);
					$insrt = $this->db->insert('tbl_login',$log_data);
					$last_id = $this->db->insert_id();
					$this->db->select('tbl_users.id as id,fullname,email,profile_pic,notification_status,loginType,type,status');
					$this->db->from('tbl_login');
					$this->db->join('tbl_users','tbl_users.id = tbl_login.user_id');
					$this->db->where('tbl_login.id',$last_id);
					$send = $this->db->get()->row();
					$msg = array(
						'msg'=>"login",
						'send'=>$send
						);
					return $msg;
					//}
				}
			}
		}
		public function changepassword($data){
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('id',$data['id']);
			$this->db->where('password',$data['oldpassword']);
			$sel = $this->db->get()->row();
			if(empty($sel)){
				return "error";
			}else{
				$ins = $this->db->where('id',$data['id']);
				$this->db->update('tbl_users',array('password'=>$data['newpassword']));
				return "update";
			}
		}
		public function forgotpassword($email){
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('email',$email);
			$sel = $this->db->get()->row();
			if(empty($sel)){
				return "error";
			}else{
				$email1 = $sel->email;
				$userid = $sel->id;
				$static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
				$id = $userid . "_" . $static_key;
				$result['b_id'] = base64_encode($id);
				$result['name'] = $sel->fullname;		       
				return $result;
			}
		}
		public function updateNewpassword($data){
			$update = $this->db->where('id',$data['id']);
			$this->db->update('tbl_users',array('password'=>md5($data['password'])));
			return "update";
		}
		public function viewprofile($data){
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('id',$data['userid']);
			$sel = $this->db->get()->row();
			// $sel->profile_pic = base_url().''.$sel->profile_pic;
			if(empty($sel)){
				return "error";
			}else{
				return $sel;
			}
		}
		public function updateprofile($dataa){
			$this->db->select('*');
			$this->db->from('tbl_users');
			$this->db->where('id',$dataa['id']);
			$sel = $this->db->get()->row();
			if(empty($sel)){
				return "error";
			}else{
				$profle_updte = $this->db->where('id',$dataa['id']);
				$this->db->update('tbl_users',array('fullname'=>$dataa['fullname']));
				$pro_data = $this->db->query("SELECT * FROM tbl_users Where id = '".$dataa['id']."' ")->row();
				return $pro_data;
			}
		}
		public function updateprofilepic($data1){
			$sel = $this->db->query("SELECT * FROM tbl_users Where id = '".$data1['id']."' ")->row();
			if(empty($sel)){
				return "error";
			}else{
				$image = str_replace(base_url("public/profile_pic/"), '', $sel->profile_pic);
				$path = 'public/profile_pic/'.$image;
				unlink($path);
				$ins = $this->db->where('id',$data1['id']);
				$this->db->update('tbl_users',array('fullname'=>$data1['fullname'],'profile_pic'=>$data1['profile_pic']));
				$pro_data = $this->db->query("SELECT * FROM tbl_users Where id = '".$data1['id']."' ")->row();
			    //$pro_data->profile_pic = base_url().''.$pro_data->profile_pic;
				return $pro_data;
			}
		}
		public function logout($id,$device){
			$sel = $this->db->query("SELECT * from tbl_login Where user_id = '".$id."' AND unique_deviceId = '".$device."' ORDER BY id desc")->row();
			// print_r($sel);die;
			$update = array(
				'status'=>0
				);
			$this->db->where('user_id',$sel->user_id);
			$this->db->where('unique_deviceId',$sel->unique_deviceId);
			$this->db->update('tbl_login',$update);
			return "1";			
		}
		public function insert_data($tbl_name,$data){
			$this->db->insert($tbl_name,$data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
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
		public function reportdetail($id){
			$sel = $this->db->query("SELECT * FROM tbl_reports WHERE userId='".$id."' ")->result();
			return $sel;
		}
		public function notification($data){
			$this->db->where('id',$data['id']);
			$this->db->update('tbl_users',array('notification_status'=>$data['status']));
			$this->db->select('notification_status');
			$this->db->from("tbl_users");
			$this->db->where('id',$data['id']);
			$sel = $this->db->get()->row()->notification_status;				
			return $sel;
		}
		public function searchfriend($data){
			$af = array_flip($data);
			$af['fullname'] = 'email';
			$arr = array_flip($af);
			$arr['email'] = $data['fullname'];

			$this->db->select('id,fullname,email,profile_pic');
			$this->db->from('tbl_users');
			$this->db->where('tbl_users.id !=',$arr['userId']);
			$this->db->where("(fullname LIKE '%".$arr['fullname']."%' OR email = '".$arr['email']."')");
			$sel = $this->db->get()->result();
			foreach($sel as $key=>$list){
				// if(!empty($list->profile_pic)){
				// 	$list->profile_pic = base_url().''.$list->profile_pic;
				// }
				$query = $this->db->query("SELECT `tbl_users`.`id` as ids,(select is_block from tbl_friend where (from_Id = '".$list->id."' and to_Id = '".$arr['userId']."') OR (to_Id = '".$list->id."' and from_Id = '".$arr['userId']."') ) AS block FROM tbl_users WHERE id = '".$list->id."'")->row();
				if($query->block == 1){
					unset($sel[$key]);				
				}else{
					$list->block = empty($query)?'': $query->block;						
				}				
			}
			return $sel;
		}
			public function getUser($id){
			$this->db->select('id,fullname,profile_pic');
			$this->db->from('tbl_users');
			$this->db->where('id',$id);
			$sel1 = $this->db->get()->row();
			return $sel1;
		}
		public function addfriend($data){
			$this->db->select('*');
			$this->db->from('tbl_friend');
			$this->db->where("to_Id = '".$data['from_Id']."' AND is_block = 0 AND from_Id = '".$data['to_Id']."' AND (status = 0 OR status = 3)");
			$this->db->or_where("from_Id = '".$data['from_Id']."' AND is_block = 0 AND to_Id = '".$data['to_Id']."' AND (status = 0 OR status = 3)");
			$query = $this->db->get()->row();
			// print_r($query);die;
			if(!empty($query)){
				$this->db->where("to_Id = '".$data['from_Id']."' AND is_block = 0 AND from_Id = '".$data['to_Id']."' AND (status = 0 OR status = 3)");
				$this->db->or_where("from_Id = '".$data['from_Id']."' AND is_block = 0 AND to_Id = '".$data['to_Id']."' AND (status = 0 OR status = 3)");
				$this->db->update('tbl_friend',array('from_Id'=>$data['from_Id'],'to_Id'=>$data['to_Id'],'status'=>$data['status'],'date_updated'=>date('Y-m-d H:i:s')));

				$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$data['to_Id']."' ")->row();
				if($pushstatus->notification_status == 0){
					$this->db->insert('tbl_notifications',array('type'=>1,'to_id'=>$data['to_Id'],'from_id'=>$data['from_Id'],'date_created'=>date('Y-m-d H:i:s')));
					$this->pushdata($pushstatus->id,"You have a new friend request.","friendRequest","Friend Request");
				}
				return "reqsend";
			}else{
				$sel = $this->db->query("SELECT * FROM `tbl_friend` WHERE (`to_Id` = '".$data['from_Id']."' AND `is_block` = 0 AND`from_Id` = '".$data['to_Id']."' AND (status = '".$data['status']."' or status = 2)) OR (`from_Id` = '".$data['from_Id']."' AND `is_block` = 0 AND `to_Id` = '".$data['to_Id']."' AND (status = '".$data['status']."' or status = 2))")->row();
				// print_r($sel);die;
				if(empty($sel)){
					$ins = $this->db->insert('tbl_friend',$data);
					$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$data['to_Id']."' ")->row();
					if($pushstatus->notification_status == 0){
						$this->db->insert('tbl_notifications',array('type'=>1,'to_id'=>$data['to_Id'],'from_id'=>$data['from_Id'],'date_created'=>date('Y-m-d H:i:s')));
						$this->pushdata($pushstatus->id,"You have a new friend request.","friendRequest","Friend Request");
					}
					return "reqsend";
				}else{
					if($sel->status == 2){
						return "List";
					}else{
						return "exist";
					}
				}
			}
		}
		public function commomaction($data){
			$sel = $this->db->query("SELECT * FROM tbl_friend where from_Id = '".$data['to_Id']."' and to_Id = '".$data['from_Id']."' AND is_block = 0 AND status = 1 ")->row();
			if(!empty($sel)){
				$this->db->where('from_Id',$data['to_Id']);
				$this->db->where('to_Id',$data['from_Id']);
				$this->db->where('status',1);
				$this->db->update('tbl_friend',array('status'=>$data['status']));
				$check = $this->db->query("SELECT * FROM tbl_friend where from_Id = '".$data['to_Id']."' and to_Id = '".$data['from_Id']."' AND is_block = 0 AND status = 2 ")->row();
				//print_r($check);die;
				if($check->status == 2){
					$info = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$check->to_Id."' ")->row();
					$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$check->from_Id."' ")->row();
					if($pushstatus->notification_status == 0){
						$this->db->insert('tbl_notifications',array('type'=>2,'to_id'=>$pushstatus->id,'from_id'=>$check->to_Id,'date_created'=>date('Y-m-d H:i:s')));
						$this->pushdata($pushstatus->id," ".$info->fullname." has accepted your friend request.","friendAccept","Friend Accept");
					}
					//$this->pushdata($check->from_Id,"friend added","friendAccept");
				} 
				return "success";
			}else{
				return "error";
			}			
		}
		public function unfriend($data){
			$this->db->where("to_Id = '".$data['from_Id']."' AND is_block = 0 AND from_Id = '".$data['to_Id']."' AND status = 2");
			$this->db->or_where("from_Id = '".$data['from_Id']."' AND is_block = 0 AND to_Id = '".$data['to_Id']."' AND status = 2");
			$this->db->update('tbl_friend',array('status'=>$data['status']));
			return "ok";
		}
		public function friendlist($select,$table,$where,$data){
			$this->db->select($select);
			$this->db->from($table);
			$this->db->where($where);
			$this->db->order_by('date_created DESC');
			$sel = $this->db->get()->result();
			$count = count($sel);

		    $row = 'row';
			
			foreach($sel as $list){
				$userList = $this->db->query("SELECT id,fullname,email,profile_pic from tbl_users where (id = '".$list->from_Id."' or id='".$list->to_Id."'  ) and id !='".$data['userId']."'")->$row();
				$quick = $this->db->query("SELECT quickBlockId from tbl_quickBlock WHERE (userId = '".$list->from_Id."' or userId='".$list->to_Id."'  ) and userId !='".$data['userId']."' ")->$row()->quickBlockId;
				if($quick == null && empty($userList)){
					$userList = '';
				}else{
					$userList->quickBlockId = $quick;
					//$hello[] = $userList;
				}
				// if(!empty($userlist->profile_pic)){
					// $userList->profile_pic = base_url().''.$userList->profile_pic;
				$hello[] = $userList;
				// }
				$list->name = empty($userList)?'' : $userList;
				$list->quickBlockId = empty($quick)?'' :$quick;
			}
			return array_filter($hello);
		}
		public function blockuser($data){
			if($data['is_block'] == 1 || $data['is_block'] == 0){
				$this->db->where("(from_Id = '".$data['from_Id']."' AND to_Id = '".$data['to_Id']."' AND (status = 0 OR status = 1 OR status = 2 OR status = 3)) OR (to_Id = '".$data['from_Id']."' AND from_Id = '".$data['to_Id']."' AND (status = 0 OR status = 1 OR status = 2 OR status = 3))");
				$this->db->update('tbl_friend',array('is_block'=>$data['is_block']));
				return "block";
			}else{
				return "error";
			}
		}
		public function blockList($userid){
			$sel = $this->db->query("SELECT to_id,from_id FROM tbl_friend WHERE (from_id = '".$userid."' OR to_id = '".$userid."') AND is_block = 1 ")->result();
			foreach ($sel as $key => $value) {
				if($value->to_id == $userid){
					$name = $this->db->query("SELECT fullname  FROM tbl_users WHERE id = '".$value->from_id."'")->row()->fullname;
				}else{
					$name = $this->db->query("SELECT fullname  FROM tbl_users WHERE id = '".$value->to_id."' ")->row()->fullname;
				}
				$value->name = empty($name)?$name:$name;
			}
			return $sel;
		}
		public function createchallenge($data){
			// $user = [$data['userId']];
			// $decode = json_decode($invite);
			// $merge = array_merge($user,$decode);
			$this->db->insert('tbl_challenge',$data);
			$last_id = $this->db->insert_id();
			$ins_data = ['chalnge_Id'=>$last_id,'to_Id'=>$data['userId'],'from_Id'=>$data['userId'],'status'=>1,'date_updated'=>date('Y-m-d H:i:s'),'date_created'=>date('Y-m-d H:i:s')];
			$this->db->insert('tbl_challengeRequest',$ins_data);
			// foreach($merge as $id){

			// 	$ins_data = ['chalnge_Id'=>$last_id,'to_Id'=>$id,'from_Id'=>$data['userId'],'date_updated'=>date('Y-m-d H:i:s'),'date_created'=>date('Y-m-d H:i:s')];
			// 		if($id == $data['userId']){
			// 			$dataS =array('status'=>1);
			// 			$ins_data= array_merge($dataS,$ins_data);
			// 		}
			// 	$this->db->insert('tbl_challengeRequest',$ins_data);
			// 	$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
			// 	if(($pushstatus->notification_status == 0) && ($pushstatus->id != $data['userId'])){
		 //        	$this->pushdata($id,"You have a new challenge request.","challengeInvite","Challenge Invite",$last_id);
		 //        }
			// 	//$this->pushdata($id,"challenge request","challengeInvite",$last_id);
			// }
			$slct = $this->db->query("SELECT * FROM tbl_challenge WHERE id = '".$last_id."'")->row();
			$slct->ids = $slct->id;
			$send = ['response'=>'insert','data'=>$slct];
			return $send;
		}
		public function editchalenege($data){
			$sel = $this->Api_model->select_data('*','tbl_challenge',array('id'=>$data['id']));
			if(empty($sel)){
				return "error";
			}else{
				$current = date('Y-m-d');
				$filter = array_filter($data);
				if($current == $sel[0]->startDate){
					$filter['startDate'] = $sel[0]->startDate;
					$upd = $filter;
				}else{
					$upd = $filter;
				}
				$this->db->where('id',$sel[0]->id);
				$this->db->update('tbl_challenge',$upd);
				$re_repon = $this->Api_model->select_data('*','tbl_challenge',array('id'=>$sel[0]->id));
				return $re_repon;
			}
		}
		public function chalengerequest($userid){
			$this->db->select('tbl_challengeRequest.id,chalnge_Id,to_Id,from_Id,title,description,startDate,endDate,fullname,status,tbl_challenge.type');
			$this->db->from('tbl_challengeRequest');
			$this->db->join('tbl_challenge','tbl_challenge.id = tbl_challengeRequest.chalnge_Id');
			//$this->db->join('tbl_challengeType','tbl_challengeType.id = tbl_challenge.challengeType_Id');
			$this->db->join('tbl_users','tbl_users.id = tbl_challenge.userId');
			$this->db->where('tbl_challengeRequest.to_Id',$userid);
			$this->db->where("(status = 0 OR status = 2)");
			//$this->db->or_where('status',2);
			//$this->db->order_by('tbl_challengeRequest.date_created','desc');
			$sel = $this->db->get()->result();
			//print_r($sel);die;
			foreach ($sel as $key => $value) {
				$value->ids = $value->id;
				$query = $this->db->query("SELECT status FROM tbl_challengeRequest WHERE chalnge_Id = '".$value->chalnge_Id."' and status = 1")->num_rows();
				$value->total = empty($query)?'':$query;
			}
			return $sel;		
		}
		public function acceptchallenge($data){
			$this->db->select('*');
			$this->db->from('tbl_challengeRequest');
			// $this->db->where('id',$data['id']);
			// $this->db->or_where('chalnge_Id',$data['id']);
			$this->db->where('chalnge_Id',$data['id']);
			$this->db->where('to_Id',$data['userId']);
			$sel = $this->db->get()->row();
			 // print_r($sel);die;
			if(empty($sel)){

			}else{
				if($sel->status == 1 && $data['status'] == 3){
					$this->db->where('chalnge_Id',$data['id']);
					$this->db->where('to_Id',$data['userId']);
					$this->db->update('tbl_challengeRequest',array('status'=>$data['status']));
					$action = $this->db->query("SELECT * FROM tbl_challengeProof WHERE challenge_id = '".$data['id']."' AND userId = '".$data['userId']."'")->row();
					if(empty($action)){
						// return "quit";
					}else{
						$this->db->where('proof_id',$action->id);
						$this->db->where('userId',$action->userId);
						$this->db->delete('tbl_challengeVote');

						$this->db->where('id',$action->id);
						$this->db->delete('tbl_challengeProof');
						// return "quit";
					}
					return "quit";
				}else{
					$this->db->where('id',$sel->id);
					$this->db->where('to_Id',$data['userId']);
					$this->db->update('tbl_challengeRequest',array('status'=>$data['status'],'date_updated'=>date('Y-m-d H:i:s')));
					$selct = $this->db->query("SELECT id,to_Id,from_Id FROM tbl_challengeRequest WHERE  id='".$sel->id."' AND to_Id = '".$data['userId']."' AND status = 1")->row();
					// print_r($selct);die;
					if($data['status'] == 1){
						$info = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$selct->to_Id ."' ")->row();
						$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$selct->from_Id ."' ")->row();
						//print_r($pushstatus);die;
						if($pushstatus->notification_status == 0){
							// $this->insertnoti($data['userId'],'challengeAccept',$pushstatus->id);
							$this->pushdata($pushstatus->id,"".$info->fullname." has accepted your challenge request.","challengeAccept","Chanllenge Accept");
						}
						//$this->pushdata($selct->from_Id,"challenge accepted ","challengeInvite");
						return "acp";
					}else{
						return "del";
					}
				}
			}
		}
		public function challengenoti($data){
			$this->db->where('id',$data['id']);
			$this->db->update('tbl_challenge',array('notification'=>$data['notification']));
			$var = $this->Api_model->select_data('*','tbl_challenge',array('id'=>$data['id']));
			if($var[0]->notification == 1){
				$msg = "off";
			}else{
				$msg = "on";
			}
			return $msg;
		}
		public function challengelist($data){
			if($data['type'] == 0){
				$gre = '>=';
				$where = "(to_Id = '".$data['userId']."' AND status = 1 )";
			}elseif($data['type'] == 1){
				$gre = '<';
				$where = "(to_Id = '".$data['userId']."' AND (status = 1 OR status = 3))";
			}
			$date = date('Y-m-d');
			// print_r($date);die;
			$this->db->distinct();
			$this->db->select('chalnge_Id,from_Id,to_Id,status');
			$this->db->from('tbl_challengeRequest');
			$this->db->join('tbl_challenge','tbl_challenge.id = tbl_challengeRequest.chalnge_Id');
			$this->db->where($where);
			$this->db->order_by('tbl_challenge.startDate','asc');
			$sel = $this->db->get()->result();				
			// if(!empty($sel)){
				// print_r($sel);die;	
			foreach ($sel as $key => $value) {
					//$query = $this->db->query("SELECT * FROM tbl_challenge WHERE endDate >= '".$date."' AND userId = '".$value->from_Id."' AND id = '".$value->chalnge_Id."' ORDER BY `date_created` DESC")->row();
				$this->db->select('fullname,tbl_challenge.id,userId,title,description,startDate,endDate,tbl_challenge.type');
				$this->db->from('tbl_challenge');
				$this->db->join('tbl_users','tbl_users.id = tbl_challenge.userId');
					// $this->db->join('tbl_challengeType','tbl_challengeType.id = tbl_challenge.challengeType_Id');
					// $this->db->join('tbl_challengeRequest','tbl_challengeRequest.chalnge_Id = tbl_challenge.id');

				$this->db->where('tbl_challenge.endDate'.$gre,$date);
					// $this->db->or_where('tbl_challengeRequest.status',3);
				$this->db->where('tbl_challenge.userId',$value->from_Id);
				$this->db->where('tbl_challenge.id',$value->chalnge_Id);
				$this->db->order_by('tbl_challenge.startDate','asc');
				$query = $this->db->get()->row();
				if(empty($query)){
					unset($sel[$key]);
				}
				if(!empty($query)){
					$query->ids = $query->id;
				}
				$total =  $this->db->query("SELECT status FROM tbl_challengeRequest WHERE chalnge_Id = '".$value->chalnge_Id."' and status = 1")->num_rows();

				$value->detail = empty($query)?'':$query;	
				$value->total = empty($total)?'':$total;
			}
			$val = array_values($sel);			
			return $val;
			// }else{
			// 	$this->db->select('fullname,tbl_challenge.id,userId,title,description,startDate,endDate');
			// 	$this->db->from('tbl_challenge');
			// 	$this->db->join('tbl_users','tbl_users.id = tbl_challenge.userId');
			// 	// $this->db->join('tbl_challengeType','tbl_challengeType.id = tbl_challenge.challengeType_Id');
			// 	$this->db->where('tbl_challenge.endDate'.$gre,$date);
			// 	$this->db->where('tbl_challenge.userId',$data['userId']);
			// 	$query = $this->db->get()->result();
			// 	return $query;
			// }
		}     
		public function pushdata($userid,$message,$action,$title,$challengeId=null){
			$selectRes = $this->db->select('*')->from('tbl_users')->where('id',$userid)->get()->row();
			$selectPreviousUsers = $this->db->select('*')
			->from('tbl_login')
			->where('user_id',$selectRes->id)
			->where('status',1)
	                                         // ->limit(1,'DESC')
			->get()->result(); 
			$pushData['message'] = $message;
			$pushData['action'] = $action;
			$pushData['title'] = $title;
			$pushData['profile_pic'] = $selectRes->profile_pic;
			$pushData['id'] = $challengeId;
	        // $pushData['token'] = $selectPreviousUsers->token_id;
	        // echo"<pre>"; print_r($pushData);die;
	        // echo "<pre>";print_r($selectPreviousUsers);die;
			foreach ($selectPreviousUsers as $key => $value) {
				if($value->device_id == 1){
					$pushData['token'] = $value->token_id;
					$this->iosPush($pushData);
				}else if($value->device_id == 0){
					$pushData['token'] = $value->token_id;
					$this->androidPush($pushData);
				}
			}
		}
		public function iosPush($pushData=null){
			$deviceToken = $pushData['token'];
			$passphrase = '123456';
			$ctx = stream_context_create();
			stream_context_set_option($ctx, 'ssl', 'local_cert', './certs/sunsoftAshishPushFile.pem');
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		    // Open a connection to the APNS server
			$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
		   // if (!$fp) exit("Failed to connect: $err $errstr" . PHP_EOL);
			$body['aps'] = array(
				'alert' => array(
					'title' =>$pushData['title'],
					'body' =>$pushData['message']
					),
				"req_id"=>$pushData['id'],
				"action" => $pushData['action'],
				'profile_pic' => $pushData['profile_pic'],
				'sound' => 'default'
				);
		    // Encode the payload as JSON
			$payload = json_encode($body);
		    // Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		    // Send it to the server
		    $result = fwrite($fp, $msg, strlen($msg)); //echo "<pre>"; print_r($result);die;
		   // echo"there";
		   // print_r($result);
		    fclose($fp);
		}
		public function androidPush($pushData=null){

			$mytime = date("Y-m-d H:i:s");

			$api_key = "AAAA1StA-oA:APA91bGQW5nfnBDP_5iouES7-l9nULXUwvTzda1uEIrDO4Pw1Q59VpeRL1EOpPp581MC0gHV8jsJwfA1lhVLuYH3q9lQZOAXxdGqrV987Bx0xjOuSyNxuiA_E3IlBpw82DDs7HXW545x";
			$fcm_url = 'https://fcm.googleapis.com/fcm/send';
			$fields = array(
				'registration_ids' => array(
					$pushData['token']
					) ,
				'data' => array(
					"message" =>$pushData['message'], 
					"action" => $pushData['action'],
					"profile_pic" => $pushData['profile_pic'],
					"id" =>$pushData['id'],
					"time" => $mytime
					) ,
				);

			$headers = array(
				'Authorization: key=' . $api_key,
				'Content-Type: application/json'
				);
			$curl_handle = curl_init();

		    // set CURL options

			curl_setopt($curl_handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($curl_handle, CURLOPT_URL, $fcm_url);
			curl_setopt($curl_handle, CURLOPT_POST, true);
			curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, json_encode($fields));
			$response = curl_exec($curl_handle);
		    // print_r($response);die;
			curl_close($curl_handle);
		}
		public function challengedeltl($id,$userid){
			$check = $this->db->query("SELECT * FROM tbl_challenge WHERE id = '".$id."'")->row();
			if(!empty($check)){
				$this->db->select("tbl_challenge.*,fullname,count(tbl_challengeRequest.id) as people,status");
				$this->db->from("tbl_challenge");
				$this->db->join('tbl_users','tbl_users.id = tbl_challenge.userId');
				$this->db->join('tbl_challengeRequest','tbl_challengeRequest.chalnge_Id = tbl_challenge.id');
				$this->db->where('tbl_challenge.id',$id);
				$sel = $this->db->get()->row();
				$query = $this->db->query("SELECT tbl_challengeProof.*,profile_pic FROM tbl_challengeProof LEFT JOIN tbl_users ON tbl_users.id = tbl_challengeProof.userId WHERE challenge_id = '".$sel->id."' AND tbl_challengeProof.userId = '".$userid."'")->row();
				if(!empty($query->image)){
					$query->image = base_url().''.$query->image;
				}
				$sel->my_proof = empty($query)?'':$query;
				$res =  $this->db->query("SELECT tbl_challengeProof.*,profile_pic,fullname FROM tbl_challengeProof LEFT JOIN tbl_users ON tbl_users.id = tbl_challengeProof.userId WHERE challenge_id = '".$sel->id."'")->result();
				foreach ($res as $key => $value) {
					$vote = $this->db->query("SELECT tbl_challengeVote.id as is_voted,tbl_challengeVote.userId as vote_user FROM tbl_challengeVote LEFT JOIN tbl_challengeProof ON tbl_challengeProof.id = tbl_challengeVote.proof_id WHERE tbl_challengeVote.userId = '".$userid."' and tbl_challengeVote.proof_id = '".$value->id."' and tbl_challengeVote.vote = 1")->row();
					$count = $this->db->query("SELECT count(tbl_challengeVote.id) as total_vote FROM tbl_challengeVote LEFT JOIN tbl_challengeProof ON tbl_challengeProof.id = tbl_challengeVote.proof_id WHERE tbl_challengeVote.proof_id = '".$value->id."' AND vote = 1")->row()->total_vote;
					if(!empty($value->image)){
						$value->image = base_url().''.$value->image;
					}
					$value->user_vote = empty($vote->vote_user)?'0':$vote->vote_user;
					$value->is_voted = empty($vote->is_voted)?false:true;
					$value->total_vote = empty($count)?'0':$count;
				}				
				$sel->proof = empty($res)?'':$res;	
				return $sel;
			}else{
				return "error";
			}
		}
		public function updatetaskk($data){
			$sel = $this->Api_model->select_data('*','tbl_taskWork',array('id'=>$data['id']));
			if(empty($sel)){
				return "error";
			}else{
				$this->db->where('id',$sel[0]->id);
				$this->db->update('tbl_taskWork',array('task_name'=>$data['task_name'],'description'=>$data['description']));
				$select = $this->Api_model->select_data('*','tbl_taskWork',array('id'=>$sel[0]->id));
				return $select[0];
			}
		}
		public function taskDeleteData($id){
			$sel = $this->Api_model->select_data('*','tbl_taskWork',array('id'=>$id));
			if(empty($sel)){
				return "error";
			}else{
				$this->db->where('id',$id);
				$this->db->delete('tbl_taskWork');
				return "delete";
			}
		}
		public function detailalltask($data){
			$limit = 30;
			$date = date('Y-m-d');
			$offset = ($data['page'] * $limit);
			$this->db->select('*');
			$this->db->from('tbl_taskWork');
			$this->db->where('userId',$data['userId']);
			$this->db->limit($limit,$offset);
			$this->db->order_by('date_created','desc');
			$sel = $this->db->get()->result();
			foreach ($sel as $key => $value) {
				$value->ids = $value->id;
			}
			// $this->db->select('SUM(time_spent) as total');
			// $this->db->from('tbl_taskTime');
			// $this->db->join('tbl_taskWork','tbl_taskWork.id = tbl_taskTime.task_id');
			// $this->db->where('tbl_taskWork.userId',$data['userId']);
			// $this->db->where('tbl_taskTime.date',$date);
			// $sum = $this->db->get()->row()->total;
			// $val = empty($sum)?'0':$sum;
			$count = $this->db->query("SELECT count(id) as total FROM tbl_taskWork WHERE userId = '".$data['userId']."'")->row()->total;
			$send = [
			'total'=>$count,
				// 'time'=>$val,
			'record'=>$sel
			];
			return $send;
		}
		public function marktaskcompleted($data){
			$sel = $this->db->query("SELECT * FROM tbl_taskWork WHERE id = '".$data['id']."'")->row();
			if(empty($sel)){
				return "error";
			}else{
				$this->db->where('id',$data['id']);
				$this->db->update('tbl_taskWork',array('end_date'=>$data['end_date'],'status'=>$data['status']));
				return "update";
			}
		}
		public function addgoals($data,$invite,$rules){
			$decode =  explode('":"',$rules);
			$ruledata = json_decode($rules);
			$current = date('Y-m-d');
			for($i = 0; $i < 7 ; $i++){
				$date = date('Y-m-d', strtotime("-".$i."days", strtotime($current)));
				$dayName = date('D', strtotime($date));
				if($dayName == "Mon"){
					$startdate1 = $date;
				}
			}
			for($i = 0; $i < 7 ; $i++){
				$date = date('Y-m-d', strtotime("+".$i."days", strtotime($current)));
				$dayName = date('D', strtotime($date));
				if($dayName == "Sun"){
					$enddate = $date;
				}
			}
		    // $check = $this->db->query("SELECT * FROM tbl_goalsCalender WHERE userId = '".$data['userId']."' AND (start_date = '".$data['start_date']."' OR end_date = '".$data['end_date']."' ) ")->row();
		    // if(empty($check)){
				//$select = $this->db->query("SELECT * FROM tbl_goalsCalender WHERE userId = '".$data['userId']."' AND end_date > '".$data['start_date']."' AND (date_created > '".$startdate1."' OR date_created < '".$enddate."')");
			$select = $this->db->query("SELECT * FROM tbl_goalsCalender WHERE userId = '".$data['userId']."' AND (date_created > '".$startdate1."' OR date_created < '".$enddate."')");
			$count = count($select->result());
			$rows = $select->row();
				// print_r($rows);die;
				//if($data['end_date'] <= $enddate){
					// if(empty($rows)){
						//if($count < 3){
			$enddate = $rows->end_date;
			$startdate = $data['start_date'];
			$this->db->insert('tbl_goalsCalender',$data);
			$last_id = $this->db->insert_id();
			$decode = json_decode($invite);
			foreach ($decode as $key => $id) {
				$ss = $this->db->query("SELECT * FROM tbl_goalEventInvitation WHERE type = 0 AND goalEvent_id = '".$last_id."' AND to_id = '".$id."' AND from_id = '".$data['userId']."'")->row();
				if(empty($ss)){
					$ins_data = ['type'=>0,'goalEvent_id'=>$last_id,'to_id'=>$id,'from_id'=>$data['userId'],'date_updated'=>date('Y-m-d H:i:s'),'date_created'=>date('Y-m-d H:i:s')];
					$this->db->insert('tbl_goalEventInvitation',$ins_data);
					$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
					if(($pushstatus->notification_status == 0)){
										// $this->insertnoti($data['userId'],'goalInvite',$id);

						$this->pushdata($id,"You have a new goal request.","goalInvite","Goal Invite",$last_id);
					}
				}else{
							    	//unset($decode[$key]);
					if($ss->status == 2){
						$this->db->where("type = 0 AND goalEvent_id = '".$last_id."' AND to_id = '".$id."' AND from_id = '".$data['userId']."'");
						$this->db->update('tbl_goalEventInvitation',array('status'=>0));
						$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
						if(($pushstatus->notification_status == 0)){
											// $this->insertnoti($data['userId'],'goalInvite',$id);
							$this->pushdata($id,"You have a new goal request.","goalInvite","Goal Invite",$last_id);
						}
								        // $msg = "insert";
					}else{
							    		// $msg = "already";
					}
				}
			}
			foreach ($ruledata as $key => $value) {

				$insertRule = ['goalId'=>$last_id,'rule_name'=>$value->rule,'date_created'=>date('Y-m-d H:i:s')];
				$this->db->insert('tbl_goalsCalenderRules',$insertRule);
			}
			$this->db->select('*');
			$this->db->from('tbl_goalsCalender');
			$this->db->where('id',$last_id);
			$this->db->where('userId',$data['userId']);
			$sel = $this->db->get()->row();
			$send = [
			'sel'=>$sel,
			'msg'=>'insert'
			];
			return $send;
						// }else{
						// 	return "exceed";
						// }
					// }else{
					// 	return "already";
					// }
				// }else{
				// 	return "greater";
				// }
			// }else{
			// 	return "already";
			// }
		}
		public function addgoalrules($data){
			$sel = $this->db->query("SELECT * FROM tbl_goalsCalender WHERE id = '".$data['goalId']."' ")->row();
			if(!empty($sel)){
				$this->db->insert('tbl_goalsCalenderRules',$data);
				$last_id = $this->db->insert_id();
				$selct = $this->Api_model->select_data('*','tbl_goalsCalenderRules',array('id'=>$last_id));
				$send = array(
					"resposne"=>"insert",
					'data'=>$selct
					);
				return $send;
			}else{
				return "error";
			}
		}
		public function updategoal($filter,$data){
			$this->db->select('tbl_goalsCalender.*');
			$this->db->from('tbl_goalsCalender');
			$this->db->join('tbl_goalEventInvitation','tbl_goalEventInvitation.goalEvent_id = tbl_goalsCalender.id',LEFT);
			$this->db->where('tbl_goalsCalender.id',$data['id']);
			$this->db->where_in('tbl_goalEventInvitation.from_id',$data['userId']);
			$this->db->or_where('tbl_goalsCalender.userId',$data['userId']);
			$sel = $this->db->get()->row();
			//print_r($sel);die;
			if(!empty($sel)){
				$current = date('Y-m-d');
				for($i = 0; $i < 7 ; $i++){
					$date = date('Y-m-d', strtotime("-".$i."days", strtotime($current)));
					$dayName = date('D', strtotime($date));
					if($dayName == "Mon"){
						$startdate1 = $date;
					}
				}
				for($i = 0; $i < 7 ; $i++){
					$date = date('Y-m-d', strtotime("+".$i."days", strtotime($current)));
					$dayName = date('D', strtotime($date));
					if($dayName == "Sun"){
						$enddate = $date;
					}
				}
				$check = $this->db->query("SELECT * FROM tbl_goalsCalender WHERE userId = '".$data['userId']."' AND (start_date = '".$data['start_date']."' AND end_date = '".$data['end_date']."' ) ")->row();
				// print_r($check);die;
				//if($data['end_date'] <= $enddate){
				if(empty($check)){
					$this->db->where('id',$data['id']);
					$this->db->update('tbl_goalsCalender',$filter);
					$selct = $this->Api_model->select_data('*','tbl_goalsCalender',array('id'=>$data['id']));
					$send = array(
						"resposne"=>"update",
						'data'=>$selct
						);
					return $send;
				}else{
						// if($check->title != $data['title'] || $check->total_time != $data['total_time']){
					$this->db->where('id',$data['id']);
					$this->db->update('tbl_goalsCalender',$filter);
					$selct = $this->Api_model->select_data('*','tbl_goalsCalender',array('id'=>$data['id']));
					$send = array(
						"resposne"=>"update",
						'data'=>$selct
						);
					return $send;
						// }else{
						// 	return "already";
						// }
				}
				// }else{
				// 	return "greater";
				// }
			}else{
				return "error";
			}
		}
		public function detailgoalsdata($data){
			$this->db->select('*');
			$this->db->from('tbl_goalsCalender');
			$this->db->where('id',$data['id']);
			//$this->db->where('userId',$data['userId']);
			$sel = $this->db->get()->row();
			//foreach ($sel as $key => $value) {
			$query = $this->db->query("SELECT * FROM tbl_goalsCalenderRules WHERE goalId = '".$sel->id."' ORDER BY date_created desc")->result();
			$sel->rules = empty($query)?$query:$query;
			//}
			return $sel;
		}
		public function invitegoalsOld($data,$table){

			$sel = $this->db->query("SELECT * FROM ".$table." WHERE id = '".$data['id']."' ")->row();

			if(!empty($sel)){
				if($data['type'] == 0){

					$decode = json_decode($data['invite']);
					$res=$this->db->query("SELECT * from tbl_goalsCalender  where id='".$data['id']."'")->row();
					
					foreach ($decode as $id) {
						if ($id!=$res->userId){
							$res=$this->db->query("SELECT * from tbl_goalEventInvitation where goalEvent_id='".$data['id']."'  and ((to_id='".$id."' and from_id='".$data['userId']."')or(to_id='".$data['userId']."' and from_id='".$id."') ")->result();


							if (empty($res)) {
								$ss1 = $this->db->query("SELECT * FROM tbl_challengeRequest WHERE chalnge_Id = '".$data['id']."' AND to_id = '".$id."' AND from_id = '".$data['userId']."'")->row();
								if(empty($ss1)){
									$ins_data = ['chalnge_Id'=>$sel->id,'to_id'=>$id,'from_id'=>$data['userId'],'date_updated'=>date('Y-m-d H:i:s'),'date_created'=>date('Y-m-d H:i:s')];
									$this->db->insert('tbl_challengeRequest',$ins_data);
									$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
									if(($pushstatus->notification_status == 0)){
										$this->db->insert('tbl_notifications',array('type'=>3,'task_id'=>$sel->id,'to_id'=>$id,'date_created'=>date('Y-m-d H:i:s')));
										$this->pushdata($id,"You have a new challenge request.","challengeInvite","Challenge Invite",$sel->id);
									}
									$msg = "insert";
								}else{
									if($ss1->status == 2){
										$this->db->where("chalnge_Id = '".$data['id']."' AND to_id = '".$id."' AND from_id = '".$data['userId']."'");
										$this->db->update('tbl_challengeRequest',array('status'=>0));
										$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
										if(($pushstatus->notification_status == 0)){
											$this->db->insert('tbl_notifications',array('type'=>3,'task_id'=>$sel->id,'to_id'=>$id,'date_created'=>date('Y-m-d H:i:s')));
											$this->pushdata($id,"You have a new challenge request.","challengeInvite","Challenge Invite",$sel->id);
										}
										$msg = "insert";
									}else{
										$msg = "already";
									}
								}

							}
							elseif($res->status==1){
								$msg="alreadypart";
							}
							else{
								$msg="alreadyinvited";
							}



						}
						else{
							$msg="creator";

						}
					}
				}
				else{
					$res=$this->db->query("SELECT * from tbl_goalsCalender  where id='".$data['id']."'")->row();
					$decode = json_decode($data['invite']);
					foreach ($decode as $id) {
						if ($id!=$res->userId  ) {
							$res=$this->db->query("SELECT * from tbl_goalEventInvitation where goalEvent_id='".$data['id']."' and ((to_id='".$id."' and from_id='".$data['userId']."')or(to_id='".$data['userId']."' and from_id='".$id."')) ")->row();

							if (empty($res)) {

								$ss = $this->db->query("SELECT * FROM tbl_goalEventInvitation WHERE type = '".$data['type']."' AND goalEvent_id = '".$data['id']."' AND to_id = '".$id."' AND from_id = '".$data['userId']."'")->row();
								if(empty($ss)){
									
									$ins_data = ['type'=>$data['type'],'goalEvent_id'=>$data['id'],'to_id'=>$id,'from_id'=>$data['userId'],'date_updated'=>date('Y-m-d H:i:s'),'date_created'=>date('Y-m-d H:i:s')];
									$this->db->insert('tbl_goalEventInvitation',$ins_data);
									$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
									if(($pushstatus->notification_status == 0)){
										if($data['type'] == 0){
											$this->db->insert('tbl_notifications',array('type'=>4,'task_id'=>$data['id'],'to_id'=>$id,'date_created'=>date('Y-m-d H:i:s')));
											$this->pushdata($id,"You have a new goal request.","goalInvite","Goal Invite",$data['id']);
										}elseif($data['type'] == 1){
											$this->db->insert('tbl_notifications',array('type'=>5,'task_id'=>$data['id'],'to_id'=>$id,'date_created'=>date('Y-m-d H:i:s')));
											$this->pushdata($id,"You have a new event request.","eventInvite","Event Invite",$data['id']);
										}
									}
									$msg = "insert";
								}else{
									if($ss->status == 2){
										$this->db->where("type = '".$data['type']."' AND goalEvent_id = '".$data['id']."' AND to_id = '".$id."' AND from_id = '".$data['userId']."'");
										$this->db->update('tbl_goalEventInvitation',array('status'=>0));
										$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
										if(($pushstatus->notification_status == 0)){
											if($data['type'] == 0){
												$this->db->insert('tbl_notifications',array('type'=>4,'task_id'=>$data['id'],'to_id'=>$id,'date_created'=>date('Y-m-d H:i:s')));
												$this->pushdata($id,"You have a new goal request.","goalInvite","Goal Invite",$data['id']);
											}elseif($data['type'] == 1){
												$this->db->insert('tbl_notifications',array('type'=>5,'task_id'=>$data['id'],'to_id'=>$id,'date_created'=>date('Y-m-d H:i:s')));
												$this->pushdata($id,"You have a new event request.","eventInvite","Event Invite",$data['id']);
											}
										}
										$msg = "insert";

									}else{
										$msg = "already";
									}
								}
							}

							elseif($res->status==1 ){
								$msg="alreadypart";
							}
							else{
								$msg="alreadyinvited";

							}
						}
						else{
							$msg="creator";
						}

					}
				}
				return $msg;
			}else{
				return "error";
			}
		}

/*******************************************************************************/


public function invitegoals($data){

        $InviteData = json_decode($data['invite']);

        $fVar = array();
		foreach ($InviteData as $key => $vale) {

				if($data['type'] == 0){
					$sel = $this->db->query("SELECT * FROM tbl_goalsCalender WHERE id = '".$data['id']."' ")->row();
			
                 
                   if(!empty($sel)){
                   	$selInternal = $this->db->query("SELECT * FROM tbl_goalEventInvitation WHERE goalEvent_id = '".$data['id']."' and from_id = '".$data['userId']."' and to_id = '".$vale."' and type = 0 ")->row();

                   	 if(empty($selInternal)){
                   	 	$goalInsi_data = [
								            "type"=>0,
								            "goalEvent_id"=>$data['id'],
								            "to_id"=>$vale,
								            "from_id"=>$data['userId'],
								            "status"=>0,
								            "date_created"=>date('Y-m-d H:i:s')
								        ];
                   	 	$this->db->insert('tbl_goalEventInvitation',$goalInsi_data);
							$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$vale."' ")->row();
							if(($pushstatus->notification_status == 0)){
								$this->db->insert('tbl_notifications',array('type'=>4,'task_id'=>$data['id'],'to_id'=>$vale,'date_created'=>date('Y-m-d H:i:s')));
							$this->pushdata($vale,"You have a new goal request.","goalInvite","Goal Invite",$data['id']);
							}
	                        $fVar[] = 1;
	                   	 }else{

	                     	$fVar[] = 0;
	                  
	                     }
                    }
				}elseif($data['type'] == 1){
					$sel1 = $this->db->query("SELECT * FROM tbl_events WHERE id = '".$data['id']."' ")->row();
                  
                   if(!empty($sel1)){

              	$selInternal1 = $this->db->query("SELECT * FROM tbl_goalEventInvitation WHERE goalEvent_id = '".$data['id']."' and from_id = '".$data['userId']."' and to_id = '".$vale."' and type = 1")->row();

                   	 if(empty($selInternal1)){
                   	 	$goalInsi_data1 = [
								            "type"=>1,
								            "goalEvent_id"=>$data['id'],
								            "to_id"=>$vale,
								            "from_id"=>$data['userId'],
								            "status"=>0,
								            "date_created"=>date('Y-m-d H:i:s')
								        ];
                   	 	$this->db->insert('tbl_goalEventInvitation',$goalInsi_data1);
							$pushstatus1 = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$vale."' ")->row();
							if(($pushstatus1->notification_status == 0)){
								$this->db->insert('tbl_notifications',array('type'=>5,'task_id'=>$data['id'],'to_id'=>$vale,'date_created'=>date('Y-m-d H:i:s')));
							$this->pushdata($vale,"You have a new event request.","eventInvite","Event Invite",$data['id']);
							}
                   	   $fVar[] = 1;   
                   	 }else{
                   	   $fVar[] = 0;   
                     }

                   }
				}elseif($vale->type == 2){
				    $sel2 = $this->db->query("SELECT * FROM tbl_challenge WHERE id = '".$data['id']."' ")->row();

				   
				    if(!empty($sel2)){
                   	         	


					$selInternal2 = $this->db->query("SELECT * FROM tbl_challengeRequest WHERE chalnge_Id = '".$data['id']."' and from_id = '".$data['userId']."' and to_id = '".$vale."'")->row();

	      	           if(empty($selInternal2)){
	                   	 	$goalInsi_data2 = [
									            
									            "chalnge_Id"=>$data['id'],
									            "to_id"=>$vale,
									            "from_id"=>$data['userId'],
									            "status"=>0,
									            "date_created"=>date('Y-m-d H:i:s')
									        ];
	                   	 	$this->db->insert('tbl_goalEventInvitation',$goalInsi_data2);
								$pushstatus2 = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$vale."' ")->row();
								if(($pushstatus2->notification_status == 0)){
									$this->db->insert('tbl_notifications',array('type'=>3,'task_id'=>$data['id'],'to_id'=>$vale,'date_created'=>date('Y-m-d H:i:s')));
								$this->pushdata($vale,"You have a new challenge request.","challengeInvite","Challenge Invite",$data['id']);
								}
		                       $fVar[] = 1;   
		                   	}else{
		                   	   $fVar[] = 0;   
		                    }

                    	 }
				    }
		        } 
   return $fVar;
}



		public function addevents($data,$invite){
			$decode = json_decode($invite);
			$this->db->insert('tbl_events',$data);
			$last_id = $this->db->insert_id();
			foreach($decode as $key => $id){
				$ss = $this->db->query("SELECT * FROM tbl_goalEventInvitation WHERE type = 1 AND goalEvent_id = '".$last_id."' AND to_id = '".$id."' AND from_id = '".$data['userId']."'")->row();
				if(empty($ss)){
					$ins_data = ['type'=>1,'goalEvent_id'=>$last_id,'to_id'=>$id,'from_id'=>$data['userId'],'date_updated'=>date('Y-m-d H:i:s'),'date_created'=>date('Y-m-d H:i:s')];
					$this->db->insert('tbl_goalEventInvitation',$ins_data);
					$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
					if(($pushstatus->notification_status == 0)){
						$this->db->insert('tbl_notifications',array('type'=>5,'task_id'=>$last_id,'to_id'=>$id,'date_created'=>date('Y-m-d H:i:s')));
						$this->pushdata($id,"You have a new event request.","eventInvite","Event Invite",$last_id);
					}
			       // $msg = "insert";
				}else{
			    	//unset($decode[$key]);
					if($ss->status == 2){
						$this->db->where("type = 1 AND goalEvent_id = '".$last_id."' AND to_id = '".$id."' AND from_id = '".$data['userId']."'");
						$this->db->update('tbl_goalEventInvitation',array('status'=>0));
						$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$id."' ")->row();
						if(($pushstatus->notification_status == 0)){
							$this->db->insert('tbl_notifications',array('type'=>5,'task_id'=>$last_id,'to_id'=>$id,'date_created'=>date('Y-m-d H:i:s')));
							$this->pushdata($id,"You have a new event request.","eventInvite","Event Invite",$last_id);
						}
					}else{
			    		//$msg = "already";
					}

				}
			}
			$selct = $this->Api_model->select_data('*','tbl_events',array('id'=>$last_id));
			$send = array(
				"resposne"=>"insert",
				'data'=>$selct
				);
			return $send;
		}
		public function eventinvite($data){
			$this->db->select('tbl_goalEventInvitation.id,goalEvent_id,tbl_goalEventInvitation.type,to_Id,from_Id,eventTitle,startDate,endDate,eventPlace,eventComment,reminder,fullname,status,');
			$this->db->from('tbl_goalEventInvitation');
			$this->db->join('tbl_events','tbl_events.id = tbl_goalEventInvitation.goalEvent_id');
			$this->db->join('tbl_users','tbl_users.id = tbl_events.userId');
			$this->db->where('tbl_goalEventInvitation.to_Id',$data['userId']);
			$this->db->where('tbl_goalEventInvitation.type',$data['type']);
			$this->db->where("(status = 0 OR status = 2)");
			$this->db->order_by('tbl_goalEventInvitation.date_created','desc');
			$sel = $this->db->get()->result();


			// print_r($sel);die;
			foreach ($sel as $key => $value) {
				$query = $this->db->query("SELECT count(id) as count FROM tbl_goalEventInvitation WHERE type = 0 AND status = 1 AND goalEvent_id = '".$value->goalEvent_id."'  ")->row()->count;

				// print_r($query);die;
				$value->count = empty($query)?"1":$query+1;
			}
			return $sel;		
		}
		public function goalinvite($data){
			$this->db->select('tbl_goalEventInvitation.id,goalEvent_id,tbl_goalEventInvitation.type,to_Id,from_Id,title,start_date,end_date,total_time,fullname,status,');
			$this->db->from('tbl_goalEventInvitation');
			$this->db->join('tbl_goalsCalender','tbl_goalsCalender.id = tbl_goalEventInvitation.goalEvent_id');
			$this->db->join('tbl_users','tbl_users.id = tbl_goalsCalender.userId');
			$this->db->where('tbl_goalEventInvitation.to_Id',$data['userId']);
			$this->db->where('tbl_goalEventInvitation.type',$data['type']);
			$this->db->where("(status = 0 OR status = 2)");
			$this->db->order_by('tbl_goalEventInvitation.date_created','desc');
			$sel = $this->db->get()->result();
			foreach ($sel as $key => $value) {
				$query = $this->db->query("SELECT count(id) as count FROM tbl_goalEventInvitation WHERE type = 0 AND status = 1 AND goalEvent_id = '".$value->goalEvent_id."'  ")->row()->count;
				$value->count = empty($query)?"1":$query+1;
			}
			return $sel;		
		}
		public function accepteventgoalinvite($data){
			if($data['type'] == 0){

			$row= $this->db->select('*')
			->from('tbl_goalsCalender')
			->where('id',$data['id'])
			->get()->row();

			}else if($data['type'] == 1){

			$row= $this->db->select('*')
			->from('tbl_events')
			->where('id',$data['id'])
			->get()->row();

			}
		    if(!empty($row)){

					$reminder=$row->reminder; 
					$fromID=$row->userId; 
					$startDate =$row->startDate; 
					$endDate =$row->endDate; 
					$eventTitle =$row->eventTitle; 
					$toID= $data['userId'];  
					$eventID= $data['id']; 


					$this->db->select('*');
					$this->db->from('tbl_goalEventInvitation');
					$this->db->where('goalEvent_id',$data['id']);
					$this->db->where('status',0);
					$this->db->where('to_Id',$data['userId']);
					$sel = $this->db->get()->row();
					// print_r($sel);die;
					if(empty($sel)){
						return 2;
					}else{
						$this->db->where('goalEvent_id',$data['id']);
						$this->db->where('status',0);
						$this->db->where('to_Id',$data['userId']);
						$this->db->update('tbl_goalEventInvitation',array('status'=>$data['status'],'date_updated'=>date('Y-m-d H:i:s')));

				
						if($data['status'] == 1){
							$info = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$data['userId'] ."' ")->row();
							$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$row->userId ."' ")->row();
							if($pushstatus->notification_status == 0){
								if($sel->type == 1){
									$this->db->insert('tbl_friendsReminder',array('from_id'=>$fromID,'to_id'=>$toID,'eventTitle'=>$eventTitle,'event_id'=>$eventID,'reminder'=>$reminder,'start_date'=>$startDate,'end_date'=>$endDate));
									$this->pushdata($pushstatus->id,"".$info->fullname." has accepted your event request.","eventAccept","Event Accept");
								}else{
									$this->pushdata($pushstatus->id,"".$info->fullname." has accepted your goal request.","goalAccept","Goal Accept");
								}
							}
							return 1;
						}else{
							return 0;
						}
					}
				}else{
					return 3;
				}

	    }

        public function getSorted_Friends($data){

    
            $orgIds = array();
            $mnData = array();
            $fnData = array();
        	$val = $this->db->select('*')
				        	->from('tbl_friend')
				        	->where("(from_Id = '".$data['userId']."' or to_id = '".$data['userId']."')")
				        	->where('is_block ',0)
				        	->where('status',2)
				        	->get()->result();
				        	foreach ($val as  $vale) {
				     
				        		if($vale->to_Id == $data['userId']){

				        		 $orgIds[] = $vale->from_Id;

				        	     }else if($vale->from_Id == $data['userId']){

				        	     $orgIds[] = $vale->to_Id;

				        	     }
				        	 }
				    
			if($data['type'] == 0 || $data['type'] == 1){
				$inviVal = $this->db->select('to_id')
						        	->from('tbl_goalEventInvitation')        /* get already invited */
						        	->where("goalEvent_id",$data['id'])
						        	->where('from_id ',$data['userId'])
						        	->get()->result();
                if($data['type'] == 0){ 
				$checkVal = $this->db->select('userId')
						        	->from('tbl_goalsCalender')       
						        	->where("id",$data['id'])
						        	->get()->result();
				}else if($data['type'] == 1){
				$checkVal = $this->db->select('userId')
						        	->from('tbl_events')        
						        	->where('id ',$data['id'])
						        	->get()->result();

				}

			}else if($data['type'] == 2){
				$inviVal = $this->db->select('to_Id')
					        	->from('tbl_challengeRequest')
					        	->where("chalnge_Id",$data['id'])            /* get already invited */
					        	->where('from_id ',$data['userId'])
					        	->get()->result();
			    $checkVal = $this->db->select('userId')
						        	->from('tbl_challenge')        
						        	->where('id ',$data['id'])
						        	->get()->result();
			}

	        	if(!empty($inviVal)){
	        		foreach ($inviVal as  $value) {
	        		
                      $mnData[] = $value->to_id;

	        	     }
        
	        	$diff2 = array_diff($orgIds,$mnData);
                }else{
                $diff2 = $orgIds;
                }
       
	        	foreach($diff2 as $key => $fbal){
	    
	        		if($checkVal[0]->userId == $fbal){
	        			// unset($diff2[$key]);
	        			 continue;
	        		}
	        		$deta = $this->getUser($fbal);
	        		$fnData[] = $deta;
	        	} 
	  
	        	 return $fnData;
}

		public function insertnoti($type,$id,$to,$from){
			$this->db->insert('tbl_notifications',array('type'=>$type,'task_id'=>$id,'to_id'=>$to,'from_id'=>$from,'date_created'=>date('Y-m-d H:i:s')));
		}
		public function eventdetail($data){
			$this->db->select('*');
			$this->db->from('tbl_events');
			$this->db->where('id',$data['id']);
			//$this->db->where('status',0);
			$sel = $this->db->get()->row();
			//print_r($sel);die;
			if(empty($sel)){
				return "empty";
			}else{
				// $sel_data = $this->db->query("SELECT * FROM tbl_events WHERE id = '".$sel->goalEvent_id."'")->row();
				// return $sel_data;
				$sel->reminder = substr($sel->reminder,0,5);
				return $sel;
			}
		}
		public function goaleventlisting($data,$where,$where1){
			function custom_sort($a,$b) {
				return strtotime($b->date_created)>strtotime($a->date_created);
			}
			$this->db->distinct('tbl_events.id');
			$this->db->select('tbl_events.*');
			$this->db->from('tbl_events');
			$this->db->join('tbl_goalEventInvitation','tbl_goalEventInvitation.goalEvent_id = tbl_events.id',LEFT);
			$this->db->where("((tbl_goalEventInvitation.to_id = '".$data['userId']."' AND status = 1 AND type = 1) OR (tbl_events.userId = '".$data['userId']."'))");
			$this->db->where($where);
			$this->db->or_where('tbl_events.startDate','desc');
			$this->db->order_by('tbl_events.startDate','asc');
			$event = $this->db->get()->result();

			$this->db->distinct('tbl_goalsCalender.id');
			$this->db->select('tbl_goalsCalender.*');
			$this->db->from('tbl_goalsCalender');
			$this->db->join('tbl_goalEventInvitation','tbl_goalEventInvitation.goalEvent_id = tbl_goalsCalender.id',LEFT);
			$this->db->where("((tbl_goalEventInvitation.to_id = '".$data['userId']."' AND status = 1 AND type = 0) OR (tbl_goalsCalender.userId = '".$data['userId']."'))");
			$this->db->where($where1);
			$this->db->or_where('tbl_goalsCalender.start_date','desc');
			$this->db->order_by('tbl_goalsCalender.start_date','asc');
			$goal = $this->db->get()->result();
			
			$merge = array_merge($event,$goal);
			foreach ($merge as $key => $value) {
				$value->ids = $value->id;
				if($value->eventTitle){
					$value->type = "1";
				}else{
					$value->eventPlace = "";
					$value->type = "0";
				}
			}
			usort($merge, "custom_sort");
			// print_r($merge);die;
			return $merge;
		}
		public function updateevent($data){
			$this->db->select('tbl_events.*');
			$this->db->from('tbl_events');
			$this->db->join('tbl_goalEventInvitation','tbl_goalEventInvitation.goalEvent_id = tbl_events.id',LEFT);
			$this->db->where('tbl_events.id',$data['id']);
			$this->db->where_in('tbl_goalEventInvitation.from_id',$data['userId']);
			$this->db->or_where('tbl_events.userid',$data['userId']);
			$sel = $this->db->get()->row();
			if(!empty($sel)){
				$update = array(
					'eventTitle'=>$data['eventTitle'],
					'eventPlace'=>$data['eventPlace'],
					'eventComment'=>$data['eventComment'],
					'startDate'=>$data['startDate'],
					'endDate'=>$data['endDate'],
					'reminder'=>$data['reminder']
					);
				$filter = array_filter($update);
				// if(!empty($update['reminder'])){
				// 	$this->db->where('event_id',$data['id']);
				// 	$this->db->delete('tbl_cron');
				// }
				$this->db->where('id',$data['id']);
				$this->db->update('tbl_events',$filter);
				$selct = $this->Api_model->select_data('*','tbl_events',array('id'=>$data['id']));
				return $selct;
			}else{
				return "error";
			}
		}
		public function updaterules($data){


			$data1=$this->db->query("SELECT * from tbl_goalsCalender where id='".$data['goal_id']."'")->row();
			if ($data1->userId==$data['user_id']) {

				$this->db->where('id',$data['id']);
				$this->db->update('tbl_goalsCalenderRules',array('rule_name'=>$data['rule_name']));
				$sel = $this->db->query("SELECT * FROM tbl_goalsCalenderRules WHERE id = '".$data['id']."'")->row();
				return $sel;
			}
			else{
				return "not";
			}

		}
		public function commondelete($table,$id,$type,$userid){
			$this->db->select($table.'.*');
			$this->db->from($table);
		//	$this->db->join('tbl_goalEventInvitation','tbl_goalEventInvitation.goalEvent_id = '.$table.'.id',LEFT);
			$this->db->where($table.'.id',$id);
		//	$this->db->where_in('tbl_goalEventInvitation.from_id',$userid);
			$this->db->where($table.'.userId',$userid);
			$sel = $this->db->get()->row();
			// print_r($sel);die;
			if(!empty($sel)){
				$this->db->where('id',$id);
				$this->db->delete($table);
				if($type == 0){
					$this->db->where_in('goalId',$id);
					$this->db->delete('tbl_goalsCalenderRules');
				}
				return "delete";
			}else{
				return "error";
			}
		}
		public function deleterule($data){

			// print_r($data);die;
			$data1=$this->db->query("SELECT * from tbl_goalsCalender where id='".$data['goal_id']."'")->row();

			// print_r($this->db->last_query());die;
			if ($data1->userId==$data['user_id']) {
				$this->db->where('id',$data['id']);
				$this->db->delete('tbl_goalsCalenderRules');
				return "del";
			}
			else{
				return "not";
			}
		}
		public function categoryList(){
			$current = date('Y-m-d');
			$simplr = 'select id,date from tbl_quotes';
			$new_query = $this->db->query("select * from tbl_quotes where date like '%".$current."%'")->num_rows();			
			$select_data = $this->db->query($simplr)->result();
			$select_num = $this->db->query($simplr)->num_rows();
			foreach ($select_data as $key => $value) {
				$queryy = $value->id;
			}
			$counter=0;
			if($new_query ==0){	
				for($i=0;$i<$select_num;$i++){ 
					if($counter == 0 ){
						if($select_data[$i]->date == '0000-00-00'){
							++$counter ;
							$this->db->where('id',$queryy);
							$this->db->update('tbl_quotes',array('date'=>'0000-00-00'));
							$this->db->where('id',$select_data[$i]->id);
							$this->db->update('tbl_quotes',array('date'=>$current));							
						}
					}
				}		
			}
			$sel = $this->db->query("SELECT * FROM tbl_quotes WHERE date = '".$current."'")->row();
			if(!empty($sel) && $queryy == $sel->id){
				$this->db->where('date !=',$current);
				$this->db->update('tbl_quotes',array('date'=>'0000-00-00'));
			}
			$dash = $this->db->query("SELECT * FROM tbl_categories")->result();
			foreach($dash as $value){
				$value->ids = $value->id;
				$value->image = base_url().''.$value->image; 
			}
			$send = [
			'quote'=>$sel->quote,
			'dashboard'=>$dash
			];
			return $send;	
		}
		public function addbook($data,$id){
			$sel = $this->Api_model->select_data('*','tbl_bookResource',array('id'=>$id));
			if(empty($sel)){
				$this->db->insert('tbl_bookResource',$data);
				$this->db->insert('tbl_notifications',array('type'=>6,'to_id'=>$data['userId'],'from_id'=>0,'date_created'=>date('Y-m-d H:i:s')));
				return "insert";
			}else{
				$update = array(
					'title'=>$data['title'],
					'description'=>$data['description'],
					'file'=>$data['file'],
					'status'=>$data['status'],
					'completeDate'=>$data['completedate']
					);
				$filter = array_filter($update);
				$this->db->where('id',$sel[0]->id);
				$this->db->update('tbl_bookResource',$filter);
				return "update";
			}
		}
		public function markbookcomplete($data){
			$this->db->where('id',$data['id']);
			$this->db->update('tbl_bookResource',array('status'=>$data['status'],'completeDate'=>$data['completeDate']));
			return "update";
		}
		public function deletebook($id){
			$sel = $this->db->query("SELECT * FROM tbl_bookResource WHERE id = '".$id."'")->row();
			$image = str_replace("public/books_img/", '', $sel->file);
			$path = 'public/books_img/'.$image;
			$this->db->where('id',$sel->id);
			$this->db->delete('tbl_bookResource');
			unlink($path);
			return "delete";
		}
		public function taskreportlisting($data){
			if($data['type'] == 1){
				$sel = $this->db->query("SELECT * FROM tbl_taskWork WHERE status = 1 AND userId = '".$data['userId']."' AND ( DATE(date_created) >= '".$data['startdate']."' AND DATE(end_date) <= '".$data['enddate']."' ) ORDER BY date_created ASC ")->result();
				$name = "task";
			}

			elseif($data['type'] == 2){
				$sel = $this->db->query("SELECT * FROM tbl_bookResource WHERE userId = '".$data['userId']."' AND status = 1 AND completeDate BETWEEN '".$data['startdate']."' AND '".$data['enddate']."' ORDER BY completeDate ASC")->result();
				foreach ($sel as $key => $value) {
					if(!empty($value->file)){
						$value->file = base_url().''.$value->file;
					}
				}
				$name = "book";
			}

			elseif($data['type'] == 3){
				$name = "goal";
				$sel = $this->db->query("SELECT * FROM tbl_goalsCalender WHERE userId = '".$data['userId']."' AND start_date >= '".$data['startdate']."' AND end_date <= '".$data['enddate']."' ORDER BY start_date ASC")->result();
				foreach($sel as $key => $value){
					$value->task_name = $value->title;
					$value->time_spent = $value->total_time;
				}
			}

			else{
				$name = "challengeList";
				$date = date('Y-m-d');
				$sel = $this->db->query("SELECT id,userId,title,description,startDate,endDate,type FROM tbl_challenge WHERE userId = '".$data['userId']."' AND startDate >= '".$data['startdate']."' AND endDate <= '".$data['enddate']."'  ORDER BY startDate ASC")->result();
				foreach ($sel as $key => $value) {
					$value->ids = $value->id;
					// if($value->startDate == $date || $value->endDate == $date){
					// 	unset($sel[$key]);
					// }
					$total =  $this->db->query("SELECT status FROM tbl_challengeRequest WHERE chalnge_Id = '".$value->id."' and status = 1")->num_rows();
					$status = $this->db->query("SELECT status FROM tbl_challengeRequest WHERE to_Id = '".$value->userId."' AND status = 1")->row()->status;
					$slct = $this->db->query("SELECT fullname FROM tbl_users WHERE id = '".$value->userId."'")->row()->fullname;
					$value->status = empty($status)?'':$status;
					$value->fullname = empty($slct)?'':$slct;
					$value->total = $total;
				}
			}
			return array('reponse'=>$sel,'name'=>$name);
		}
		public function resume($id,$type){
			$this->db->select('*');
			$this->db->from('tbl_resume');
			$this->db->where('userId',$id);
			$this->db->where('type',$type);
			$sel = $this->db->get()->result();
			return $sel;
		}
		public function updateresume($data){
			$sel = $this->db->query("SELECT * from tbl_resume where id='".$data['id']."' and type='".$data['type']."'")->row();
			if(!empty($sel)){
				$this->db->where('id',$data['id']);
				$this->db->where('type',$data['type']);
				$this->db->update('tbl_resume',array('endDate'=>$data['endDate'],'description'=>$data['description']));
				$sell = $this->db->query("select * from tbl_resume where id='".$data['id']."' and type='".$data['type']."'")->row();
				$send = [
				'response'=>"update",
				'send'=>$sell
				];
				return $send;
			}else{	
				return "error";
			}
		}
		public function deleteresume($id){
			$this->db->where('id',$id);
			$this->db->delete('tbl_resume');
			return "delete";
		}
		public function notidelete($to_id){
			$this->db->where('to_id',$to_id);
			$this->db->delete('tbl_notifications');
			return "delete";
		}
		Public function Excel($data){
	    	// print_r($data);die;
			$this->load->library('excel');
			$fileName = $data['name'].'.xls';
			$objPHPExcel = new PHPExcel();
			$default_border = array(
				'style' => PHPExcel_Style_Border::BORDER_THIN,
				'color' => array('rgb' => '000000'),
				);		
			$top_header_style = array(
				'borders' => array(
					'bottom' => $default_border,
					'left' => $default_border,
					'top' => $default_border,
					'right' => $default_border,
					),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					// 'color' => array('rgb' => 'ffff03'),
					),
				'font' => array(
					'color' => array('rgb' => '000000'),
					'size' => 15,
					'name' => 'Arial',
					'bold' => true,
					),
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					),
				);
			$style_header = array(
				'borders' => array(
					'bottom' => $default_border,
					'left' => $default_border,
					'top' => $default_border,
					'right' => $default_border,
					),
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					// 'color' => array('rgb' => 'ffff03'),
					),
				'font' => array(
					'color' => array('rgb' => '000000'),
					'size' => 12,
					'name' => 'Arial',
					'bold' => true,
					),
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					),
				);
			$cell_style = array(
				'alignment' => array(
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					),
				'borders' => array(
					'bottom' => $default_border,
					'left' => $default_border,
					'top' => $default_border,
					'right' => $default_border,
					),
				'font' => array(
					'color' => array('rgb' => '000000'),
					'size' => 12,
					'name' => 'Arial',
					'bold' => false,
					),
				);

			$data1 = $this->Api_model->taskreportlisting($data);
			// print_r($data);die;

			if($data['type'] == 4){
				$des = 'Description';
				foreach ($data1['reponse'] as $key => $value) {
					$value->task_name = $value->title;
					$value->start_date = $value->startDate;
					$value->end_date = $value->endDate;
				}
			}elseif($data['type'] == 2){
				$des = 'Description';
				foreach ($data1['reponse'] as $key => $value) {
					$value->task_name = $value->title;
					$value->start_date = $value->completeDate;
				}
			}elseif($data['type'] == 3){
				$des = 'Time Devoted';
			}else{
				$des = 'Description';
			}

			$objPHPExcel->getProperties()->setTitle("Task Result");                                
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Title');
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($top_header_style);
			$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($top_header_style);
			$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($top_header_style);
			$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($top_header_style);
			$objPHPExcel->getActiveSheet()->setCellValue('B1', $des);
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Start Date');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'End date');
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
			$i = 2;

			foreach ($data1['reponse'] as $key => $row) {
				$title = $row->task_name;

				$tz = new DateTimeZone($data['time_zone']);

				// print_r($tz);die;
				$date = new DateTime($row->date_created);
				$date->setTimezone($tz);
				$startDate=$date->format('d M y');
				$startTime=$date->format('h:i A');


				$date = new DateTime($row->end_date);
				$date->setTimezone($tz);
				$row->end_date=$date->format('Y-m-d H:i:s');
				// $startTime=$date->format('h:i A');


				// $startDate = date("d M y",strtotime($row->date_created));
				// $startTime = date("h:i A.",strtotime($row->date_created));
				if($data['type'] == 1){				
					$startdate = $startDate." At ".$startTime;
					$enddate = date("d M y",strtotime($row->end_date))." At ".date("h:i A.",strtotime($row->end_date));
					$description = $row->description;
				}elseif($data['type'] == 2){
					$description = $row->description;
					$startdate = $startDate." At ".$startTime;
					$enddate = date("d M y",strtotime($row->completeDate));
				}elseif($data['type'] == 3){
					$minutes = $row->time_spent;
					$hours = floor($minutes / 60);
					$min = $minutes - ($hours * 60);
					if($hours == 0){
						$date1 = $minutes. " Minutes";
					}elseif($min == 0 && $hours < 2){
						$date1 = $hours." Hour";
					}elseif($min == 0){
						$date1 = $hours." Hours";
					}else{
						$date1 =  $hours." Hours ".$min." Min";
					}
					$description = $date1;
					$startdate = date("d M y",strtotime($row->start_date));
					$enddate = date("d M y",strtotime($row->end_date));
				}elseif($data['type'] == 4){
					$description = $row->description;
					$startdate = date("d M y",strtotime($row->startDate));
					$enddate = date("d M y",strtotime($row->endDate));
				}else{ }
				$objPHPExcel->getActiveSheet()->getStyle('A'.$i)->applyFromArray($cell_style);
				$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->applyFromArray($cell_style);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->applyFromArray($cell_style);
				$objPHPExcel->getActiveSheet()->getStyle('D'.$i)->applyFromArray($cell_style);
				$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(20);
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i,$title)
				->setCellValue('B'.$i,$description)
				->setCellValue('C'.$i,$startdate)
				->setCellValue('D'.$i,$enddate);
				$i++;
			}



			$objPHPExcel->setActiveSheetIndex(0);
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$fileName.'"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');
			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			exit;
		}
		public function deleteChallenge($data){
			$date = date('Y-m-d');
			$sel = $this->db->query("SELECT * FROM tbl_challenge WHERE id = '".$data['id']."' AND endDate < '".$date."'")->row();
			if(!empty($sel)){
				$sel_req = $this->db->query("SELECT * FROM tbl_challengeRequest WHERE chalnge_Id = '".$sel->id."' AND to_Id = '".$data['userId']."' AND from_Id = '".$data['userId']."'")->row();
				// print_r($sel_req);die;
				if(!empty($sel_req)){
					$this->db->where('id',$sel_req->id);
					$this->db->delete('tbl_challengeRequest');
					$find = $this->db->query("SELECT * FROM tbl_challengeRequest WHERE chalnge_Id = '".$sel->id."' ")->row();
					$this->db->where('id',$data['id']);
					$this->db->update('tbl_challenge',array('userId'=>$find->to_Id));
					$this->db->where('chalnge_Id',$find->chalnge_Id);
					$this->db->update('tbl_challengeRequest',array('from_Id'=>$find->to_Id));
				}else{
					$sel_req1 = $this->db->query("SELECT * FROM tbl_challengeRequest WHERE chalnge_Id = '".$sel->id."' AND to_Id = '".$data['userId']."'")->row();
					$this->db->where('id',$sel_req1->id);
					$this->db->delete('tbl_challengeRequest');
				}
				$sel12 = $this->Api_model->select_data('*','tbl_challengeRequest',array('chalnge_Id'=>$data['id']));
				$user = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$value->data['userId']."'")->row();
				foreach ($sel12 as $key => $value) {
					$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id != '".$value->to_Id."'")->row();
					if($pushstatus->notification_status == 0){
						$this->pushdata($pushstatus->id,$user->fullname."has delete the assignment.","deleteAssignRequest","Delect Assignment Request");
					}
				}
				return "delete";
			}else{
				return "error";
			}			
		}
		public function cancelChallenge($data){
			$current = date('Y-m-d');
			$past_date = date('Y-m-d', strtotime("-1 days", strtotime($current)));
			$sel = $this->Api_model->select_data('*','tbl_challengeRequest',array('chalnge_Id'=>$data['id']));
			if(!empty($sel)){
				$this->db->where('id',$sel[0]->chalnge_Id);
				$this->db->update('tbl_challenge',array('endDate'=>$past_date));
				$user = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$value->data['userId']."'")->row();
				foreach ($sel as $key => $value) {
					$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id != '".$value->to_Id."'")->row();
					if($pushstatus->notification_status == 0){
						$this->pushdata($pushstatus->id,$user->fullname."has cancelled the assignment.","cancelRequest","Cancel Request");
					}
				}
				return "cancel";
			}else{
				return "error";
			}
		}
		public function bookshare($bookid,$share){
			$sel = $this->Api_model->select_data('*','tbl_bookResource',array('id'=>$bookid));
			if(!empty($sel)){
				$decode = json_decode($share);
				foreach ($decode as $key => $value) {
					$select = $this->db->select("SELECT * FROM tbl_bookRequest WHERE book_id = '".$bookid."' AND to_id = '".$value."'")->row();
					if(empty($select)){
						$insert = $this->db->insert('tbl_bookRequest',array('book_id'=>$bookid,'to_id'=>$value,'status'=>0,'date_created'=>date('Y-m-d H:i:s')));
						$msg = "insert";
					}else{
						$msg = "already";
					}
				}
				return $msg;
			}else{
				return "error";
			}
		}
	}
	?>