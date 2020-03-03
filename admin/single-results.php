<?php include('../middleware/verifyadmin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $title = 'Single Position Results'; include('../layouts/admin-head.php'); ?>
<style>
@media print { 
    .yesprint{ display: block !important; }
}
</style>
</head>

<body>

<?php include('../layouts/admin-menus.php'); ?>

<!--start body-->
<!-- Breadcrumb-->
<div class="row pt-2 pb-2">
    <div class="col-sm-9">
        <h4 class="page-title">Perform this activities on position result module</h4>
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
            <form id="formFilter" class="form-inline">
                <div class="form-group validate">
                    <select name="position" class="form-control" id="position">
                        <option value="">-Select-</option>
                        <?php require_once("../models/DBLayer.php");
                            $positions= Model::all('positions'); 
                            foreach($positions as $pos){ ?>
                                <option value="<?php echo $pos['name']; ?>"><?php echo $pos['name']; ?></option>
                        <?php } ?>
                    </select>
                    <span class="text-danger small" role="alert"></span>
                </div>
            </form>
        <div class="card-body"><hr>
            <div class="row">
                <div class="col-sm-12"><a href="javascript:void(0);" class="mb-2 ml-5 btn_print"><i class="fa fa-print"></i> Print</a></div>
                <div class="col-sm-1"></div>
                <div class="col-sm-10 get_result_div" id="printOut"></div>
            </div>
        </div>
      </div>
    </div>
</div><!-- End Row-->


<!--end body-->

<?php include('../layouts/admin-footer.php'); ?>
<?php include('../layouts/admin-scripts.php'); ?>
<script src="../assets/js/jQuery.print.min.js"></script>
<script>
$("#formFilter select").on('change', function(){
    if($(this).val()!=''){
        $(this).parents('.validate').find('span').text('');
        var data = $(this).serialize();
        $.ajax({
            url: "../controllers/admin/get-single-result.php",
            type: "POST",
            data: data,
            success: function(resp){
                $(".get_result_div").hide().fadeIn('fast').html(resp);
                $('.btn_filter').html('<i class="fa fa-search"></i> Filter').attr('disabled', false);
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_filter').html('<i class="fa fa-search"></i> Filter').attr('disabled', false);
            }
        });
    }else{ 
        $(this).parents('.validate').find('span').text('The '+$(this).attr('name').replace(/[\_]+/g, ' ')+' field is required');
    }
});

$(".btn_print").on('click', function(e){
    e.preventDefault();
    e.stopPropagation();
    $("#printOut").print();
    return false;
});
</script>  

</body>
</html>
