<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <p>Activity Task List of <span class="color"> <?php echo $weekList[0]->fullname; ?> </span> </p>
                        <a href="<?php echo base_url(); ?>Dashboard/userActivity">
                            <button class="btn btn-md" type=""> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                        </a>
                    </header>
                    <div class="row tab_penal_cust">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#Weekly" aria-controls="Weekly" role="tab" data-toggle="tab">Weekly</a></li>
                                <li role="presentation"><a href="#Monthly" aria-controls="Monthly" role="tab" data-toggle="tab">Monthly</a></li>
                                <li role="presentation"><a href="#Yearly" aria-controls="Yearly" role="tab" data-toggle="tab">Yearly</a></li>
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
                                                    <th>Task Title</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; foreach($weekList as $list){ 
                                                  $userid = $list->userId;
                                                  $static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
                                                  $id = $userid . "_" . $static_key;
                                                  $uid = base64_encode($id);
                                                  $tid = $list->id . "_" . $static_key;                      
                                                  $id1 = base64_encode($tid);
                                                  $replace = array('!','@','#','$','%','^','&','*','(',')','+','=','[','{','}',']','>','<',',','.','/','|',':',';','~','`');
                                                  $taskid = str_replace($replace,'', $id1);
                                                  $user_id = str_replace($replace,'',$uid);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list->taskTitle; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $date = date("jS F, Y", strtotime($list->date_created));
                                                            $time = date("h:i A.", strtotime($list->date_created));
                                                            echo $date.'  At '.$time;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>Dashboard/activityDetail/<?php echo $user_id; ?>/<?php echo $taskid; ?>">
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
                            <div role="tabpanel" class="tab-pane" id="Monthly">
                                <div class="panel-body">
                                    <div class="adv-table">
                                        <table id="datatable1" class="table table-striped table-bordered" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Task Title</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; foreach($monthList as $list1){ 
                                                  $userid = $list1->userId;
                                                  $static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
                                                  $id = $userid . "_" . $static_key;
                                                  $uid = base64_encode($id);
                                                  $tid = $list1->id . "_" . $static_key;                      
                                                  $id1 = base64_encode($tid);
                                                  $replace = array('!','@','#','$','%','^','&','*','(',')','+','=','[','{','}',']','>','<',',','.','/','|',':',';','~','`');
                                                  $taskid = str_replace($replace,'', $id1);
                                                  $user_id = str_replace($replace,'',$uid);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list1->taskTitle; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $date = date("jS F, Y", strtotime($list1->date_created));
                                                            $time = date("h:i A.", strtotime($list1->date_created));
                                                            echo $date.'  At '.$time;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>Dashboard/activityDetail/<?php echo $user_id; ?>/<?php echo $taskid; ?>">
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
                            <div role="tabpanel" class="tab-pane" id="Yearly">
                                <div class="panel-body">
                                    <div class="adv-table">
                                        <table id="datatable2" class="table table-striped table-bordered" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Task Title</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; foreach($yearList as $list2){
                                                  $userid = $list2->userId;
                                                  $static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
                                                  $id = $userid . "_" . $static_key;
                                                  $uid = base64_encode($id);
                                                  $tid = $list2->id . "_" . $static_key;                      
                                                  $id1 = base64_encode($tid);
                                                  $replace = array('!','@','#','$','%','^','&','*','(',')','+','=','[','{','}',']','>','<',',','.','/','|',':',';','~','`');
                                                  $taskid = str_replace($replace,'', $id1);
                                                  $user_id = str_replace($replace,'',$uid);
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $list2->taskTitle; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $date = date("jS F, Y", strtotime($list2->date_created));
                                                            $time = date("h:i A.", strtotime($list2->date_created));
                                                            echo $date.'  At '.$time;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>Dashboard/activityDetail/<?php echo $user_id; ?>/<?php echo $taskid; ?>">
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