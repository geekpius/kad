<?php include('../middleware/verifyadmin.php');  if($user['role'] =='verifier'){ header("Location: dashboard.php"); } if(isset($_SESSION['image'])){ $image = $_SESSION['image']; unlink("../assets/images/candidates/".$image); unset($_SESSION['image']); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Candidates'; include('../layouts/admin-head.php'); ?>
<!-- notifications css -->
<link rel="stylesheet" href="../assets/plugins/notifications/css/lobibox.min.css"/> 
</head>

<body>

<?php include('../layouts/admin-menus.php'); ?>

<!--start body-->
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Perform this activities on candidate module</h4>
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
            <button type="button" data-toggle="modal" data-target="#AddNewCandidate" data-backdrop="static" class="btn btn-primary btn-round waves-effect waves-light m-1"><i class="fa fa-plus-circle"></i> ADD NEW CANDIDATE</button>
       </div>
        <div class="card-body">
            <div class="row">
            <?php 
                require_once("../models/DBLayer.php");
                $candidates = Model::all('candidates'); 
            if(count($candidates)>0){
            foreach($candidates as $can){ ?>
                <div class="col-12 col-sm-4">
                  <div class="card gradient-primary rounded-0">
                     <div class="card-body text-center">
                       <h5 class="text-uppercase text-white"><?php echo $can['name'];?></h5>
                       <a href="javascripts:void(0);" data-toggle="popover" data-trigger="focus" data-placement="left" data-html=true data-title='<img src="../assets/images/candidates/<?php echo $can['image'];?>" alt="<?php echo $can['name'];?>" class="img-responsive img-thumbnail" height="250" width="250">'>
                            <img src="../assets/images/candidates/<?php echo $can['image'];?>" alt="<?php echo $can['name'];?>" class="img-responsive img-thumbnail" height="160" width="160" title="Toggle photo to enlarge" data-toggle="tooltip" data-placement="right">  
                        </a>
                        <div>
                            <span class="my-5 text-white">Position: <?php echo $can['position'];?> </span><br>
                            <span class="my-5 text-white">Gender: <?php echo ucfirst($can['gender']);?> </span><br>
                            <?php if($user['role']=='administrator'){ ?>
                            <span class="my-5 text-white">Your Votes: <a href="javascript:void(0);" class="text-success btn_list" data-name="<?php echo $can['name'];?>"><?php echo $can['vote'];?></a></span>
                            <?php } ?>
                        </div>
                        <a href="javascript:void(0);" title="Edit" data-toggle="tooltip" class="btn_edit" data-id="<?php echo $can['id'];?>" data-name="<?php echo $can['name'];?>" data-position="<?php echo $can['position'];?>" data-gender="<?php echo $can['gender'];?>"><i class="fa fa-edit text-white"></i></a>&nbsp;&nbsp;
                        <a href="javascript:void(0);" title="Delete" data-toggle="tooltip" data-id="<?php echo $can['id'];?>" class="btn_delete"><i class="fa fa-trash text-white"></i></a>
                     </div>
                   </div>
                </div>
            <?php  }
            }else{ ?>
                <div class="col-12 col-sm-12">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <div class="alert-icon contrast-alert">
                            <i class="fa fa-times"></i>
                        </div>
                        <div class="alert-message">
                            <span><strong>Opps:</strong> No candidate available </span>
                        </div>
                    </div>  
                </div>
            <?php  
            }
            ?>
            </div>
        </div>
      </div>
    </div>
</div><!-- End Row-->


<!-- Modal -->
<div class="modal fade" id="AddNewCandidate">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Add New Candidate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formAddNew">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group validate">
                        <label>Full Name*</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" oninput="GetUpperCase('fullname');" placeholder="Enter Full Name">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">Position*</label>
                        <select name="position" class="form-control" id="position">
                            <option value="">-Select-</option>
                            <?php $positions = Model::all('positions'); 
                            foreach($positions as $pos){ ?>
                                <option value="<?php echo $pos['name']; ?>"><?php echo $pos['name']; ?></option> 
                            <?php } ?>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">Gender*</label>
                        <select name="gender" class="form-control" id="gender">
                            <option value="">-Select-</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">House</label>
                        <select name="house" class="form-control" id="house">
                            <option value="">-Select-</option>
                            <?php $houses = Model::all('houses');  
                            foreach($houses as $h){ ?>
                                <option value="<?php echo $h['alias']; ?>"><?php echo $h['name']; ?></option> 
                            <?php } ?>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>         
                    <div class="form-group validate" align="center">
                        <div class="user-profile-img" onclick="getFile()" style="cursor:pointer; width:200px; height:200px">
                            <img src="../assets/images/110x110.png" alt="Candidate" class="img_preview img-upload-photo" height="200" width="200" />
                            <div style='height: 0px;width:0px; overflow:hidden;'><input id="upfile" type="file" name="photo" /></div>
                            <small><strong><i class="text-danger upload_msg">Click to upload photo</i></strong></small>
                        </div>
                    </div> <br> 
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block px-5 btn_addnew"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditCandidateModal">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Edit Candidate</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="formEditCandidate">
                    <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <input type="hidden" name="can_id" id="can_id" readonly> 
                    <div class="form-group validate">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname1" oninput="GetUpperCase('fullname1');" placeholder="Enter Full Name">
                        <span class="text-danger small" role="alert"></span>
                    </div>
                    <div class="form-group validate">
                        <label for="input-3">Position</label>
                        <select name="position" class="form-control" id="position1">
                        <?php  $positions = Model::all('positions'); 
                            foreach($positions as $pos){ ?>
                                <option value="<?php echo $pos['name']; ?>"><?php echo $pos['name']; ?></option> 
                            <?php } ?>
                        </select>
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block px-5 btn_edit_candidate"><i class="fa fa-refresh"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ListModal">
    <div class="modal-dialog">
        <div class="modal-content animated zoomInUp">
            <div class="modal-header">
            <h5 class="modal-title">Candidate Voter List</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body modal_content" id="printDiv">
                
            </div>
            <a href="javascript:void(0);" id="btn_print" class="mb-2 ml-2"><i class="fa fa-print"></i> Print</a>
        </div>
    </div>

<!--end body-->

<?php include('../layouts/admin-footer.php'); ?>
<?php include('../layouts/admin-scripts.php'); ?>
<!--notification js -->
<script src="../assets/plugins/notifications/js/lobibox.min.js"></script>
<script src="../assets/plugins/notifications/js/notifications.min.js"></script>
<script src="../assets/js/jQuery.print.min.js"></script>
<script>
function GetUpperCase(field){
    var set_field = document.getElementById(field).value;
    document.getElementById(field).value=set_field.toUpperCase();
}

function getFile(){
    document.getElementById("upfile").click();
}


$("#formAddNew").on("submit", function(e){
    e.stopPropagation();
    var valid = true;
    $('#formAddNew input, #formAddNew select').each(function() {
        var $this = $(this);
        
        if(!$this.val() && $this.attr("name") != "house") {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        $('.btn_addnew').html('<i class="fa fa-spinner fa-spin"></i> Submitting...').attr('disabled', true);
        var data = $("#formAddNew").serialize();
        $.ajax({
            url: "../controllers/admin/save-candidate.php",
            type: "POST",
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Saved",
                        text: "Candidate saved successful",
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


$("#upfile").on("change", function(){
    $(".upload_msg").html('<i class="fa fa-spin fa-spinner"></i> Uploading...');
    var form_data = new FormData();
    var size = document.getElementById('upfile').files[0].size;
    var selectedFile = document.getElementById('upfile').files[0].name;
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
        document.getElementById("upfile").value = null;
        $(".upload_msg").text('Click to upload photo');
    }
    else if(ext!='jpg' && ext!='jpeg' && ext!='png'){
        Lobibox.notify('warning', {
            size: 'mini',
            position: "top right",
            showClass: 'rollIn',
            hideClass: 'rollOut',
            icon: true,
            msg: 'File type is unknown.'
        });
        document.getElementById("upfile").value = null;
        $(".upload_msg").text('Click to upload photo');
    }
    else{
        form_data.append("photo", document.getElementById('upfile').files[0]);
        $.ajax({
            url: "../controllers/admin/upload-candidate-photo.php", 
            type: 'POST',
            data: form_data,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response=='error'){
                    swal("Opps", "Something went wrong.", "warning");
                }
                else{
                    $(".img_preview").attr("src", "../assets/images/candidates/"+response); 
                }
                $(".upload_msg").text('Click to upload photo');
            },
            error: function(response){
                alert('Something went wrong.');
                document.getElementById("upfile").value = null;
                $(".upload_msg").text('Click to upload photo');
            }
            
        });
    }
    
    return false;
});

//edit
$(".btn_edit").on("click", function(e){
    e.stopPropagation();
    var $this = $(this);
    $("#formEditCandidate #can_id").val($this.data('id'));
    $("#formEditCandidate  input[name='fullname']").val($this.data('name'));
    $("#formEditCandidate  #position1").val($this.data('position'));
    $("#formEditCandidate  #gender1").val($this.data('gender'));
    $("#EditCandidateModal").modal({backdrop: 'static'});
    return false;
});

$("#formEditCandidate").on("submit", function(e){
    e.stopPropagation();
    var valid = true;
    $('#formEditCandidate input, #formEditCandidate select').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });
    if(valid) {
        $('.btn_edit_candidate').html('<i class="fa fa-spinner fa-spin"></i> Updating...').attr('disabled', true);
        var data = $("#formEditCandidate").serialize();
        $.ajax({
            url: "../controllers/admin/edit-candidate.php",
            type: "POST",
            data: data,
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Saved",
                        text: "Candidate updated successful",
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
                $('.btn_edit_candidate').html('<i class="fa fa-save"></i> Update').attr('disabled', false);
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_edit_candidate').html('<i class="fa fa-save"></i> Update').attr('disabled', false);
            }
            
        });
    }
    return false;
});


$('.btn_delete').on('click', function(e){
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this);
    var $href = $this.data('href');
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
            url: '../controllers/admin/delete-candidate.php',
            type: 'POST',
            data: {id:$this.data('id')},
            success: function(resp){
                if(resp=='success'){
                    swal({
                        title: "Deleted",
                        text: "Candidate deleted successful",
                        type: "success",
                        confirmButtonClass: "btn-primary btn-sm",
                        confirmButtonText: "OKAY",
                        closeOnConfirm: true
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
            },
            error: function(resp){
                alert('Something went wrong');
            }
        });
    });
    return false;
});



$('.btn_list').on('click', function(e){
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this);
    getList($this.data('name'));
    $("#ListModal").modal({backdrop: 'static'});
    return false;
});

function getList(name){
    $.ajax({
        url: "../controllers/admin/candidate-voters-list.php",
        type: "POST",
        data: {name:name},
        success: function(resp){
            $(".modal_content").html(resp);
        },
        error: function(resp){
            alert('Something went wrong.');
        }
    });
}


$("#btn_print").on('click', function(e){
    e.preventDefault();
    e.stopPropagation();
    $("#printDiv").print();
    return false;
});

</script> 

</body>
</html>
