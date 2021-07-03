<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Home - Status</h1>
      </div>
      <p>
    <?php 
      require_once('../includes/php/core.php');
      checkSession(true);
      echo countSize();
      echo "MB of space used.<br>";
      echo countFiles();
      echo " files uploaded.<br>"
      ?> 
      </p>
    </main>
  </div>
</div>