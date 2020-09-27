<?php

main();
//FileParser("");
//GetFiles("");
//FileImport("");

function main()
{
	$dataDirs = array();
	array_push($dataDirs, './lists');

	//var_dump($dataDirs);
	
	//patron
	//villain
	//ally
	//introduction
	//adventure
	//goal
	//complication
	//side quest
	//twist
	//climax	


	$fileList = GetFiles($dataDirs);

	print_r($fileList);
	$fileContents = array();

	foreach($fileList as &$aryElem)
	{
		$singleFileContents = FileImport($aryElem);
		array_push($fileContents, $singleFileContents);

		//print_r($fileContents);
	}
	unset($aryElem);


	$fileLength = count($fileContents);
	print_r("fileLength " . $fileLength. "\n");
	$fileOutput = "";

	for($i = 0; $i<10000; $i++){
		//$fileOutput = $fileOutput . 
		for($j = 0; $j<$fileLength; $j++)
		{
			$lngth = count($fileContents[$j])-1;
			if($j==0)
			{
				$fileOutput = $fileOutput . "Patron: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==1)
			{
				$fileOutput = $fileOutput . "Villain: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==2)
			{
				$fileOutput = $fileOutput . "Ally: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==3) {
				$fileOutput = $fileOutput . "introduction: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==4) {
				$fileOutput = $fileOutput . "goal: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==5) {
				$fileOutput = $fileOutput . "complication: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==6) {
				$fileOutput = $fileOutput . "side quest: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==7) {
				$fileOutput = $fileOutput . "twist: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==8) {
				$fileOutput = $fileOutput . "climax: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}else if($j==9) 
			{
				$fileOutput = $fileOutput . "framing event: " . $fileContents[$j][rand(0,$lngth)] . "\n";
			}
			//$fileContents[rand(0,$fileLength)] . "\n";
		}
		$fileOutput = $fileOutput . "\n\n";
	}

	echo $fileOutput;
	file_put_contents("outputScripts/adventure".gmdate("Y-m-d H:i:s") . ".txt", $fileOutput);



	//PrintCurrentFunction(__FUNCTION__);
}

function FileParser($file)
{
	$firstPass = explode("\n", $file);
	$secondPass = array();
	foreach($firstPass as &$fp)
	{
		/*
		if (strpos($fp, 'ABRANCHES	19') !== false) {
		    echo 'ABRANCHES	19'."\n";
		}
		*/
		$explode = explode("\t", $fp);
		$passBack = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $explode[0]); 
		array_push($secondPass, str_replace("'", "", ucfirst(strtolower($passBack))));
		/*
		if (strpos($fp, 'ABRANCHES	19') !== false) {
		    echo $passBack."\n";
		}
		*/
	}
	unset($fp);

//	print_r($secondPass);

	return $secondPass;

	PrintCurrentFunction(__FUNCTION__);
}

//Get the data from the files on the list
function FileImport($filePathAndName)
{
	$myfile = fopen($filePathAndName, "r") or die("Unable to open file!");
	$newFile = fread($myfile,filesize($filePathAndName));
	fclose($myfile);

	//print_r($myfile);

	$fileAry = FileParser($newFile);


	return $fileAry;

	PrintCurrentFunction(__FUNCTION__);
}

//Get the full file path of the files in the data directories.
function GetFiles($ArrayOfDataDirectories)
{	

	$outputFileList = array();

	$fileList = scandir($ArrayOfDataDirectories[0]);

	foreach($fileList as &$files)
	{
		if($files != "." && $files != "..")
		{
			array_push($outputFileList, $ArrayOfDataDirectories[0] . "/" . $files);
		}
	}
	unset($files);

	//PrintCurrentFunction(__FUNCTION__);

	return $outputFileList;
}




function PrintCurrentFunction($funcName)
{
		echo $funcName . " working \n";
}



?>