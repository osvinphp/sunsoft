<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">Activity List</header>
          <div class="panel-body">
            <div class="adv-table">
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Name</th>
                    <th>Total Activity</th>
                    <!-- <th>Date Created</th> -->
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      $i = 1; 
                      $static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
                      foreach ($userAct as $key => $value) {
                        $id = $value->userId . "_" . $static_key;
                        $uid = base64_encode($id); 
                  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $value->fullname; ?></td>
                      <td><?php echo $value->total; ?></td>
                      <td><a href="<?php echo base_url('details/'.$uid); ?>"><button class="Details_Button" type="button">View Details</button></a></td>
                    </tr>
                  <?php $i++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
</section>