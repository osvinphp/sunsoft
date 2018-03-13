<!--sidebar end-->
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">Users List</header>
          <div class="panel-body">
            <div class="adv-table">
              <div class="table-responsive">
              <?php if ($this->session->flashdata('msg')) { ?>
                <div class="cudo_puntoo">
                  <h4><?php echo $this->session->flashdata('msg'); ?></h4>
                </div>
              <?php } ?>
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile Pic</th>
                    <!-- <th>Working hour</th> -->
                    <th>Member since</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $i=1; 
                    foreach($users as $key => $value){ 
                      $id = $value->id;
                      $static_key = "afvsdsdjkldfoiuyfdrv546n4b32j4b2kj2z";
                      $userid = $value->id . "_" . $static_key;
                      $uid = base64_encode($userid);
                      $replace = array('!','@','#','$','%','^','&','*','(',')','+','=','[','{','}',']','>','<',',','.','/','|',':',';','~','`');
                      $user_id = str_replace($replace,'',$uid);
                      $minutes = $value->workhour;
                      $hours = floor($minutes / 60);
                      $min = $minutes - ($hours * 60);
                      if($hours == 0){
                        $date1 = $minutes. " Minutes";
                      }elseif($min == 0 && $hours < 2){
                        $date1 = $hours."Hour";
                      }elseif($min == 0){
                        $date1 = $hours."Hours";
                      }else{
                        $date1 =  $hours." Hours ".$min." Minutes";
                      }
                  ?>
                    <tr>
                      <td>
                        <?php echo $i; ?>
                      </td>
                      <td>
                        <?php 
                          if(isset($value->fullname)){
                            echo $value->fullname;
                          }else{
                            echo "";
                          }
                        ?>
                      </td>
                      <td>
                        <?php echo  $value->email; ?>
                      </td>
                      <td> 
                          <?php if(!empty($value->profile_pic)){ ?>
                            <img src="<?php echo $value->profile_pic; ?>" width="150px" height="150px">
                          <?php }else{ echo "N/A"; } ?>
                      </td>
                      <!-- <td>
                        <?php if(empty($minutes)){ echo 'N/A'; }else{ echo $date1 ; } ?>
                      </td> -->
                      <td>
                        <?php 
                          $date = date("jS F, Y", strtotime($value->date_created));
                          $time = date("h:i A.", strtotime($value->date_created));
                          echo $date.'  At '.$time;
                        ?>
                      </td>
                      <td>
                        <!-- <a href="#" data-toggle="modal" data-target="#Edit<?php echo $i; ?>"><button class="EDIT_Button" type="button" value="Edit">Edit</button></a>   <a href="#" data-toggle="modal" data-target="#Delete<?php echo $i; ?>"><button class="DELETE_Button" type="button" value="Delete">Delete</button></a>  --> 
                        <?php $type = $value->is_suspend; if($value->is_suspend == 0){ ?>
                          <a href="javascript:void(0);" onclick="myfun(<?php echo $value->id; ?>);"><button class="SUSPEND_Button" type="button" id="suspend<?php echo $value->id; ?>">Suspend</button></a>
                        <?php }else{ ?>
                          <a href="javascript:void(0);" onclick="myfun(<?php echo $value->id; ?>);"><button class="SUSPEND_ACtive" type="button" id="suspend<?php echo $value->id; ?>">Activate</button></a>
                        <?php } ?>
                        <!-- <?php $type = $value->is_suspend; if($value->is_suspend == 0){ ?>
                          <button type="button">Suspend</button></a>
                        <?php }else{ ?>
                         <button type="button">Activate</button></a>
                        <?php } ?> -->
                      </td>
                    </tr>
                   <!--  <div class="modal fade" id="Edit<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="<?php echo base_url(); ?>edit/<?php echo $user_id; ?>" method="POST">
                              <div class="form-group">
                                <!-- <label for="exampleInputName2">Name</label> -->
                              <!--   <input class="form-control" type="text" id="username" name="username" placeholder="Enter Your name">
                              </div>
                          </div>
                          <div class="modal-footer">
                              <ul class="list-inline banner-social-buttons">
                                <li><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></li>
                                <li><input type="submit" class="btn btn-primary" name="edit" value="Update"></li>
                              </ul>
                          </div>
                          </form>
                        </div>
                      </div> -->
                    <!-- </div>
                    <div class="modal fade" id="Delete<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h4>Do you really want to delete this account!</h4>
                          </div>
                          <div class="modal-footer">
                            <ul class="list-inline banner-social-buttons">
                              <li>
                                <a href="<?php echo base_url(); ?>delete/<?php echo $value->id; ?>"><input type="submit" class="btn btn-primary" name="edit" value="Delete"></a>
                              </li>
                              <li>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div> -->
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  <!-- page end-->
  </section>
</section>

