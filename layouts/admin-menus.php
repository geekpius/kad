
<!-- Start wrapper-->
 <div id="wrapper">
 
  <!--Start sidebar-wrapper-->
  <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
      <a href="dashboard.php">
      <img src="../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        <h5 class="logo-text text-transform-default">True Voting</h5>
      </a>
    </div>
  <div class="user-details">
   <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
   <div class="avatar"><img class="mr-3 side-user-img" src="../assets/images/110x110.png" alt="user avatar"></div>
      <div class="media-body">
      <h6 class="side-user-name"><?php echo ucwords($user['name']); ?> </h6>
     </div>
      </div>
    <div id="user-dropdown" class="collapse">
     <ul class="user-setting-menu">
           <li><a href="change-password.php"><i class="icon-lock"></i>  Change Password</a></li>
            <li><a href="logout.php"><i class="icon-power"></i> Logout</a></li>
        </form>
     </ul>
    </div>
     </div>
  <ul class="sidebar-menu">
     <li class="sidebar-header">MAIN NAVIGATION</li>
     <li>
       <a href="dashboard.php" class="waves-effect">
         <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
       </a>
     </li>
     
     <li>
      <a href="settings.php" class="waves-effect">
        <i class="fa fa-cog"></i> <span>Settings</span>
      </a>
    </li>
     <li>
       <a href="users.php" class="waves-effect">
         <i class="fa fa-user-circle"></i> <span>Users</span>
       </a>
     </li>
     <li>
      <a href="houses.php" class="waves-effect">
        <i class="fa fa-home"></i> <span>Houses</span>
      </a>
    </li>
    <li>
      <a href="positions.php" class="waves-effect">
        <i class="fa fa-user-md"></i> <span>Positions</span>
      </a>
    </li>
     <li>
       <a href="candidates.php" class="waves-effect">
         <i class="fa fa-user-plus"></i> <span>Candidates</span>
       </a>
     </li>
     <li>
       <a href="voters.php" class="waves-effect">
         <i class="fa fa-address-card"></i> <span>Voters</span>
       </a>
     </li>   

     <li>
       <a href="verification.php" class="waves-effect">
         <i class="fa fa-check"></i> <span>Verification</span>
       </a>
     </li>   
     
     <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="fa fa-address-card-o"></i> <span>Voter's Register</span>
        <i class="fa fa-angle-left float-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="verified-voters.php"><i class="zmdi zmdi-dot-circle-alt"></i> All Verified</a></li>
        <li><a href="not-verified-voters.php"><i class="zmdi zmdi-dot-circle-alt"></i> Not Verified</a></li>
        <li><a href="voted-voters.php"><i class="zmdi zmdi-dot-circle-alt"></i> All Voted</a></li>
        <li><a href="not-voted-voters.php"><i class="zmdi zmdi-dot-circle-alt"></i> All Not Voted</a></li>
      </ul>
    </li>
    
     <li>
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-chart"></i> <span>Election Results</span>
        <i class="fa fa-angle-left float-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="single-results.php"><i class="zmdi zmdi-dot-circle-alt"></i> Single Position</a></li>
        <li><a href="all-results.php"><i class="zmdi zmdi-dot-circle-alt"></i> All Position</a></li>
        <!-- <li><a href="winners.php"><i class="zmdi zmdi-dot-circle-alt"></i> Winners</a></li> -->
      </ul>
    </li>
     
     <br>
     <li><a href="javaScript:void(0);" class="waves-effect"><i class="zmdi zmdi-coffee text-danger"></i> <span>Production version 1.1</span></a></li>
     <li><a href="javascript:void(0);" class="waves-effect myDataBackup"><i class="fa fa-database text-primary"></i> <span>Backup Data</span></a></li>
   </ul>
  
  </div>

   <!-- Modal -->
   <div class="modal fade" id="BackupDataModal">
       <div class="modal-dialog modal-sm">
           <div class="modal-content animated zoomInUp">
               <div class="modal-header">
               <h5 class="modal-title">Backup Data</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
               </div>
               <div class="modal-body">
                <div class="myBackupResults"></div>  
               </div>
           </div>
       </div>
   </div>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
        <nav id="header-setting" class="navbar navbar-expand fixed-top">
         <ul class="navbar-nav mr-auto align-items-center">
           <li class="nav-item">
             <a class="nav-link toggle-menu" href="javascript:void();">
              <i class="icon-menu menu-icon"></i>
            </a>
           </li>
           <li class="nav-item">
             <form class="search-bar">
               <input type="text" class="form-control" placeholder="Enter keywords">
                <a href="javascript:void();"><i class="icon-magnifier"></i></a>
             </form>
           </li>
         </ul>
            
         <ul class="navbar-nav align-items-center right-nav-link">
           <li class="nav-item">
             <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
               <span class="user-profile"><img src="../assets/images/110x110.png" class="img-circle" alt="user avatar"></span>
             </a>
             <ul class="dropdown-menu dropdown-menu-right">
              <li class="dropdown-item user-details">
               <a href="javaScript:void();">
                  <div class="media">
                    <div class="avatar"><img class="align-self-start mr-3" src="../assets/images/110x110.png" alt="user avatar"></div>
                   <div class="media-body">
                   <h6 class="mt-2 user-title"><?php echo ucwords($user['username']); ?></h6>
                   <p class="user-subtitle"><?php echo ucwords($user['role']); ?></p>
                   </div>
                  </div>
                 </a>
               </li>
               <li class="dropdown-divider"></li>
               <li class="dropdown-item"><a href="change-password.php"><i class="icon-lock mr-2"></i> Change Password</a></li>
               <li class="dropdown-divider"></li>
               <li class="dropdown-item"><a href="logout.php"><i class="icon-power mr-2"></i> Logout</a></li>
             </ul>
           </li>
         </ul>
       </nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

