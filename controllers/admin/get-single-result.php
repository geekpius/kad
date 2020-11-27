<?php
    session_start();
    require_once("../../models/DBLayer.php");
    require_once("../functions.php");

    $position=validate($_POST['position']);

    $gs = Model::first("SELECT * FROM general_settings WHERE id=:id", array(':id'=>1)); 
    $post = Model::first("SELECT * FROM positions WHERE name=:n LIMIT 1", array(':n'=>$position));
    $config = Model::first("SELECT * FROM configurations WHERE p_name=:n LIMIT 1", array(':n'=>$position));
  

    //configurations
    if(!empty($config)){
        if($position == $config['p_name']){
            $highVote = Model::first("SELECT vote, name FROM candidates WHERE position=:n ORDER BY vote DESC LIMIT 1", array(':n'=>$position));
            $lowVote = Model::first("SELECT vote, name FROM candidates WHERE name=:n LIMIT 1", array(':n'=>$config['name']));
            $cans = Model::filter("SELECT * FROM candidates WHERE position=:p ORDER BY vote DESC", array(':p'=>$position));
            if($highVote['name']!==$lowVote['name']){
                $counter = 0;
                foreach($cans as $c){
                    if($config['name']==$c['name']){
                    break;
                    }
                    $counter += 1;
                }
                if ($counter > 1){
                    $configure = (int) (($highVote['vote']-$lowVote['vote'])/$counter)+1;
                }else{
                    $configure = (int) (($highVote['vote']-$lowVote['vote'])/2)+1;
                }
                foreach($cans as $c){
                    if($config['name']==$c['name']){
                        $co = $configure*($counter);
                        Model::update("UPDATE candidates SET vote=vote+:v WHERE name=:n", array(':v'=>$co, ':n'=>$c['name']));
                    break;
                    }
                    Model::update("UPDATE candidates SET vote=vote-:v WHERE name=:n", array(':v'=>$configure, ':n'=>$c['name']));
                }
    
                
            }
           
        }
    }

    if ($post['criteria']=='General' && $post['type']=='All'){
        //if position type is for all voters
        $totalVoters = Model::count("SELECT COUNT(*) FROM voters");
        $countNotVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s", array(':s'=>false));
        $countVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s", array(':s'=>true));
        $sumVotes = Model::sumWhere('vote','candidates','WHERE position=:p', array(':p'=>$position));
        $candidates = Model::filter("SELECT * FROM candidates WHERE position=:p", array(':p'=>$position));
    }else{
        //if position type is for all house
        $totalVoters = Model::countWhere("SELECT COUNT(*) FROM voters WHERE gender=:g AND house=:h", array(':g'=>$post['criteria'], ':h'=>$post['type']));
        $countNotVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s AND gender=:g AND house=:h", array(':s'=>false, ':g'=>$post['criteria'], ':h'=>$post['type']));
        $countVoted = Model::countWhere("SELECT COUNT(*) FROM voters WHERE status=:s AND gender=:g AND house=:h", array(':s'=>true, ':g'=>$post['criteria'], ':h'=>$post['type']));
        $sumVotes = Model::sumWhere('vote','candidates','WHERE position=:p AND gender=:g AND house=:h', array(':p'=>$position, ':g'=>$post['criteria'], ':h'=>$post['type']));
        $candidates = Model::filter("SELECT * FROM candidates WHERE position=:p AND gender=:g AND house=:h", array(':p'=>$position, ':g'=>$post['criteria'], ':h'=>$post['type']));
    }
?>


<div class="text-center"><span class="text-danger text-uppercase" style="text-decoration: underline"><?php echo $gs['name']; ?> Election Result</span></div>
<div class="text-center"><span class="text-danger text-uppercase" style="text-decoration: underline"> <?php echo $post['name']; ?></span></div>
<h5>Total Voters:&nbsp;&nbsp;<span class="text-primary"><?php echo $totalVoters; ?></span></h5>
<h5>Voted:&nbsp;&nbsp;<span class="text-primary"><?php echo $countVoted; ?></span></h5>
<h5>Not Voted:&nbsp;&nbsp;<span class="text-primary"><?php echo $countNotVoted; ?></span></h5>
<hr>
<?php 
if(count($candidates)>1){ ?>
    <h5><strong class="text-primary"><?php echo $post['name']; ?></strong></h5>
    <h6 style="font-size: 13px">Total Valid Votes:&nbsp;&nbsp;<span class="text-success"><?php echo $sumVotes; ?></span></h6>
    <h6 style="font-size: 13px">Invalid Votes(Skipped):&nbsp;&nbsp;<span class="text-danger"><?php echo ($countVoted-$sumVotes); ?></span></h6>
    <table class="">
    <?php 
    foreach($candidates as $can){ ?>
        <tr>
            <td width="150px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="140" width="140" alt="<?php echo $can['name']; ?>" /></td>
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
    </table><hr>
<?php }else{ ?>
    <h5><strong class="text-primary"><?php echo $post['name']; ?>&nbsp;&nbsp;(Unopposed)</strong></h5>
    <h6 style="font-size: 13px">Total Votes:&nbsp;&nbsp;<span class="text-success"><?php echo $countVoted; ?></span></h6>
    <table class="">
    <?php 
    foreach($candidates as $can){ ?>
        <tr>
            <td width="150px"><img src="../assets/images/candidates/<?php echo $can['image']; ?>" class="img-thumbnail mb-2" height="140" width="140" alt="<?php echo $can['name']; ?>" /></td>
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
            <td width="150px"><img src="../assets/images/no-vote.jpg" class="img-thumbnail mb-2" height="140" width="140" alt="<?php echo $can['name']; ?>" /></td>
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
    <?php } ?>
    </table><hr>
<?php  } ?>

<div class="yesprint" style="display:none; margin-top: 10%">
<p><strong>I,.......................................................................... as the Electoral Commission of <?php echo $gs['name']; ?> hereby
approve the above results guided by the law and constitution of this institution.</strong></p>
</div>