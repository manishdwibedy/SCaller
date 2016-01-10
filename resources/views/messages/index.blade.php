<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

<style>

.nav-tabs .glyphicon:not(.no-margin) { margin-right:10px; }
.tab-pane .list-group-item:first-child {border-top-right-radius: 0px;border-top-left-radius: 0px;}
.tab-pane .list-group-item:last-child {border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;}
.tab-pane .list-group .checkbox { display: inline-block;margin: 0px; }
.tab-pane .list-group input[type="checkbox"]{ margin-top: 44%; }
.tab-pane .list-group .glyphicon { margin-right:5px; }
.tab-pane .list-group .glyphicon:hover { color:#FFBC00; }
a.list-group-item.read { color: #222;background-color: #F3F3F3; }
hr { margin-top: 5px;margin-bottom: 10px; }
.nav-pills>li>a {padding: 5px 10px;}

</style>
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


              <div class="tab-content">
                <div class="tab-pane fade in active" id="home">
                    <div class="list-group">
                        @foreach($threads as $thread)
                        <a href="#" class="list-group-item">
                            <span class="checkbox">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </span>
                            <span class="glyphicon glyphicon-star-empty"></span>
                            <span class="name" style="min-width: 120px;
                                display: inline-block;">
                                {!! $thread->creator()->name !!}
                            </span>
                            <span class="">
                                {!! $thread->subject !!}
                            </span>
                            <span class="text-muted" style="font-size: 11px;">
                                {!! $thread->latestMessage->body !!}
                            </span>
                            <span class="badge">
                                @if (Carbon\Carbon::parse($thread->created_at)->format('d/m/Y')
                                            == Carbon\Carbon::parse(Carbon\Carbon::now())->format('d/m/Y'))
                                    {!! Carbon\Carbon::parse($thread->created_at)->format('h:i A') !!}
                                @else
                                    {!! Carbon\Carbon::parse($thread->created_at)->format('d/m/Y') !!}
                                @endif

                            </span>
                            <span class="pull-right">
                                <span class="glyphicon glyphicon-paperclip">
                                </span>
                            </span>
                        </a>
                        @endforeach

                    </div>
                </div>
                <div class="tab-pane fade in" id="profile">
                    <div class="list-group">
                        <div class="list-group-item">
                            <span class="text-center">This tab is empty.</span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade in" id="messages">
                    ...</div>
                <div class="tab-pane fade in" id="settings">
                    This tab is empty.</div>
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
