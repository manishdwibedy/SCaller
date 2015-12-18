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
          <div class="container-fluid">
            <?php
            $showMessage = isset($saved) ? $saved : false
            ?>
            @if ($showMessage)
              <div class="alert alert-success " role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Shift Information has been updated successfully.
              </div>
            @endif

            {!! Form::open(array('url' => 'testingForm')) !!}

            @for ($day = 0; $day < 7; $day++)
            <div class="row">
              <div class="col-md-3 valign">
                <span class='day_{{$day}}'>Day {{$day+1}}</span>
              </div>

              @for ($shift = 0; $shift < 3; $shift++)
              <div class="col-md-3">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox_{{$day}}_{{$shift}}" name="checkbox_{{$day}}_{{$shift}}" class="styled" type="checkbox">
                    <label for="checkbox_{{$day}}_{{$shift}}">
                        Shift {{$shift+1}}
                    </label>
                </div>
              </div>
              @endfor
            </div>
            @endfor
            {!! Form::submit('Update Shift Info!', array('class'=>'btn btn-primary')) !!}

            {!! Form::close() !!}

            {!! Form::open(array('url' => 'foo/bar')) !!}

            {!! Form::close() !!}

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
