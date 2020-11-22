<?php include('../middleware/verifyvoter.php'); if(!isset($_GET['pos'])){ header("Location: preview.php"); }else{ $position= $_GET['pos']; } ?>
<!doctype html>
<html lang="en">
    <head>
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <meta name="description" content="Electronic voting for ePower-House"/>
      <meta name="author" content="T.K.Pius Geek @ VibTech"/>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>ePower-House - CHANGE <?php echo $position; ?></title>
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
        #msform {
            width: 700px;
            margin: 50px auto;
            text-align: center;
            position: relative;
            margin-top: 25px;
        }
        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 3px;
            box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
            padding: 20px 30px;
            text-align: left;

            -moz-box-sizing: border-box;
            width: 100%;

            /*stacking fieldsets above each other*/
            position: absolute;
        }
        /*Hide all except first fieldset*/
        #msform fieldset:not(:first-of-type) {display: none;}
        /*inputs*/
        #msform input, #msform button, #msform textarea, #msform select {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
            width: 100%;
            -moz-box-sizing: border-box;
            color: #2C3E50;
            font-size: 13px;
        }
        /*buttons*/
        #msform .action-button {
            width: 100px;
            background: #27AE60;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }
        #msform .action-button:hover, #msform .action-button:focus {box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;}

        #msform .action-button2 {
            width: 100px;
            background: #dc3545;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }
        #msform .action-button2:hover, #msform .action-button2:focus {box-shadow: 0 0 0 2px white, 0 0 0 3px #dc3545;}

        #msform #submit {
            width: 100px;
            background: #27AE60;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px;
        }
        #msform #submit:hover, #msform #submit:focus {box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;}

        /*headings*/
        .fs-title {
            font-size: 15px;
            text-transform: uppercase;
            color: #2C3E50;
            margin-bottom: 10px;
        }
        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
        }
        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
            width: 100%;
            text-align: center;
        }
        #progressbar li {
            list-style-type: none;
            color: white;
            text-transform: uppercase;
            font-size: 9px;
            width: 9.1%;
            float: left;
            position: relative;
            text-align: center;
        }
        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 20px;
            line-height: 20px;
            display: block;
            font-size: 10px;
            color: #333;
            background: white;
            border-radius: 3px;
            margin: 0 auto 5px auto;
        }
        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }
        #progressbar li:first-child:after {/*connector not needed before the first step*/ content: none;}
        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before,  #progressbar li.active:after{background: #27AE60; color: white;}

        #logo {margin: 25px auto; width: 500px;}

        #logo img {float: left;}

        .clearfix {clear: both;}

        #logo span {
            display: inline-block;
            font-size: 17px;
            vertical-align: middle;
            margin-top: 34px;
            color: #000000;
        }

        td {height: 50px; width:50px;}

        #cssTable td {text-align:center; vertical-align:middle;}

        </style>
    </head>
    
    <body>

     <!-- body start--> 

    <div class="col-sm-12">
    <?php  require_once("../models/DBLayer.php"); $pos = Model::first("SELECT * FROM positions WHERE name=:n LIMIT 1", array(':n'=>$position));?>
    <!-- multistep form -->
        <form id="msform" action="../controllers/voter/preview.php" method="POST">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>" readonly>
            <input type="hidden" name="voter_id" value="<?php echo $user['id']; ?>" readonly>
            <!-- progressbar -->
        <?php 
            $candidates = Model::filter("SELECT * FROM candidates WHERE position=:p ORDER BY id", array(':p'=>$pos['name']));
            if(count($candidates)!=1){ ?>
            <fieldset>
                <h2 class="fs-title text-primary text-uppercase"><strong><?php echo $pos['name']; ?></strong></h2>
                <table class="table table-hover table-condensed" id="cssTable">
                <?php 
                    foreach($candidates as $can){ ?>
                    <tr>
                        <td><img src="../assets/images/candidates/<?php echo $can['image']; ?>" width="110" height="110" class="img-rounded img-responsive img-thumbnail" /></td>
                        <td width="300px" align="center" valign="middle"><?php echo $can['name']; ?></td>
                        <td align="center" valign="middle" width="50px">
                            <button type="button" class="next action-button" name="<?php echo $pos['name']; ?>" id="<?php echo $can['name']; ?>" onclick="f1(this)"><i class="fa fa-check-square-o"></i> Vote</button>
                        </td>
                    </tr>
                <?php } ?>
                    <tr>
                        <td>
                            <button type="button" class="next action-button2" name="<?php echo $pos['name']; ?>" id="Skipped" onclick="f1(this)"><i class="fa fa-times-circle-o"></i> Skip</button>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                </table>

                <select name="<?php echo (strpos($pos['name'],' ')!==false)? str_replace(' ','_',$pos['name']):$pos['name']; ?>" id ="<?php echo $pos['name']; ?>" class="s_n" style="height: 51px; display:none !important;">
                    <option value="Skipped">Skipped</option>
                    <?php foreach($candidates as $can){ ?>
                    <option value="<?php echo $can['name']; ?>"><?php echo $can['name']; ?></option>
                    <?php } ?>
                </select>
            </fieldset>
            <?php }else{ ?>
            <fieldset>
                <h2 class="fs-title text-primary text-uppercase"><strong><?php echo $pos['name']; ?></strong></h2>
                <table class="table table-hover table-condensed" id="cssTable">
                <?php
                    foreach($candidates as $can){ ?>
                    <tr>
                        <td><img src="../assets/images/candidates/<?php echo $can['image']; ?>" width="120" height="120" class="img-rounded img-responsive img-thumbnail"/></td>
                        <td width="300px" align="center"><?php echo $can['name']; ?></td>
                        <td align="right" width="50px">
                            <button type="button" class="next action-button" name="<?php echo $pos['name']; ?>" id="<?php echo $can['name']; ?>" onclick="f1(this)"><i class="fa fa-check-square-o"></i> Yes</button>
                            <button type="button" class="next action-button2" name="<?php echo $pos['name']; ?>" id="No" onclick="f1(this)"><i class="fa fa-times-circle-o"></i> No</button>
                        </td>
                    </tr>
                <?php } ?>
                </table>

                <select name="<?php echo (strpos($pos['name'],' ')!==false)? str_replace(' ','_',$pos['name']):$pos['name']; ?>" id ="<?php echo $pos['name']; ?>" style="height: 51px; display: none;">
                    <option value="No">No</option>
                    <?php foreach($candidates as $can){ ?>
                    <option value="<?php echo $can['name']; ?>"><?php echo $can['name']; ?></option>
                    <?php } ?>
                </select>
            </fieldset>
        <?php } ?>
        </form>

    </div>



     <!-- body ends--> 
     
      <script src="../assets/js/jquery.min.js"></script>
      <script src="../assets/js/bootstrap.min.js"></script>
      <script src="../assets/js/jquery.easing.min.js"></script>
      <script type="text/javascript">
        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function(){
            if(animating) return false;
            animating = true;
            current_fs = $(this).parent().parent().parent().parent().parent();
            next_fs = $(this).parent().parent().parent().parent().parent().next();
            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'transform': 'scale('+scale+')'});
                    next_fs.css({'left': left, 'opacity': opacity});
                },
                duration: 800,
                complete: function(){
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
            
            //check for the last one and submit
            var counterCheck = $(this).parent().parent().parent().parent().parent().nextAll().length;
            if(counterCheck==0){
                document.getElementById("msform").submit();
                //console.log(counterCheck)
            }
        });

        function f1(objButton){
            document.getElementById(objButton.name).value =objButton.id;
        }

        </script>

    </body>
</html>