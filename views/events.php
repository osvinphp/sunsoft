<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <p>Event List</p>
          </header>
          <div class="panel-body">
            <div class="adv-table">
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Name</th>
                    <th>Total Events</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach($data as $list){
                      $static_key = "!#hkj#H>wsKJ43243jjJKJKjk##h342423jkdewdf";
                      $id = $list->userId . "_" . $static_key;
                      $uid = base64_encode($id);
                  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $list->fullname; ?></td>
                      <td><?php echo $list->total; ?></td>
                      <td><a href="<?php echo base_url('eventdetails/'.$uid); ?>"><button class="Details_Button" type="button">Detail</button></a></td>
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