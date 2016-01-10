<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

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
            Inbox
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Inbox</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

              <h1>{!! $thread->subject !!}</h1>

              @foreach($thread->messages as $message)
                  <div class="media">
                      <a class="pull-left" href="#">
                          <img src="//www.gravatar.com/avatar/{!! md5($message->user->email) !!}?s=64" alt="{!! $message->user->name !!}" class="img-circle">
                      </a>
                      <div class="media-body">
                          <h5 class="media-heading">{!! $message->user->name !!}</h5>
                          <p>{!! $message->body !!}</p>
                          <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                      </div>
                  </div>
              @endforeach

              <h2>Add a new message</h2>
              {!! Form::open(['method' => 'PUT']) !!}
              <!-- Message Form Input -->
              <div class="form-group">
                  {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
              </div>

              @if($users->count() > 0)
              <div class="checkbox">
                  @foreach($users as $user)
                      <label title="{!! $user->name !!}"><input type="checkbox" name="recipients[]" value="{!! $user->id !!}">{!! $user->name !!}</label>
                  @endforeach
              </div>
              @endif

              <!-- Submit Form Input -->
              <div class="form-group">
                  {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
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
