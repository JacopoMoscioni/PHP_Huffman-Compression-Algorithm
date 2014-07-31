<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Huffman_Project - Compression </title>
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
            <div id="loginbox" style="height:auto;overflow:auto;">            
                <?php
                	$uno;
                	if (isset($_POST['uno']))
                		$uno = $_POST['uno'];
                	 else
                	 	die("Error occurred");
                 	
                 	if (!isset($_FILES["file"]["tmp_name"]) || strlen($_FILES["file"]["tmp_name"]) == 0)
	                 	die("file not uploaded");
	                 	
					if($_POST['comodo'] == 1){
						if ( $uno == 'zero'){
							echo "huffman Compression";
							include('include/huffmanCompression.php'); 
						}
						else
						if ( $uno == 'uno'){
													echo "mod1 Compression";
							include('include/mod1Compression.php'); 
						}
						else
						if ( $uno == 'due'){
													echo "mod2 Compression";
							include('include/mod2Compression.php'); 
						}
						else{
							die ("error occurred...");
						}
					?>
			<div style="margin:10px;">
				<a href="<?php echo $folder ?>/output.bmm" class="btn btn-primary btn-warning"><span class="glyphicon glyphicon-arrow-down"></span> Download</a>
				<a href="<?php echo $folder ?>/output.txt" class="btn btn-primary btn-warning"><span class="glyphicon glyphicon-align-justify"></span> Read text </a>
				<!-- <a href="#" class="btn btn-primary btn-warning"><span class="glyphicon glyphicon-resize-full"></span> Decompress </a> -->
			</div>
				<?
					} 
					else
					if ($_POST['comodo'] == 2){
						if ( $uno == 'zero'){
													echo "huffman dec";
							include('include/huffmanDecompression.php'); 
						}
						else
						if ( $uno == 'uno'){
													echo "mod1 dec";
							include('include/mod1Decompression.php'); 
						}
						else
						if ( $uno == 'due'){
													echo "mod2 dec";
							include('include/mod2Decompression.php'); 
						}
						else
							die ("error occurred...");
					}
					
				?>
		
		
		

		
			</div>
			
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/unicorn.login.js"></script> 
    </body>
</html>