<style>
.displaynone{
  display:none;
}
</style>
<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading add_float">
            <p>Quotes List</p>
            <a href="<?php echo base_url(); ?>addquo">
              <button class="btn btn-md" type="">Add New Quotes</button>
            </a>
          </header>
          <div class="panel-body">
            <div class="adv-table">
             <div class="table-responsive">
              <p class="error_msg" id="response"></p>
              <?php if ($this->session->flashdata('delquo')) { ?>
                <div class="cudo_puntoo">
                  <h4><?php echo $this->session->flashdata('delquo'); ?></h4>
                </div>
              <?php } ?>
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Quotes</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($quote as $key => $value) { ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td>
                      <div id="quote_val<?php echo $value->id; ?>"><?php echo $value->quote; ?></div>
                      <span class="displaynone" id="desciption_lenn<?php echo $value->id; ?>" style="color:#f00; padding: 5px 0 5px;">500 Characters remaining</span>
                    </td>
                    <td>
                      <button class="EDIT_Button" type="button" id="editquoteval<?php echo $value->id; ?>" onclick="editFunction(<?php echo $value->id; ?>)">Edit</button>
                      <a href="#" data-toggle="modal" data-target="#Deletequote<?php echo $i; ?>"><button  type="button" value="Delete" class="DELETE_Button">Delete</button></a>
                      <!--  class="DELETEC_Button" -->
                    </td>
                  </tr>


                  <div class="modal fade" id="Deletequote<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Quote</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h4>Do you really want to delete this Quote!</h4>
                        </div>
                        <div class="modal-footer">
                          <ul class="list-inline banner-social-buttons">
                            <li>
                              <a href="<?php echo base_url(); ?>Dashboard/delete_quote/<?php echo $value->id; ?>"><input type="submit" class="btn btn-primary" name="edit" value="Delete"></a>
                            </li>
                            <li>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>


                  <?php $i++; } ?>
                </tbody>
              </table>
           <!--  </div> -->
            </div>
          </div>
        </section>
      </div>
    </div>
  <!-- page end-->
  </section>
</section>


