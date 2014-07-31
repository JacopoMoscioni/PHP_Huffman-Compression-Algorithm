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
            <div id="loginbox" style="height:250px;">            
                <form id="manualUpdate" action="codifica.php" method="post" enctype="multipart/form-data">
    				<p>Upload <b>your</b> File  </p>
                    <div class="">
                        <input class="form-control" type="file" name="file" placeholder="file" style="height:auto;"/>
					</div>
					<div style="text-align:center;padding-top:10px;">
						<input type="radio" name="uno" value="zero" style="margin-right:5px;" checked="checked"> Huffman  
						<input type="radio" name="uno" value="uno" style="margin-left:10px;"> Mod 1  
						<input type="radio" name="uno" value="due" style="margin-left:10px;"> Mod 2  <br/>
						<input type="hidden" id="comodo" name="comodo" value="0" />
                    </div>
					<hr/>
					<div class="form-actions">
						<div class="pull-left">
							<a href="#" class="flip-link to-recover"></a><br />
							<a href="#" class="flip-link to-register"></a>
						</div>
						<!-- <div class="pull-right"><input type="submit" class="btn btn-default" value="Decompress" name="decompress" style="margin-left:4px;width:177px;float:left" /></div>
						<div class="pull-right"><input type="submit" class="btn btn-default" value="Compress" name="compress" style="width:178px;float:left" /></div> -->
						<div style="margin:10px;">
							<a href="#" onclick="document.getElementById('comodo').value=1;document.getElementById('manualUpdate').submit();" class="btn btn-primary btn-warning" style="width: 125px;margin-right:3px;"><span class="glyphicon glyphicon-resize-small"></span> Compress </a>
							<a href="#" onclick="document.getElementById('comodo').value=2;document.getElementById('manualUpdate').submit();" class="btn btn-primary btn-warning" style="width: 125px;margin-left:3px;"><span class="glyphicon glyphicon-resize-full"></span> Decompress </a>
							<a href="validator.php" class="btn btn-primary btn-warning" style="width: 125px;margin-left:3px;"><span class="glyphicon glyphicon-resize-full"></span> Validate </a>
						</div>
					</div>
                </form>
            </div>
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/unicorn.login.js"></script> 
    </body>
</html>
