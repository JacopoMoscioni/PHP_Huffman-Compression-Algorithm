<?php
	$time_start = microtime(true); 
	set_time_limit(0);
	ini_set('memory_limit','-1');
/*	$zeroC ="æ";
	$unoC = "œ";*/
	$zeroC=chr(1);
	$unoC=chr(127);
	$zero = "0";
	$uno = "1";
	
	function bytesToBinaryString($byteString) {
		$out = '';
		for($i = 0; $i < strlen($byteString); $i++) {
			$out .= str_pad(decbin(ord($byteString[$i])), 8, '0', STR_PAD_LEFT);
		}
		return $out;
	}

	/*
	if ($_FILES["file"]["error"] > 0)
		{
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
		}
	else
		{
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br/>";
		}
	*/
	echo "<hr/>";
	echo "<h4 style='color:orange'> Decompression done </h4>";
	//echo "<hr style='margin-bottom:10px;'/>";

	$output="";
	$deBinarizedTime ="";
	$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	if ($ext == "bmm"){
		$output = bytesToBinaryString(file_get_contents($_FILES["file"]["tmp_name"]));
		$deBinarizedTime = "<b>Time spent to convert binary file in string, in seconds:</b><br/>". (microtime(true) - $time_start);

		$time_start = microtime(true);
		
		$added = bindec(substr($output, 0, 8));
		$output = substr($output, 8+$added);
	}
	else{
		$output = file_get_contents($_FILES["file"]["tmp_name"]);
	}
		
	
	
	//echo "<br/><br/><h2 style='color:green'>-----------------------------DECODIFICA---------------------------------------</h2><br/><br/>";

	$finito = false;
	$arrayCode;
	$counter = 1;
	$dddd = 0;
	$controlloPrefixSetEstratto = "";
	$decodificato = "";

	//array per il prefix set estratto
	for($ii=0;$ii<256;$ii++){
		$estratto[chr($ii)]="";
	}

	while($finito == false){

		$charEstratto = substr($output,$dddd,8);
		$lunghEstratta = substr($output,$dddd+8,8);
		$codeEstratto = substr($output,$dddd+16,bindec($lunghEstratta));
			
		$dddd += 8+8+bindec($lunghEstratta);	
			
		$spread = 200;
		$color = rand(0+$spread,200-$spread);
		$r = rand($color-$spread, $color+$spread);
		$g = rand($color-$spread, $color+$spread);
		$b = rand($color-$spread, $color+$spread);
		
		$controlloPrefixSetEstratto .= "<span style='color:rgb(".$r.",".$g.",".$b.")'> ".chr(bindec($charEstratto))." | ".$lunghEstratta." | ".$codeEstratto." ||| </span><br/>";
		
		$estratto[chr(bindec($charEstratto))] = $codeEstratto;
		
		if($charEstratto == $lunghEstratta && $lunghEstratta == $zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero){
			$finito = true;
		}

	} 

		
	
	
	//echo "----------- CONTROLLO PREFIX SET ESTRATTO --------------- <br/>".$controlloPrefixSetEstratto ;

	
	
	foreach ($estratto as $key => $value) {
		if($value == ""){
			unset($estratto[$key]);
		}
	}
	
	$minLenght = 9999999;
	$minCode = "";
	foreach ($estratto as $key => $value) {
		if(strlen($value) < $minLenght){
			$minLenght = strlen($value);
			$minCode = $key;
		}
		//echo "key: ".$key." - ".$value."<br/>";
	}

	//echo "minore = ".$minCode." - ".$minLenght."<br/>";

	$ii= $dddd;
	$comodino = $minLenght;
	
	//echo "<br/>".substr($output,$ii)."<br/>";

	while($ii < strlen($output)){

		$comodo = (string) substr($output,$ii,$comodino);
		//echo $comodo."<br/>";
		$comodino++;
		
		foreach ($estratto as $key => $value) {
			
			if((string)$value === (string)$comodo){
				//echo $value." = ".$comodo." quindi la lettera &egrave; ".$key."<br/>";
				$decodificato .= $key;
				$ii += $comodino-1;
				$comodino = $minLenght;
				break;
			}
			
		}
		
		/*$file = fopen("tempDec.txt","w");
		fwrite($file,"Avanzamento: ".(100*$ii)/strlen($output)."%");
		fclose($file);*/
	} 
	
//	echo "<br/>--------- DECOMPRESSION DONE --------------- <br/>";

		//$md5decodificato = md5($decodificato);
		
		$num = array($zeroC,$unoC);
		$replace= array($zero,$uno);
		$decodificato = str_replace($num, $replace, $decodificato);
		
		
		/*if($md5input == $md5decodificato){
			echo "<h1 style='color:yellowgreen'> MATCHATO </h1> <br/>";
		} else {
			echo " nooooooooooooooooooooo! <br/>";
		}*/
		$folder = "output/huffman";
		$file = fopen($folder."/decode.txt","w");
		fwrite($file,$decodificato) ;
		fclose($file);
		$decompressionTime = '<b>Decompression time in seconds:</b><br/>' . (microtime(true) - $time_start);
	
	echo "<hr /><br/>";
	echo $deBinarizedTime;
	echo "<br/>";
	echo $decompressionTime;
	
		//echo $decodificato; 

?>