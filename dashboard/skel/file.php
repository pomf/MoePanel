
<?php require_once('../includes/php/core.php');
checkSession(true);
?>
<script>
function showResult(keyword) {
var limit = document.getElementById("limit").value;
  if (keyword.length === 0) { 
    document.getElementById("search-result").innerHTML="";
    document.getElementById("search-result").style.display = 'none';
    return;
  }

  var moe_host = window.location.protocol + '//' + window.location.hostname + ':' + window.location.port;
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    myObj = JSON.parse(this.responseText);
    let text = ""
    for (let x in myObj) {
    var size = myObj[x].size / 1000000;
    size = size.toFixed(2);

    document.getElementById("search-result").style.display = 'block';
    text += '<li class="list-group-item">' +
        '<p><b>ID:</b> ' + myObj[x].id + 
        '<br><b>Hash: </b>' + myObj[x].hash + 
        '<br><b>Original Name: </b>' + myObj[x].originalname +
        '<br><b>Filename: </b>' + myObj[x].filename + 
        '<br><b>Size: </b>' + size + 'MB' +
        '<br><b>Date:</b> </b> ' + myObj[x].date +
        '<br><b>IP: </b>' + myObj[x].ip + 
        '<div id="del-buttons">' +
        '<a href="' + moe_host + '/includes/php/api.php?d=delete&fileid=' + myObj[x].id + 
        '&blacklist=' + false + '" target="_BLANK" class="btn btn-outline-danger btn-sm">' +
        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">' +
        '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>' +
        '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>' +
        '</svg>' +
        ' Delete' +
        '</a>  ' +
        
        '<a href="' + moe_host + '/includes/php/api.php?d=delete&fileid=' + myObj[x].id + 
        '&blacklist=true" target="_BLANK" class="btn btn-outline-danger btn-sm">' + 
        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-x" viewBox="0 0 16 16">' +
        '<path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>' +
        '<path d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z"/>' +
        '</svg>' +
        ' Blacklist' +
        '</a>' +
        '</div></p>' +
        '</li>';
  }
  document.getElementById("search-result").innerHTML = text;
};
    
}
xmlhttp.open("GET",moe_host + "/includes/php/api.php?d=fetchData&limit=" + limit + "&keyword=" + keyword, true);
xmlhttp.send();
}
</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">File management</h1>
</div>

<form>
    <p>Max amount of records shown, setting a high number can spazz ur server or browser.
        <input class="form-control form-control-sm" type="text"  value="50" id="limit"></p>
    <p>% can be used as a wildcard before or after a keyword to match records. E.g 255.255.25%
<input class="form-control form-control-sm" type="text" placeholder="Search for file, hash or IP." onkeyup="showResult(this.value)"></p>
</form>

<ul class="list-group list-group-flush border" id="search-result" style="display:none;">
</div>
</ul>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    </main>
  </div>
</div>