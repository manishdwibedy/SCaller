<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" >
        <script src="{{asset('js/login.js')}}"></script> -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet"></link>
        <style>
        body{
            background: url(http://mymaplist.com/img/parallax/back.png);
        	background-color: #444;
            background: url(http://mymaplist.com/img/parallax/pinlayer2.png),url(http://mymaplist.com/img/parallax/pinlayer1.png),url(http://mymaplist.com/img/parallax/back.png);
        }

        .vertical-offset-100{
            padding-top:100px;
        }
        </style>

        <script>
        $(document).ready(function(){
          $(document).mousemove(function(e){
             TweenLite.to($('body'),
                .5,
                { css:
                    {
                        backgroundPosition: ""+ parseInt(event.pageX/8) + "px "+parseInt(event.pageY/'12')+"px, "+parseInt(event.pageX/'15')+"px "+parseInt(event.pageY/'15')+"px, "+parseInt(event.pageX/'30')+"px "+parseInt(event.pageY/'30')+"px"
                    }
                });
          });
        });
        </script>
    </head>
    <body>
      <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->

      <div class="container">
          <div class="row vertical-offset-100">
          	<div class="col-md-4 col-md-offset-4">
          		<div class="panel panel-default">
      			  	<div class="panel-heading">
      			    	<h3 class="panel-title">Please sign in</h3>
      			 	</div>
      			  	<div class="panel-body">
      			    	<form accept-charset="UTF-8" role="form">
                          <fieldset>
      			    	  	<div class="form-group">
      			    		    <input class="form-control" placeholder="E-mail" name="email" type="text">
      			    		</div>
      			    		<div class="form-group">
      			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
      			    		</div>
      			    		<div class="checkbox">
      			    	    	<label>
      			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
      			    	    	</label>
      			    	    </div>
      			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
      			    	</fieldset>
      			      	</form>
      			    </div>
      			</div>
      		</div>
      	</div>
      </div>
    </body>
</html>
