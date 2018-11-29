	<?php
		$mysqli = mysqli_connect("localhost", "root", "", "Youtube");
		$mysqli_wynk = mysqli_connect("localhost", "root", "", "WynkDB");
		$res = mysqli_query($mysqli, "SELECT ImageUrl from YTVideoDetails order by Views DESC LIMIT 10");
		$res_wynk = mysqli_query($mysqli_wynk, "SELECT Id from WynkData order by currentPosition DESC LIMIT 10");
		$a=array();
		$id=array();
		while ($row = mysqli_fetch_assoc($res)){
			array_push($a,$row['ImageUrl']);
		}
		while ($row  = mysqli_fetch_assoc($res_wynk)) {
			array_push($id,$row['Id']);
		}
		$Wynk_url=array();
		foreach ($id as $value){
    		$result=mysqli_query($mysqli, "SELECT ImageUrl from YTVideoDetails where VideoId='$value'");
    		while ($row = mysqli_fetch_assoc($result)){
				array_push($Wynk_url,$row['ImageUrl']);
			}
		}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Statistics Page</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style type="text/css">
			body{
				background-image: url('wallpaper.jpg');
			}
			#Shazam{
				background-color: red;
			}
			#Wynk{
				background-color: crimson;
    			margin-top: 38px;
			}
			#Saavn{
				margin-top: 38px;
    			background-color: coral;
			}
			#Radio{
				margin-top: 38px;
    			background-color: teal;
			}
			p.title{
				color: white;
			}
			button{

				    margin-left: 44%;
    				margin-bottom: 20%;
    				margin-top: 3%;
			}
			body{
				background-color: white;
			}
			div.caption p{
				
				color: white;
    font-size: 23px;
			}
		.caption{
			    background-color: black;
		}
			.jumbotron{
				width: 100%;
				background-image: url("SonyMusic.jpg");
				margin-top: 2%;
				color: white;
			}
			div.gallery {
			    margin: 5px;
			    border: 1px solid #ccc;
			    float: left;
			    width: 180px;
			}

			div.gallery:hover {
			    border: 1px solid #777;
			}

			div.gallery img {
			    width: 100%;
			    height: auto;
			}

			div.desc {
			    padding: 15px;
			    text-align: center;
			}
			header { 
			  padding: .5vw;
			  font-size: 0;
			  display: -ms-flexbox;
			  -ms-flex-wrap: wrap;
			  -ms-flex-direction: column;
			  -webkit-flex-flow: row wrap; 
			  flex-flow: row wrap; 
			  display: -webkit-box;
			  display: flex;
			}
			header div { 
			  -webkit-box-flex: auto;
			  -ms-flex: auto;
			  flex: auto; 
			  width: 200px; 
			  margin: .5vw; 
			}
			header div img { 
			  width: 100%; 
			  height: auto; 
			}
			@media screen and (max-width: 400px) {
			  header div { margin: 0; }
			  header { padding: 0; }
			  
			}
			.title{
			color: black;
			}
			#Shazam.row,#Wynk.row,#Saavn.row,#Radio.row{
				padding: 23px;
			}
			#Shazam.row p.title{
				font-size: 24px;
			}
			#Wynk.row p{
				font-size: 24px;
			}
			#Saavn.row p.title{
				font-size: 24px;
			}
			#Radio.row p.title{
				font-size: 24px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="jumbotron">
				<h1 align="center">Sony Music</h1> 
				<div class="dropdown">
	    			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Region
	    			<span class="caret"></span></button>
	    			<ul class="dropdown-menu">
	      			<li><a href="#">Karnataka</a></li>
	      			<li><a href="#">Punjab</a></li>
	      			<li><a href="#">Tamilnadu</a></li>
	    			</ul>
	  			</div>     
	  		</div>  
	  		<div class="row">
			  <div class="col-md-4" style="margin-left: 33%;">
			    <div class="thumbnail">
			        <img src="https://i.ytimg.com/vi/w8LcxY43N5Y/mqdefault.jpg" alt="Lights" style="width:100%">
			        <div class="caption">
			          <p align="center">Top Trending Song</p>
			        </div>
			    </div>
			  </div> 
		    </div>
		    <div class="row" id="Shazam">
		    	<p class="title">Youtube</p>
				<header>
					
					<div><a href="Graph.php?varname=<?php echo $a[0] ?>"><img src=<?php echo $a[0]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $a[1] ?>"><img src=<?php echo $a[1]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $a[2] ?>"><img src=<?php echo $a[2]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $a[3] ?>"><img src=<?php echo $a[3]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $a[4] ?>"><img src=<?php echo $a[4]?> alt></a></div>
				</header>
		    </div>

		    <div class="row" id="Wynk">
		    	<p class="title">Wynk</p>
				<header>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[0] ?>"><img src=<?php echo $Wynk_url[0]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[1] ?>"><img src=<?php echo $Wynk_url[1]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[9] ?>"><img src=<?php echo $Wynk_url[9]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[3] ?>"><img src=<?php echo $Wynk_url[3]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[4] ?>"><img src=<?php echo $Wynk_url[4]?> alt></a></div>
				</header>
		    </div>
		    <div class="row" id="Saavn">
		    	<p class="title">Saavn</p>
				<header>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[5] ?>"><img src=<?php echo $Wynk_url[5]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[6] ?>"><img src=<?php echo $Wynk_url[6]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[7] ?>"><img src=<?php echo $Wynk_url[7]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[8] ?>"><img src=<?php echo $Wynk_url[8]?> alt></a></div>
					<div><a href="Graph.php?varname=<?php echo $Wynk_url[2] ?>"><img src=<?php echo $Wynk_url[2]?> alt></a></div>
				</header>
		    </div>
		    <div class="row" id="Radio">
		    	<p class="title">Radio</p>
				<header>
					<div><img src="https://i.ytimg.com/vi/w8LcxY43N5Y/mqdefault.jpg" alt></div>
					<div><img src="https://i.ytimg.com/vi/w8LcxY43N5Y/mqdefault.jpg" alt></div>
					<div><img src="https://i.ytimg.com/vi/w8LcxY43N5Y/mqdefault.jpg" alt></div>
					<div><img src="https://i.ytimg.com/vi/w8LcxY43N5Y/mqdefault.jpg" alt></div>
					<div><img src="https://i.ytimg.com/vi/w8LcxY43N5Y/mqdefault.jpg" alt></div>
				</header>
		    </div>
		    <div class="row">
		    	<a href="http://localhost/Upload.php"><button type="button" class="btn btn-primary btn-lg">Analyse Song</button></a>
		    </div>
		    <br>
		    <br>
		</div>
	</body>
	</html>