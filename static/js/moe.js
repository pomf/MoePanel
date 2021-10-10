function getSearchResult(keyword, type) {
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
                size = size.toFixed(4);
    
                const dateObject = new Date(myObj[x].date * 1000);
                const humanDateFormat = dateObject.toLocaleString();
    
                document.getElementById("search-result").style.display = 'block';

                if(type === 'fetchBlacklist') {

                  text += '<li class="list-group-item">' +
                  '<p><b>ID:</b> ' + myObj[x].id +
                  '<br><b>Hash: </b>' + myObj[x].hash +
                  '<br><b>Original Name: </b>' + myObj[x].originalname +
                  '<div class="btn-group" id="' + myObj[x].id + '">' +
                  '<button class="btn btn-outline-danger btn-sm" onclick="delBlacklist(' + myObj[x].id + ')">' +
                  '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">' +
                  '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>' +
                  '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>' +
                  '</svg>' +
                  'Remove blacklist' +
                  '</button>' +
                  '</div></p>' +
                  '</li>';

                } else {

                text += '<li class="list-group-item">' +
                '<p><b>ID:</b> ' + myObj[x].id +
                '<br><b>Hash: </b>' + myObj[x].hash +
                '<br><b>Filename: </b>' + myObj[x].filename +
                '<br><b>Original Name: </b>' + myObj[x].originalname +
                '<br><b>Date:</b> </b> ' + humanDateFormat +
                '<br><b>Size: </b>' + size + 'MB' +
                '<br><b>IP: </b>' + myObj[x].ip +
                '<div class="btn-group" id="' + myObj[x].id + '">' +
                '<button class="btn btn-outline-danger btn-sm" onclick="delFile(' + myObj[x].id + ',false' + ')">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">' +
                '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>' +
                '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>' +
                '</svg>' +
                ' Delete' +
                '</button>' +
                '<button class="btn btn-outline-danger btn-sm" onclick="delAllIP(' + myObj[x].id + ')">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">' +
                '<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>' +
                '<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>' +
                '</svg>' +
                ' All IP' +
                '</button>' +
                '<button class="btn btn-outline-danger btn-sm" onclick="delFile(' + myObj[x].id + ',true' + ')">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-x" viewBox="0 0 16 16">' +
                '<path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>' +
                '<path d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z"/>' +
                '</svg>' +
                ' Blacklist' +
                '</button>' +
                '<button class="btn btn-outline-danger btn-sm" onclick="blackListAllIP(' + myObj[x].id + ')">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-x" viewBox="0 0 16 16">' +
                '<path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>' +
                '<path d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z"/>' +
                '</svg>' +
                ' All IP' +
                '</button>' +
                '</div></p>' +
                '</li>';
                }
            }
            document.getElementById("search-result").innerHTML = text;
        };
    }
    xmlhttp.open("GET",moe_host + "/api.php?d=" + type + "&limit=" + limit + "&keyword=" + keyword, true);
    xmlhttp.send();
}



function sendData( data , api, div) {
  var moe_host = window.location.protocol + '//' + window.location.hostname + ':' + window.location.port;

  const XHR = new XMLHttpRequest();

  let urlEncodedData = "",
      urlEncodedDataPairs = [],
      name;

  // Turn the data object into an array of URL-encoded key/value pairs.
  for( name in data ) {
    urlEncodedDataPairs.push( encodeURIComponent( name ) + '=' + encodeURIComponent( data[name] ) );
  }

  // Combine the pairs into a single string and replace all %-encoded spaces to
  // the '+' character; matches the behavior of browser form submissions.
  urlEncodedData = urlEncodedDataPairs.join( '&' ).replace( /%20/g, '+' );

  // Define what happens on successful data submission
  XHR.addEventListener( 'load', function(event) {
    myObj = JSON.parse(this.responseText);
      document.getElementById(div).innerHTML = myObj.description;
  } );

  // Define what happens in case of error
  XHR.addEventListener( 'error', function(event) {
    document.getElementById(div).innerHTML = this.responseText;
  } );

  // Set up our request
  XHR.open( 'POST', moe_host + '/api.php?d=' + api, true);

  // Add the required HTTP header for form data POST requests
  XHR.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded; charset=utf-8' );

  // Finally, send our data.
  XHR.send( urlEncodedData );
}

function delFile (id, blacklist) {
  sendData( {fileid:id, blacklist:blacklist}, 'delete', id );
}

function delAllIP (id) {
  sendData( {fileid:id}, 'delAllIP', id);
  document.getElementById("search-result").innerHTML="All files related to the IP deleted.";
  document.getElementById("search-result").style.display = 'Block';
}

function blackListAllIP (id) {
  sendData( {fileid:id}, 'blacklistAllIP', id);
  document.getElementById("search-result").innerHTML="All files related to the IP deleted and blacklisted.";
  document.getElementById("search-result").style.display = 'Block';
}

function delBlacklist (id) {
  sendData( {fileid:id}, 'deleteBlacklist', id);
}

function changePassword(pass) {
if(pass === document.getElementById('pass2').value){
  sendData( {pass:pass}, 'changePassword', 'change-password' );
} else {
  document.getElementById('change-password').innerHTML = "Passwords dont match!";
}
}