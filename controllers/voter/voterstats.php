<?php 
require_once("../../models/DBLayer.php");
$totalVoters = Model::count("SELECT COUNT(*) FROM voters");
$countVoters = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s", array(':s'=>true));
$countNotVoters = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s", array(':s'=>false));
?>

<div class="text-right" style="width: 40%">
    <h4>Total Voters:&nbsp;&nbsp;<span class="badge badge-primary"><?php echo $totalVoters ?></span></h4>
    <h4>Voted:&nbsp;&nbsp;<span class="badge badge-success"><?php echo $countVoters ?></span></h4>
    <h4>Not Voted:&nbsp;&nbsp;<span class="badge badge-danger"><?php echo $countNotVoters ?></span></h4>
</div>
<hr>

<div class="mt-5">
    <h4 class="text-success">TOTAL VOTED  (<?php echo ($totalVoters==0)? 0:round(($countVoters/$totalVoters)*100,2) ?>%)</h4>
    <div class="progress-wrapper hidden-print">
        <div class="progress mb-4">
            <div class="progress-bar bg-success" style="width:<?php echo ($totalVoters==0)? 0:round(($countVoters/$totalVoters)*100,2) ?>%"></div>
        </div>
    </div>
</div>
<br>
<div class="mt-5">
    <h4 class="text-danger">TOTAL NOT VOTED (<?php echo ($totalVoters==0)? 0:round(($countNotVoters/$totalVoters)*100,2) ?>%)</h4>
    <div class="progress-wrapper hidden-print">
        <div class="progress mb-4">
            <div class="progress-bar bg-danger" style="width:<?php echo ($totalVoters==0)? 0:round(($countNotVoters/$totalVoters)*100,2) ?>%"></div>
        </div>
    </div>
</div>