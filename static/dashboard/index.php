<?php require_once('../includes/core.php');
checkSession(true);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moe Panel - Dashboard</title>
    <link rel="icon" href="../img/favicon-32x32.png" type="image/png" sizes="32x32">

    <!-- Bootstrap core CSS -->
<link href="../css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../css/moe.min.css" rel="stylesheet">
  </head>
  <body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php"><img src="img/logo.png" alt="" width="30" height="30">  Moe Panel</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>

<?php 
require_once('skel/nav.php'); 

if(!isset($_GET['p'])){
  require_once('skel/stats.php');
}

if(isset($_GET['p'])){
switch ($_GET['p']) {

  case 'files':
    require_once('skel/file.php');
    break;

  case 'settings':
    require_once('skel/settings.php');
    break;

  case 'blacklist':
    require_once('skel/blacklist.php');
    break;

  case 'user':
    require_once('skel/user.php');
    break;

  default:
  require_once('skel/stats.php');
  break;
}
}

?>
<script src="../js/bootstrap.min.js"></script>
 <script src="../js/moe.min.js"></script>
  </body>
</html>
