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
				$resultBlock  = $resultBlock  . "Villain scheme: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==1)
			{
				$resultBlock  = $resultBlock  . "Scheme method: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==2)
			{
				$resultBlock  = $resultBlock  . "specific action: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==3) {
				$resultBlock  = $resultBlock  . "villain weakness: " . $fileContents[$j][rand(0,$lngth)] . "</div>";
			}
		}


		$fileOutput = $fileOutput . $resultBlock;

		unset($resultBlock);
	}

	echo $fileOutput;

	//file_put_contents("outputScripts/adventure".gmdate("Y-m-d H:i:s") . ".txt", $fileOutput);



	//PrintCurrentFunction(__FUNCTION__);
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

}

//Get the data from the files on the list
function FileImport($filePathAndName)
{
	$myfile = fopen($filePathAndName, "r") or die("Unable to open file!");
	$newFile = fread($myfile,filesize($filePathAndName));
	fclose($myfile);

	$fileAry = FileParser($newFile);


	return $fileAry;

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

	return $outputFileList;
}




function PrintCurrentFunction($funcName)
{
		echo $funcName . " working \n";
}

?>

