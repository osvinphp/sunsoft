<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
	            <p>Goals List of <span class="color"><?php echo $username; ?></span></p>
	            <a href="<?php echo base_url('goals'); ?>">
	                <button class="btn btn-md" type=""> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
	            </a>
            </header>
          	<div class="panel-body">
            	<div class="adv-table">
              		<table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                		<thead>
		                  	<tr>
			                    <th>Sr.No.</th>
			                    <th>Goal Title</th>
			                    <th>Goal Rules</th>
                          <th>Spent Hour</th>
			                    <th>Goal Start</th>
                          <th>Goal End</th>
                          <!-- <th>Date Created</th> -->
			                    <!-- <th>Action</th> -->
		                  	</tr>
		                </thead>
                	<tbody>
                  	<?php $i = 1; foreach($detail as $list){ ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php if(!empty($list->title)){ echo $list->title; }else{ echo "N/A"; } ?></td>
                      <td>
                        <?php
                          $decode=$list->workDes;
                          if(!empty($decode)){
                            $j = 1;
                            foreach($decode as $subList){
                              echo $j.') '.$subList->rule_name.'. <br>';
                              $j++;
                            }
                          }else{
                            echo "N/A";
                          }
                        ?>
                      </td>
                      <td>
                      	<?php
                      		$minutes = $list->total_time;
                      		if(!empty($minutes)){
		                      	$hours = floor($minutes / 60);
		                      	$min = $minutes - ($hours * 60);
		                     	if($hours == 0){
		                        	$time = $minutes. " Minutes";
		                      	}elseif($min == 0 && $hours < 2){
		                        	$time = $hours." Hour";
		                      	}elseif($min == 0){
		                        	$time = $hours." Hours";
		                      	}else{
		                        	$time =  $hours." Hours ".$min." Minutes";
		                      	}
	                      		echo $time;
	                      	}else{
	                      		echo "N/A";
	                      	}
                      	?>
                      </td>
                      <td>
                        <?php 
                          $date = date("jS F, Y", strtotime($list->start_date));
                          echo $date;
                        ?>
                      </td>
                      <td>
                        <?php 
                          $date = date("jS F, Y", strtotime($list->end_date));
                          echo $date;
                        ?>
                      </td>
                      
                    <!--   <td><a href="<?php echo base_url(); ?>Dashboard/workingDetail/<?php echo $list->category_Id; ?>/<?php echo $list->userId; ?>"><button class="Details_Button" type="button">Detail</button></a></td> -->
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