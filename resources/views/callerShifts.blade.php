<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

    {!! HTML::style('css/bootstrap-switch.css') !!}
    {!! HTML::style('css/build.css') !!}


    <script>

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
            View Caller Shifts
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View Shifts</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <?php
              $counter = 1;
            ?>

            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Caller Name
                  </th>
                  <th>
                    Number of Shifts
                  </th>
                  <th>
                    Details
                  </th>
                </tr>
              </thead>
              @foreach($callerData as $callerName => $callerDetail)
              <tr>
                <td>
                  {{$counter++}}
                </td>
                <td>
                  {{$callerName}}
                </td>
                <td>
                  {{$callerDetail -> shiftCount}}
                </td>
                <td>
                  Some
                </td>
              </tr>
              @endforeach

            </table>


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
