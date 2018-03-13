<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
         <header class="panel-heading">
            <p>Report List of <span class="color"> <?php echo $result[0]->fullname; ?> </span> </p>
            <a href="<?php echo base_url(); ?>Dashboard/UsersReport">
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
                    <th>Value</th>
                    <th>NextStep</th>
                    <th>Comment</th>
                    <th>Date Created</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach($result as $list){ ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $list->title; ?></td>
                      <td><?php echo $list->value; ?></td>
                      <td><?php echo $list->nextStep; ?></td>
                      <td><?php echo $list->comment; ?></td>
                      <td>
                        <?php 
                          $date = date("jS F, Y", strtotime($list->date_created));
                          $time = date("h:i A.", strtotime($list->date_created));
                          echo $date.'  At '.$time;
                        ?>
                      </td>
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