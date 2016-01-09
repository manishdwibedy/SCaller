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
              @if (Session::has('error_message'))
                  <div class="alert alert-danger" role="alert">
                      {!! Session::get('error_message') !!}
                  </div>
              @endif
              @if($threads->count() > 0)
                  @foreach($threads as $thread)
                  <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                  <div class="media alert {!!$class!!}">
                      <h4 class="media-heading">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                      <p>{!! $thread->latestMessage->body !!}</p>
                      <p><small><strong>Creator:</strong> {!! $thread->creator()->name !!}</small></p>
                      <p><small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id()) !!}</small></p>
                  </div>
                  @endforeach
              @else
                  <p>Sorry, no threads.</p>
              @endif
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
