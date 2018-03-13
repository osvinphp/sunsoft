<?php 
	if($this->session->flashdata('msg_succ')){ 
 		echo $this->session->flashdata('msg_succ');
	} 
?>