<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <p>Activity List</p>
                        <a href="<?php echo base_url(); ?>Dashboard/userActivity">
                            <button class="btn btn-lg" type=""> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
                        </a>
                    </header>
                    <div class="row tab_penal_cust">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation"><a href="<?php echo base_url(); ?>Dashboard/activityList/<?php echo "weekly"; ?>/<?php echo $actList[0]->category_Id; ?>/<?php echo $actList[0]->userId; ?>">Weekly</a></li>

                                <li role="presentation"><a href="<?php echo base_url(); ?>Dashboard/activityList/<?php echo "monthly"; ?>/<?php echo $actList[0]->category_Id; ?>/<?php echo $actList[0]->userId; ?>">Monthly</a></li>

                                <li role="presentation" class="active"><a href="javascript:void(0);">Yearly</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="Weekly">
                                    <div class="panel-body">
                                        <div class="adv-table">
                                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No.</th>
                                                        <th>Name</th>
                                                        <th>Title</th>
                                                        <th>Date Created</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; foreach($actList as $list){ ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $i; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $list->fullname; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $list->taskTitle; ?>
                                                        </td>
                                                        <td>
                                                            <?php $date = $list->date_created; echo date("d M y", strtotime($date)); ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>Dashboard/activityDetail/<?php echo $list->userId; ?>">
                                                                <button class="Details_Button" type="button">Detail</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++ ; } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>