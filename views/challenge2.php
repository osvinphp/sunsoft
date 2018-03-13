<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading add_float">
            <p>Admin Challenge</p>
            <a href="<?php echo base_url(); ?>create">
              <button class="btn btn-md" type="">Add Challenge</button>
            </a>
          </header>
          <div class="panel-body">
            <div class="adv-table">
              <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <?php if ($this->session->flashdata('errmsg')) { ?>
                  <div class="cudo_puntoo">
                    <h4><?php echo $this->session->flashdata('errmsg'); ?></h4>
                  </div>
                <?php } ?>
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Tile</th>
                    <th>Description</th>
                    <th>Action</th>
                   <!-- <th>Date Created</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach($list as $value){ ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $value->title; ?></td>
                      <td><?php echo $value->description; ?></td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#EditChall<?php echo $i; ?>"><button class="EDIT_Button" type="button" value="Edit">Edit</button></a>
                        <a href="<?php echo base_url(); ?>del/<?php echo $value->id; ?>"><button class="DELETE_Button" type="button">Delete</button></a>
                      </td>
                    </tr>
                    <div class="modal fade" id="EditChall<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Challenge</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action=""  id="chalformed" method="POST">
                            <div class="modal-body">
                              <p class="error_msg" id="error<?php echo $value->id; ?>"></p>
                                <div class="form-group">
                                  <label for="exampleInputName2">Tittle</label>
                                  <input class="form-control" type="text" id="titlefe<?php echo $value->id; ?>" value="<?php echo $value->title; ?>" name="title">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName2">Description</label>
                                  <input class="form-control" type="text" id="descripfe<?php echo $value->id; ?>" value="<?php echo $value->description; ?>" name="description">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <ul class="list-inline banner-social-buttons">
                                  <li><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></li>
                                  <li><button type="button" class="btn btn-primary" name="chaleEdit" onclick="myChaledit(<?php echo $value->id; ?>);" value="Update">Update</li>
                                </ul>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  <?php $i++; } ?>
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