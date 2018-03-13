<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <p>Activity Details of <span class="color"> <?php echo $username; ?> </span> </p>
            <a href="<?php echo base_url(); ?>activity">
                <button class="btn btn-md" type=""> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
            </a>
          </header>
          <div class="panel-body">
            <div class="adv-table">
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Activity Title</th>
                    <th>Activity Description</th>
                    <th>Activity Starts</th>
                    <th>Activity Ends</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach($details as $key => $list){ ?>
                  <tr>
                    <td>
                      <?php echo  $i; ?>
                    </td>
                    <td>
                      <?php echo $list->task_name; ?>
                    </td>
                    <td>
                      <?php
                        if(!empty($list->description)){
                          $decode=json_decode($list->description);
                          $j = 1;
                          foreach($decode as $subList){
                            echo $j.') '.$subList->item.'. <br>';
                            $j++;
                          }
                        }else{
                          echo "N/A";
                        }
                      ?>
                    </td>
                    <td>
                      <?php 
                        $date = date("jS F, Y", strtotime($list->date_created));
                        $time = date("h:i A.", strtotime($list->date_created));
                        echo $date.'  At '.$time;
                      ?>
                    </td>
                    <td>
                      <?php 
                        if($list->end_date != "0000-00-00 00:00:00"){
                          $date = date("jS F, Y", strtotime($list->end_date));
                          $time = date("h:i A.", strtotime($list->end_date));
                          echo $date.'  At '.$time;
                        }else{
                          echo "-";
                        }
                      ?>
                    </td>
                    <td><?php if($list->status == 1){ echo "Completed"; }else{ echo "In Progess"; } ?></td>
                  </tr>
                  <?php $i++ ; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
</section>