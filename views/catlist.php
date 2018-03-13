
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                             Category List
                          </header>
                                <?php if ($this->session->flashdata('msg1')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg1'); 
                                ?>
                                </div>
                                <?php } ?>
                                       <?php if ($this->session->flashdata('msg2')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg2'); 
                                ?>
                                </div>
                                <?php } ?>
                                 <?php if ($this->session->flashdata('msg3')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg3'); 
                                ?>
                                </div>
                                <?php } ?>
                                      <?php if ($this->session->flashdata('msg4')!='') { ?>
                                <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php
                                echo $this->session->flashdata('msg4'); 
                                ?>
                                </div>
                                <?php } ?>
                          <a class="btn btn-info" role="button" href="<?php echo base_url("Dashboard/addcategory")?>">Add Category </a>
                          <div class="panel-body">
                                <div class="adv-table">
                                    <table  class="display table table-bordered table-striped" id="example">
                                      <thead>
                                      <tr>
                                          <th>Sr.No.</th>
                                          <th>Name</th>
                                          <th>Hint</th>
                                          <th>Description</th>
                                          <th>Date Created</th>
                                          <th>Action</th>
                                      </tr>
                                      </thead>
                                       <?php
                                       $i=1;
                                       foreach ($category as $key => $value) {
                                          // echo "<pre>";
                                          // print_r($value);
                                        ?>

                                        <tr id ='hello<?php echo $value->id; ?>'> 
                                        <td>

                                          <?php echo $i; ?>
                                        </td>
                                        <td>
                                        <input type="hidden" name="name" data-id="<?php echo $value->name ; ?>" >
                                          <?php 

                                           if (isset($value->name)) {
                                          echo $value->name; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                        <td>
                                       <input type="hidden" name="hint" data-id="<?php echo $value->hint ; ?>" >
                                          <?php echo  $value->hint; ?>
                                        </td>
                                           <td>
                                            <input type="hidden" name="description" data-id="<?php echo $value->description ; ?>" >
                                          <?php 
                                           if (!empty($value->description)) {
                                          echo $value->description; 
                                           }
                                           else{
                                            echo "N\A";
                                           }  ?>
                                        </td>
                                        <td>
                                          <?php $date= $value->creation_date;
                                          echo date("F d, Y", strtotime($date));
                                           ?>
                                        </td>
                                          <td>
                                          <button type="button" class="btn btn-info deleteAction" data-toggle="modal" data-target="#myModal" data-id="<?php echo $value->id; ?>" data-name="<?php echo $value->name; ?>" data-hint="<?php echo $value->hint; ?>" data-description="<?php echo $value->description; ?>" >Edit</button>
                                          <button type="button" class="delete btn btn-danger" id="<?php echo $value->id;?>" >Delete</button>
                                         
                                        </td>
                                       </tr>

                                      <?php 
                                        $i++;
                                        }
                                       

                                        ?>




                                      </tbody>
                           
                                  </table>
                                </div>
                          </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
<?php 
 $this->load->view('templete/footer');
?>
      <!--footer end-->
  


    <!--script for this page only-->
    <script type="text/javascript" language="javascript" src="<?php echo base_url("public/assets/advanced-datatable/media/js/jquery.dataTables.js")?>"></script>

      <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#example').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );
          } );
      </script>
  </body>
</html>
  <div class="panel-body">
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Update Your Detail Here</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" id="default" method="POST" action="<?php echo base_url("Dashboard/editcatlist")?>">
                      <div class="form-group">
                       
                        <div class="col-lg-8">
                         Name: <input type="text"  class="form-control" id="name"  name="name" value="" >
                        </div>
                         <div class="col-lg-8">
                         Hint: <input type="text"  class="form-control" id="hint"  name="hint" value="" >
                        </div>
                         <div class="col-lg-8">
                         Description: <input type="text"  class="form-control"  id="description"  name="description" value="">
                        </div>

                      </div>
                   
                      <input type="hidden" name= "submitid" id='hiddid' value=""/>
                      <button  type="submit" class="btn btn-info editdata"  >Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
<script type="text/javascript">

       $(document).ready(function() {
       $('#myModal').on('show.bs.modal', function(e) {
    var userid = $(e.relatedTarget).data('id');
    var name = $(e.relatedTarget).data('name');
    var hint = $(e.relatedTarget).data('hint');
    var description = $(e.relatedTarget).data('description');
    
    document.getElementById('hiddid').value = userid;
    document.getElementById('name').value = name;
    document.getElementById('hint').value = hint;
    document.getElementById('description').value = description;
    


       });

     });
 
   </script>

 <script> 
 $(document).ready(function(){

   $(".delete").click(function(event){
        var result = confirm("Are you Sure to delete?");
        if (result) {

         var id = $(this).attr("id");  

         $.ajax({
          type: "POST",
          url: "http://phphosting.osvin.net/sunSoft/Dashboard/deletecat",
          data: {id:id},
          success: function(response) {
                  if (response == "1")
                  {
                    $("#hello"+id).slideUp(100, function() {
                      $(this).remove();
                    });

                  }
                  else if(response == "2")
                  {
                    alert("Error");
                  } else{
                    alert('cannot delete the id');
                  }
       

           }
         });

         event.preventDefault();
       }
       else{

       }
       })
 });
</script>