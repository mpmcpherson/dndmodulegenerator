<!DOCTYPE html>

<html>
<head>
<title>Random adventure plot generator</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<?php 
	$log = getUserIpAddr();
	
	$log = $log . "\n" . $_SERVER['HTTP_USER_AGENT'];

	file_put_contents("../logs/access".gmdate("Y-m-d H:i:s") . ".txt", $log);
	
	unset($log);

	function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>	
</head>

<body style="background-color: #edefd3;">
	<div id="container">
		<div id="header">
			<h3>Built from DMG charts; generate ten start to finish plots</h3>
		</div>
		<div id="body">
			<button id="btn">Generate some plots</button>
			<div id="results"></div>
		</div>
	</div>
</body>	
</html>

<script type="text/javascript">
	var button = document.getElementById('btn');
	var resultDiv = document.getElementById('results');

 
	button.addEventListener('click', function() {
		console.log("hit click");

  		getRequest('basicGenerator.php',
  			function(response){
  				//console.log(response);
  				resultDiv.innerHTML = response;
  			},
  			function(response){
  				resultDiv.innerHTML = 'An error occurred during your request: ' +  response.status + ' ' + response.statusText;
  			},
  			null);
	});



// helper function for cross-browser request object
	function getRequest(url, success, error, params) {
	    var req = false;
	    try{
	        // most browsers
	        req = new XMLHttpRequest();
	    } catch (e){
	        // IE
	        try{
	            req = new ActiveXObject("Msxml2.XMLHTTP");
	        } catch(e) {
	            // try an older version
	            try{
	                req = new ActiveXObject("Microsoft.XMLHTTP");
	            } catch(e) {
	                return false;
	            }
	        }
	    }
	    if (!req) return false;
	    if (typeof success != 'function') success = function () {};
	    if (typeof error!= 'function') error = function () {};



	    if(params != null){

	        req.open("GET", url+"?"+params, true);
	        req.setRequestHeader('Cache-Control', 'no-cache');

	    }else {
	        req.open("GET", url, true);
	    	req.setRequestHeader('Cache-Control', 'no-cache');
	    }


	    req.onreadystatechange = function(){
	        if(req.readyState == 4) {
	            return req.status === 200 ?
	                success(req.responseText) : error(req.status);
	        }
	    };


	    req.send(null);
	    return req;
	}
</script>