<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Voters'; include('../layouts/admin-head.php'); ?>
<!-- notifications css -->
<link rel="stylesheet" href="../assets/plugins/notifications/css/lobibox.min.css"/> 
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
        <h4 class="page-title">Perform this activities on voter module</h4>
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
            <button type="button" data-toggle="modal" data-target="#AddNewVoter" data-backdrop="static" class="btn btn-primary btn-round waves-effect waves-light m-1"><i class="fa fa-plus-circle"></i> ADD NEW VOTER</button>
            <button type="button" data-toggle="modal" data-target="#ImportVoters" data-backdrop="static" class="btn btn-primary btn-round waves-effect waves-light m-1"><i class="fa fa-upload"></i> UPLOAD VOTERS LIST</button>
       </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="example" class="table table-striped table-borderless">
            <thead>
                <tr>
                    <th>Access No</th>
                    <th>Fullname</th>
                    <th>Gender</th>
                    <th>Form</th>
                    <th>House</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once("../models/DBLayer.php");
                $voters= Model::all('voters');
                foreach($voters as $voter){ ?>
                <tr class="records">
                    <td><?php echo $voter['access_number']; ?></td>
                    <td><?php echo ucwords($voter['name']); ?></td>
                    <td><?php echo ucwords($voter['gender']); ?></td>
                    <td><?php echo strtoupper($voter['cls']); ?></td>
                    <td><?php echo ucwords($voter['house']); ?></td>
                    <td>
                        <a href="javascript:void(0);" title="Edit" data-toggle="tooltip" class="text-primary btn_edit" data-id="<?php echo $voter['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" title="Delete" data-toggle="tooltip" data-id="<?php echo $voter['id']; ?>" class="text-danger btn_delete"><i class="fa fa-trash"></i></a>
                    </td>
                </tr> 
            <?php } ?>
            </tbody>
        </table>
        </div>
        </div>
      </div>
    </div>
  </div><!-- End Row-->


<!-- Modal -->
<div class="modal fade" id="AddNewVoter">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Add New Voter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formAddNew">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group validate">
                        <label for="input-1">Access Number</label>
                        <input type="text" name="access_number" class="form-control" placeholder="Enter Access Number">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-1">Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" oninput="GetUpperCase('fullname');" placeholder="Enter Full Name">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">Gender</label>
                        <select name="gender" class="form-control" id="gender">
                            <option value="">-Select-</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">Form</label>
                        <input type="text" name="form" class="form-control" placeholder="Enter Class/Form">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">House</label>
                        <select name="house" class="form-control" id="house">
                            <option value="">-Select-</option>
                            <?php 
                                $houses = Model::all('houses');
                                foreach($houses as $house){ ?>
                                    <option value="<?php echo $house['alias']; ?>"><?php echo $house['name']; ?></option>
                            <?php } ?>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success px-5 btn-block btn_addnew"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditVoter">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Edit Voter</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formEditVoter">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <input type="hidden" name="voter_id" id="voter_id" readonly>
                    <div class="form-group validate">
                        <label for="input-1">Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname1" oninput="GetUpperCase('fullname1');" placeholder="Enter Full Name">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">Gender</label>
                        <select name="gender" class="form-control" id="gender1">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">Form</label>
                        <input type="text" name="form" class="form-control" placeholder="Enter Class/Form">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">House</label>
                        <select name="house" class="form-control" id="house1">
                        <?php 
                            $houses = Model::all('houses');
                            foreach($houses as $house){ ?>
                                <option value="<?php echo $house['alias']; ?>"><?php echo $house['name']; ?></option>
                        <?php } ?>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary px-5 btn-block btn_edit_voter"><i class="fa fa-refresh"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ImportVoters">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Import Voters</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formImport" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group validate">
                        <label for="input-1">Browse for csv</label>
                        <input type="file" name="file" id="voters_file" class="form-control">
                        <span class="text-danger small" role="alert"></span>
                    </div> 
                    <div class="form-group">
                        <button type="submit" class="btn btn-success px-5 btn-block btn_import"><i class="fa fa-upload"></i> Import</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <small class="text-danger">Note: <i>Excel format should be arranged as the voters table</i></small>
            </div>
        </div>
    </div>
</div>

<!--end body-->

<?php include('../layouts/admin-footer.php'); ?>
<?php include('../layouts/admin-scripts.php'); ?>
<!--notification js -->
<script src="../assets/plugins/notifications/js/lobibox.min.js"></script>
<script src="../assets/plugins/notifications/js/notifications.min.js"></script>
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


$("#formAddNew").on("submit", function(e){
    e.preventDefault();
    e.stopPropagation();
    var valid = true;
    $('#formAddNew :text, #formAddNew select').each(function() {
        var $this = $(this);
        
        if(!$this.val() && $this.attr('name') != 'form' && $this.attr('name') != 'house') {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        $('.btn_addnew').html('<i class="fa fa-spinner fa-spin"></i> Submitting...').attr('disabled', true);
        var data = $("#formAddNew").serialize();
        $.ajax({
            url: "../controllers/admin/save-voter.php",
            type: "POST",
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Saved",
                        text: "Voter saved successful",
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


$("#formAddNew :text").on('input', function(){
    if($(this).val()!=''){
        $(this).parents('.validate').find('span').text('');
    }else{ $(this).parents('.validate').find('span').text('The '+$(this).attr('name').replace(/[\_]+/g, ' ')+' field is required'); }
});

$("#formAddNew select").on('change', function(){
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
    $("#formEditVoter #voter_id").val($this.data('id'));
    $("#formEditVoter  input[name='fullname']").val($this.parents('.records').find('td').eq(1).text());
    $("#formEditVoter #gender1").val($this.parents('.records').find('td').eq(2).text());
    $("#formEditVoter input[name='form']").val($this.parents('.records').find('td').eq(3).text());
    $("#formEditVoter  #house1").val($this.parents('.records').find('td').eq(4).text());
    $("#EditVoter").modal({backdrop: 'static'});
    return false;
});

$("#formEditVoter").on("submit", function(e){
    e.preventDefault();
    e.stopPropagation();
    var valid = true;
    $('#formEditVoter input, #formEditVoter select').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        $('.btn_edit_voter').html('<i class="fa fa-spinner fa-spin"></i> Updating...').attr('disabled', true);
        var data = $("#formEditVoter").serialize();
        $.ajax({
            url: "../controllers/admin/edit-voter.php",
            type: "POST",
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Updated",
                        text: "Voter updated successful",
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
            
                $('.btn_edit_voter').html('<i class="fa fa-refresh"></i> Update').attr('disabled', false);
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_edit_voter').html('<i class="fa fa-refresh"></i> Update').attr('disabled', false);
            }
            
        });
    }
    return false;
});

//delete
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
            url: '../controllers/admin/delete-voter.php',
            type: 'POST',
            data: {id:$this.data('id')},
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Deleted",
                        text: "Voter deleted successful",
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

//import
$("#formImport").on("submit", function(e){
    e.preventDefault();
    e.stopPropagation();
    var valid = true;
    $('#formImport input').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        var form_data = new FormData();
        var size = document.getElementById('voters_file').files[0].size;
        var selectedFile = document.getElementById('voters_file').files[0].name;
        var ext = selectedFile.replace(/^.*\./, '');
        ext= ext.toLowerCase();
        if(size>1000141){
        Lobibox.notify('warning', {
            size: 'mini',
            position: "top right",
            showClass: 'rollIn',
            hideClass: 'rollOut',
            icon: true,
            msg: 'File is more than 1mb.'
        });
        document.getElementById("voters_file").value = null;
        }
        else if(ext!='csv'){
            Lobibox.notify('warning', {
                size: 'mini',
                position: "top right",
                showClass: 'rollIn',
                hideClass: 'rollOut',
                icon: true,
                msg: 'File type is unknown.'
            });
            document.getElementById("voters_file").value = null;
        }
        else{
            form_data.append("file", document.getElementById('voters_file').files[0]);
            $.ajax({
                url: "../controllers/admin/import-voters.php", 
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response=='success'){
                        swal({
                            title: "Imported",
                            text: "Voters list imported successful",
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
                        swal("Opps", response, "warning");
                    }
                    $("#formImport")[0].reset();
                },
                error: function(response){
                    alert('Something went wrong.');
                    document.getElementById("voters_file").value = null;
                }
                
            });
        }
    }
    return false;
});

</script> 

</body>
</html>
