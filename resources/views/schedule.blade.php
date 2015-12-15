<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

    {!! HTML::style('css/bootstrap-switch.css') !!}
    {!! HTML::script('js/bootstrap-switch.js') !!}

    <script>
    $(function() {
        $(".shift").bootstrapSwitch('state', false);
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
            Schedule your shifts
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Schedule</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">Day Comes here</div>
              <div class="row">
                <div class="col-xs-6 col-md-3 text-center">Time 1</div>
                <div class="col-xs-6 col-md-3 text-center"><input type="checkbox" class="shift" checked></input></div>
                <div class="col-xs-6 col-md-3 text-center">Time 1</div>
                <div class="col-xs-6 col-md-3 text-center"><input type="checkbox" class="shift" checked></input></div>
                <div class="col-xs-6 col-md-3 text-center">Time 1</div>
                <div class="col-xs-6 col-md-3 text-center"><input type="checkbox" class="shift" checked></input></div>

              </div>
            </div>

          </div>
          @if (Auth::user()->type == 'manager')
          asas
          @endif

 {{       Auth::user()->type }}


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
