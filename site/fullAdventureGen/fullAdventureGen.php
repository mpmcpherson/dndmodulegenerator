<?php

main();
//FileParser("");
//GetFiles("");	
//FileImport("");

function main()
{
//first, get a single adventure plot
//then get an NPC for each role: patron, villain, ally
//then, get a setting for each adventure using the settlement generator
//then at least one "interesting locale"

	$dataDirs = array();
	array_push($dataDirs, './lists');



	$fileList = GetFiles($dataDirs);

	//	print_r($fileList);
	$fileContents = array();

	foreach($fileList as &$aryElem)
	{
		$singleFileContents = FileImport($aryElem);
		array_push($fileContents, $singleFileContents);

		//print_r($fileContents);
	}
	unset($aryElem);


	$fileLength = count($fileContents);
	//print_r("fileLength " . $fileLength. "\n");
	$fileOutput = "";

	for($i = 0; $i<10; $i++){
		//$fileOutput = $fileOutput . 

		$resultBlock = "</div><div id='".$i . "x"."' style='padding: 10px;'>";			
		for($j = 0; $j<$fileLength; $j++)
		{



			$lngth = count($fileContents[$j])-1;
			if($j==0)
			{
				$resultBlock  = $resultBlock  . "Patron: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==1)
			{
				$resultBlock  = $resultBlock  . "Villain: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==2)
			{
				$resultBlock  = $resultBlock  . "Ally: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==3) {
				$resultBlock  = $resultBlock  . "introduction: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==4) {
				$resultBlock  = $resultBlock  . "goal: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==5) {
				$resultBlock  = $resultBlock  . "complication: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==6) {
				$resultBlock  = $resultBlock  . "side quest: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==7) {
				$resultBlock  = $resultBlock  . "twist: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==8) {
				$resultBlock  = $resultBlock  . "climax: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==9) 
			{
				$resultBlock  = $resultBlock  . "framing event: " . $fileContents[$j][rand(0,$lngth)] . "</div>";
			}
		}


		$fileOutput = $fileOutput . $resultBlock;

		unset($resultBlock);
	}

	echo $fileOutput;
}

function FileParser($file)
{
	$firstPass = explode("\n", $file);
	$secondPass = array();
	foreach($firstPass as &$fp)
	{

		$explode = explode("\t", $fp);
		$passBack = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $explode[0]); 
		array_push($secondPass, str_replace("'", "", ucfirst(strtolower($passBack))));

	}
	unset($fp);

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

