 <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="http://hackerkernel.com" target="_blank">Hackerkernel</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>
  
  <!--   Core JS Files   -->

  <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap-material-design.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{asset('assets/js/plugins/moment.min.js')}}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{asset('assets/js/plugins/sweetalert2.js')}}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{asset('assets/js/plugins/jquery.validate.min.js')}}"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{asset('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{asset('assets/js/plugins/bootstrap-selectpicker.js')}}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{asset('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{asset('assets/js/plugins/bootstrap-tagsinput.js')}}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{asset('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{asset('assets/js/plugins/jquery-jvectormap.js')}}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('assets/js/plugins/nouislider.min.js')}}"></script>
  
  <!-- Library for adding dinamically elements -->
  <script src="{{asset('assets/js/plugins/arrive.min.js')}}"></script>
  
  <!-- Chartist JS -->
  <script src="{{asset('assets/js/plugins/chartist.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
  
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('assets/demo/demo.js')}}"></script>
  <!-- for toaster message deepak-->
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script type="text/javascript" src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://wrappixel.com/demos/admin-templates/material-pro/assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>



<script>
  
    $(document).ready(function(){
        $(".viewOrderDetails").click(function(e){
              e.preventDefault();
             var order_id = $(this).attr("data-order_id"); 
             var base_url="{{URL::to('/')}}/";
             
             $.ajax({  
              url: '{{route('order-detail-modal')}}',  
                method:"POST",  
                data:{"_token": "{{ csrf_token() }}","order_id":order_id},  
                success:function(data){  
                    
                     var result = JSON.parse(data);
                     // console.log(result);
                       // $('#orderModal').html(result); 
                       
                       $('#order_no').html(result["id"]);
                        $('#payment_id').html(result["order_no"]);
                       $('#order_by').html(result["name"]);
                       $('#package_name').html(result["pname"]);
                       $('#service_date').html(result["service_date"]);
                       $('#service_time').html(result["startTime"]);
                       $('#service_endTime').html(result["endTime"]);
                       $('#order_date').html(result["bookingTime"]);
                       $('#service_addr').html(result["address"]);
                       $('#order_mobile').html(result["mobile_no"]);
                       $('#order_email').html(result["email"]);
                       $('#order_status').html(result["status"]);
                       $('#payment_status').html(result["payment_status"]);
                       $('#order_amount').html(result["amount"]);
                       $('#panel_before').attr("src",base_url+result["plant_before_img"]);
                       $('#panel_after').attr("src",base_url+result["plant_after_img"]);
                     $('#OrderDetailModal').modal("show");  
                }  
          });  
      
        });
    });

    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
</script>

  <!-- for Datatable by deepak -->
<script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }

      });

      // Clock pickers
      $('#single-input').clockpicker({
        format:'HH:MM:A',
          placement: 'bottom',
          align: 'left',
          autoclose: true,
          'default': 'now'
      
      });

      $('.clockpicker').clockpicker({
          format:'HH:MM:A',
          donetext: 'Done',
      }).find('input').change(function() {
          console.log(this.value);
      });
      $('#check-minutes').click(function(e) {
          // Have to stop propagation here
          e.stopPropagation();
          input.clockpicker('show').clockpicker('toggleView', 'minutes');
      
      });

      $('.datetimepicker').datetimepicker({
         format:'DD-MM-YYYY HH:MM:A',
          icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }
      
      });

      $('.datepicker').datetimepicker({
         format:'DD-MM-YYYY',
          icons: {
              
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
          }
      
      });
    });    
</script>
  

  @yield('script')

<script>
  @if($errors->any())
    toastr.info("{{ $errors->first() }}");
  @endif
  @if(Session::has('message'))
      toastr.success("{{ Session::get('message') }}");
  @endif
  
  @if(Session::has('error'))
      toastr.error("{{ Session::get('error') }}");
  @endif
</script>
</body>

</html>