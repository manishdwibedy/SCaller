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
              $showMessage = isset($saved) ? $saved : false;
              $counter = 0;
            ?>
            @if ($showMessage)
              <div class="alert alert-success " role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Shift Information has been updated successfully.
              </div>
            @endif

            {!! Form::open(array('url' => 'changeShiftDefinations')) !!}

            <?php
            $nextSunday = date('Y-m-d', strtotime('next sunday'));
            ?>

            @for ($day = 0; $day < 6; $day++)
            <div class="row">
              <div class="col-md-3 valign">
                <?php
                  $date = strtotime("+".$day." days", strtotime($nextSunday));
                ?>

                <span class='day_{{$day}}'>{{date("l d F y", $date)}}</span>

              </div>

              @for ($shift = 0; $shift < 3; $shift++)
              <div class="col-md-3">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox_{{$day}}_{{$shift}}" name="checkbox_{{$day}}_{{$shift}}" class="styled" type="checkbox" {{ $shifts[$counter] -> active ? "checked" : ""}}>
                    <label for="checkbox_{{$day}}_{{$shift}}">
                        <!--Shift {{$shift+1}} -->

                        <?php
                        $endTime = new DateTime($shifts[$counter]->shift_start); //current date/time
                        $endTime->add(new DateInterval("PT" . $shifts[$counter]->duration .  "H"));
                        $endTime = $endTime->format('h:i A');
                         ?>

                        {{ date('h:i A', strtotime($shifts[$counter++] -> shift_start)) }}
                        -
                        {{ $endTime }}
                    </label>
                </div>
              </div>
              @endfor
            </div>
            @endfor


            <div class="checkbox checkbox-primary">
                <input id="checkbox_toggle" name="checkbox_toggle" class="styled" type="checkbox">
                <label for="checkbox_toggle">
                    Toggle shifts availablity
                </label>
            </div>

            {!! Form::submit('Update Shift Info!', array('class'=>'btn btn-primary')) !!}

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
