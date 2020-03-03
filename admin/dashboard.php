<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Dashboard'; include('../layouts/admin-head.php'); ?>
</head>

<body>

<?php include('../layouts/admin-menus.php'); ?>

<!--start body-->
<?php require_once("../models/DBLayer.php");
$count_position = Model::count("SELECT COUNT(*) FROM positions");
$count_house = Model::count("SELECT COUNT(*) FROM houses");
$count_candidate= Model::count("SELECT COUNT(*) FROM candidates");
$count_voter= Model::count("SELECT COUNT(*) FROM voters");

$count_voted= Model::count("SELECT COUNT(*) FROM voters WHERE status=true");
$count_notvoted= Model::count("SELECT COUNT(*) FROM voters WHERE status=false");
?>
<div class="row mt-3">
  <div class="col-12 col-lg-6 col-xl-3">
    <a href="positions.php">
      <div class="card gradient-deepblue">
        <div class="card-body">
          <h5 class="text-white mb-0"><?php echo $count_position; ?> <span class="float-right"><i class="fa fa-user-md"></i></span></h5>
            <div class="progress my-3" style="height:3px;">
               <div class="progress-bar" style="width:55%"></div>
            </div>
          <p class="mb-0 text-white small-font">Positions <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
        </div>
      </div> 
    </a>
  </div>
  <div class="col-12 col-lg-6 col-xl-3">
    <a href="candidates.php">
      <div class="card gradient-orange">
        <div class="card-body">
          <h5 class="text-white mb-0"><?php echo $count_candidate; ?> <span class="float-right"><i class="fa fa-user-plus"></i></span></h5>
            <div class="progress my-3" style="height:3px;">
               <div class="progress-bar" style="width:55%"></div>
            </div>
          <p class="mb-0 text-white small-font">Candidates <span class="float-right">+1.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-lg-6 col-xl-3">
    <a href="voters.php">
      <div class="card gradient-ohhappiness">
        <div class="card-body">
          <h5 class="text-white mb-0"><?php echo $count_voter; ?> <span class="float-right"><i class="fa fa-address-card"></i></span></h5>
            <div class="progress my-3" style="height:3px;">
               <div class="progress-bar" style="width:55%"></div>
            </div>
          <p class="mb-0 text-white small-font">Voters <span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
        </div>
      </div>
    </a>
  </div>
  <div class="col-12 col-lg-6 col-xl-3">
    <a href="houses.php">
    <div class="card gradient-ibiza">
      <div class="card-body">
        <h5 class="text-white mb-0"><?php echo $count_house; ?> <span class="float-right"><i class="fa fa-home"></i></span></h5>
          <div class="progress my-3" style="height:3px;">
             <div class="progress-bar" style="width:55%"></div>
          </div>
        <p class="mb-0 text-white small-font">House <span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
      </div>
    </div>
    </a>
  </div>
</div><!--End Row-->


<div class="row">
 <div class="col-12 col-lg-12">
     <div class="card">
       <div class="card-header">Voting Statistics
         <div class="card-action">
         <div class="dropdown">
         <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
           <i class="icon-options"></i>
         </a>
           </div>
         </div>
       </div>
       <div class="card-body">
           <div class="chart-container-2">
             <canvas id="chart2"></canvas>
     </div>
       </div>
       <div class="table-responsive">
         <table class="table align-items-center">
           <tbody>
             <tr>
               <td><i class="fa fa-circle mr-2" style="color: #14abef"></i> Total Voters</td>
               <td><?php echo $count_voter; ?></td>
               <td> <?php echo ($count_voter==0)? 0:round(($count_voter/$count_voter)*100,2); ?>%</td>
             </tr>
             <tr>
               <td><i class="fa fa-circle mr-2" style="color: #02ba5a"></i>Voted</td>
               <td><?php echo $count_voted; ?></td>
               <td><?php echo ($count_voter==0)? 0:round(($count_voted/$count_voter)*100,2); ?>%</td>
             </tr>
             <tr>
               <td><i class="fa fa-circle mr-2" style="color: #d13adf"></i>Not Voted</td>
               <td><?php echo $count_notvoted; ?></td>
               <td><?php echo ($count_voter==0)? 0:round(($count_notvoted/$count_voter)*100,2); ?>%</td>
             </tr>
           </tbody>
         </table>
       </div>
     </div>
 </div>
</div><!--End Row-->


<!--end body-->

<?php include('../layouts/admin-footer.php'); ?>
<?php include('../layouts/admin-scripts.php'); ?>

<!-- Chart js -->
<script src="../assets/plugins/Chart.js/Chart.min.js"></script>
<!-- Vector map JavaScript -->
<script src="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Easy Pie Chart JS -->
<script src="../assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<!-- Sparkline JS -->
<script src="../assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="../assets/plugins/jquery-knob/excanvas.js"></script>
<script src="../assets/plugins/jquery-knob/jquery.knob.js"></script>
  
<script>
var ctx = document.getElementById("chart2").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Total Voters", "Voted", "Not Voted"],
    datasets: [{
      backgroundColor: [
        "#14abef",
        "#02ba5a",
        "#d13adf"
      ],
      data: [<?php echo $count_voter; ?>, <?php echo $count_voted; ?>, <?php echo $count_notvoted; ?>],
      borderWidth: [0, 0, 0, 0]
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
    position :"bottom",	
    display: false,
      labels: {
        fontColor: '#ddd',  
        boxWidth:15
      }
    },
    tooltips: {
      displayColors:false
    }
  }
});
</script>

</body>
</html>
