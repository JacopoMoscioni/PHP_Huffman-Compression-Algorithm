<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Huffman_Project </title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-glyphicons.css" />
        <link rel="stylesheet" href="css/unicorn.login.css" />
		
    </head>
    <body style="background-image:url(img/background.jpg);background-size:100%;">
        <div id="container">
            <div id="logo">
                <img src="img/logo.png" alt="" style="width:320px;" />
            </div>
            <div id="loginbox" style="height:200px">    

<?php

  	if (!isset($_FILES["file1"]["tmp_name"]) || strlen($_FILES["file1"]["tmp_name"]) == 0 || !isset($_FILES["file2"]["tmp_name"]) || strlen($_FILES["file2"]["tmp_name"]) == 0){
?>
<div style="margin:10px;">
<form id="manualUpdate" action="validator.php" method="post" enctype="multipart/form-data">
    				<p>Upload <b>your</b> File  </p>
                    <div class="">
                        <input class="form-control" type="file" name="file1" placeholder="file" style="height:auto;"/>
					</div>
		              <div class="">
                        <input class="form-control" type="file" name="file2" placeholder="file" style="height:auto;"/>
					</div>
					<div style="margin:10px;">
						<a href="#" onclick="document.getElementById('manualUpdate').submit();" class="btn btn-primary btn-warning" style="width: 150px;margin-right:3px;"><span class="glyphicon glyphicon-resize-small"></span> Start validating </a>
					</div>
                </form>
                
</div>
<?php
  	}
  	else{
	$file1 = md5_file($_FILES["file1"]["tmp_name"]);
	$file2 = md5_file($_FILES["file2"]["tmp_name"]);
	echo "<div class=\"\">";
	echo "<b>md5 file1:</b>".$file1."<br />";
	echo "<b>md5 file2:</b>".$file2;
	if ($file1 === $file2)
	
		echo "<hr/><br /><h1 style='color:yellowgreen'>Matching verified!</h1>";
	else
		echo "<hr/><br /><h1 style='color:red'>Matching not verified!</h1>";
		
	echo "</div>";
	}

?>

        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/unicorn.login.js"></script> 
    </body>
</html>

