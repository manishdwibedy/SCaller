<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

    {!! HTML::style('css/bootstrap-switch.css') !!}
    {!! HTML::style('css/build.css') !!}
    {!! HTML::style('css/font-awesome.css') !!}
    {!! HTML::script('js/bootstrap-switch.js') !!}


    <script>
    $(function() {
        $(".shift").bootstrapSwitch('state', false);

        $("#checkbox_toggle").click(function() {
          var checkBoxes = $(".styled");
          $.each(checkBoxes, function( index, value ) {
            value.checked = !value.checked;
          });

        });
    });
    </script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      @include('common.title')

      <!-- Left side column. contains the logo and sidebar -->
      @include('common.left-menu', ['page' => $page])

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Manage Reminders
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Reminder</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Footer -->
      @include('common.footer')

      <!-- Control Sidebar -->
      @include('common.sidebar')
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

  </body>
</html>
