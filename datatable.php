<?php
require("database.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Plant Environment Analysis Software</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		hr {
			height: 3px;
			background: white;
			border-radius: 5px;
		}
		table {
			border-collapse:separate; 
			border-spacing:4em;
			btn-outline-light;
			font-size: 20px;
		}
	</style>
</head>

<body class="bg-dark" onload="refresh()">
<?php

/*$sql = "SELECT * FROM plantdata;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);*/


$mysqli = new mysqli($servername, $username, $password, $dbName);
$sql = "SELECT * FROM plantdata ORDER BY DataID DESC;";
$result = $mysqli -> query($sql);
$data = $result -> fetch_all(MYSQLI_ASSOC);
$resultCheck = mysqli_num_rows($result);

?>


<div class="container mt-4">

	<div class="row">
		<div class="col text-center text-white">
			<h1 class="display-3">Plant Environment Analysis Software</h1>
		</div>
	</div>
	
	<div class="row mt-2">
		<div class="col text-center text-white">
			<a href="/index.php" class="btn btn-outline-light m-1" role="button">Home</a>
			<a href="/datatable.php" class="btn btn-outline-light m-1" role="button">Data</a>
			<hr>
		</div>
	</div>
	
	<div class="row justify-content-center" id="ajaxBox">

	</div>

</div>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
	count = 0;
	function refresh(){
		count++;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("ajaxBox").innerHTML = this.responseText;
			}
		};
		
		xhttp.open("GET", "datatable_ajax.php?id="+count);
		xhttp.send();
		
		setTimeout(refresh, 5000);
	}
	
</script>

</body>
</html>