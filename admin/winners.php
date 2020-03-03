<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'All Winners'; include('../layouts/admin-head.php'); ?>
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
                    <div class="text-center"><span class="text-danger text-uppercase" style="text-decoration: underline"> All Election Winners</span></div>
                    <hr>
                    <span><strong>This winners are based on simple majority</strong></span>
                    <hr>
                    <?php
                    if(count($positions)>0){
                    foreach($positions as $post){ 
                        if($post['type']=='General'){
                            $countCandidate = Model::countWhere("SELECT COUNT(*) FROM candidates WHERE position=:p", array(':p'=>$post['name']));
                            $can = Model::first("SELECT * FROM candidates WHERE position=:p ORDER BY vote DESC LIMIT 1", array(':p'=>$post['name']));
                            $countVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s", array(':s'=>true));
                            $sumVotes = Model::sumWhere("vote", "candidates", "WHERE position=:p", array(':p'=>$post['name']));
                            if($countCandidate!=1){ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <table class="">
                            <?php if($sumVotes==0){ ?>
                                <tr class="text-danger">
                                    <td colspan="4"><strong>No winner found for this position</strong></td>
                                </tr>
                            <?php }else{ ?>
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
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <table class="">
                            <?php if($sumVotes==0){ ?>
                                <tr class="text-danger">
                                    <td colspan="4"><strong>No winner found for this position</strong></td>
                                </tr>
                            <?php }else{ ?>
                                <tr>
                                    <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                    <td width="300px"><?php echo $can['name']; ?></td>
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
                            <?php } ?>
                            </table> <hr>
                        <?php } ?>
                    <?php }elseif($post['type']=='SRC'){
                            $countCandidate = Model::countWhere("SELECT COUNT(*) FROM candidates WHERE position=:p", array(':p'=>$post['name']));
                            $can = Model::first("SELECT * FROM candidates WHERE position=:p ORDER BY vote DESC LIMIT 1", array(':p'=>$post['name']));
                            $sumVotes = Model::sumWhere("vote", "candidates", "WHERE position=:p", array(':p'=>$post['name']));
                            $countSrcVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s AND delegate=:d", array(':s'=>true, ':d'=>true));
                            if($countCandidate!=0){ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <table class="">
                            <?php if($sumVotes==0){ ?>
                                <tr class="text-danger">
                                    <td colspan="4"><strong>No winner found for this position</strong></td>
                                </tr>
                            <?php }else{ ?>
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
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <table class="">
                            <?php if($sumVotes==0){ ?>
                                <tr class="text-danger">
                                    <td colspan="4"><strong>No winner found for this position</strong></td>
                                </tr>
                            <?php }else{ ?>
                                <tr>
                                    <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                    <td width="300px"><?php echo $can['name']; ?></td>
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
                            <?php } ?>
                            </table> <hr>
                            <?php  }
                        }else{
                            //this is for all house candidates 
                            $countCandidate = Model::countWhere("SELECT COUNT(*) FROM candidates WHERE position=:p AND house=:h", array(':p'=>$post['name'], ':h'=>$post['type']));
                            $can = Model::first("SELECT * FROM candidates WHERE position=:p AND house=:h ORDER BY vote DESC LIMIT 1", array(':p'=>$post['name'], ':h'=>$post['type']));
                            $sumVotes = Model::sumWhere("vote", "candidates", "WHERE position=:p AND house=:h", array(':p'=>$post['name'], ':h'=>$post['type']));
                            $countHouseVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s AND house=:h", array(':s'=>true, ':h'=>$post['type']));
                            if($countCandidate!=0){ ?>
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <table class="">
                            <?php if($sumVotes==0){ ?>
                                <tr class="text-danger">
                                    <td colspan="4"><strong>No winner found for this position</strong></td>
                                </tr>
                            <?php }else{ ?>
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
                            <h5><strong class="text-primary text-uppercase"><?php echo $post['name']; ?></strong></h5>
                            <table class="">
                            <?php if($sumVotes==0){ ?>
                                <tr class="text-danger">
                                    <td colspan="4"><strong>No winner found for this position</strong></td>
                                </tr>
                            <?php }else{ ?>
                                <tr>
                                    <td width="100px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="80" width="80" alt="<?php echo $can['name']; ?>" /></td>
                                    <td width="300px"><?php echo $can['name']; ?></td>
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
                            <?php } ?>
                            </table> <hr>
                            <?php  }
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
