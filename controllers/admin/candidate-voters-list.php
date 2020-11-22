<?php
    require_once("../../models/DBLayer.php");
    $name = $_POST['name'];
    $info = Model::first("SELECT * FROM candidates WHERE name=:n LIMIT 1", array(':n'=>$name));
    $votes = Model::filter("SELECT * FROM votes WHERE candidate=:n", array(':n'=>$name));
   
?>

<div class="text-center text-success"><strong><?php echo $info['name'] ?> - <?php echo $info['position'] ?></strong></div>
<table class="table table-striped">
    <thead>
        <tr class="text-primary">
            <th colspan="2">Your Voters</th>
        </tr>
    </thead>
    <tbody>
    <?php
        if(count($votes)>0){
            foreach($votes as $vote){ 
            $voter = Model::findorFail('voters', $vote['voter_id']);
        ?>
            <tr>
                <td><?php echo ucwords($voter['name']); ?></td>
                <td><?php echo strtoupper($voter['cls']); ?></td>
            </tr>
        <?php    }
        }else{ ?>
            <tr>
                <td colspan="2">No votes found!</td>
            </tr>
        <?php } ?>
    </tbody>
</table>