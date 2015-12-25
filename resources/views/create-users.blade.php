<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

    {!! HTML::style('css/bootstrap-switch.css') !!}
    {!! HTML::style('css/multiple-emails.css') !!}
    {!! HTML::script('js/bootstrap-switch.js') !!}
    {!! HTML::script('js/multiple-emails.js') !!}

    <script>
    $(document).ready(function() {
        $('#users').multiple_emails({
           position: 'top', // Display the added emails above the input
           theme: 'bootstrap', // Bootstrap is the default theme
           checkDupEmail: true // Should check for duplicate emails added
        });

    });

    function createUsers(form)
    {
        var my_emails = $('#users').val();
        if(my_emails.length > 2)
        {

            console.log(JSON.parse("[" + my_emails + "]"));
            form.submit();
        }
        else
        {
            console.log('Error : ' );
        }


    }

    function test(form)
    {
        var userInput = $('#users').val();
        var users = userInput.split(',');
        var validUsers = false;
        var errorMessage = '';
        $.each( users, function( index, value ) {
          if(!validEmail(value))
          {
              validUsers = false;
              if(errorMessage == '')
              {
                  errorMessage += 'Invalid Email ID - ' + value;
              }
              else
              {
                  errorMessage += ', ' + value;
              }
          }
          else
          {
                validUsers = true;
          }
        });
        if(!validUsers)
        {
            $('#errorMessageContent').text(errorMessage);
            $('#errorMessages').show();
        }
        if(validUsers)
        {
            $('#errorMessage').hide();
            form.submit();
        }
    }

    function validEmail(v) {
        var r = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
        return (v.match(r) == null) ? false : true;
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
            Create Callers
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Create Users</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="container-fluid">
            <div class="row">

                <div id='errorMessages' class="alert alert-danger alert-dismissible" role="alert" hidden>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <span id='errorMessageContent'></span>

                </div>

                {!! Form::open(array( 'method' => 'post', 'url' => 'create-users', 'onsubmit' => 'createUsers(this); return false;')) !!}
                {!! csrf_field() !!}

                <div class="form-group">
                  <label for="comment">User to add:</label>
                  <input type="text" class="form-control" id="users">
                </div>
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
