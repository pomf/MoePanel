<?php require_once('../includes/php/core.php');
checkSession(true);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User Management</h1>
</div>
<div id="change-password">
<form>
<p>New password:
<input class="form-control form-control-sm" type="password" name="pass" id="pass" name="pass"></p>
<p>New password again:
<input class="form-control form-control-sm" type="password" name="pass2" id="pass2"></p>
<button type="button" class="btn btn-success btn-sm" onclick="changePassword(pass.value)">Change password</button>
</form>
</div>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    </main>
  </div>
</div>

