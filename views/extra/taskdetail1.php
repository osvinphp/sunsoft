<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <p>Activity List</p>
                        <a href="<?php echo base_url(); ?>Dashboard/userActivity">
                            <button class="btn btn-lg" type=""> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                        </a>
                    </header>
                    <div class="row tab_penal_cust">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation"><a href="<?php echo base_url(); ?>Dashboard/activityList/<?php echo "weekly"; ?>/<?php echo $actList[0]->category_Id; ?>/<?php echo $actList[0]->userId; ?>">Weekly</a></li>

                                <li role="presentation" class="active"><a href="javascript:void(0);">Monthly</a></li>

                                <li role="presentation"><a href="<?php echo base_url(); ?>Dashboard/activityList/<?php echo "yearly"; ?>/<?php echo $actList[0]->category_Id; ?>/<?php echo $actList[0]->userId; ?>">Yearly</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="Weekly">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th>Name</th>
                                                        <th>Title</th>
                                                        <th>Date Created</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; foreach($actList as $list){ ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $list->fullname; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $list->taskTitle; ?>
                                                        </td>
                                                        <td>
                                                            <?php $date = $list->date_created; echo date("d M y", strtotime($date)); ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>Dashboard/activityDetail/<?php echo $list->userId; ?>">
                                                                <button class="Details_Button" type="button">Detail</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++ ; } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>


<?php 
    // public function activitylist($type,$cat_id,$id){
    //     if($type == "weekly"){
    //         $from_date = date('Y-m-d H:i:s',strtotime('-6 days'));
    //     }elseif($type == "monthly"){
    //         $from_date = date('Y-m-d H:i:s',strtotime('-30 days'));
    //     }elseif($type == "yearly"){
    //         $from_date = date('Y-m-d H:i:s',strtotime('-365 days'));
    //     }else{
    //         return "error";
    //     }       
    //     $to_date = date('Y-m-d H:i:s');
    //     $this->db->select('*');
    //     $this->db->from('tbl_task');
    //     $this->db->where('userId',$id);
    //     $this->db->where('category_Id',$cat_id);
    //     $this->db->where('date_created >=',$from_date);
    //     $this->db->where('date_created <',$to_date);
    //     $this->db->order_by('date_created','desc');
    //     $sel = $this->db->get()->result();
    //     foreach($sel as $value){
    //         $this->db->select('*');
    //         $this->db->from('tbl_users');
    //         $this->db->where('id',$value->userId);
    //         $query = $this->db->get()->row()->fullname;
    //         $value->fullname = empty($query)?'':$query;
    //     }
    //     return $sel;
    // }

    // public function activityList($type,$cat_id,$id){
    //     $result['actList'] = $this->Admin_model->activitylist($type,$cat_id,$id);
    //     $this->template();
    //     if($type == "weekly"){
    //         $this->load->view('taskdetail',$result);
    //     }elseif($type =="monthly"){
    //         $this->load->view('taskdetail1',$result);
    //     }elseif($type =="yearly"){
    //         $this->load->view('taskdetail2',$result);
    //     }else{
    //         $this->load->view('errors/html/error_404');
    //     }
    //     $this->load->view('templete/footer');
    // }
    ?>