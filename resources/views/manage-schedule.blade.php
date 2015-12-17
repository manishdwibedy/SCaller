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
            Manage Shifts
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Shifts</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              Sunday
            </div>
            <div class="col-md-3">
              <div class="checkbox checkbox-primary">
                  <input id="checkbox1" class="styled" type="checkbox">
                  <label for="checkbox1">
                      Shift 1
                  </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="checkbox checkbox-primary">
                  <input id="checkbox2" class="styled" type="checkbox">
                  <label for="checkbox2">
                      Shift 2
                  </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="checkbox checkbox-primary">
                  <input id="checkbox3" class="styled" type="checkbox">
                  <label for="checkbox3">
                      Shift 3
                  </label>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-3">
              Sunday
            </div>
            <div class="col-md-3">
              <div class="checkbox checkbox-primary">
                  <input id="checkbox1" class="styled" type="checkbox">
                  <label for="checkbox1">
                      Shift 1
                  </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="checkbox checkbox-primary">
                  <input id="checkbox2" class="styled" type="checkbox">
                  <label for="checkbox2">
                      Shift 2
                  </label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="checkbox checkbox-primary">
                  <input id="checkbox3" class="styled" type="checkbox">
                  <label for="checkbox3">
                      Shift 3
                  </label>
              </div>
            </div>
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
