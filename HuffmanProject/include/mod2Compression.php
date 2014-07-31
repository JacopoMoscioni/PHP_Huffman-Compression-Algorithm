<?php
	$time_start = microtime(true); 
	/*$lol = str_word_count("ciao uno due uno ciao",2);
	print_r($lol);
	
	print_r($lol); */

	
	function mb_count_chars($input) {
		$l = mb_strlen($input);
		$unique = array();
		for($i = 0; $i < $l; $i++) {
			$char = mb_substr($input, $i, 1);
			if(!array_key_exists($char, $unique))
				$unique[$char] = 0;
			$unique[$char]++;
		}
		return $unique;
	}

/*	if ($_FILES["file"]["error"] > 0)
		{
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
		}
	else
		{
		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		echo "Type: " . $_FILES["file"]["type"] . "<br>";
		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br/>";
		}*/
		
	
	
	echo "<hr/>";
	echo "<h4 style='color:orange'> Compression done </h4>";
	//echo "<hr style='margin-bottom:10px;'/>";
	
	echo "<h5 style='color:orange'> Statistics </h5>";

	set_time_limit(0);
	ini_set('memory_limit','-1');
	$zeroC ="æ";
	$unoC = "œ";
	$zeroC=chr(1);
	$unoC=chr(127);
	$zero = "0";
	$uno = "1";
	
	$specialChar = explode(",","あ,う,お,え,か,く,こ,け,が,ぐ,ご,げ,さ,す,そ,せ,ざ,ず,ぞ,ぜ,た,つ,と,て,だ,づ,ど,で,な,ぬ,の,ね,は,ふ,ほ,へ,ば,ぶ,ぼ,べ,ぱ,ぷ,ぽ,ぺ,ま,む,も,め,や,よ,ら,れ,わ,ん");
	
	//print_r($specialChar);


	$input = "";
	$myFile = $_FILES["file"]["tmp_name"];
	
	
	
	//$myFile = "fileDiProva.txt";
	
	$fh = file($myFile);

	$lungh = 0;
	$testo = "";

	for($ii=0;$ii<256;$ii++){
		$arrayCharGlobal[chr($ii)]=0;
	}

	//echo $arrayCharGlobal['a'];

	for($i=0;$i < sizeOf($fh);$i++){
		$input = $fh[$i];
		
		$lungh += (strlen($input)*8);
		//$input =htmlentities($input, ENT_QUOTES);

		//echo "klhsd ";

		$num = array($zero,$uno);
		$replace= array($zeroC,$unoC);
		$input = str_replace($num, $replace, $input);
		
		

		//echo "<hr/>".strlen($input)."<hr/>";

		//print_r( mb_count_chars($input) );

		/*$arrayChar = mb_count_chars($input); 
		
		foreach ($arrayChar as $key => $value) {
			$arrayCharGlobal[$key] += $value;
		}*/
		
		//echo "<hr/>";
		$testo .= $input;
	}
	
	//calcolo media value char
	$media = 0;
	$com = 0;
	foreach ($arrayCharGlobal as $key => $value) {
		$media += $value;
		$com++;
	}
	
	$media = $media/$com;
	
	//da qui comincia la modifica della mod2 ---------------------------------------------------- MOD2 ------------------------------
	
	$array2char = array();
	$array3char= array();
	$array4char= array();
	
	for($ii = 0; $ii < strlen($testo)-1; $ii++){
		$twoChar = substr($testo,$ii,2);
		if(Array_key_exists($twoChar,$array2char)){
			$array2char[$twoChar]++;
			//echo "2char esistente: ".$twoChar." - ".$array2char[$twoChar]."<br/>";
		} else {
			$array2char[$twoChar] = 1;
			//echo "nuovo 2char: ".$twoChar." - ".$array2char[$twoChar]."<br/>";
		}
		
		//qui lo faccio per il 3char
		$threeChar = substr($testo,$ii,3);
		if(Array_key_exists($threeChar,$array3char)){
			$array3char[$threeChar]++;
			//echo "3char esistente: ".$threeChar." - ".$array3char[$threeChar]."<br/>";
		} else {
			$array3char[$threeChar] = 1;
			//echo "nuovo 3char: ".$threeChar." - ".$array3char[$threeChar]."<br/>";
		}
		
		//qui lo faccio per il 3char
		$fourChar = substr($testo,$ii,4);
		if(Array_key_exists($fourChar,$array4char)){
			$array4char[$fourChar]++;
			//echo "3char esistente: ".$fourChar." - ".$array4char[$fourChar]."<br/>";
		} else {
			$array4char[$fourChar] = 1;
			//echo "nuovo 3char: ".$fourChar." - ".$array4char[$fourChar]."<br/>";
		}
	}
	
	arsort($array3char);
	arsort($array2char);
	arsort($array4char);
	
	$arraySubString;
	
	$summ = array_sum($array2char);
	//questo valore decide quante sub vengono prese.. più è alto più ne prende.. 
	$chosenVal = 4;
	$vall = $summ/sizeOf($array2char)*$chosenVal;
		
	
	//echo $summ." ".sizeOf($array2char)." ".$vall;
	
	$trtr = 0;
	foreach ($array2char as $key => $value) {
		if($value < $vall){
			unset($array2char[$key]);
		} else {
			$arraySubString[$key] = $value;
			//echo " - ".$key." - ".$value."<br/>";
		}
	}
	//echo "<br/> Scelta 2char completata <br/>";
	
	foreach ($array3char as $key => $value) {
		if($value < $vall){
			unset($array3char[$key]);
		} else {
			$arraySubString[$key] = $value;
			//echo " - ".$key." - ".$value."<br/>";
		}
	}
	//echo "<br/> Scelta 3char completata <br/>";
	
	foreach ($array4char as $key => $value) {
		if($value < $vall){
			unset($array4char[$key]);
		} else {
			$arraySubString[$key] = $value;
			//echo " - ".$key." - ".$value."<br/>";
		}
	}
	//echo "<br/> Scelta 4char completata <br/>";
	
	/*foreach ($arraySubString as $key => $value) {
		
		echo $key." = ".$value."<br/>";
	}*/

	//qui associo ogni sub al suo carattere cinese
	foreach ($arraySubString as $key => $value) {
		if($trtr >= sizeOf($specialChar)){
			unset($arraySubString[$key]);
		} else {
			$arraySubString[$key] = $specialChar[$trtr]; 
			//echo " - ".$key." - ".$value." -> ".$specialChar[$trtr]."<br/>";
		}
		$trtr++;
	}
	
	//echo "<br/><br/> Counting char start! <br/><br/>";
	
	foreach ($arraySubString as $key => $value) {
		$testo = str_replace($key, $value, $testo);
	}
	
	/*foreach ($arraySubString as $key => $value) {
		
		echo $key." = ".$value."<br/>";
	}*/
	
	//echo "<hr/>";
	
	
	
	
	$md5input = md5($testo);
	
	$arrayCharGlobal = mb_count_chars($testo);

	/*foreach ($arrayCharGlobal as $key => $value) {
		echo $key." _ ".$value."<br/>";
	}*/

	//echo "<hr/>";

	arsort($arrayCharGlobal);

	$prefixSet;
	$counter = 0;

	foreach ($arrayCharGlobal as $key => $value) {
		if($value == 0){
			unset($arrayCharGlobal[$key]);
		}
	}

	//nuovo metodo per creare il prefix set
	//echo "METODO NUOVO<br/>";
	$prefixArray;
	$counter2=0;

	$comodo;
	
	foreach ($arrayCharGlobal as $key => $value) {
		//echo $key." _ ".$value."<br/>";
		$$key = array($value,$key);
		$prefixArray[$counter2] = $$key;
		$comodo[$key] = "";
		$counter2++;
	}

	//print_r($prefixArray[0]);
	

	//uso comodo per salvare i valori 1 e 0 per i nuovi prefixset e l'array prefixArray per fare l'albero

	//echo "<hr/>";
	//creazione albero
	$counterPassi = 1;

	while($counterPassi != sizeof($prefixArray)){
		//trovo i due figli minori
		$min1[0] = 999999999999999999999999999999999;
		$min2[0] = 999999999999999999999999999999999;
		for($y=0;$y<sizeof($prefixArray);$y++){
			if($prefixArray[$y][0] < $min1[0] || $prefixArray[$y][0] < $min2[0]){
				if($min1[0] < $min2[0]){
					$min2[0] = $prefixArray[$y][0];
					$min2[1] = $prefixArray[$y][1];
				}else{
					$min1[0] = $prefixArray[$y][0];
					$min1[1] = $prefixArray[$y][1];
				}
			}

			/* vecchio metodo per estrarre i minimi, sostituisce quello sagliato in alcune esecuzioni
			if($prefixArray[$y][0] < $min1[0]){
				$min1[0] = $prefixArray[$y][0];
				$min1[1] = $prefixArray[$y][1];
			} elseif ($prefixArray[$y][0] < $min2[0]) {
				$min2[0] = $prefixArray[$y][0];
				$min2[1] = $prefixArray[$y][1];
			}*/
		}

		//echo "minori = ".$min1[1]." con ".$min1[0]."e = ".$min2[1]." con ".$min2[0]."<br/>";

		//creo il padre dei due minori
		for($i=0;$i<sizeof($prefixArray);$i++){
			if($prefixArray[$i][1] == $min1[1]){
				$prefixArray[$i][0] = $min1[0]+$min2[0];
				$prefixArray[$i][1] = $min1[1]."".$min2[1];
			} elseif ($prefixArray[$i][1] == $min2[1]) {
				$prefixArray[$i][0] = 999999999999999999;
				$prefixArray[$i][1] = "";
			}
		}

		$zeri = array();
		
		for($i=0; $i < strlen($min1[1]); $i++){
			$zeri[$i] = substr($min1[1], $i, 1);	
		}

		$uni= array();
		
		for($i=0;$i<strlen($min2[1]);$i++){
			$uni[$i] = substr($min2[1], $i, 1);	
		}

		foreach ($comodo as $key => $value) {
			if(in_array($key, $zeri)){
				$comodo[$key] = $zero.$comodo[$key];
				
				/*if ($key == $zeroC)
				echo "bla bla bla bla";*/
				
			} elseif (in_array($key, $uni)) {
				$comodo[$key] = $uno.$comodo[$key];
				
				/*if ($key == $zeroC)
				echo "bla bla bla bla";*/
			}
		}

		$counterPassi++;
	}
	
	$output = "";

	$controlloPrefixSet = "";
	
	//prePrefixSet codifica delle parole
	foreach ($arraySubString as $key => $value) {
		
		//creiamo la codifica binaria
		
		$binaryKeyGlobal = "";
		
		for($ii = 0; $ii < strlen($key) ; $ii++){
			
			$binaryKey = "";
			$binaryKey .= decbin(ord($key[$ii]));
			while(strlen($binaryKey) < 8){
				$binaryKey = "0".$binaryKey;
			}
			
			if($ii == strlen($key)-1 ){
				$binaryKey .= "01";
			}else{
				$binaryKey .= "00";
			}
			
			$binaryKeyGlobal .= $binaryKey;
		}
		
		$output .= $binaryKeyGlobal ;
		
		//echo $key." _ ".$binaryKeyGlobal."<br/>";
	
	}
	
	$output .= "1111111111";
	
	foreach ($comodo as $key => $value) {

		$asciBin = decbin(ord($key));
		
		while(strlen($asciBin) < 8){
			$asciBin = $zero.$asciBin;
		}

		$lunghezza = decbin(strlen($value));
		
		while(strlen($lunghezza) < 8){
			$lunghezza = $zero.$lunghezza;
		}
		
		$output .= $asciBin.$lunghezza.$value;
		
		/*$spread = 255;
		$color = rand(0+$spread,255-$spread);
		$r = rand($color-$spread, $color+$spread);
		$g = rand($color-$spread, $color+$spread);
		$b = rand($color-$spread, $color+$spread);
		
		$controlloPrefixSet .= "<span style='color:rgb(".$r.",".$g.",".$b.")'> ".$asciBin." | ".$lunghezza." | ".$value." ||| </span><br/>";
		*/
	}

	//echo "----------- CONTROLLO PREFIX SET --------------- <br/>".$controlloPrefixSet ;

	//$output .= "000000000";
	//$output .= $zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero.$zero;
	$output .= "0000000000000000";

	$costoPrefix = $output;

	//sostituisco tutti i caratteri
	$comodino = 0;
	foreach ($comodo as $key => $value) {
		$testo = str_replace($key, $value, $testo);
		$file = fopen("temp.txt","w");
		fwrite($file,"Analizzo ".$key." codificata ".$value." ==> Avanzamento: ".($comodino/sizeof($comodo)*100)."% ") ;
		fclose($file);
		$comodino++;
	}
	$output .= $testo;

	
	
	$folder = "output/mod2";
	$file = fopen($folder."/output.txt","w");
	fwrite($file,$output) ;
	fclose($file);
	
$compressionTime = '<b>Compression time in seconds:</b><br/>' . (microtime(true) - $time_start);
$time_start = microtime(true);
function binaryStringToBytes($binaryString) {
    $out = '';
    for($i = 0; $i < strlen($binaryString); $i +=8)  {
        $out .= chr(bindec(substr($binaryString, $i, 8)));
    }
    return $out;
}

//aggiungo alcuni caratteri per fare in modo che la stringa sia divisibile per 8, altrimenti
//la funzione binaryStringToBytes non funziona bene e la decodifica del file .bmm non andrà a buon fine
	$temp ="";
	
	for ($jj = 0; $jj<8-(strlen($output) %8 );$jj++){
		$temp.="0";
	}
	//$temp =  str_pad(decbin(strlen($temp)), 8-strlen($output), '0', STR_PAD_LEFT);
	
	//aggiungo anche added perché con questa variabile tengo traccia di quanti zeri sono stati aggiunti
	//per pareggiare la stirnga facendola diventare un multiplo di 8.
	//la decodifica sarà facile perché come prima cosa si devono leggere i primi 8 bit (che sono added)
	//dopo di che, si converte added in decimale e si saprà quanti altri bit bisogna rimuovere per
	//cominciare a trattare il file....
	$added = str_pad(decbin(strlen($temp)), 8, '0', STR_PAD_LEFT);
	
	$output = $added.$temp.$output;
	
	file_put_contents($folder."/output.bmm",binaryStringToBytes($output));

	$binarizedTime = "<b>Time spent to create binary file in seconds:</b><br/>". (microtime(true) - $time_start);






	
	/*for($i=0;$i < sizeOf($fh);$i++){
		$swec = $fh[$i];
		foreach ($comodo as $key => $value) {
			$swec = str_replace($key, $value, $swec);
		}
		$output .= $swec;
	}*/

	//echo "<b style='color:orange'>".$output."</b><br/> <br/>";
	//echo "<b style='color:green'>".substr($output,strlen($costoPrefix))."</b><br/> <br/>";


	echo "<b>Original File: </b> ".$lungh." bits <br/>";
	echo "<b>Compressed File: </b>".strlen($output)." bits <br>";
	echo "Prefix-Cost: ".strlen($costoPrefix)." bits (".((strlen($costoPrefix)/strlen($output))*100)." %)<br>";
	echo "<b> Compression ratio =	</b> ".((strlen($output)/$lungh)*100)." %  <br/>";
	echo "<hr /><br/>";	
	echo $compressionTime;
	echo "<br/>";
	echo $binarizedTime;
?>