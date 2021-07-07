
<?php require_once('../includes/core.php');
checkSession(true);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Blacklist Management</h1>
</div>

<form>
    <p>Max amount of records shown, setting a high number can spazz ur server or browser.
        <input class="form-control form-control-sm" type="text"  value="50" id="limit" name="limit"></p>
    <p>% can be used as a wildcard before or after a keyword to match records. E.g something_jpg%
<input class="form-control form-control-sm" type="text" placeholder="Search for file or hash." onkeyup="getSearchResult(this.value, 'fetchBlacklist')">
</form>

<ul class="list-group list-group-flush border" id="search-result" style="display:none;">
</div>
</ul>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    </main>
  </div>
</div>