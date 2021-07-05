<?php
session_start();
if(isset($_SESSION['moe'])){
  header('Location: dashboard/');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moe Panel Login</title>

    <!-- Bootstrap core CSS -->
<link href="includes/css/bootstrap.min.css" rel="stylesheet">
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
    <link href="includes/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
<main class="form-signin">
  <form action="includes/php/api.php?d=login" method="POST">
    <img class="mb-4" src="includes/img/logo.png" alt="" width="150" height="150">
    <h1 class="h3 mb-3 fw-normal">Moe Panel~</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass">
      <label for="floatingPassword">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted" id="fail" style="display:none;"></p>
  </form>
</main>
<script>
var textElement = document.getElementById('fail');
if(window.location.hash == '#fail-cred'){
    textElement .style.display = 'block';
    textElement .innerHTML = 'Wrong email or password!';
}
if(window.location.hash == '#fail-limit'){
    textElement .style.display = 'block';
    textElement .innerHTML = 'Wait 10 minutes before trying again!';
}
if(window.location.hash == '#logout'){
    textElement .style.display = 'block';
    textElement .innerHTML = 'You have been logged out.';
}
</script>
  </body>
</html>
