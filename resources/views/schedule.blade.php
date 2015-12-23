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

        @foreach($caller_shifts as $shift)
          $('input[id="shift_{{$shift->shift_id}}"]').bootstrapSwitch('state', true, true);
        @endforeach
        $(".shift").on('switchChange.bootstrapSwitch', function(event, state) {
          var shiftID = this.id.substring(6); // DOM element
          if(state){
            //alert($('input[name=zyx]').val());
            $('input[name=shift_' + shiftID + ']').val(1);
            //$('[name="shift' + shiftID + ']').value(1);
          }
          else {
            //$('[name="shift' + shiftID + ']').value(0);
          }



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
            Schedule your shifts
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Schedule</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <?php
            $nextSunday = date('Y-m-d', strtotime('next sunday'));
            $counter = 0;
          ?>
          <div class="container-fluid">
            <div class="row">
              {!! Form::open(array('url' => 'schedule')) !!}
              {!! csrf_field() !!}

              @for ($day = 0; $day < 6; $day++)
                <?php
                  $date = strtotime("+".$day." days", strtotime($nextSunday));
                ?>

                <div class="col-md-12">{{date("l d F y", $date)}}</div>
                <div class="row">
                  @for ($shift = 0; $shift < 3; $shift++)
                  <?php
                    $endTime = new DateTime($shifts[$counter]->shift_start); //current date/time
                    $endTime->add(new DateInterval("PT" . $shifts[$counter]->duration .  "H"));
                    $endTime = $endTime->format('h:i A');
                  ?>
                        @if ($shifts[$counter] -> active === 1)
                        <div class="col-xs-6 col-md-2 text-center">
                        {{ date('h:i A', strtotime($shifts[$counter] -> shift_start)) }}
                        -
                        {{ $endTime }}
                        </div>
                        <div class="col-xs-6 col-md-2 text-center">
                          <input type="checkbox" class="shift" id='shift_{{$shifts[$counter]->id}}'></input>
                          <input type="hidden" name="shift_{{$shifts[$counter++]->id}}" value='0'>
                        </div>
                      @else
                        <?php $counter++; ?>
                      @endif

                  @endfor


                </div>
              @endfor
              <br>

              {!! Form::submit('Save Shift Schedule!', array('class'=>'btn btn-primary')) !!}

              {!! Form::close() !!}


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
