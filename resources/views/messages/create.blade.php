<!DOCTYPE html>
<html>
  <head>
    @include('common.head')
    @include('common.scripts')

    {!! HTML::style('css/jquery-ui.min.css') !!}
    {!! HTML::style('css/jquery-ui.theme.min.css') !!}
    {!! HTML::style('css/jquery-ui.structure.min.css') !!}
    {!! HTML::script('js/jquery-ui.min.js') !!}
    {!! HTML::script('js/bootstrap-wysihtml5.js') !!}
    {!! HTML::style('css/bootstrap-wysihtml5.css') !!}

    <script>

        function split( val ) {
          return val.split( /,\s*/ );
        }
        function extractLast( term ) {
          return split( term ).pop();
        }

        $(function()
        {
        	 $( "#users" ).autocomplete({
                source: function( request, response ) {
                    if(extractLast(request.term) != '')
                    {
                        $.ajax({
                            url: "searchUsers",
                            dataType: "json",
                            data: { searchText: extractLast(request.term) },
                            success: function( data ) {
                                response( $.map( data, function( item ) {
                                    return {    label: item.value,
                                                value: item.value   , //value: item.route_name+', '+item.route_grade+', '+item.area_name,
                                                id: item.id,
                                                route_grade: item.value,

                                                }
                                }));
                            }
                        });
                    }
              },
        	  minLength: 3,
              multiple:true,
        	  select: function(event, ui) {
                  var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                //terms.push( "" );
                this.value = terms.join( "," );

                return false;
        	  	//$('#users').append(ui.item.value);
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
          <div class="row">
            <div class="col-md-3">
              <a href="/getMessages" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="mailbox.html"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right">12</span></a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                    <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                    <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li>
                    <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Labels</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Social</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
                  {!! Form::open(['method' => 'post', 'url' => 'new-message']) !!}
                        <div class="box-header with-border">
                          <h3 class="box-title">Compose New Message</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">

                            <div class="form-group">
                                <input class="form-control users" placeholder="To:" id="users" name="users">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Subject:" id="subject" name="subject">
                            </div>
                            <div class="form-group">
                                <textarea id="compose-textarea" class="form-control" style="height: 300px" name ="message">

                                </textarea>
                            </div>
                            <div class="form-group">
                                <!--
                                Attachments
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment">
                                </div>
                                <p class="help-block">Max. 32MB</p>
                                -->
                            </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <div class="pull-right">
                        <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                      </div>
                      <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                    </div><!-- /.box-footer -->
                {!! Form::close() !!}
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
    <script>
      $(function () {
        //Add text editor
        $("#compose-textarea").wysihtml5();
      });
    </script>
  </body>
</html>
