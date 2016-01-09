<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

    <script>
        $(function()
        {
        	 $( "#users" ).autocomplete({
        	  source: "searchUsers",
        	  minLength: 3,
              multiple:true,
        	  select: function(event, ui) {
        	  	$('#users').val(ui.item.value);
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
            New Message
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Create New Message</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
                {!! Form::open(['method' => 'post', 'url' => 'new-message']) !!}
                <div class="col-md-6">
                    <!-- Users Form Input -->
                    <div class="form-group">
                        {!! Form::label('users', 'Subject', ['class' => 'control-label']) !!}
                        {!! Form::text('users', null, ['id' =>  'users', 'class' => 'control-label', 'placeholder' =>  'Enter name']) !!}
                    </div>

                    <!-- Subject Form Input -->
                    <div class="form-group">
                        {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
                        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Message Form Input -->
                    <div class="form-group">
                        {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                    </div>

                    @if($users->count() > 0)
                    <div class="checkbox">
                        @foreach($users as $user)
                            <label title="{!!$user->name!!}"><input type="checkbox" name="recipients[]" value="{!!$user->id!!}">{!!$user->name!!}</label>
                        @endforeach
                    </div>
                    @endif

                    <!-- Submit Form Input -->
                    <div class="form-group">
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
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
