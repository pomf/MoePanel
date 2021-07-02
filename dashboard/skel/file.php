
<script>
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("search").innerHTML="";
    document.getElementById("search").style.display = 'none';
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
    myObj = JSON.parse(this.responseText);

    let text = ""
  for (let x in myObj) {
    document.getElementById("search").style.display = 'block';
    text += '<b>ID:</b> ' + myObj[x].id + 
        '<br><b>Hash: </b>' + myObj[x].hash + 
        '<br><b>Filename: </b>' + myObj[x].filename + 
        '<br><b>Original Name: </b>' + myObj[x].originalname
        + '<br><b>Size: </b>' + myObj[x].size / 1000000 + ' MB' +
        '<br><b>Date:</b> </b> ' + myObj[x].time +
        '<br><b>IP: </b>' + myObj[x].ip + '<hr>';
  }
  document.getElementById("search").innerHTML = text;
};
    
}
  xmlhttp.open("GET","http://localhost:8080/includes/php/api.php?d=fetchData&keyword="+str,true);
  xmlhttp.send();
}
</script>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">File management</h1>
</div>

<form>
    <p>Max amount of records shown, setting a high number can spazz ur server or browser. (FIXA DET HÄR!)<input class="form-control form-control-sm" type="text"  value="50" name="limit"></p>
    <p>% can be used as a wildcard before or after a keyword to match records. E.g 255.255.25%
<input class="form-control form-control-sm" type="text" placeholder="Search for file, hash or IP." onkeyup="showResult(this.value)"></p>
</form>
<p>
<div class="alert alert-success" role="alert" id="search" style="display:none;">

</div>
</p>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    </main>
  </div>
</div>