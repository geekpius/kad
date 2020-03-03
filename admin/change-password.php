<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Change Password'; include('../layouts/admin-head.php'); ?>
</head>

<body>

<?php include('../layouts/admin-menus.php'); ?>

<!--start body-->
<?php require_once('../controllers/admin/dashboard.php'); ?>

<div class="row pt-2 pb-2">
  <div class="col-sm-9">
      <h4 class="page-title">Perform change password on account module</h4>
  </div>
</div>
<!-- End Breadcrumb-->


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
          Change Password   
     </div>
      <div class="card-body">
      <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
              <form id="formChangePassword">
                  <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                  <div class="form-group validate">
                      <label for="input-1">Current Password</label>
                      <input type="password" name="current_password" class="form-control" id="input-1" placeholder="Enter Current Password">
                      <span class="text-danger small" role="alert"></span>
                  </div> 
                  <div class="form-group validate">
                      <label for="input-1">New Password</label>
                      <input type="password" name="password" class="form-control" id="input-1" placeholder="Enter New Password">
                      <span class="text-danger small" role="alert"></span>
                  </div>
                  <div class="form-group validate">
                      <label for="input-1">Confirm New Password</label>
                      <input type="password" name="password_confirmation" class="form-control" id="input-1" placeholder="Confirm New Password">
                      <span class="text-danger small" role="alert"></span>
                  </div> 
                  <div class="form-group">
                      <button type="submit" class="btn btn-block btn-primary px-5 btn_change_password"><i class="fa fa-refresh"></i> Change Password</button>
                  </div>
              </form>
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
$("#formChangePassword").on("submit", function(e){
      e.preventDefault();
      e.stopPropagation();
      var valid = true;
      $('#formChangePassword :password').each(function() {
          var $this = $(this);
          
          if(!$this.val()) {
              valid = false;
              $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
          }
      });
      if(valid) {
          $('.btn_change_password').html('<i class="fa fa-spinner fa-spin"></i> Changing Password...').attr('disabled', true);
          var data = $("#formChangePassword").serialize();
            $.ajax({
                url: '../controllers/admin/change-password.php',
                type: 'POST',
                data: data,
                success: function(resp){
                    if(resp=='success'){
                        swal({
                            title: "Changed",
                            text: "Password is changed",
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
                
                    $("#formChangePassword")[0].reset();
                    $('.btn_change_password').html('<i class="fa fa-refresh"></i> Change Password').attr('disabled', false);
                },
                error: function(resp){
                    alert('Something went wrong');
                    $('.btn_change_password').html('<i class="fa fa-refresh"></i> Change Password').attr('disabled', false);
                }
            });
      }
      return false;
  });

  $("#formChangePassword input").on('input', function(){
      if($(this).val()!=''){
          $(this).parents('.validate').find('span').text('');
      }else{ $(this).parents('.validate').find('span').text('The '+$(this).attr('name').replace(/[\_]+/g, ' ')+' field is required'); }
  });
</script>


</body>
</html>
