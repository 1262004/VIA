<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Get Token Full</title>
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">
    
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        
		<br />
       
      </div>
		
		<div class="panel panel-primary">
		  <div class="panel-heading">Get Token Facebook Full</div>
		  <div class="panel-body">
		    <form id="flogin" name="flogin" class="form-horizontal" action="" method="POST">
				<div class="form-group col-sm-12">
					<input name="user" id="" class="form-control" placeholder="Email" />
				 </div>
				 <div class="form-group col-sm-12">
					<input name="pass" type="password" id="" class="form-control" placeholder="Mật khẩu" />
				 </div>
			  <div style="text-align: center">
			  	<input type="submit" name="btn-submit" id="btn-submit" class="btn btn-danger" value="Lấy token" />
			  </div>
			  <br /><br />
			  </form>
			  <div id="ketqua"></div>
			  
			

		  </div>
		</div>

      <footer class="footer">
        <p>&copy; 2016</p>
      </footer>

    </div> <!-- /container -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script>
  $(document).ready(function (){	
  	$('form#flogin').submit(function(event) {
    	$('#ketqua').html('<center><img src="loading.gif" /> Đang tải...</center>');
        $.ajax({
            type        : 'POST',
            url         : 'api.php?type=gettoken',
            data        : $('form#flogin').serialize(),
            cache		: false
        })
            
            .done(function(data) {
   				$('#ketqua').html(data);
            });
        event.preventDefault();
    });
   });
   
   function check_token(token)
   {
   		$('#check').html('<center><img src="loading.gif" /> Đang tải...</center>');
        $.ajax({
            type        : 'POST',
            url         : 'api.php?type=checktoken',
            data        : 'token='+token,
            cache		: false
        })
            
            .done(function(data) {
   				$('#check').html(data);
            });
   }
  </script>

	
	

  </body>
</html>
