<?php include('../middleware/verifyadmin.php'); if($user['role'] =='verifier'){ header("Location: dashboard.php"); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Positions'; include('../layouts/admin-head.php'); ?>
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
        <h4 class="page-title">Perform this activities on position module</h4>
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
            <button type="button" data-toggle="modal" data-target="#AddPositionModal" data-backdrop="static" class="btn btn-primary btn-round waves-effect waves-light m-1"><i class="fa fa-plus-circle"></i> ADD NEW POSITION</button>
       </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="example" class="table table-striped table-borderless">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Max Contestant</th>
                    <th>Criteria</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                require_once("../models/DBLayer.php");
                $positions = Model::all('positions');
                foreach($positions as $pos){ ?>
                    <tr class="records">
                        <td><?php echo ucwords($pos['name']); ?></td>
                        <td><?php echo $pos['maxcon']; ?></td>
                        <td><?php echo ucwords($pos['criteria']); ?></td>
                        <td><?php echo ucwords($pos['type']); ?></td>
                        <td>
                            <a href="javascript:void(0);" title="Edit" data-toggle="tooltip" class="text-primary btn_edit" data-id="<?php echo $pos['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                            <a href="javascript:void(0);" title="Delete" data-toggle="tooltip" data-id="<?php echo $pos['id']; ?>" class="text-danger btn_delete"><i class="fa fa-trash"></i></a>  
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
<div class="modal fade" id="AddPositionModal">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Add New Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formAddPosition">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group validate">
                        <label for="input-3">Criteria</label>
                        <select name="criteria" class="form-control" id="criteria">
                            <option value="">-Select-</option>
                            <option value="General">General</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">Type</label>
                        <select name="type" class="form-control" id="type">
                            <option value="">-Select-</option>
                            <option value="All">All</option>
                            <option value="">-------------------</option>
                            <?php $houses = Model::all('houses'); 
                            foreach($houses as $house){ ?>
                                <option value="<?php echo ucwords($house['alias']); ?>"><?php echo ucwords($house['name']); ?></option>
                            <?php } ?>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="">Position Name</label>
                        <input type="text" name="position_name" id="position_name" oninput="GetUpperCase('position_name');" onkeypress="return preventSpcialChar(event);" class="form-control" placeholder="Enter Position Name">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="">Number of Contestant</label>
                        <input type="text" name="max_contestant" onkeypress="return isNumber(event)" maxlength="2" class="form-control" placeholder="Enter Maximum Contestant">
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

<div class="modal fade" id="EditPositionModal">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Edit Position</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formEditPosition">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <input type="hidden" id="pos_id" name="pos_id" readonly>
                    <div class="form-group validate">
                        <label for="input-1">Position Name</label>
                        <input type="text" name="position_name" id="position_name1" oninput="GetUpperCase('position_name1');" onkeypress="return preventSpcialChar(event);" class="form-control" placeholder="Enter Position Name">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-1">Number of Contestant</label>
                        <input type="text" name="max_contestant" onkeypress="return isNumber(event)" maxlength="2" class="form-control" placeholder="Enter Maximum Contestant">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block px-5 btn_edit_position"><i class="fa fa-refresh"></i> Update</button>
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

function GetUpperCase(field){
    var set_field = document.getElementById(field).value;
    document.getElementById(field).value=set_field.toUpperCase();
}

$("#formAddPosition").on("submit", function(e){
    e.stopPropagation();
    var valid = true;
    $('#formAddPosition input, #formAddPosition select').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        $('.btn_addnew').html('<i class="fa fa-spinner fa-spin"></i> Submitting...').attr('disabled', true);
        var data = $("#formAddPosition").serialize();
        $.ajax({
            url: "../controllers/admin/save-position.php",
            type: "POST",
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Saved",
                        text: "Position saved successful",
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
            
                $("#formAddPosition")[0].reset();
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


$("#formAddPosition input").on('input', function(){
    if($(this).val()!=''){
        $(this).parents('.validate').find('span').text('');
    }else{ $(this).parents('.validate').find('span').text('The '+$(this).attr('name').replace(/[\_]+/g, ' ')+' field is required'); }
});

$("#formAddPosition select").on('change', function(){
    if($(this).val()!=''){
        $(this).parents('.validate').find('span').text('');
    }else{ 
        $(this).parents('.validate').find('span').text('The '+$(this).attr('name').replace(/[\_]+/g, ' ')+' field is required');
    }
});


//edit
$('#example tbody').on('click', '.btn_edit', function(e){
    e.stopPropagation();
    var $this = $(this);
    $("#formEditPosition #pos_id").val($this.data('id'));
    $("#formEditPosition  input[name='position_name']").val($this.parents('.records').find('td').eq(0).text());
    $("#formEditPosition  input[name='max_contestant']").val($this.parents('.records').find('td').eq(1).text());
    $("#EditPositionModal").modal({backdrop: 'static'});
    return false;
});


$("#formEditPosition").on("submit", function(e){
    e.stopPropagation();
    var valid = true;
    $('#formEditPosition input').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        $('.btn_edit_position').html('<i class="fa fa-spinner fa-spin"></i> Updating...').attr('disabled', true);
        var data = $("#formEditPosition").serialize();
        $.ajax({
            url: "../controllers/admin/edit-position.php",
            type: "POST",
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Saved",
                        text: "Position updated successful",
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
            
                $("#formEditPosition")[0].reset();
                $('.btn_edit_position').html('<i class="fa fa-save"></i> Submit').attr('disabled', false);
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_edit_position').html('<i class="fa fa-save"></i> Submit').attr('disabled', false);
            }
            
        });
    }
    return false;
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
            url: '../controllers/admin/delete-position.php',
            type: 'POST',
            data: {id:$this.data('id')},
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Deleted",
                        text: "Position deleted successful",
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


// allower only numbers
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
  }

  // dont allow . / - _
  function preventSpcialChar(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46 || charCode == 45 || charCode == 47 || charCode==95) {
        return false;
    }
    return true;
  }
</script> 

</body>
</html>
