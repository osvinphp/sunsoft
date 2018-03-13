<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
           <p>Add Quotes</p>
            <a href="<?php echo base_url(); ?>quote">
                <button class="btn btn-md" type=""> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
            </a>
          </header>
          <div class="panel-body">
            <div class="form">
              <p class="error_msg" id="error"></p>
              <?php if ($this->session->flashdata('errorquo')) { ?>
                <div class="cudo_puntoo">
                  <h4><?php echo $this->session->flashdata('errorquo'); ?></h4>
                </div>
              <?php } ?>
              <form class="cmxform form-horizontal tasi-form" method="post" action="">
                <div class="form-group ">
                  <label for="firstname" class="control-label col-lg-2">Quotes</label>
                  <div class="col-lg-10">
                    <input class="form-control" name="quotetitle" type="text" id="quote" maxlength="500"/>
                     <span class="text-right_custum" id="desciption_len" style="color:#f00; padding: 5px 0 5px;">500 Characters remaining</span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-success"  name="addquote" type="submit" id="quotesub">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
</section>
