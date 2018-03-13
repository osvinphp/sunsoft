<?php
error_reporting(1);
//ini_set('display_error', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
	function __construct(){
	    parent::__construct();
	    $this->load->model('Api_model','',TRUE);
	    $this->load->helper('url');
	}

	public function index(){

	}
	public function cron(){
		// print(date_default_timezone_get());die;
		$current = date('Y-m-d H:i:s');
		$date = strtotime($current);
		$var = $this->Api_model->select_data('*','tbl_events');
		foreach ($var as $key => $value) {
			$eventDate = $value->startDate.' '.$value->reminder;
			$start = strtotime($eventDate);
			$sel = $this->Api_model->select_data("*","tbl_cron",array('event_id'=>$value->id));
			if(empty($sel)){
				if($value->reminder != '00:00:00'){

					if($date > $start){
						$selOthers = $this->db->select('*')
						                      ->from('tbl_goalEventInvitation')
						                      ->where('goalEvent_id',$value->id)
						                      ->where('status',1)
						                      ->get()->result();
						$this->db->insert('tbl_cron',array('event_id'=>$value->id,'date_created'=>date('Y-m-d H:i:s')));
						$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$value->userId."' ")->row();
							if($pushstatus->notification_status == 0){
					        	$this->Api_model->pushdata($pushstatus->id,"Reminder for ".$value->eventTitle.".","reminder","",$value->id);
					        }
						foreach ($selOthers as  $selData) {
					
					    	$pushstatusALL = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$selData->to_id."' ")->row();
							if($pushstatusALL->notification_status == 0){
					        	$this->Api_model->pushdata($pushstatusALL->id,"Reminder for ".$value->eventTitle.".","reminder","",$value->id);
					        }
						}

					}
				}
			}
		}
	}


/*******  Cron job to set reminder for invited friends **********/
	public function InviteRemindercron(){
		$current = date('Y-m-d H:i:s');
		$date = strtotime($current);
		$var = $this->Api_model->select_data('*','tbl_friendsReminder');
		foreach ($var as $key => $value) {
			$eventDate = $value->start_date.' '.$value->reminder;
			$start = strtotime($eventDate);
			$sel = $this->Api_model->select_data("*","tbl_cron",array('event_id'=>$value->event_id));
			if(empty($sel)){
				if($value->reminder != '00:00:00'){
					if($date > $start){
						$this->db->insert('tbl_cron',array('event_id'=>$value->event_id,'date_created'=>date('Y-m-d H:i:s')));
						$pushstatus = $this->db->query("SELECT * FROM tbl_friendsReminder WHERE to_id = '".$value->to_id."' ")->row();
						// if($pushstatus->notification_status == 0){
				        	$this->Api_model->pushdata($pushstatus->to_id,"Reminder for ".$value->eventTitle.".","reminder","",$value->to_id);
				        // }
					}
				}
			}
		}
	}

	public function challengeCron(){
		$current = date('Y-m-d');
		$date = strtotime($current);
		$var = $this->Api_model->select_data('*','tbl_challenge','(type = 0 OR type = 1)');
		foreach($var as $key =>$value){
			$chalstr = $value->startDate;
			$start = strtotime($chalstr);
			$chalend = $value->endDate;
			$end = strtotime($chalend);
			$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$value->userId."' ")->row();
			if($pushstatus->notification_status == 0){
				if($date == $start){				
					//$this->db->insert('tbl_notifications',array('type'=>7,'task_id'=>$value->id,'to_id'=>$value->userId,'date_created'=>date('Y-m-d H:i:s')));
	  				$this->Api_model->pushdata($pushstatus->id,"Challenge Start","challengeStart","",$value->id);
		 		}
				if($date == $end){				
					//$this->db->insert('tbl_notifications',array('type'=>8,'task_id'=>$value->id,'to_id'=>$value->userId,'date_created'=>date('Y-m-d H:i:s')));
	  				$this->Api_model->pushdata($pushstatus->id,"Challenge End","challengeEnd","",$value->id);
	  			}
			}			
		}
	}

	public function eventCron(){
		$current = date('Y-m-d');
		$date = strtotime($current);
		$var1 = $this->Api_model->select_data('*','tbl_events');
		foreach($var1 as $key =>$value1){
			$chalstr = $value1->startDate;
			$start = strtotime($chalstr);
			$chalend = $value1->endDate;
			$end = strtotime($chalend);
			$value1->str = $start;
			$value1->ee = $end;
			$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$value1->userId."' ")->row();
			if($pushstatus->notification_status == 0){
				if($date == $start){
					//$this->db->insert('tbl_notifications',array('type'=>9,'task_id'=>$value1->id,'to_id'=>$value1->userId,'date_created'=>date('Y-m-d H:i:s')));
	  				$this->Api_model->pushdata($pushstatus->id,"event start","eventStart","",$value1->id);
		 		}
				if($date == $end){
					//$this->db->insert('tbl_notifications',array('type'=>10,'task_id'=>$value1->id,'to_id'=>$value1->userId,'date_created'=>date('Y-m-d H:i:s')));
	  				$this->Api_model->pushdata($pushstatus->id,"event end","eventEnd","",$value1->id);
		 		}
			}			
		}
	}

	public function goalCron(){
		$current = date('Y-m-d');
		$date = strtotime($current);
		$var2 = $this->Api_model->select_data('*','tbl_goalsCalender');
		foreach($var2 as $key =>$value2){
			$chalstr = $value2->start_date;
			$start = strtotime($chalstr);
			$chalend = $value2->end_date;
			$end = strtotime($chalend);
			$value2->str = $start;
			$value2->ee = $end;
			$pushstatus = $this->db->query("SELECT * FROM tbl_users WHERE id = '".$value2->userId."' ")->row();
			if($pushstatus->notification_status == 0){
				if($date == $start){	
					//$this->db->insert('tbl_notifications',array('type'=>11,'task_id'=>$value->id,'to_id'=>$value->userId,'date_created'=>date('Y-m-d H:i:s')));
	  				$this->Api_model->pushdata($pushstatus->id,"goal start","goalStart","",$value2->id);
		 		}
				if($date == $end){
					//$this->db->insert('tbl_notifications',array('type'=>12,'task_id'=>$value->id,'to_id'=>$value->userId,'date_created'=>date('Y-m-d H:i:s')));
	  				$this->Api_model->pushdata($pushstatus->id,"Goal end","goalEnd","",$value2->id);
		 		}
			}			
		}
	}
}
?>