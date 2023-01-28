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
	</style>
</head>

<body class="bg-dark" onload="refresh()">
<?php

/*$sql = "SELECT * FROM plantdata;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);*/


$mysqli = new mysqli($servername, $username, $password, $dbName);
$sql = "SELECT * FROM plantdata ORDER BY DataID DESC LIMIT 1;";
$result = $mysqli -> query($sql);
$data = $result -> fetch_all(MYSQLI_ASSOC);
$resultCheck = mysqli_num_rows($result);


$soilMoisture = $data['0']['Moisture'];
$temp = $data['0']['Temperature'];
$humidity = $data['0']['Humidity'];

//print_r($data['0']);




//print_r($resultCheck);
//print_r($data);

/*if ($resultCheck > 0){
	while ($row = mysqli_fetch_assoc($result)){
		echo $row['Time'];
		echo " | ";
		echo $row['Temperature'] . " degrees Celsius";
		echo " | ";
		echo $row['Humidity'] . "% humidity";
		echo " | ";
		echo $row['Moisture'] . "% soil moisture";
		echo "<br>";
	}
}
else{
	echo "bruh";
}*/
?>


<div class="container mt-4" id="ajaxBox">


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
		
		xhttp.open("GET", "index_ajax.php?id="+count);
		xhttp.send();
		
		setTimeout(refresh, 5000);
	}
	
</script>

</body>
</html>