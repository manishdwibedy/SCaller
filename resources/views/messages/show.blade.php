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
              <?php var_dump($message); ?>
                  <div class="media">
                      <!-- <a class="pull-left" href="#">
                          <img src="//www.gravatar.com/avatar/{!! md5($message->user->email) !!}?s=64" alt="{!! $message->user->name !!}" class="img-circle">
                      </a> -->
                      <div class="media-body">
                          <h5 class="media-heading">{!! $message->user->name !!}</h5>
                          <p>{!! $message->body !!}</p>
                          <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                      </div>
                  </div>
              @endforeach

              <h2>Add a new message</h2>
              {!! Form::open(['method' => 'post', 'url' => 'updateThread/' . $thread->id]) !!}
              <div class="col-md-6">
                  <!-- Users Form Input -->
                  <div class="form-group">
                      {!! Form::label('users', 'Users', ['class' => 'control-label']) !!}
                      {!! Form::text('users', null, ['id' =>  'users', 'name' => 'users', 'class' => 'form-control']) !!}
                  </div>

                  <!-- Subject Form Input -->
                  <div class="form-group">
                      {!! Form::hidden('subject', $thread->subject, ['class' => 'form-control']) !!}
                  </div>

                  <!-- Message Form Input -->
                  <div class="form-group">
                      {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                      {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                  </div>

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
