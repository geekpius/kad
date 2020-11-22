<?php include('../middleware/verifyadmin.php'); if($user['role'] =='verifier'){ header("Location: dashboard.php"); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Houses'; include('../layouts/admin-head.php'); ?>
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
        <h4 class="page-title">Perform this activities on house module</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">View</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Delete</a></li>
        </ol>
    </div>
</div>
<!-- End Breadcrumb-->

<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
            <button type="button" data-toggle="modal" data-target="#AddHouseModal" data-backdrop="static" class="btn btn-primary btn-round waves-effect waves-light m-1"><i class="fa fa-plus-circle"></i> ADD NEW HOUSE</button>
       </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="example" class="table table-striped table-borderless">
            <thead>
                <tr>
                    <th>ID#</th>
                    <th>House Name</th>
                    <th>House Alias</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                require_once("../models/DBLayer.php");
                $houses = Model::all('houses');
                $i =0;        
                foreach($houses as $house){ 
                    $i++;
                ?>
                <tr class="records">
                    <td><?php echo $i; ?></td>
                    <td><?php echo ucwords($house['name']); ?></td>
                    <td><?php echo ucwords($house['alias']); ?></td>
                    <td>
                        <a href="javascript:void(0);" title="Delete" data-toggle="tooltip" data-id="<?php echo $house['id']; ?>" class="text-danger btn_delete"><i class="fa fa-trash"></i></a>  
                    </td>
                </tr>
            <?php    
                }        
            ?>
            </tbody>
        </table>
        </div>
        </div>
      </div>
    </div>
  </div><!-- End Row-->


<!-- Modal -->
<div class="modal fade" id="AddHouseModal">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Add New House</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formAddHouse">
                  <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group validate">
                        <label for="input-1">House Name</label>
                        <input type="text" name="house_name" class="form-control" id="input-1" placeholder="Enter House Name">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-1">House Alias</label>
                        <input type="text" name="house_alias" class="form-control" placeholder="Enter House Alias(eg: House1)">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block px-5 btn_addnew"><i class="fa fa-save"></i> Submit</button>
                </div>
            </form>
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
var table = $('#example').DataTable( {
lengthChange: false,
buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
} );

table.buttons().container()
.appendTo( '#example_wrapper .col-md-6:eq(0)' );

$("#formAddHouse").on("submit", function(e){
    e.stopPropagation();
    var valid = true;
    $('#formAddHouse input').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        $('.btn_addnew').html('<i class="fa fa-spinner fa-spin"></i> Submitting...').attr('disabled', true);
        var data = $("#formAddHouse").serialize();
        $.ajax({
            url: '../controllers/admin/save-house.php',
            type: 'POST',
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Saved",
                        text: "House saved successful",
                        type: "success",
                        confirmButtonClass: "btn-primary btn-sm",
                        confirmButtonText: "OKAY",
                        closeOnConfirm: false
                        },
                    function(){
                        window.location.reload();
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
            
                $("#formAddNew")[0].reset();
                $('.btn_addnew').html('<i class="fa fa-save"></i> Submit').attr('disabled', false);
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_addnew').html('<i class="fa fa-save"></i> Submit').attr('disabled', false);
            }
        });
    }
    return false;
});

$("#formAddHouse input").on('input', function(){
    if($(this).val()!=''){
        $(this).parents('.validate').find('span').text('');
    }else{ $(this).parents('.validate').find('span').text('The '+$(this).attr('name').replace(/[\_]+/g, ' ')+' field is required'); }
});


$('#example tbody').on('click', '.btn_delete', function(e){
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this);
    swal({
        title: "Sure to delete?",
        text: "This action is irreversible",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger btn-sm",
        cancelButtonClass: "btn-sm",
        confirmButtonText: "Yes, delete",
        closeOnConfirm: false
        },
    function(){
        $.ajax({
            url: '../controllers/admin/delete-house.php',
            type: 'POST',
            data: {id:$this.data('id')},
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Deleted",
                        text: "House saved successful",
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
