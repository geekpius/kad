<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Not Verified Voters'; include('../layouts/admin-head.php'); ?>
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
            <h5>Not Verified Voters</h5>
       </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="example" class="table table-striped table-borderless">
            <thead>
                <tr>
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
                $voters= Model::filter("SELECT * FROM voters WHERE verify=:v", array(':v'=>false));
                foreach($voters as $voter){ ?>
                <tr class="records">
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

</script> 

</body>
</html>
