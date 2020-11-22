<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Settings'; include('../layouts/admin-head.php'); ?>
</head>

<body>

<?php include('../layouts/admin-menus.php'); ?>

<!--start body-->
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Perform configurations on general settings module</h4>
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
                        require_once("../models/DBLayer.php");
                        $gs = Model::first("SELECT * FROM general_settings WHERE id=:id", array(':id'=>1));        
                        ?>
                            <div class="card-title">Voting Settings</div><hr>
                            <form id="formVotingTime">   
                                <div class="row">
                                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                                    <div class="col-sm-12">
                                        <div class="form-group validate">
                                            <label for="input-1">Institution Name</label>
                                            <input type="text" name="name" value="<?php echo $gs['name']; ?>" class="form-control">
                                            <span class="text-danger small" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group validate">
                                            <label for="input-1">End Date</label>
                                            <input type="date" name="end_date" class="form-control">
                                            <span class="text-danger small" role="alert"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group validate">
                                            <label for="input-1">End Time</label>
                                            <input type="time" name="end_time" class="form-control" >
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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">System Cleaning</div><hr>
                            <form id="formFactoryReset">
                                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                                <input type="hidden" name="type" value="factory">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block px-5 btn_factory_reset"><i class="fa fa-database"></i> Data Factory Reset</button>
                                </div>
                            </form>
                            <hr>
                            <form id="formTestReset">
                                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                                <input type="hidden" name="type" value="test">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block px-5 btn_test_reset"><i class="fa fa-database"></i> Data After Test Reset</button>
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

<?php include('../layouts/admin-footer.php'); ?>
<?php include('../layouts/admin-scripts.php'); ?>
<script>
$("#formVotingTime").on('submit', function(e){
    e.preventDefault();
    e.stopPropagation();
    var valid = true;
      $('#formVotingTime input').each(function() {
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


$('#formTestReset').on("submit", function(e){
    e.preventDefault();
    e.stopPropagation();
    if(confirm("Sure to reset after test?")){
        $(".btn_test_reset").html('<i class="fa fa-spin fa-spinner"></i> Reseting After Test Data...').attr('disabled', true);
        var data = $("#formTestReset").serialize();
        $.ajax({
            url: '../controllers/admin/data-reset.php',
            type: 'POST',
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Reset",
                        text: "Data after test reset is done",
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
            
                $('.btn_test_reset').html('<i class="fa fa-refresh"></i> Data After Test Reset').attr('disabled', false);
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_test_reset').html('<i class="fa fa-refresh"></i> Data After Test Reset').attr('disabled', false);
            }
        });
    }
    return false;
});


$('#formFactoryReset').on("submit", function(e){
    e.preventDefault();
    e.stopPropagation();
    if(confirm("Sure to reset all data?")){
        $(".btn_factory_reset").html('<i class="fa fa-spin fa-spinner"></i> Reseting All Data...').attr('disabled', true);
        var data = $("#formFactoryReset").serialize();
        $.ajax({
            url: '../controllers/admin/data-reset.php',
            type: 'POST',
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Reset",
                        text: "Data factory reset is done",
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
            
                $('.btn_factory_reset').html('<i class="fa fa-refresh"></i> Data Factory Reset').attr('disabled', false);
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_factory_reset').html('<i class="fa fa-refresh"></i> Data Factory Reset').attr('disabled', false);
            }
        });
    }
    return false;
});
</script> 

</body>
</html>
