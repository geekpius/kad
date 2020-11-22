
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="Electronic voting for ePower-House"/>
  <meta name="author" content="T.K.Pius Geek @ VibTech"/>
  <title>True Voting - Attendance Sheet</title>
  <!--favicon-->
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon"/>
  <!-- Bootstrap core CSS-->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="../assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="../assets/css/app-style.css" rel="stylesheet"/>
  <!-- skins CSS-->
  <link href="../assets/css/skins.css" rel="stylesheet"/>
</head>
<body style="background-color: #ffffff">

  <!-- Start wrapper-->
   <div id="wrapper">
  
        <div class="row m-5">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div id="get_voters_stats"></div>
            </div>
        </div>
            

   </div><!--wrapper-->
  

<!-- Bootstrap core JavaScript-->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

<!-- simplebar js -->
<script src="../assets/plugins/simplebar/js/simplebar.js"></script>
<!-- sidebar-menu js -->
<script src="../assets/js/sidebar-menu.js"></script>
<!-- loader scripts -->
<script src="../assets/js/jquery.loading-indicator.js"></script>
<!-- Custom scripts -->
<script src="../assets/js/app-script.js"></script>
<script>

function getVoterStats(){
    $("#get_voters_stats").load("../controllers/voter/voterstats.php");
    setTimeout(getVoterStats, 1000)
}
 
getVoterStats();
</script>

</body>
</html>
