<section id="main-content">
  <section class="wrapper site-min-height">
    <div class="row">
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
            <p>Goals List</p>
          </header>
          <div class="panel-body">
            <div class="adv-table">
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Name</th>
                    <th>Total Goals</th>
                    <th>Total Hours</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach($data as $list){ 
                      $userid = $list->userId;
                      $static_key = "!#hkj#H>wsKJ43243jjJKJKjk##h342423jkdewdf";
                      $id = $userid . "_" . $static_key;
                      $uid = base64_encode($id);
                      $minutes = $list->sum;
                      $hours = floor($minutes / 60);
                      $min = $minutes - ($hours * 60);
                      if($hours == 0){
                        $date1 = $minutes. " Minute";
                      }elseif($min == 0 && $hours < 2){
                        $date1 = $hours." Hour";
                      }elseif($min == 0){
                        $date1 = $hours." Hours";
                      }else{
                        $date1 =  $hours." Hours ".$min." Minutes";
                      }
                  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $list->fullname; ?></td>
                      <td><?php echo $list->total; ?></td>
                      <td><?php if(empty($minutes)){ echo 'N/A'; }else{ echo $date1 ; } ?></td>
                      <td><a href="<?php echo base_url('goaldetails/'.$uid); ?>"><button class="Details_Button" type="button">Detail</button></a></td>
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