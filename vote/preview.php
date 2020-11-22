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
		#msform .action-button2 {
			width: 80px;
			background: #007bff !important;
			font-size: 12px !important;
			color: white;
			border: 0 none;
			border-radius: 2px;
			cursor: pointer;
			padding: 4px;
			margin: 0px 0px, 0px, 3px;
		}
		#msform .action-button2:hover, #msform .action-button2:focus {box-shadow: 0 0 0 2px white, 0 0 0 3px #007bff !important;}

		#msform #submit {
			width: 200px;
			background: #27AE60;
			font-weight: bold;
			color: white;
			border: 0 none;
			border-radius: 1px;
			padding: 10px 5px;
			margin: 10px 5px;
			font-size: 14px;
		}
		#msform #submit:hover, #msform #submit:focus {box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;}

		#msform a{text-decoration: none; padding: 10px 22px !important;}

		#msform {
			width: 700px;
			margin: 25px auto;
			background: white;
			border: 0 none;
			border-radius: 3px;
			box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
			padding: 20px 30px;
			text-align: left;
			-moz-box-sizing: border-box;
		}

		.fs-title {
			font-size: 15px;
			text-transform: uppercase;
			color: #2C3E50;
			margin-bottom: 10px;
			margin-top: 10px;
		}

		#cssTable td {text-align:center; vertical-align:middle;}
		</style> 
    </head>
    
    <body>

     <!-- body start--> 
	
	 <div class="col-sm-12">
    <?php  require_once("../models/DBLayer.php"); $selectedCandidates = Model::filter("SELECT * FROM voter_carts WHERE voter_id=:id ORDER BY id", array(':id'=>$user['id']));?>
    <!-- multistep form -->
    <form id="msform" action="../controllers/voter/submit.php" method="POST">
        <div class="text-center">
			<button type="submit" class="btn_submit" id="submit"><i class="fa fa-check-circle-o"></i> Submit Votes</button>
		</div>
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>" readonly="readonly">
		<input type="hidden" value="<?php echo $user['id']; ?>" name="voter_id" readonly="readonly" />
        <table class="table table-hover table-condensed" id="cssTable">
		<?php
			foreach($selectedCandidates as $s){ 
			$can = Model::first("SELECT image FROM candidates WHERE name=:n", array(':n'=>$s['candidate'])); ?>
				<tr class="fs-title text-primary"><td colspan="3" style="text-align: left !important"><strong><?php echo $s['position']; ?></strong></td></tr>
				<tr>
					<td><img src="../assets/images/<?php echo (empty($can))? 'no-vote.jpg':'candidates/'.$can['image']; ?>" width="100" height="<?php echo (empty($can))? '':'90';?>" class="img-rounded img-responsive" alt="<?php echo $s['candidate']; ?>" /></td>
					<td width="100%" align="center" valign="middle"><?php echo $s['candidate']; ?></td>
					<td>
						<button type="button" class="action-button2" onclick="window.location='change-candidate.php?pos=<?php echo $s['position']; ?>'"><i class="fa fa-edit"></i> Change</button>
					</td>
				</tr>
				<input type="hidden" value="<?php echo $s['candidate']; ?>" name="votes[]" readonly="readonly" />	
		<?php } ?>
        </table>
        <div class="text-center">
			<button type="submit" class="btn_submit" id="submit"><i class="fa fa-check-circle-o"></i> Submit Votes</button>
		</div>
    </form>
</div>



     <!-- body ends--> 
     
      <script src="../assets/js/jquery.min.js"></script>
      <script src="../assets/js/bootstrap.min.js"></script>
      <script src="../assets/js/jquery.easing.min.js"></script>
      <script type="text/javascript">
		$("#msform").on('submit', function(){
			$('.btn_submit').html('<i class="fa fa-spin fa-spinner"></i> Submitting Votes...').attr('disabled', true);
		});
	  </script>

    </body>
</html>