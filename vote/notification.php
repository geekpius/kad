<?php include('../middleware/verifyvoter.php'); ?>
<!doctype html>
<html lang="en">
    <head>
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <meta name="description" content="Electronic voting for ePower-House"/>
      <meta name="author" content="T.K.Pius Geek @ VibTech"/>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>ePower-House - Your Selected Candidates</title>
      <!--favicon-->
      <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon"/>
      <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
      <!-- Icons CSS-->
      <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/>
      <style class="csscreations">
		/*basic reset*/
		* {margin: 0; padding: 0;}

		html {height: 100%; background: #ffffff;}

		body {font-family: montserrat, arial, verdana;}
		/*form styles*/

		.msform {
			width: 600px;
			margin: 25px auto;
			background: white;
			border: 0 none;
			border-radius: 3px;
			box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
			padding: 20px 30px;
			text-align: left;
			-moz-box-sizing: border-box;
			margin-top: 10%;
		}

		</style>
    </head>
    
    <body>

     <!-- body start--> 
	 <form id="logout-form" class="msform">
		<p style="font-size: 16px" class="text-center text-primary">Your votes have been Submitted, You can now leave the station.</p><br>
		<p style="font-size: 30px" class="text-center text-primary"><i class="fa fa-thumbs-o-up"></i> Thank You. You May Leave</p><br>
		<p class="text-center" style="color: #CC0000;"><strong>Note:</strong> <i>( you cannot vote again after you read this confirmation )</i></p><br>

	</form>


     <!-- body ends--> 
     
      <script src="../assets/js/jquery.min.js"></script>
      <script src="../assets/js/bootstrap.min.js"></script>
      <script src="../assets/js/jquery.easing.min.js"></script>
      <script type="text/javascript">
		var inter=setTimeout(function(){
			clearTimeout(inter);
			window.location = "logout.php";
		},2000);
	  </script>

    </body>
</html>