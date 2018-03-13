 <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                <li>
                  <a id="a" href="<?php echo base_url("Dashboard"); ?>" class="<?php if($this->uri->uri_string() == 'Dashboard') { echo 'active'; } ?>">
                    <i class="fa fa-dashboard"></i>
                      <span>Dashboard</span>
                  </a>
                </li>            
                <li>
                  <a  href="<?php echo base_url("user"); ?>" class="<?php if($this->uri->uri_string() == 'user') { echo 'active'; } ?>">
                    <i class="fa fa-user-plus"></i>
                    <span>Users</span>
                  </a>
                </li> 
                <li>
                  <a  href="<?php echo base_url("category"); ?>" class="<?php if($this->uri->uri_string() == 'category') { echo 'active'; } ?>">
                  <i class="fa fa-tags" aria-hidden="true"></i>
                    <span>Home Category</span>
                  </a>
                </li> 
                <li class="sub-menu" id="tab5">
                  <a href="<?php echo base_url("quote")?>" class="<?php if($this->uri->uri_string() == 'quote') { echo 'active'; } ?>" >
                    <i class="fa fa-quote-left" aria-hidden="true"></i>
                    <span>Quotes</span>
                  </a>
                    <!-- <ul class="sub">                         -->
                      <!-- <li><a href="javascript:;">Challenges list</a></li> -->
                      <!-- <li><a href="<?php echo base_url("quote")?>">Quotes List</a></li> -->
                     <!--  <li><a href="<?php //echo base_url("addquo")?>">Add Quotes</a></li> -->
                    <!-- </ul> -->
                </li>           
               <!--  <li class="sub-menu" id="tab2">
                  <a href="<?php echo base_url("Dashboard/workingHour"); ?>" >
                    <i class="fa fa-clock-o"></i>
                    <span>Working Hours</span>
                  </a>
                </li> -->
                <!-- <li class="sub-menu">
                  <a href="javascript:;" >
                    <i class="fa fa-book"></i>
                    <span>Goals</span>
                  </a>
                </li> -->
                <!-- <li class="sub-menu" id="tab3">
                  <a href="<?php //echo base_url("Dashboard/UsersReport"); ?>" >
                    <i class="fa fa-flag-o"></i>
                    <span>Reports</span>
                  </a>
                </li> -->
               <!--  <li class="sub-menu" id="tab4">
                  <a href="javascript:;" >
                    <i class="fa fa-pie-chart"></i>
                    <span>Applied Job</span>
                  </a>
                </li> -->
                <li class="sub-menu" id="tab5">
                  <a href="<?php echo base_url("challenge")?>" class="<?php if($this->uri->uri_string() == 'challenge') { echo 'active'; } ?>">
                    <i class="fa fa-trophy" aria-hidden="true"></i>
                    <span>Admin Challenges</span>
                  </a>
                    <!-- <ul class="sub">                         -->
                      <!-- <li><a href="javascript:;">Challenges list</a></li> -->
                      <!-- <li><a href="<?php echo base_url("challenge")?>">Challenge</a></li> -->
                      <!-- <li><a href="<?php echo base_url("create")?>">Add Challenges</a></li> -->
                    <!-- </ul> -->
                </li>

                 <li class="sub-menu" id="tab1">
                  <a href="javascript:;" >
                    <i class="fa fa-list-alt"></i>
                      <span>User Activity</span>
                  </a>
                   <ul class="sub">                    
                      <li><a href="<?php echo base_url("activity"); ?>">Activity Journal</a></li>
                       <li><a href="<?php echo base_url('goals'); ?>">Goals</a></li>
                       <li><a href="<?php echo base_url('events'); ?>">Events</a></li>
                      <li><a href="<?php echo base_url('challenges'); ?>">Challenges</a></li> 
                   </ul>
                </li>

       <!--            <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Components</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="grids.html">Grids</a></li>
                          <li><a  href="calendar.html">Calendar</a></li>
                          <li><a  href="gallery.html">Gallery</a></li>
                          <li><a  href="todo_list.html">Todo List</a></li>
                          <li><a  href="draggable_portlet.html">Draggable Portlet</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Form Stuff</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="form_component.html">Form Components</a></li>
                          <li><a  href="advanced_form_components.html">Advanced Components</a></li>
                          <li><a  href="form_wizard.html">Form Wizard</a></li>
                          <li><a  href="form_validation.html">Form Validation</a></li>
                          <li><a  href="dropzone.html">Dropzone File Upload</a></li>
                          <li><a  href="inline_editor.html">Inline Editor</a></li>
                          <li><a  href="image_cropping.html">Image Cropping</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                          <li><a  href="dynamic_table.html">Dynamic Table</a></li>
                          <li><a  href="advanced_table.html">Advanced Table</a></li>
                          <li><a  href="editable_table.html">Editable Table</a></li>
                      </ul>
                  </li>
                  <li>
                      <a  href="inbox.html">
                          <i class="fa fa-envelope"></i>
                          <span>Mail </span>
                          <span class="label label-danger pull-right mail-info">2</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                          <li><a  href="flot_chart.html">Flot Charts</a></li>
                          <li><a  href="xchart.html">xChart</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-shopping-cart"></i>
                          <span>Shop</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="product_list.html">List View</a></li>
                          <li><a  href="product_details.html">Details View</a></li>
                      </ul>
                  </li>
              
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-glass"></i>
                          <span>Extra</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="blank.html">Blank Page</a></li>
                          <li><a  href="lock_screen.html">Lock Screen</a></li>
                          <li><a  href="profile.html">Profile</a></li>
                          <li><a  href="invoice.html">Invoice</a></li>
                          <li><a  href="search_result.html">Search Result</a></li>
                          <li><a  href="pricing_table.html">Pricing Table</a></li>
                          <li><a  href="faq.html">FAQ</a></li>
                          <li><a  href="404.html">404 Error</a></li>
                          <li><a  href="500.html">500 Error</a></li>
                      </ul>
                  </li>
                  <li>
                      <a  href="login.html">
                          <i class="fa fa-user"></i>
                          <span>Login Page</span>
                      </a>
                  </li> -->

                  <!--multi level menu start-->
                  <!-- <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-sitemap"></i>
                          <span>Multi level Menu</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="javascript:;">Menu Item 1</a></li>
                          <li class="sub-menu">
                              <a  href="boxed_page.html">Menu Item 2</a>
                              <ul class="sub">
                                  <li><a  href="javascript:;">Menu Item 2.1</a></li>
                                  <li class="sub-menu">
                                      <a  href="javascript:;">Menu Item 3</a>
                                      <ul class="sub">
                                          <li><a  href="javascript:;">Menu Item 3.1</a></li>
                                          <li><a  href="javascript:;">Menu Item 3.2</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </li> -->
                  <!--multi level menu end-->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>

      <script type="text/javascript">
    // $(document).ready(function () {
    //     var url = window.location;
    //     $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
    //     $('ul.nav a').filter(function() {
    //          return this.href == url;
    //     }).parent().addClass('active');
    // });
</script>