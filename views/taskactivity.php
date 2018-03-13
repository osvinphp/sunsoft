<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">Activity List</header>
          <div class="panel-body">
            <div class="adv-table">
              <!-- <div class="table-responsive"> -->
                <?php if ($this->session->flashdata('update')) { ?>
                  <div class="cudo_puntoo">
                    <h4><?php echo $this->session->flashdata('update'); ?></h4>
                  </div>
                <?php } ?>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sr.No.</th>
                      <th>Activity Title</th>
                      <th>Date Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; foreach($taskAct as $list){ ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $list->taskTitle; ?></td>
                      <td>
                        <?php 
                          $date = date("jS F, Y", strtotime($list->date_created));
                          $time = date("h:i A.", strtotime($list->date_created));
                          echo $date.'  At '.$time;
                        ?>
                      </td>
                      <td><a href="#" data-toggle="modal" data-target="#update<?php echo $i; ?>"><button class="EDIT_Button" type="button" value="Edit">Update</button></a></td>
                    </tr>
                    <div class="modal fade" id="update<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Update Activity title</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form action="<?php echo base_url(); ?>Dashboard/updateTaskActivity/<?php echo $list->id; ?>" method="POST">
                                <div class="form-group">
                                  <!-- <label for="exampleInputName2">Name</label> -->
                                  <input class="form-control" type="text" name="tasktitle" placeholder="Activity title">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <ul class="list-inline banner-social-buttons">
                                  <li><input type="submit" class="btn btn-primary" name="update" value="Update"></li>
                                </ul>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    <?php $i++ ; } ?>
                  </tbody>
                </table>
             <!--  </div> -->
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
</section>