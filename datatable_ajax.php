	<?php
	require("database.php");
	$mysqli = new mysqli($servername, $username, $password, $dbName);
	$sql = "SELECT * FROM plantdata ORDER BY DataID DESC;";
	$result = $mysqli -> query($sql);
	$data = $result -> fetch_all(MYSQLI_ASSOC);
	$resultCheck = mysqli_num_rows($result);
	
	//$count = $_GET['id'];
	echo "hi";
	echo 
	"<table class=' text-center text-white '>
		<tr>
			<th>Soil Moisture</th>
			<th>Temperature</th>
			<th>Humidity</th>
			<th>Time</th>
		</tr>";
		
	foreach($data as $key => $value){
		$soilMoisture = $data[$key]['Moisture'];
		$temp = $data[$key]['Temperature'];
		$humidity = $data[$key]['Humidity'];
		$time = $data[$key]['Time'];
		
		echo
		"<tr>
		<td>" .$soilMoisture ."%</td>
		<td>" .$temp ."°C</td>
		<td>" .$humidity ."%</td>
		<td>" .$time ."</td>
		</tr>";
		

	}
	
	
	?>