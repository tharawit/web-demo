<?php 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

	session_start(); 
	$SET_PASS = "u1234"; /* Set pass HERE */
	if($_POST['upass'] == $SET_PASS){
		$_SESSION['user'] = 1;
	}
	if(isset($_GET['user'])){
		if($_GET['user'] == 0){
			$_SESSION['user'] = 0;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload Image</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<style>
	 .tr-over:hover{
		background:#F5F5F5;
	 }
	 /* animate noti */
	 @keyframes animateNoti {
    	from {opacity: 1;}
    	to {opacity: 0;}
	}
	 #noti{
		 z-index: 2;
		 opacity: 1;
		 position: absolute;
		 animation-name: animateNoti;
		 animation-duration: 3s;
		 animation-timing-function: ease;
	 }
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<span style="font-size:30px">Upload Images</span>
			</div>
			<div class="col-md-5">
				<a href="./api.php?api=1">			
					<button class="btn btn-success">Get API</button>
				</a>
			</div>
			<div class="col-md-2">
			<?php
				if($_SESSION['user'] == 1){
			?>
				<a href="index.php?user=0">			
					<button class="btn btn-danger">Logout</button>
				</a>
			<?php
				}
			?>
			</div>
		</div>
	<?php
		if($_SESSION['user'] != 1){
	?>
				<form action="index.php" method="post">
					<input type="password" name="upass" placeholder="Password" class="col-md-12 form-control">
					<br />
					<button type="submit" class="btn btn-md btn-primary col-md-12">Login</button>
				</form>
	<?php
		}else{
	?>
			<div class="row">
				<p> 
				<?php 
					/* status nortification */
					if($_SESSION['status'] == 1){
						echo "
							<div id='noti' class='alert alert-danger col-md-12' role='alert'>
								<span>Upload image fail !!!</span>
							</div>
						";
					}elseif($_SESSION['status'] == 2){
						echo "
							<div id='noti' class='alert alert-success col-md-12' role='alert'>
								<span>Upload image success</span>
							</div>
						";
					}elseif($_SESSION['status'] == 3){
						echo "
							<div id='noti' class='alert alert-warning col-md-12' role='alert'>
								<span>Delete image success</span>
							</div>
						";
					}elseif($_SESSION['status'] == 4){
						echo "
							<div id='noti' class='alert alert-danger col-md-12' role='alert'>
								<span>Database Error</span>
							</div>
						";
					}else{
						echo "";
					}
					unset($_SESSION['status']);
				?>
				</p>
			</div>
			<div style="margin-bottom:50px">
			</div>
			<div>
				<form action="./action/action_upload.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
				    	<input type="file" name="filename" class="col-md-12 form-control">
						<br/>
				    	<select name="type" class="form-control col-md-12">
					    	    <option value="type1">Prople</option>
					    	    <option value="type2">Sea</option>
					    	    <option value="type3">Mountain</option>
			    		    <option value="type4">Forest</option>
			    		</select>
						<br/>						
			    		<button type="submit" class="btn btn-md btn-primary col-md-12">Upload</button>
						<br/>						
					</div>
				</form>	
			</div>
	<?php
		/* show table */
		$sql = "SELECT name, type, time FROM images ORDER BY time DESC";
	   // Call function condb
	   require("./action/condb.php");
	   $con = new Condb();
	   $result = $con->db_fetch($sql);
	   $con->db_close();
				
	   echo '<b>Total images : ( '.count($result).' )</b><br/><br/>';
	   echo '<button class="btn btn-danger" onclick="delAll()">
			   <b> DELETE ALL</b>
			</button><br/>';
	   echo '<br/>';
	   echo '
			<table class="table table-bordered ">
				<thead>
					<tr>
					  <th scope="col">#</th>
					  <th scope="col">Image</th>
					  <th scope="col">Detail</th>
					  <th scope="col">&emsp;</th>
					</tr>
				  </thead>
				  <tbody>
	   ';
	   $index_table = 1;
	   foreach($result as $data){
		   echo '<tr class="tr-over">';
		   echo '<td>'.$index_table++.'</td>';
		   echo "<td><img style='width:100px;height:100px;' src=".$data['name']."></td>";
		   echo '<td>';
		   echo '<b>URL  : </b>'.$data['name'].'<br/>';
		   echo '<b>TYPE : </b>'.$data['type'].'<br/>';
		   echo '<b>TIME : </b>'.$data['time'].'<br/><br/>';
		   echo '<a style="text-decoration:none;" href="'.$data['name'].'" target="_blank">( OPEN )</a>';
		   echo '</td>';	
		   echo '<td>
				   <a style="text-decoration:none;" href="./action/action_delete.php?img='.$data['name'].'">
				   <button class="btn btn-danger"><b>X</b></button>
				   </a>
				</td>';
		   echo '</tr>';
	   }
	   echo '
	   			</tbody>
			</table>
		';
	?>
	<?php
		}
	?>
	</div>
</body>
</html>
<script>
setTimeout(function(){
	document.getElementById("noti").style.display="none";
}, 3000);

function delAll(){
	let u_confirm = confirm("Are you sure to delete all images");
	if (u_confirm){
		window.location.assign("./action/action_delete.php?img=allimg");
	}
}
</script>