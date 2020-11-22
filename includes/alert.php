<?php
if(isset($_SESSION['success'])){ ?>
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="alert-icon contrast-alert">
        <i class="fa fa-check"></i>
    </div>
    <div class="alert-message">
        <span><strong>Success!</strong> <?php echo $_SESSION['success']; ?></span>
    </div>
</div>
<?php } elseif(isset($_SESSION['error'])){ ?>
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div class="alert-icon contrast-alert">
        <i class="fa fa-times"></i>
    </div>
    <div class="alert-message">
        <span><strong>Opps:</strong>  <?php echo $_SESSION['error']; ?></span>
    </div>
</div>  
<?php } ?>
