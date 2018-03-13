 <footer class="site-footer">
          <div class="text-center">
              2017 &copy; GAN Dashboard
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
</body>
</html>

<!-- js placed at the end of the document so the pages load faster -->
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script> -->
<!--<script src="<?php //echo base_url("public/js/jquery.js")?>"></script>
<script src="<?php //echo base_url("public/js/jquery-1.8.3.min.js")?>"></script>
<script src="<?php //echo base_url("public/js/bootstrap.min.js")?>"></script>
<script class="include" type="text/javascript" src="<?php// echo base_url("public/js/jquery.dcjqaccordion.2.7.js")?>"></script>
<script src="<?php //echo base_url("public/js/jquery.scrollTo.min.js")?>"></script>
<script src="<?php// echo base_url("public/js/jquery.nicescroll.js")?>" type="text/javascript"></script>
<script src="<?php// echo base_url("public/js/jquery.sparkline.js")?>" type="text/javascript"></script>
<script src="<?php// echo base_url("public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js")?>"></script>
<script src="<?php// echo base_url("public/js/owl.carousel.js")?>" ></script>
<script src="<?php// echo base_url("public/js/jquery.customSelect.min.js")?>" ></script>
<script src="<?php //echo base_url("public/js/respond.min.js")?>" ></script>
<script src="<?php //echo base_url("public/js/jquery.dcjqaccordion.2.7.js")?>"></script>
<!--common script for all pages-->
<!-- <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="<?php //echo base_url("public/js/common-scripts.js")?>"></script> -->

<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?php echo base_url(); ?>public/js/owl.carousel.js" ></script>
<script src="<?php echo base_url(); ?>public/js/jquery.customSelect.min.js" ></script>
<script src="<?php echo base_url(); ?>public/js/respond.min.js" ></script>
<script src="<?php echo base_url(); ?>public/assets/xchart/d3.v3.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/xchart/xcharts.min.js"></script>
<!--common script for all pages-->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/common-scripts.js"></script>
<!--script for this page-->
<script src="<?php echo base_url(); ?>public/js/sparkline-chart.js"></script>
<script src="<?php echo base_url(); ?>public/js/easy-pie-chart.js"></script>

<script>
  //owl carousel
  $(document).ready(function() {
      $("#owl-demo").owlCarousel({
          navigation : true,
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem : true,
    autoPlay:true

      });
  });
  //custom select box
  $(function(){
    $('select.styled').customSelect();
  });
</script>
<script>
  (function () {
      var data = [
      {"xScale":"ordinal","comp":[],"main":[{"className":".main.l1","data":[{"y":15,"x":"2012-11-19T00:00:00"},{"y":11,"x":"2012-11-20T00:00:00"},{"y":8,"x":"2012-11-21T00:00:00"},{"y":10,"x":"2012-11-22T00:00:00"},{"y":1,"x":"2012-11-23T00:00:00"},{"y":6,"x":"2012-11-24T00:00:00"},{"y":8,"x":"2012-11-25T00:00:00"}]},{"className":".main.l2","data":[{"y":29,"x":"2012-11-19T00:00:00"},{"y":33,"x":"2012-11-20T00:00:00"},{"y":13,"x":"2012-11-21T00:00:00"},{"y":16,"x":"2012-11-22T00:00:00"},{"y":7,"x":"2012-11-23T00:00:00"},{"y":18,"x":"2012-11-24T00:00:00"},{"y":8,"x":"2012-11-25T00:00:00"}]}],"type":"line-dotted","yScale":"linear"},

      {"xScale":"ordinal","comp":[],"main":[{"className":".main.l1","data":[{"y":12,"x":"2012-11-19T00:00:00"},{"y":18,"x":"2012-11-20T00:00:00"},{"y":8,"x":"2012-11-21T00:00:00"},{"y":7,"x":"2012-11-22T00:00:00"},{"y":6,"x":"2012-11-23T00:00:00"},{"y":12,"x":"2012-11-24T00:00:00"},{"y":8,"x":"2012-11-25T00:00:00"}]},{"className":".main.l2","data":[{"y":29,"x":"2012-11-19T00:00:00"},{"y":33,"x":"2012-11-20T00:00:00"},{"y":13,"x":"2012-11-21T00:00:00"},{"y":16,"x":"2012-11-22T00:00:00"},{"y":7,"x":"2012-11-23T00:00:00"},{"y":18,"x":"2012-11-24T00:00:00"},{"y":8,"x":"2012-11-25T00:00:00"}]}],"type":"cumulative","yScale":"linear"},
      
      {"xScale":"ordinal","comp":[],"main":[{"className":".main.l1","data":[{"y":12,"x":"2012-11-19T00:00:00"},{"y":18,"x":"2012-11-20T00:00:00"},{"y":8,"x":"2012-11-21T00:00:00"},{"y":7,"x":"2012-11-22T00:00:00"},{"y":6,"x":"2012-11-23T00:00:00"},{"y":12,"x":"2012-11-24T00:00:00"},{"y":8,"x":"2012-11-25T00:00:00"}]},{"className":".main.l2","data":[{"y":29,"x":"2012-11-19T00:00:00"},{"y":33,"x":"2012-11-20T00:00:00"},{"y":13,"x":"2012-11-21T00:00:00"},{"y":16,"x":"2012-11-22T00:00:00"},{"y":7,"x":"2012-11-23T00:00:00"},{"y":18,"x":"2012-11-24T00:00:00"},{"y":8,"x":"2012-11-25T00:00:00"}]}],"type":"bar","yScale":"linear"}];
      var order = [0, 1, 0, 2],
              i = 0,
              xFormat = d3.time.format('%A'),
              chart = new xChart('line-dotted', data[order[i]], '#chart', {
                  axisPaddingTop: 5,
                  dataFormatX: function (x) {
                      return new Date(x);
                  },
                  tickFormatX: function (x) {
                      return xFormat(x);
                  },
                  timing: 1250
              }),
              rotateTimer,
              toggles = d3.selectAll('.multi button'),
              t = 3500;

      function updateChart(i) {
          var d = data[i];
          chart.setData(d);
          toggles.classed('toggled', function () {
              return (d3.select(this).attr('data-type') === d.type);
          });
          return d;
      }

      toggles.on('click', function (d, i) {
          clearTimeout(rotateTimer);
          updateChart(i);
      });

      function rotateChart() {
          i += 1;
          i = (i >= order.length) ? 0 : i;
          var d = updateChart(order[i]);
          rotateTimer = setTimeout(rotateChart, t);
      }
      rotateTimer = setTimeout(rotateChart, t);
  }());
</script>



<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $("#tab1").click(function () {
        $("#a").removeClass("active");
        $("#tab1").addClass("active");        
    });
  });
  function myfun(e){
    //var j = 1;
    var id = e;
    $.ajax({
      method:'GET',
      url:'<?php echo base_url('suspend'); ?>',
      data:'id='+id,
      success: function(html){
        //alert(html);return false;
        if(html == 0){
          $("#suspend" + id).html('Suspend');
        }else{
          $("#suspend" + id).html('Activate');
        }
      }
    });
    //j++;
  }
  $("#username").keypress(function(e){
  var code =e.keyCode || e.which;
    if((code<65 || code>90)&&(code<97 || code>122)&&code!=32&&code!=46){
      alert("Only alphabates are allowed");
      return false;
    }
  });
  $(document).ready(function() {
    $('#datatable').dataTable( {
      //"aaSorting": [[ 4, "desc" ]]
    });
  });
  $(document).ready(function() {
    $('#datatable1').dataTable( {
    });
  });
  $(document).ready(function() {
    $('#datatable2').dataTable( {
    });
  });
</script>
<script type="text/javascript">
  $('.responsive-tabs').responsiveTabs({
      accordionOn: ['xs', 'sm'] // xs, sm, md, lg 
    });
  </script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('.example').dataTable( {
       "aLengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
       "iDisplayLength": 100
                  // "aaSorting": [[ 4, "desc" ]]
                } );
    } );
  </script>
  <script>
  function countUp(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.count'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}

countUp(<?php echo $total; ?>);

function countUp2(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.count2'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}

countUp2(<?php echo $work ; ?>);

function countUp3(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.count3'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}

countUp3(<?php echo $task; ?>);

function countUp4(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.count4'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}

countUp4(0);

function countUp5(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.count5'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}

countUp5(<?php echo $report; ?>);

function countUp6(count)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        $display = $('.count6'),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}

countUp6(0);
</script>
<script>
  $('#challsubmit').click(function(){
    var title = $('#chaltitle').val();
    var description = $('#chaldes').val();
    if(title == '' && description == ''){
      $('#error').html('Please fill Required field!');
      $('#success').html('');
      return false;
    }else if(title == ''){
      $('#error').html('Please fill Title field!');
      $('#success').html('');
      return false;
    }else if(description == ''){
      $('#error').html('Please fill Description field!');
      $('#success').html('');
      return false;
    }else{
      $('#error').html('');
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>adchalnge',
        data:'title='+title+'&description='+description,
        success:function(html){
          $("#adchalenge1").trigger('reset');
          $('#success').html('Successfully Added!');          
        }
      });
    }
  });

  function myChaledit(e){
    var title = $('#titlefe'+e).val();
    var des = $('#descripfe'+e).val();
    if(title == '' && des == ''){
      $('#error'+e).html('Please fill Required field!');
      return false;
    }else{
      $('#error'+e).html('');
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>edchal',
        data:'title='+title+'&description='+des+'&ejd='+e,
        success:function(html){
          if(html == 1){
            $('#error'+e).html('successfully Updated!');
            location.reload(5000);
          }else{
            $('#error'+e).html('Error');
          }        
        }
      });
    }
  }
</script>
<script>
// function myval(){
//   $('#quote').keypress(function(){
//     var len = $('#quote').val().length;
//     if(len > 500){
//       $('#span').text('Limit exceeds.');
//       $(this).val($(this).val().substr(0,500)+'');
//     }else{
//       $('#span').text();
//     }
//   });
// }
// $(document).on("keydown", function (event) {        
//    if (event.keyCode === 8 || event.keyCode === 46) {
//        $('#span').text('');
//     }
//   });

$('#quotesub').click(function(){
  var quote = $('#quote').val();
  var msg = 'addquote';
  if(quote == ''){
    $('#error').html('Quote field empty.');
    $('#sucess').html('');
    return false;
  }else{
    $('#error').html('');
    form.submit();
  }
});

var text = $('#quote');
var maxlength = parseInt(text.attr("maxlength"));
text.on("keyup keypress change", function() {
  charCount = parseInt($(this).val().length);
    charRemain = maxlength - charCount;
    $("#desciption_len").html(charRemain + " Characters remaining");
});
</script>
<script>
  function editFunction(e){
    var btn_val = $('#editquoteval'+e).html();
    $inputs = $('button[type=button]');
    if(btn_val == "Update"){      
      var quote = $('#quote_val'+e).html();
      if(quote.length == 0){
        $('#response').html('Quote filed empty!');
        return false;
      }else{
        $('#quote_val'+e).prop('contenteditable', false);
        $('#editquoteval'+e).html('Edit');
        $('#quote_val'+e).removeClass("high");
        $('#desciption_lenn'+e).addClass('displaynone');
        $.ajax({
          type:'POST',
          url:'<?php echo base_url(); ?>upquo',
          data:'quote='+quote+'&id='+e,
          success:function(html){
            if(html == "no"){
              // alert(html);
              $('#response').html('');
              $inputs.not('#editquoteval'+e).prop('disabled', false);
            }else{
              // alert(html);
              $('#response').html('Successfully updated!');
              $inputs.not('#editquoteval'+e).prop('disabled', false);
            }
          }
        });
      }
      return false;
    }
    $('#quote_val'+e).prop('contenteditable', true);
    $('#editquoteval'+e).html('Update');
    $('#quote_val'+e).addClass("high");
    $inputs.not('#editquoteval'+e).prop('disabled', true);
    $('#desciption_lenn'+e).removeClass('displaynone');
    var text = $('#quote_val'+e);
    text.attr('maxlength', 500);
    var maxlength = parseInt(text.attr("maxlength"));
    charCount = parseInt($('#quote_val'+e).html().length);
    charRemain = maxlength - charCount;
    $('#desciption_lenn'+e).html(charRemain + " Characters remaining");
    text.on("keyup keypress change", function() {
      charCount = parseInt($('#quote_val'+e).html().length);
      charRemain = maxlength - charCount;
      if(charRemain == 0){
        $('#quote_val'+e).keypress(function (e){
          if((e.which < 37 && charRemain == 0) || (e.which > 40 && charRemain == 0))
            e.preventDefault();
        });
      }else{
        $('#desciption_lenn'+e).html(charRemain + " Characters remaining");
      }
    });
    $('#response').html();
  };
</script>