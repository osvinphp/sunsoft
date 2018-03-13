<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <p>Add Challenges</p>
              <a href="<?php echo base_url(); ?>challenge">
                  <button class="btn btn-md" type=""> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
              </a>
            </header>
            <div class="panel-body">
              <div class="form">
              <?php if ($this->session->flashdata('errmsg')) { ?>
                <div class="cudo_puntoo">
                  <h4><?php echo $this->session->flashdata('errmsg'); ?></h4>
                </div>
              <?php } ?>
                <p class="error_msg" id="error"></p>
                <p id="success" class="error_msg" style="color:green;"></p>
                <form class="cmxform form-horizontal tasi-form" method="post" action="javascript:void(0);" id="adchalenge1">
                 <!--  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Select Category Icon</label>
                      <input type="file" name="profile_pic"> -->
                    <!-- <select name="cat_id">
                      <option value="<?php echo $cat_id[6]->id; ?>"><?php echo $cat_id[6]->lowerTitle; ?></option>
                    </select> -->
                  <!-- </div> -->
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Title</label>
                      <div class="col-lg-10">
                        <input class=" form-control" name="chalngetitle" type="text" id="chaltitle"/>
                      </div>
                  </div>
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Description</label>
                      <div class="col-lg-10">
                        <input class=" form-control" name="description" type="text" id="chaldes"/>
                      </div>
                  </div>
                 <!--  <div class="form-group ">
                      <label for="lastname" class="control-label col-lg-2">Hint</label>
                      <div class="col-lg-10">
                          <input class=" form-control" id="hint" name="hint" type="text" required="" />
                      </div>
                  </div>
                  <div class="form-group ">
                      <label for="username" class="control-label col-lg-2">Description</label>
                      <div class="col-lg-10">
                          <input class="form-control " id="description" name="description" type="text" required="" />
                      </div>
                  </div> -->
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-success"  name="addChalenge" type="submit" id="challsubmit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    <!-- page end-->
  </section>
</section>
<!--main content end-->
<script src="<?php echo base_url("public/js/form-validation-script.js")?>"></script>
