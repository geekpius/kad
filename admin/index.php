<?php
session_start();
$_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));
 ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    
    <meta name="description" content="Electronic voting for ePower-House"/>
    <meta name="author" content="T.K.Pius(Geek) @ VibTech"/>
    <title>ePower-House - Sign In</title>
    <!--favicon-->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon"/>
    <!-- Bootstrap core CSS-->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="../assets/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <!-- Custom Style-->
    <link href="../assets/css/app-style.css" rel="stylesheet"/>
    <!-- skins CSS-->
    <link href="../assets/css/skins.css" rel="stylesheet"/>
  
</head>



<body>
    
    <!-- Start wrapper-->
     <div id="wrapper">
    
     <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
        <div class="card card-authentication1 mx-auto my-5">
            <div class="card-body">
             <div class="card-content p-2">
                <div class="card-title text-uppercase text-center py-3">Sign In</div>
                                
                <form id="formSignIn">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                   <div class="form-group validate">
                    <div class="position-relative has-icon-left">
                        <label for="username" class="sr-only">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                          <div class="form-control-position">
                             <i class="icon-user"></i>
                         </div>
                         <span class="text-danger small" role="alert"></span>
                    </div>
                   </div>
                   <div class="form-group validate">
                    <div class="position-relative has-icon-left">
                       <label for="password" class="sr-only">Password</label>
                       <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                       <div class="form-control-position">
                           <i class="icon-lock"></i>
                       </div>
                       <span class="text-danger small" role="alert"></span>
                    </div>
                   </div>
                   <div class="form-row mr-0 ml-0">
                 <button type="submit" class="btn btn-primary btn-block waves-effect waves-light btn_sign_in"><i class="fa fa-sign-in"></i> Sign In</button>
                  <div class="text-center pt-3">


                 <hr>
                 <!-- <a class="text-dark">Do not have an account? <a href="authentication-signup2.html"> Sign Up here</a></p> -->
                 </div>
                </form>
              
               </div>
              </div>
             </div>
        
         <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
        
        
        
        </div><!--wrapper-->
        
       <!-- Bootstrap core JavaScript-->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="../assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="../assets/js/app-script.js"></script>
  
<script>
$("#formSignIn").on("submit", function(e){
    e.stopPropagation();
    var valid = true;
    $('#formSignIn input').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        $('.btn_sign_in').html('<i class="fa fa-spinner fa-spin"></i> Signing In...').attr('disabled', true);
        var data = $("#formSignIn").serialize();
        $.ajax({
            url: '../controllers/admin/adminlogin.php',
            type: 'POST',
            data: data,
            success: function(resp){
                if(resp=='success'){
                    window.location= "dashboard.php";
                }
                else{
                    $("#formSignIn").find('span:first').text(resp);
                    $("#formSignIn")[0].reset();
                    $('.btn_sign_in').html('<i class="fa fa-sign-in"></i> Sign In').attr('disabled', false);
                }
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_sign_in').html('<i class="fa fa-sign-in"></i> Sign In').attr('disabled', false);
            }
        });
    }
    return false;
});

$("#formSignIn input").on('input', function(){
    if($(this).val()!=''){
        $(this).parents('.validate').find('span').text('');
    }else{ $(this).parents('.validate').find('span').text('The '+$(this).attr('name').replace(/[\_]+/g, ' ')+' field is required'); }
});
</script>

      
</body>

</html>