<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
	            <p>Events List of <span class="color"><?php echo $username; ?></span></p>
	            <a href="<?php echo base_url('events'); ?>">
	                <button class="btn btn-md" type=""> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
	            </a>
            </header>
          	<div class="panel-body">
            	<div class="adv-table">
              		<table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                		<thead>
		                  	<tr>
			                    <th>Sr.No.</th>
			                    <th>Title</th>
			                    <th>Place</th>
                          <th>Comment</th>
			                    <th>Event Start</th>
                          <th>Event End</th>
                          <!-- <th>Date Created</th> -->
			                    <!-- <th>Action</th> -->
		                  	</tr>
		                </thead>
                	<tbody>
                  	<?php $i = 1; foreach($detail as $list){ ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php if(!empty($list->eventTitle)){ echo $list->eventTitle; }else{ echo "N/A"; } ?></td>
                      <td><?php if(!empty($list->eventPlace)){ echo $list->eventPlace; }else{ echo "N/A"; } ?></td>
                      <td><?php if(!empty($list->eventComment)){ echo $list->eventComment; }else{ echo "N/A"; } ?></td>
                      <td>
                        <?php 
                          $date = date("jS F, Y", strtotime($list->startDate));
                          echo $date;
                        ?>
                      </td>
                      <td>
                        <?php 
                          $date = date("jS F, Y", strtotime($list->endDate));
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