<?php
	require('database.php');
	$mysqli = new mysqli($servername, $username, $password, $dbName);
	$sql = 'SELECT * FROM plantdata ORDER BY DataID DESC;';
	$result = $mysqli -> query($sql);
	$data = $result -> fetch_all(MYSQLI_ASSOC);
	$resultCheck = mysqli_num_rows($result);
	
	$soilMoisture = $data['0']['Moisture'];
	$temp = $data['0']['Temperature'];
	$humidity = $data['0']['Humidity'];
	
	if (isset($_GET['id'])){
		$count = $_GET['id'];
	}
	//echo (new \DateTime())->format('Y-m-d H:i:s');
	echo '<div class="row">';
	echo'	<div class="col text-center text-white">';
	echo'		<h1 class="display-3">Plant Environment Analysis Software</h1>';
	echo'	</div>';
	echo'</div>';
	
	
	echo'<div class="row mt-2">
		<div class="col text-center text-white">
			<a href="/index.php" class="btn btn-outline-light m-1" role="button">Home</a>
			<a href="/datatable.php" class="btn btn-outline-light m-1" role="button">Data</a>
			<hr>
		</div>
	</div>';
	
	echo'<div class="row mt-5">
		<div class="col text-left text-white ">
			<h1 class="display-1">Soil Moisture</h1>
			<h1>'.$data['0']['Moisture'].'%</h1>
			<p>'; if($soilMoisture < 41){ echo "Too Dry! "; } elseif($soilMoisture > 80){ echo "Too Wet! ";} else { echo"Good Moisture "; } echo '(Recommended 41%-80%)</p>
		</div>';
		
	echo'<div class="col text-right text-white mt-5 pt-5 ">
			<h1 class="display-1">Temperature</h1>
			<h1 class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;';echo $data['0']['Temperature']; echo'°C</h1>
			<p class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; if($temp < 18){ echo "Too Col!"; } elseif($temp > 24){ echo "Too Warm!";} else { echo"Good Temperature"; }echo' (Recommended 18°C-24°C)</p>
		</div>
	</div>';
	
	echo'<div class="row">
		<div class="col text-left text-white ">
			<h1 class="display-1">Humidity</h1>
			<h1>';echo $data['0']['Humidity']; echo'%</h1>
			<p>';if($humidity < 40){ echo "Not Humid Enough!"; } elseif($humidity > 70){ echo "Too Humid!";} else { echo"Good Humidity"; } echo' (Recommended 40%-70%)</p>
		</div>';
		
	echo'<div class="col text-right text-white mt-5 pt-5 ">
			<h1 class="display-4">Last Updated</h1>
			<h3 class="text-right">'; echo $data['0']['Time']; echo'</h1>
		</div>
	</div>';

?>