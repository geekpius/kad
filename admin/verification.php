<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Voter Verification'; include('../layouts/admin-head.php'); ?>
<!--Data Tables -->
<link href="../assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="../assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"> 
</head>

<body>

<?php include('../layouts/admin-menus.php'); ?>

<!--start body-->
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Perform this activities on voter verification module</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">View</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Add New</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Edit</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Delete</a></li>
        </ol>
    </div>
</div>
<!-- End Breadcrumb-->
 
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
        <span id="demo"></span>
       </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="example" class="table table-striped table-borderless">
            <thead>
                <tr>
                    <th>Verify</th>
                    <th>Access No</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Form</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once("../models/DBLayer.php");
                $voters= Model::filter("SELECT * FROM voters WHERE verify=:v ORDER BY id", array(':v'=>false));
                $gs = Model::first("SELECT * FROM general_settings WHERE id=:id", array(':id'=>1));
                foreach($voters as $voter){ ?>
                <tr class="records">
                    <td>
                        <a href="javascript:void();" data-id="<?php echo $voter['id']; ?>" data-number="<?php echo $voter['access_number']; ?>" title="Verify" data-toggle="tooltip" class="text-primary btn_verify"><i class="fa fa-check-circle-o fa-lg"></i></a>
                    </td>
                    <td><?php echo $voter['access_number']; ?></td>
                    <td><?php echo ucwords($voter['name']); ?></td>
                    <td><?php echo ucwords($voter['gender']); ?></td>
                    <td><?php echo strtoupper($voter['cls']); ?></td>
                </tr> 
            <?php } ?>
            </tbody>
        </table>
        </div>
        </div>
      </div>
    </div>
  </div><!-- End Row-->

  <div class="modal fade" id="ExpireModal">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-body">
                <h4 class="mt-5 text-center text-danger">VOTING TIME EXPIRED</h4>
                <h4 class="mt-5 text-center text-danger">End Of Voting</h4>
            </div>
        </div>
    </div>
</div>

<!--end body-->

<?php include('../layouts/admin-footer.php'); ?>
<?php include('../layouts/admin-scripts.php'); ?>
<!--Data Tables js-->
<script src="../assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
<script src="../assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
<script>
var table = $('#example').DataTable( );


function timer(){
    // Set the date we're counting down to
    var countDownDate = new Date("<?php  echo $gs['timer']; ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
   /*  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s "; */

    document.getElementById("demo").innerHTML = '<h4 style="font-size: 30px"></span> <span class="badge badge-success">'+hours+'h </span> '+
    '<span class="badge badge-success">'+minutes+'m </span> <span class="badge badge-success">'+seconds+'s </span></h4>';

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        var getexp = document.getElementById("demo").innerHTML = '<h4><span class="badge badge-danger">VOTING TIME EXPIRED</span></h4>';
        if(getexp){
            $("#ExpireModal").modal({backdrop: 'static'}); 
        }
    }
    }, 1000);
}

timer();


//verify
$('#example tbody').on('click', '.btn_verify', function(e){
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this);
    swal({
        title: "Sure to verify?",
        text: "You are about to verify access number "+$this.data('number'),
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success btn-sm",
        cancelButtonClass: "btn-sm",
        confirmButtonText: "Yes, verify",
        closeOnConfirm: false
        },
    function(){
        $.ajax({
            url: '../controllers/admin/verify-voter.php',
            type: 'POST',
            data: {id:$this.data('id')},
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Verified",
                        text: "Access number verified successful",
                        type: "success",
                        confirmButtonClass: "btn-primary btn-sm",
                        confirmButtonText: "OKAY",
                        closeOnConfirm: true
                    },
                    function(){
                        $this.parents('.records').fadeOut('slow', function(){
                            $this.parents('.records').remove();
                        });
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
            },
            error: function(resp){
                alert('Something went wrong');
            }
        });
    });
    return false;
});
</script> 

</body>
</html>
