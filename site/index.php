<?php
	$val = scandir('.');

	$out = array();

	$files = array_slice($val,2);

	for($i=0;$i<count($files);$i++)
	{
		if(strpos($files[$i],'.')=== false&&strpos($files[$i],'logs')===false)
		{
			array_push($out, $files[$i]);
		}
	}
?>
<html>
<head>
<title>Random RPG Stuff Generators</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no" />

<?php
 
	$log = getUserIpAddr();
	
	$log = $log . "\n" . $_SERVER['HTTP_USER_AGENT'];

	file_put_contents("logs/access".gmdate("Y-m-d H:i:s") . ".txt", $log);
	
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
<link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #edefd3;">
	<div id="container">
		<div id="header">
			<h3>AireRPG</h3>
		</div>
		<div id="body">
			<?php 
			for($i=0;$i<count($out);$i++)
			{		
				echo "<div class='link' id='".$out[$i]."'>".$out[$i]."</div><br/>";
			}
			?>
			<div id="results"></div>
		</div>
	</div>
<script>
	document.addEventListener("DOMContentLoaded", (event) => {

	//let's make those stupid hrefs into clickable divs
	let linx = document.getElementsByClassName("link");
	for(let i = 0;i<linx.length; i++)
	{
		linx[i].addEventListener('click', function(){
			//console.log(window.location+""+linx[i].id);
			window.location.href=window.location+""+linx[i].id;
		});
	}
});

</script>
<?php require 'pierrefrancoisdulac.php'; ?>
</body>	
</html>