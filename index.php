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
    <title>True Voting - Voter Login Screen</title>
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon"/>
    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet"/>
    <!-- skins CSS-->
    <link href="assets/css/skins.css" rel="stylesheet"/>
  
</head>



<body>
    
    <!-- Start wrapper-->
     <div id="wrapper">
    
     <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
        <div class="card card-authentication1 mx-auto my-5">
            <div class="card-body">
             <div class="card-content p-2">
                <div class="text-center mb-3"><img src="assets/images/logo.png" width="120" height="120" alt="logo" class="img-responsive"></div>
                <div id="myErrorMessage"></div>                 
                <form id="formSignIn">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>" readonly>
                    <div class="form-group validate">
                        <label for="access_number" class="text-danger"><small>Enter Access Number To Vote</small></label>
                        <input type="text" name="access_number" class="form-control" id="access_number" oninput="GetUpperCase('access_number');" placeholder="Enter Access Number" autofocus>
                        <span class="text-danger small" role="alert"></span>
                  </div>
                  <button type="submit" class="btn btn-success btn-block waves-effect waves-light mt-2 btn_login"><i class="fa fa-lock"></i> Login to Vote </button>
                </form>
              
               </div>
              </div>
             </div>
        
         <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
        
        
        
        </div><!--wrapper-->
        
       <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
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
            $('.btn_login').html('<i class="fa fa-spinner fa-spin"></i> Loging In...').attr('disabled', true);
            var data = $("#formSignIn").serialize();
            $.ajax({
                url: 'controllers/voter/login.php',
                type: 'POST',
                data: data,
                success: function(resp){
                    if(resp=='success'){
                        window.location= "vote/ballotsheet.php";
                    }
                    else{
                        $("#myErrorMessage").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">×</button>' +
                        '<div class="alert-icon contrast-alert"><i class="fa fa-times"></i></div><div class="alert-message"><span><strong>Opps:</strong>'+resp+'</span></div></div>')
                        $("#formSignIn")[0].reset();
                        $('.btn_login').html('<i class="fa fa-sign-in"></i> Sign In').attr('disabled', false);
                    }
                },
                error: function(resp){
                    alert('Something went wrong');
                    $('.btn_login').html('<i class="fa fa-sign-in"></i> Sign In').attr('disabled', false);
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

    function GetUpperCase(field){
        var set_field = document.getElementById(field).value;
        document.getElementById(field).value=set_field.toUpperCase();
    }
</script>

      
</body>

</html>