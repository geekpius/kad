<?php include('../../middleware/verifyadmin.php'); if($user['role']!='administrator'){ header("Location: ../dashboard.php"); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="Electronic voting for ePower-House"/>
  <meta name="author" content="T.K.Pius Geek @ VibTech"/>
  <title>True Voting - Config</title>
  <!--favicon-->
  <link rel="icon" href="../../assets/images/favicon.ico" type="image/x-icon"/>
  <!-- Vector CSS -->
  <link href="../../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="../../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="../../assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="../../assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="../../assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="../../assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="../../assets/css/app-style.css" rel="stylesheet"/>
  <!-- skins CSS-->
  <link href="../../assets/css/skins.css" rel="stylesheet"/>
  <link href="../../assets/sweetalert/sweetalert.css" rel="stylesheet"/>
  <style>
      .img-upload-photo{
        border-radius: 50% !important;
      }
    
      .text-transform-default{
        text-transform: none !important;
      }
  </style>
</head>

<body>


<!--start body-->
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Perform configurations</h4>
    </div>
</div>
<!-- End Breadcrumb-->
 
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
            Settings    
       </div>
        <div class="card-body">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                        <?php
                        require_once("../../models/DBLayer.php");
                        $candidates = Model::all("candidates");        
                        $positions = Model::all("positions");        
                        ?>
                            <div class="card-title">Voting Settings</div><hr>
                            <form id="formSetting">   
                                <div class="row">
                                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                                    <div class="col-sm-12">
                                        <div class="form-group validate">
                                            <label for="input-1">Candidate</label>
                                            <select name="name" id="name" class="form-control">
                                                <option value="">--Select--</option>
                                                <?php 
                                                foreach($candidates as $can){ ?>
                                                <option value="<?php echo $can['name']; ?>"><?php echo $can['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger small" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group validate">
                                            <label for="input-1">Position</label>
                                            <select name="position" id="position" class="form-control">
                                                <option value="">--Select--</option>
                                                <?php 
                                                foreach($positions as $pos){ ?>
                                                <option value="<?php echo $pos['name']; ?>"><?php echo $pos['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger small" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group validate">
                                            <label for="input-1">Number of Contestant</label>
                                            <input type="text" name="contestant" class="form-control" placeholder="Number of contestant">
                                            <span class="text-danger small" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block px-5 btn_update_time"><i class="fa fa-refresh"></i> Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div><!-- End Row-->



<!--end body-->

  <!-- Bootstrap core JavaScript-->
  <script src="../../assets/js/jquery.min.js"></script>
  <script src="../../assets/js/popper.min.js"></script>
  <script src="../../assets/js/bootstrap.min.js"></script>
    
  <!-- simplebar js -->
  <script src="../../assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="../../assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="../../assets/js/app-script.js"></script>
  <script src="../../assets/sweetalert/sweetalert.min.js"></script>
<script>
$("#formSetting").on('submit', function(e){
    e.preventDefault();
    e.stopPropagation();
    var valid = true;
      $('#formSetting input, #formSetting select').each(function() {
          var $this = $(this);
          
          if(!$this.val()) {
              valid = false;
              $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
          }
      });
      if(valid) {
            $(".btn_update_time").html('<i class="fa fa-spin fa-spinner"></i> Updating...').attr('disabled', true);
          var data = $("#formVotingTime").serialize();
            $.ajax({
                url: '../controllers/admin/set-time.php',
                type: 'POST',
                data: data,
                success: function(resp){
                    if(resp=='success'){
                        swal({
                            title: "Set",
                            text: "Voting settings is set",
                            type: "success",
                            confirmButtonClass: "btn-primary btn-sm",
                            confirmButtonText: "OKAY",
                            closeOnConfirm: true
                        });
                    }
                    else{
                        swal({
                            title: "Opps",
                            text: resp,
                            type: "error",
                            confirmButtonClass: "btn-primary btn-sm",
                            confirmButtonText: "OKAY",
                            closeOnConfirm: true
                        });
                    }
                
                    $('.btn_update_time').html('<i class="fa fa-refresh"></i> Update').attr('disabled', false);
                },
                error: function(resp){
                    alert('Something went wrong');
                    $('.btn_change_password').html('<i class="fa fa-refresh"></i> Update').attr('disabled', false);
                }
            });
      }
    return false;
});


</script> 

</body>
</html>
