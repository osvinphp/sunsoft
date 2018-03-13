<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <p>Report List</p>
          </header>
          <div class="panel-body">
            <div class="adv-table">
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Name</th>
                    <th>Total Reports</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach($reports as $list){ 
                    $userid = $list->userId;

                   //$static_key = "afvsdsdjkldfoiuy4uiskahkhsajbjksasdasdgf43gdsddsf";
                    // $id = $userid . "_" . $static_key;
                    // $uid = base64_encode($id);
                    // $user_id = str_replace('=','',$uid);
                  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $list->name; ?></td>
                      <td><?php echo $list->totalReport; ?></td>
                      <td>
                      <a href="<?php echo base_url(); ?>Dashboard/AllReport/<?php echo $userid; ?>">
                          <button class="Details_Button" type="button">Detail</button>
                      </a>
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