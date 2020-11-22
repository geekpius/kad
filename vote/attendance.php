
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

                <br><br><br><br><br><br><br><br><br>
                <div class="text-center">
                <?php
                require_once("../models/DBLayer.php");
                $gs = Model::first("SELECT * FROM general_settings WHERE id=:id", array(':id'=>1));
                ?>
                <h4 class="text-primary text-uppercase">Voting Closing Time Countdown </h4>
                <span id="demo"></span>
                <br><br><br>
                <div>
                    <h5>ENDING TIME</h5>
                    <p class="text-danger"><?php  echo date('d-M-Y h:ia', strtotime($gs['timer'])); ?></div></p>
                </div>
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

function timer(){
    // Set the date we're counting down to
    var countDownDate = new Date("<?php  echo $gs['timer']; ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
   /*  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s "; */

    document.getElementById("demo").innerHTML = '<h4 style="font-size:50px"><span class="badge badge-success">'+hours+'h </span> '+
    '<span class="badge badge-success">'+minutes+'m </span> <span class="badge badge-success">'+seconds+'s </span></h4>';

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        var getexp = document.getElementById("demo").innerHTML = '<h4><span class="badge badge-danger">VOTING TIME EXPIRED</span></h4>';
        if(getexp){
            $("#ExpireModal").modal({backdrop: 'static'}); 
        }
    }
    }, 1000);
}

timer();

</script>

</body>
</html>
