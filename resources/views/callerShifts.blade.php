<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

    {!! HTML::style('css/bootstrap-switch.css') !!}
    {!! HTML::style('css/build.css') !!}


    <script>
    function test(userID, weekNumber)
    {
      $.ajax({
          url: 'caller-shift-details',
          type: 'GET',
          data: { userID: userID, weekNumber: weekNumber },
          success: function(response)
          {

              var data = response;
              $('#callerName').text(data.caller.name)

              var htmlResponse = '<table class="table table-striped table-hover">';
              htmlResponse += '<thead><tr><th>#</th><th>Shift Taken</th></tr></thead><tbody>';

              var counter = 1;
              $.each( data.caller.shifts, function( index, value ){
                  htmlResponse += '<tr><td>' + counter + '</td><td>' + value.start + '</td></tr>';
                  counter++;
              });
              htmlResponse += '</tbody></table>'
              $('#shiftDetailModalBody').html(htmlResponse);
              $('#shiftDetails').modal('show');
              //alert(response);
          },
          error: function(error)
          {
            alert(error);
          }
      });
    }
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
                  <button type="button" class="btn btn-default" aria-label="Left Align" onclick="test({{$callerDetail -> id}},{{$callerDetail -> weekNumber}})">
                    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                  </button>
                </td>
              </tr>
              @endforeach

            </table>

            <a href='export'>Export to Excel</a>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <div id='shiftDetails' class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Shift Details : <span id='callerName'></span></h4>
            </div>
            <div class="modal-body" id='shiftDetailModalBody'>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

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
