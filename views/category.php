<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">Dashboard List</header>
          <div class="panel-body">
            <div class="adv-table">
              <div class="table-responsive">
              <?php if ($this->session->flashdata('cat_error')) { ?>
                <div class="cudo_puntoo">
                  <h4><?php echo $this->session->flashdata('cat_error'); ?></h4>
                </div>
              <?php } ?>
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>upperTitle</th>
                    <th>Picture</th>
                    <th>lowerTitle</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                	<?php $i = 1; foreach ($cat as $catlist) { ?>
                  <tr>
                		<td><?php echo $i; ?></td>
                		<td>
                			<?php
                				if(empty($catlist->upperTitle)){
                					echo "N/A";
                				}else{
                					echo $catlist->upperTitle;
                				}

                			?>
                		</td>
                		<td>
                			<?php
                				if(empty($catlist->image)){
                					echo "N/A";
                				}else{
                					echo "<img src=".$catlist->image." width='200px' height='200px'>";
                				}
                			?>
                		</td>
                		<td>
                			<?php
                				if(empty($catlist->lowerTitle)){
                					echo "N/A";
                				}else{
                					echo $catlist->lowerTitle;
                				}

                			?>
                		</td>
                  	<td>
                  		<a href="#" data-toggle="modal" data-target="#cat<?php echo $i; ?>"><button class="EDIT_Button" type="button" value="Edit">Edit</button></a>
                  	</td>
                  </tr>
                  <div class="modal fade" id="cat<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit category info</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="<?php echo base_url(); ?>catedit/<?php echo $catlist->id; ?>" method="POST" enctype="multipart/form-data">
                          <div class="modal-body">                          
                            <div class="form-group">
                              <label for="exampleInputName2">Upper Title</label>
                              <input class="form-control" type="text" name="uppertitle" value="<?php echo $catlist->upperTitle; ?>">
                              <label for="exampleInputName2">Lower Title</label>
                              <input class="form-control" type="text" name="lowertitle" value="<?php echo $catlist->lowerTitle; ?>">
                              <input type="file" name="profile_pic">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <ul class="list-inline banner-social-buttons">
                              <li><input type="submit" class="btn btn-primary" name="updatecat" value="Update"></li>
                              <li><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></li>
                            </ul>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <?php $i++ ; } ?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
</section>