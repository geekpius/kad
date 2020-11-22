
  <!-- Bootstrap core JavaScript-->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
    
  <!-- simplebar js -->
  <script src="../assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="../assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="../assets/js/app-script.js"></script>
  <script src="../assets/sweetalert/sweetalert.min.js"></script>
  
<script>

$(".myDataBackup").on('click',function(){
    var conf=confirm('Do you wan to backup database?');
    if(conf){
        $.ajax({
          url: "../controllers/admin/backup.php",
          type: "GET",
          success: function(resp){
             $(".myBackupResults").html(resp);
          },
          error: function(resp){
            alert("Something went wrong");
          }
        });
        $("#BackupDataModal").modal('show');
    }else{
        return false;
    }
    return false;
});

  </script>

