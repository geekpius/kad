<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'All Position Results'; include('../layouts/admin-head.php'); ?>
<style>
@media print { 
    .yesprint{ display: block !important; }
}
</style>
</head>

<body>

<?php include('../layouts/admin-menus.php'); ?>

<!--start body-->

<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Perform this activities on all position results module</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">View</a></li>
        </ol>
    </div>
</div>
<!-- End Breadcrumb-->
<?php require_once("../models/DBLayer.php"); 
    $totalVoters = Model::count("SELECT COUNT(*) FROM voters");
    $countVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s", array(':s'=>true));
    $countNotVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s", array(':s'=>false));
    $positions = Model::all('positions');
?>
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
            All Position Result
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12"><a href="javascript:void(0);" class="mb-2 ml-5 btn_print"><i class="fa fa-print"></i> Print</a></div>
                <div class="col-sm-1"></div>
                <div class="col-sm-10" id="printOut">
                    <div class="text-center"><span class="text-danger text-uppercase" style="text-decoration: underline"> St. Louis Senior High School</span></div>
                    <div class="text-center"><span class="text-danger text-uppercase" style="text-decoration: underline"> All Election Results</span></div>
                    <h5>Total Voters:&nbsp;&nbsp;<span class="text-primary"><?php echo $totalVoters; ?></span></h5>
                    <h5>Voted:&nbsp;&nbsp;<span class="text-primary"><?php echo $countVoted; ?></span></h5>
                    <h5>Not Voted:&nbsp;&nbsp;<span class="text-primary"><?php echo $countNotVoted; ?></span></h5>
                    <hr>
                    <?php
                    if(count($positions)>0){
                    foreach($positions as $post){
                        if($post['type']=='General'){ 
                            //if position is for all candidates
                            $candidates = Model::filter("SELECT * FROM candidates WHERE position=:p", array(':p'=>$post['name']));
                            $sumVotes = Model::sumWhere("vote", "candidates", "WHERE position=:p", array(':p'=>$post['name']));
                            if(count($candidates)>1){ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <h6 style="font-size: 13px">Total Valid Votes:&nbsp;&nbsp;<span class="text-success"><?php echo $sumVotes; ?></span></h6>
                            <h6 style="font-size: 13px">Invalid Votes(Skipped):&nbsp;&nbsp;<span class="text-danger"><?php echo $countVoted-$sumVotes; ?></span></h6>
                            <table class="">
                            <?php 
                                foreach($candidates as $can){ ?>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px"><?php echo $can['name']; ?></td>
                                        <td width="130px"><?php echo $can['vote']; ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*($can['vote']/$sumVotes),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*($can['vote']/$sumVotes),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php } ?>
                            </table> <hr>
                            <?php }else{ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?>&nbsp;&nbsp;(Unopposed)</strong></h5>
                            <h6 style="font-size: 13px">Total Votes:&nbsp;&nbsp;<span class="text-success"><?php echo $countVoted; ?></span></h6>
                            <table class="">
                            <?php 
                                foreach($candidates as $can){ ?>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px"><?php echo $can['name']; ?>&nbsp;&nbsp;(YES)</td>
                                        <td width="130px"><?php echo $can['vote']; ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*($can['vote']/$countVoted),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*($can['vote']/$countVoted),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/no-vote.jpg" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px">Voted (NO)</td>
                                        <td width="130px"><?php echo ($countVoted-$sumVotes); ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*(($countVoted-$sumVotes)/$countVoted),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*(($countVoted-$sumVotes)/$countVoted),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php  } ?>   
                            </table><hr>
                        <?php }

                        }elseif($post['type']=='SRC'){
                            //this is for all src candidates
                            $candidates = Model::filter("SELECT * FROM candidates WHERE position=:p", array(':p'=>$post['name']));
                            $sumVotes = Model::sumWhere("vote", "candidates", "WHERE position=:p", array(':p'=>$post['name']));
                            $countSrcVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s AND delegate=:d", array(':s'=>true, ':d'=>true));
                            $countSrcDelegates = Model::countWhere("SELECT COUNT(*) FROM voters WHERE delegate=:d", array(':d'=>true));

                            if(count($candidates)>1){ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <h6 style="font-size: 13px">Total SRC Delegates:&nbsp;&nbsp;<span class="text-primary"><?php echo $countSrcDelegates; ?></span></h6>
                            <h6 style="font-size: 13px">Total Valid Votes:&nbsp;&nbsp;<span class="text-success"><?php echo $sumVotes; ?></span></h6>
                            <h6 style="font-size: 13px">Invalid Votes(Skipped):&nbsp;&nbsp;<span class="text-danger"><?php echo $countSrcVoted-$sumVotes; ?></span></h6>
                            <table class="">
                            <?php 
                                foreach($candidates as $can){ ?>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px"><?php echo $can['name']; ?></td>
                                        <td width="130px"><?php echo $can['vote']; ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*($can['vote']/$sumVotes),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*($can['vote']/$sumVotes),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>                                   
                            <?php } ?>
                            </table> <hr>
                            <?php } else{ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?>&nbsp;&nbsp;(Unopposed)</strong></h5>
                            <h6 style="font-size: 13px">Total SRC Delegates:&nbsp;&nbsp;<span class="text-primary"><?php echo $countSrcDelegates; ?></span></h6>
                            <h6 style="font-size: 13px">Total Votes:&nbsp;&nbsp;<span class="text-success"><?php echo $countSrcVoted; ?></span></h6>
                            <table class="">
                            <?php 
                                foreach($candidates as $cand){ ?>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px"><?php echo $can['name']; ?>&nbsp;&nbsp;(YES)</td>
                                        <td width="130px"><?php echo $can['vote']; ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*($can['vote']/$countSrcVoted),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*($can['vote']/$countSrcVoted),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/no-vote.jpg" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px">Voted (NO)</td>
                                        <td width="130px"><?php echo ($countSrcVoted-$sumVotes); ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*(($countSrcVoted-$sumVotes)/$countSrcVoted),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*(($countSrcVoted-$sumVotes)/$countSrcVoted),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php } ?>
                            </table><hr>
                        <?php }
                        }else{
                            //this is for all house candidates 
                            $candidates = Model::filter("SELECT * FROM candidates WHERE position=:p AND house=:h", array(':p'=>$post['name'], ':h'=>$post['type']));
                            $sumVotes = Model::sumWhere("vote", "candidates", "WHERE position=:p AND house=:h", array(':p'=>$post['name'], ':h'=>$post['type']));
                            $countHouseVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s AND house=:h", array(':s'=>true, ':h'=>$post['type']));
                            $countHouseMembers = Model::countWhere("SELECT COUNT(*) FROM voters WHERE house=:h", array(':h'=>$post['type']));

                            if(count($candidates)>1){ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <h6 style="font-size: 13px">Total House Members:&nbsp;&nbsp;<span class="text-primary"><?php echo $countHouseMembers; ?></span></h6>
                            <h6 style="font-size: 13px">Total Valid Votes:&nbsp;&nbsp;<span class="text-success"><?php echo $sumVotes; ?></span></h6>
                            <h6 style="font-size: 13px">Invalid Votes(Skipped):&nbsp;&nbsp;<span class="text-danger"><?php echo $countHouseVoted-$sumVotes; ?></span></h6>
                            <table class="">
                            <?php
                                foreach($candidates as $can){ ?>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px"><?php echo $can['name']; ?></td>
                                        <td width="130px"><?php echo $can['vote']; ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*($can['vote']/$sumVotes),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*($can['vote']/$sumVotes),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php } ?>
                            </table> <hr>
                            <?php }else{ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?>&nbsp;&nbsp;(Unopposed)</strong></h5>
                            <h6 style="font-size: 13px">Total House Members:&nbsp;&nbsp;<span class="text-primary"><?php echo $countHouseMembers; ?></span></h6>
                            <h6 style="font-size: 13px">Total Votes:&nbsp;&nbsp;<span class="text-success"><?php echo $countHouseVoted; ?></span></h6>
                            <table class="">
                            <?php
                                foreach($candidates as $can){ ?>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px"><?php echo $can['name']; ?>&nbsp;&nbsp;(YES)</td>
                                        <td width="130px"><?php echo $can['vote']; ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*($can['vote']/$countHouseVoted),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*($can['vote']/$countHouseVoted),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100px"><img src="../assets/images/no-vote.jpg" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                        <td width="300px">Voted (NO)</td>
                                        <td width="130px"><?php echo ($countHouseVoted-$sumVotes); ?></td>
                                        <td width="250px">
                                            <span class="pull-left mr-2"><strong><?php echo ($sumVotes!=0)? round(100*(($countHouseVoted-$sumVotes)/$countHouseVoted),2):0; ?>%</strong></span>
                                            <div class="progress-wrapper hidden-print">
                                                <div class="progress mt-2">
                                                    <div class="progress-bar bg-primary" style="width:<?php echo ($sumVotes!=0)? round(100*(($countHouseVoted-$sumVotes)/$countHouseVoted),2):0; ?>%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php } ?>
                            </table><hr>
                            <?php }
                        }
                    } 
                    } 
                    ?>

                    <div class="yesprint" style="display:none; margin-top: 10%">
                    <p><strong>I,.......................................................................... as the Electoral Commission of St. Louis Senior High School hereby
                    approve the above results guided by the law and constitution of this institution.</strong></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div><!-- End Row-->

<!--end body-->

<?php include('../layouts/admin-footer.php'); ?>
<?php include('../layouts/admin-scripts.php'); ?>
<script src="../assets/js/jQuery.print.min.js"></script>
<script>
$(".btn_print").on('click', function(e){
    e.preventDefault();
    e.stopPropagation();
    $("#printOut").print();
    return false;
});
</script>

</body>
</html>
