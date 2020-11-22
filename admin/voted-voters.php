<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Voted Voters'; include('../layouts/admin-head.php'); ?>
<!--Data Tables -->
<link href="../assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="../assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"> 
</head>

<body>

<?php include('../layouts/admin-menus.php'); ?>

<!--start body-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Perform this activities on register module</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">View</a></li>
        </ol>
    </div>
</div>
<!-- End Breadcrumb-->
 
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
            <h5>Voted Voters</h5>
       </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="example" class="table table-striped table-borderless">
            <thead>
                <tr>
                    <th>Reset</th>
                    <th>Access No#</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Form</th>
                    <th>House</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once("../models/DBLayer.php");
                $voters= Model::filter("SELECT * FROM voters WHERE status=:v", array(':v'=>true));
                foreach($voters as $voter){ ?>
                <tr class="records">
                    <td>
                        <a href="javascript:void();" data-id="<?php echo $voter['id']; ?>" data-number="<?php echo $voter['access_number']; ?>" title="Reset Inconvience" data-toggle="tooltip" class="text-success btn_reset"><i class="fa fa-times-circle-o fa-lg"></i></a>
                    </td>
                    <td><?php echo $voter['access_number']; ?></td>
                    <td><?php echo ucwords($voter['name']); ?></td>
                    <td><?php echo ucwords($voter['gender']); ?></td>
                    <td><?php echo strtoupper($voter['cls']); ?></td>
                    <td><?php echo ucwords($voter['house']); ?></td>
                </tr> 
            <?php } ?>
            </tbody>
        </table>
        </div>
        </div>
      </div>
    </div>
  </div><!-- End Row-->


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
var table = $('#example').DataTable( {
lengthChange: false,
buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
} );

table.buttons().container()
.appendTo( '#example_wrapper .col-md-6:eq(0)' );


//delete
$('#example tbody').on('click', '.btn_reset', function(e){
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this);
    swal({
        title: "Sure to reset?",
        text: "Reset access number "+$this.data('number')+" to vote",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success btn-sm",
        cancelButtonClass: "btn-sm",
        confirmButtonText: "Yes, reset",
        closeOnConfirm: false
        },
    function(){
        $.ajax({
            url: '../controllers/admin/reset-voter.php',
            type: 'POST',
            data: {id:$this.data('id')},
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Reset",
                        text: "Access number reset successful",
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
