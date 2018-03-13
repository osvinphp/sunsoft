<section id="main-content">
  <section class="wrapper site-min-height">
    <!-- page start-->
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
              <p>Add Task Title</p>
            </header>
            <div class="panel-body">
              <div class="form">
              <?php if ($this->session->flashdata('errmsg')) { ?>
                <div class="cudo_puntoo">
                  <h4><?php echo $this->session->flashdata('errmsg'); ?></h4>
                </div>
              <?php } ?>
                <form class="cmxform form-horizontal tasi-form" id="signupForm" method="post" action="<?php echo base_url("Dashboard/addActivity")?>">
                  <div class="form-group ">
                    <label for="firstname" class="control-label col-lg-2">Title</label>
                      <div class="col-lg-10">
                        <input class=" form-control" id="name" name="title" type="text"/>
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
                      <button class="btn btn-success"  name="addTask" type="submit">Submit</button>
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
