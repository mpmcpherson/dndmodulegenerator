<?php

main();


function main()
{


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

	$fileOutput = "";

	for($i = 0; $i<10; $i++){

		$resultBlock = "</div><div id='".$i . "x"."' style='padding: 10px;'>";			
		for($j = 0; $j<$fileLength; $j++)
		{



			$lngth = count($fileContents[$j])-1;
			if($j==0)
			{
				$resultBlock  = $resultBlock  . "Odd feature: " . $fileContents[$j][rand(0,$lngth)] . "<br/>";
			}else if($j==1)
			{
				$resultBlock  = $resultBlock  . "Strange Locale: " . $fileContents[$j][rand(0,$lngth)] . "</div>";
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

	return $outputFileList;
}




function PrintCurrentFunction($funcName)
{
		echo $funcName . " working \n";
}

?>

