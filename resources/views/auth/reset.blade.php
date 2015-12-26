<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Login Form Template</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/font-awesome/css/font-awesome.min.css">
		    <link rel="stylesheet" href="/assets/css/form-elements.css">
        <link rel="stylesheet" href="/assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="/assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">
        <style>
        .logo{
          text-align: center;
          margin-top: 20px;
        }
        </style>
    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-center logo">
                        			<img src="/images/RuffaloCody.png">
                        		</div>

                            @if (count($errors) > 0)
                                <div class="alert alert-danger login-error" role="alert">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                        		</div>
                            <div class="form-bottom">

                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
            						<input type="hidden" name="_token" value="{{ csrf_token() }}">
            						<input type="hidden" name="token" value="{{ $token }}">

            						<div class="form-group">
            							<label class="col-md-4 control-label">E-Mail Address</label>
            							<div class="col-md-6">
            								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
            							</div>
            						</div>

            						<div class="form-group">
            							<label class="col-md-4 control-label">Password</label>
            							<div class="col-md-6">
            								<input type="password" class="form-control" name="password">
            							</div>
            						</div>

            						<div class="form-group">
            							<label class="col-md-4 control-label">Confirm Password</label>
            							<div class="col-md-6">
            								<input type="password" class="form-control" name="password_confirmation">
            							</div>
            						</div>

            						<div class="form-group">
            							<div class="col-md-6 col-md-offset-4">
            								<button type="submit" class="btn btn-primary">
            									Reset Password
            								</button>
            							</div>
            						</div>
            					</form>
		                    </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 social-login">
                        	<h3>...or login with:</h3>
                        	<div class="social-login-buttons">
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-facebook"></i> Facebook
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-twitter"></i> Twitter
	                        	</a>
	                        	<a class="btn btn-link-2" href="#">
	                        		<i class="fa fa-google-plus"></i> Google Plus
	                        	</a>
                        	</div>
                        </div>
                    </div> -->
                </div>
            </div>

        </div>


        <!-- Javascript -->
        <script src="/assets/js/jquery-1.11.1.min.js"></script>
        <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/js/jquery.backstretch.min.js"></script>
        <script src="/assets/js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="/assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
