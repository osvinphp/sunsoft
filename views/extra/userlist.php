
      <!--header end-->
      <!--sidebar start-->

      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
              <!-- page start-->
              <section class="panel">
                  <header class="panel-heading">
                    Users list
                  </header>
                  <div class="panel-body">
                        <div class="adv-table">
                            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th class="hidden-phone">Platform(s)</th>
                                    <th class="hidden-phone">Engine version</th>
                                    <th class="hidden-phone">CSS grade</th>
                                </tr>
                                </thead>
                                <?php $i=1;
                               foreach ($users as $key => $value) {
                           

                                ?>
                                <tbody>
                                <tr class="gradeX">
                                    <td><?php echo $i ?></td>
                                     <td><?php echo $value->fullname ?></td>
                                    <td><?php echo $value->email ?></td>
                                    <td><?php echo $value->profile_pic ?></td>
                         
                                </tr>
                                <?php $i++; } ?>
                                </tbody>
                            </table>

                        </div>
                  </div>
              </section>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <!--footer start-->
<?php 
 $this->load->view('templete/footer');
?>
      <!--footer end-->
  

  <!-- js placed at the end of the document so the pages load faster -->
    <!--<script src="js/jquery.js"></script>-->

 
    <script type="text/javascript" language="javascript" src="<?php echo base_url("public/assets/advanced-datatable/media/js/jquery.dataTables.js")?>"></script> 

    <script type="text/javascript">
      /* Formating function for row details */
      function fnFormatDetails ( oTable, nTr )
      {
          var aData = oTable.fnGetData( nTr );
          var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
          sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
          sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
          sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
          sOut += '</table>';

          return sOut;
      }

      $(document).ready(function() {
          /*
           * Insert a 'details' column to the table
           */
          var nCloneTh = document.createElement( 'th' );
          var nCloneTd = document.createElement( 'td' );
          nCloneTd.innerHTML = '<img src="<?php echo base_url("public/assets/advanced-datatable/examples/examples_support/details_open.png")?>">';
          nCloneTd.className = "center";

          $('#hidden-table-info thead tr').each( function () {
              this.insertBefore( nCloneTh, this.childNodes[0] );
          } );

          $('#hidden-table-info tbody tr').each( function () {
              this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
          } );

          /*
           * Initialse DataTables, with no sorting on the 'details' column
           */
          var oTable = $('#hidden-table-info').dataTable( {
              "aoColumnDefs": [
                  { "bSortable": false, "aTargets": [ 0 ] }
              ],
              "aaSorting": [[1, 'asc']]
          });

          /* Add event listener for opening and closing details
           * Note that the indicator for showing which row is open is not controlled by DataTables,
           * rather it is done here
           */
          $('#hidden-table-info tbody td img').live('click', function () {
              var nTr = $(this).parents('tr')[0];
              if ( oTable.fnIsOpen(nTr) )
              {
                  /* This row is already open - close it */
                  this.src = "<?php echo base_url("public/assets/advanced-datatable/examples/examples_support/details_open.png")?>";
                  oTable.fnClose( nTr );
              }
              else
              {
                  /* Open this row */
                  this.src = "<?php echo base_url("public/assets/advanced-datatable/examples/examples_support/details_close.png")?>";
                  oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
              }
          } );
      } );
  </script>


  </body>
</html>


<!-- <?php 

$columnname = array('userid'=>'email',

  )
$columnvalue = array('userid'=>'admin@gmail.com')
$variableS = 
array(
  'and'=> 'username',
  'or'

  );

public function gello($variable, $tablename,$columnname,$columnvalue ,$variableS){
  foreach ($variable as $key => $value) {
  $varib[]= $vas; 
}
  $this->db->query('select $variable["name"] as $variable["alias"] from $tablename where $columnname["userid"] =$columnvalue["userid"] $varib ')
} -->