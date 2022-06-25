<?php  
// header("refresh: 3");

require "function.php";
// header("refresh: 3");
date_default_timezone_set('Asia/Jakarta');

$time = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
$time2 = date("d M Y", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
// echo $time2;


// if(isset($_POST['latitude']) and isset($_POST['longitude'])){
// 	$titik1 = $_POST['latitude'];
// 	$titik2 = $_POST['longitude'];
// 	echo "BISAAA <br>";
// 	echo $titik1 . "," . $titik2;
// 	tambahLokasi($titik1, $titik2);
// }



$FilterTiga = queryKondisi("SELECT * FROM lokasi");
// location settings

if (isset($_POST['ruangan1']) and isset($_POST['ruangan2'])) {
	$KondisiBaru = $_POST['ruangan1'];
	$kondisi2 = explode("%20", $KondisiBaru);
	$kondisi3 = join(" ", $kondisi2);
	updateLokasi1($kondisi3);

	$KondisiBaru1 = $_POST['ruangan2'];
	$kondisi21 = explode("%20", $KondisiBaru1);
	$kondisi31 = join(" ", $kondisi21);
	updateLokasi2($kondisi31);

	$FilterTiga = queryKondisi("SELECT * FROM lokasi");

}elseif (isset($_POST['ruangan1']) and !isset($_POST['ruangan2'])) {
	$KondisiBaru = $_POST['ruangan1'];
	$kondisi2 = explode("%20", $KondisiBaru);
	$kondisi3 = join(" ", $kondisi2);
	updateLokasi1($kondisi3);

	$FilterTiga = queryKondisi("SELECT * FROM lokasi");

}elseif(!isset($_POST['ruangan1']) and isset($_POST['ruangan2'])){
	$KondisiBaru1 = $_POST['ruangan2'];
	$kondisi21 = explode("%20", $KondisiBaru1);
	$kondisi31 = join(" ", $kondisi21);
	updateLokasi2($kondisi31);

	$FilterTiga = queryKondisi("SELECT * FROM lokasi");
}else{
	$FilterTiga = queryKondisi("SELECT * FROM lokasi");

}

$FilterDua = queryKondisi("SELECT * FROM actionsfirst");
foreach($FilterDua as $Dua){
	if($Dua['bluetooth1'] == 'Unconnected' and $Dua['bluetooth2'] == 'Unconnected'){
		$Room = "Unknown Rooms";
		updateLokasi1($Room);
		updateLokasi2($Room);
		$FilterTiga = queryKondisi("SELECT * FROM lokasi");
	}elseif($Dua['bluetooth1'] == 'Connected' and $Dua['bluetooth2'] == 'Unconnected'){
		$Room = "Unknown Rooms";
		updateLokasi2($Room);
		$FilterTiga = queryKondisi("SELECT * FROM lokasi");
	}elseif($Dua['bluetooth1'] == 'Unconnected' and $Dua['bluetooth2'] == 'Connected'){
		$Room = "Unknown Rooms";
		updateLokasi1($Room);
		$FilterTiga = queryKondisi("SELECT * FROM lokasi");
	}else{
		$FilterTiga = queryKondisi("SELECT * FROM lokasi");
	}
}


// button settings

foreach ($FilterDua as $Dua) {
	if($Dua['buzzer1'] == 'Of' and $Dua['buzzer2'] == 'Of'){
		$tbuzzer1 = 'On';
		$gtbuzzer1 = 'sound-on';
		$tbuzzer2 = 'On';
		$gtbuzzer2 = 'sound-on';
	}elseif ($Dua['buzzer1'] == 'On' and $Dua['buzzer2'] == 'Of') {
		$tbuzzer1 = 'Of';
		$gtbuzzer1 = 'sound-on';
		$tbuzzer2 = 'On';
		$gtbuzzer2 = 'sound-on';

	}elseif ($Dua['buzzer1'] == 'Of' and $Dua['buzzer2'] == 'On') {
		$tbuzzer2 = 'Of';
		$gtbuzzer2 = 'sound-on';
		$tbuzzer1 = 'On';
		$gtbuzzer1 = 'sound-on';

	}else{
		$tbuzzer1 = 'Of';
		$gtbuzzer1 = 'sound-on';
		$tbuzzer2 = 'Of';
		$gtbuzzer2 = 'sound-on';
	}
}


foreach ($FilterDua as $Dua) {
	if($Dua['bluetooth1'] == 'Unconnected' and $Dua['bluetooth2'] == 'Unconnected'){
		$tbluetooth1 = "Connected";
		$tbuzzer1 = 'Of';
		updateBuzzer1($tbuzzer1);
		$gtbluetooth1 = "button-off2.png";
		$tbluetooth2 = "Connected";
		$tbuzzer2 = 'Of';
		updateBuzzer2($tbuzzer2);
		$gtbluetooth2 = "button-off2.png";
	}elseif ($Dua['bluetooth1'] == 'Connected' and $Dua['bluetooth2'] == 'Unconnected') {
		$tbluetooth1 = "Unconnected";
		$gtbluetooth1 = "button-on2.png";
		$tbluetooth2 = "Connected";
		$gtbluetooth2 = "button-off2.png";
		$tbuzzer2 = 'Of';
		updateBuzzer2($tbuzzer2);
	}elseif ($Dua['bluetooth1'] == 'Unconnected' and $Dua['bluetooth2'] == 'Connected') {
		$tbluetooth1 = "Connected";
		$gtbluetooth1 = "button-off2.png";
		$tbuzzer1 = 'Of';
		updateBuzzer1($tbuzzer1);
		$tbluetooth2 = "Unconnected";
		$gtbluetooth2 = "button-on2.png";
	}else{
		$tbluetooth1 = "Unconnected";
		$gtbluetooth1 = "button-on2.png";
		$tbluetooth2 = "Unconnected";
		$gtbluetooth2 = "button-on2.png";
	}
}

// history setting
$FilterSembilan = queryKondisi("SELECT * FROM kondisi");
$FilterTiga = queryKondisi("SELECT * FROM lokasi");
foreach ($FilterTiga as $Tiga) {
	$tempat1 = $Tiga['ruangan1'];
	$tempat2 = $Tiga['ruangan2'];
}

$FilterSatu = queryKondisi("SELECT * FROM internet");
foreach($FilterSatu as $Satu){
    foreach($FilterSembilan as $Sembilan){
    	    foreach ($FilterTiga as $Tiga) {
    	    	if($Tiga['ruangan1'] == 'Unknown Rooms' and $Tiga['ruangan2'] == 'Unknown Rooms'){
    	    		continue;
    	    	}elseif ($Tiga['ruangan1'] != 'Unknown Rooms' and $Tiga['ruangan2'] == 'Unknown Rooms') {
    	    		
    	    		if(isset($_POST['latitude']) and isset($_POST['longitude'])){
                    	$titik1 = $_POST['latitude'];
                    	$titik2 = $_POST['longitude'];
                    	echo "BISAAA <br>";
                    	echo $titik1 . "," . $titik2;
                    	$timez = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
                        
        	    		$nama = "Benda 1";
        	    		$date = date('d M Y');
        	    		$time = date("h:i:sa");
        	    		$tempat = $Tiga['ruangan1'];
        	    		$kondisi1 = $Sembilan['kondisi1'];
        	   // 		$titik1 = $Delapan['latitude'];
        	   // 		$titik2 = $Delapan['longitude'];

        	    		if($Satu['transmitter1'] == 'Wifi On'){
        	    		    tambahWaktu($nama, $date, $time, $tempat, $titik1, $titik2, $kondisi1, $timez);
        	    		}
                    }
    	    		
    	    		
    	    	}elseif ($Tiga['ruangan1'] == 'Unknown Rooms' and $Tiga['ruangan2'] != 'Unknown Rooms') {
    	    		
    	    		if(isset($_POST['latitude']) and isset($_POST['longitude'])){
    	    		    $titik1 = $_POST['latitude'];
                    	$titik2 = $_POST['longitude'];
        	    		$timez = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
        
        	    		$nama = "Benda 2";
        	    		$date = date('d M Y');
        	    		$time = date("h:i:sa");
        	    		$tempat = $Tiga['ruangan2'];
        	    		$kondisi2 = $Sembilan['kondisi2'];
        	   // 		$titik1 = $Delapan['latitude'];
        	   // 		$titik2 = $Delapan['longitude'];
        	    		if($Satu['transmitter2'] == 'Wifi On'){
        	    		    tambahWaktu($nama, $date, $time, $tempat, $titik1, $titik2, $kondisi2, $timez);
        	    		}
    	    		}
    	    	}else{
    	    	    
    	    	    if(isset($_POST['latitude']) and isset($_POST['longitude'])){
    	    	        $titik1 = $_POST['latitude'];
                    	$titik2 = $_POST['longitude'];
        	    	    $timez = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
        	    
        	    		$nama1 = "Benda 1";
        	    		$date1 = date('d M Y');
        	    		$time1 = date("h:i:sa");
        	    		$tempat1 = $Tiga['ruangan1'];
        	   // 		$titik1 = $Delapan['latitude'];
        	   // 		$titik2 = $Delapan['longitude'];
        	    		$kondisi1 = $Sembilan['kondisi1'];
        	    		
        	    		$nama2 = "Benda 2";
        	    		$date2 = date('d M Y');
        	    		$time2 = date("h:i:sa");
        	    		$tempat2 = $Tiga['ruangan2'];
        	   // 		$titik1 = $Delapan['latitude'];
        	   // 		$titik2 = $Delapan['longitude'];
        	    		$kondisi2 = $Sembilan['kondisi2'];
    
        	    		if($Satu['transmitter1'] == 'Wifi On' and $Satu['transmitter2'] == 'Wifi On'){
        	    		    tambahWaktu($nama1, $date1, $time1, $tempat1, $titik1, $titik2, $kondisi1, $timez);
        	    		    tambahWaktu($nama2, $date2, $time2, $tempat2, $titik1, $titik2, $kondisi2, $timez);
        	    		}elseif($Satu['transmitter1'] == 'Wifi Of' and $Satu['transmitter2'] == 'Wifi On'){
        	    		    tambahWaktu($nama2, $date2, $time2, $tempat2, $titik1, $titik2, $kondisi2, $timez);
        	    		}elseif($Satu['transmitter1'] == 'Wifi On' and $Satu['transmitter2'] == 'Wifi Of'){
        	    		    tambahWaktu($nama1, $date1, $time1, $tempat1, $titik1, $titik2, $kondisi1, $timez);
        	    		}
    	    		
    	    		
    	    	    }
    	    	}
    	    }
    }
}
// wifi setting



if (isset($_POST['transmitter1']) and isset($_POST['transmitter2'])) {
	$KondisiBaru = $_POST['transmitter1'];
	$kondisi2 = explode("%20", $KondisiBaru);
	$kondisi3 = join(" ", $kondisi2);
	updateWifi1($kondisi3);

	$KondisiBaru1 = $_POST['transmitter2'];
	$kondisi21 = explode("%20", $KondisiBaru1);
	$kondisi31 = join(" ", $kondisi21);
	updateWifi2($kondisi31);

	$time = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
	set1($time);
	set2($time);

	$FilterSatu = queryKondisi("SELECT * FROM internet");

}elseif (isset($_POST['transmitter1']) and !isset($_POST['transmitter2'])) {
	$KondisiBaru = $_POST['transmitter1'];
	$kondisi2 = explode("%20", $KondisiBaru);
	$kondisi3 = join(" ", $kondisi2);
	updateWifi1($kondisi3);

	$time = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
	set1($time);

	$FilterSatu = queryKondisi("SELECT * FROM internet");
}elseif (!isset($_POST['transmitter1']) and isset($_POST['transmitter2'])) {
	$KondisiBaru1 = $_POST['transmitter2'];
	$kondisi21 = explode("%20", $KondisiBaru1);
	$kondisi31 = join(" ", $kondisi21);
	updateWifi2($kondisi31);

	$time = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
	set2($time);

	$FilterSatu = queryKondisi("SELECT * FROM internet");
}else{
	
	$FilterSatu = queryKondisi("SELECT * FROM internet");
}

foreach ($FilterSatu as $S) {
	// echo $S['timestamps1']."<br>";
	$time = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
	// echo $time."<br>";
	if ($S['transmitter1'] == 'Wifi On' and $S['transmitter2'] == 'Wifi On') {
		
		$waktu1 = $S['timestamps1'];
		$result = queryKondisi("SELECT TIMESTAMPDIFF(SECOND,'$waktu1','$time') as NEW");
	    foreach($result as $r){
	        echo "count-down 1: ".$r["NEW"]."<br>";
	        if ($r["NEW"] > 30) {
	        	$wifi = "Wifi Of";
	        	updateWifi1($wifi);
	        	$FilterSatu = queryKondisi("SELECT * FROM internet");
	        }else{
	        	$FilterSatu = queryKondisi("SELECT * FROM internet");
	        }
	    }

		$waktu2 = $S['timestamps2'];
		$result2 = queryKondisi("SELECT TIMESTAMPDIFF(SECOND,'$waktu2','$time') as NEW");
	    foreach($result2 as $r2){
	        echo "count-down 2: ".$r["NEW"]."<br>";
	        if ($r2["NEW"] > 30) {
	        	$wifi = "Wifi Of";
	        	updateWifi2($wifi);
	        	$FilterSatu = queryKondisi("SELECT * FROM internet");
	        }else{
	        	$FilterSatu = queryKondisi("SELECT * FROM internet");
	        }
	    }

	}elseif($S['transmitter1'] == 'Wifi Of' and $S['transmitter2'] == 'Wifi On'){
		$waktu2 = $S['timestamps2'];
		$result2 = queryKondisi("SELECT TIMESTAMPDIFF(SECOND,'$waktu2','$time') as NEW");
	    foreach($result2 as $r2){
	        echo "count-down 2: ".$r2["NEW"]."<br>";
	        if ($r2["NEW"] > 30) {
	        	$wifi = "Wifi Of";
	        	updateWifi2($wifi);
	        	$FilterSatu = queryKondisi("SELECT * FROM internet");
	        }else{
	        	$FilterSatu = queryKondisi("SELECT * FROM internet");
	        }
	    }
	}elseif($S['transmitter1'] == 'Wifi On' and $S['transmitter2'] == 'Wifi Of'){
		// echo "iya zal disini";
		$waktu1 = $S['timestamps1'];
		$result = queryKondisi("SELECT TIMESTAMPDIFF(SECOND,'$waktu1','$time') as NEW");
	    foreach($result as $r){
	        echo "count-down 1: ".$r["NEW"]."<br>";
	        if ($r["NEW"] > 30) {
	        	// echo "iyah harusnya";
	        	$wifi = "Wifi Of";
	        	updateWifi1($wifi);
	        	$FilterSatu = queryKondisi("SELECT * FROM internet");
	        }else{
	        	$FilterSatu = queryKondisi("SELECT * FROM internet");
	        }
	    }
	}else{
		$FilterSatu = queryKondisi("SELECT * FROM internet");
	}
}




$FilterDua = queryKondisi("SELECT * FROM actionsfirst");
foreach ($FilterDua as $Dua) {
	$activation1 = $Dua['bluetooth1'];
	$activation2 = $Dua['bluetooth2'];
	$buz1 = $Dua['buzzer1'];
	$buz2 = $Dua['buzzer2'];
}

$FilterSatu = queryKondisi("SELECT * FROM internet");
foreach ($FilterSatu as $Satu) {
	$wifi1 = $Satu['transmitter1'];
	$wifi2 = $Satu['transmitter2'];
	
}

$FilterLima = queryKondisi("SELECT * FROM kondisi");
foreach ($FilterLima as $Lima) {
	$mode1 = $Lima['kondisi1'];
	$mode2 = $Lima['kondisi2'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>DTags</title>
	<link href="index.css?version=<?php echo filemtime('index.css'); ?>" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body onLoad="getLocation()">
	<div class="header">
		<div class="header-content">
			<a href="https://ittelkom-sby.ac.id"><img src="img/kampus.png" alt="logo-kampus"></a>
			<div class="header-content-navbar">
			    
				<a href="history.php">History</a>
				<a href="index.php">Home</a>
			</div>
		</div>
	</div>
	<div class="container-1">
		<div class="class-container-1">
			<div class="card-1">
				<div class="card-1-img">
					<div class="satu">
						<h1 id="word" class="detail-description">@<?php echo $wifi1; ?> - `BENDA 1 IS <?php echo $activation1 . "^" . $buz1; ?></h1>
						<p class="date"><?php echo $time2; ?></p>
						<div class="satu-1">
							<h1 id="t1" class="location"><?php echo $tempat1; ?></h1>
							<?php if($tempat1 == 'Unknown Rooms'): ?>
								<a href="#"><img src="img/sound-off.png" alt="sound-off"></a>
							<?php else: ?>
								<a href="updateBuzzer.php?buzzer1=<?php echo $tbuzzer1; ?>"><img src="<?php echo "img/" . $gtbuzzer1 . ".png"; ?>" alt="sound-on"></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="card-1-btn">
					<?php if($activation1 == "Unconnected"): ?>
						<a href="updateBluetooth.php?bluetooth1=Connected" class="turn">turn off</a>
					<?php elseif($activation1 == "Connected"): ?>
						<a href="updateBluetooth.php?bluetooth1=Unconnected" class="turn">turn on</a>
					<?php endif; ?>

					<?php if($mode1 == "Indoor"): ?>
						<a href="mode.php?mode1=<?php echo "Outdoor"; ?>" class="mode"><img src="img/<?php echo "indoor"; ?>.png" alt="<?php echo "indoor"; ?>"></a>
					<?php elseif($mode1 == "Outdoor"): ?>
						<a href="mode.php?mode1=<?php echo "Indoor"; ?>" class="mode"><img src="img/<?php echo "outdoor"; ?>.png" alt="<?php echo "outdoor"; ?>"></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="card-2">
				<div class="card-2-img">
					<div class="dua">
						<h1 id="words" class="detail-description">@<?php echo $wifi2; ?> - `BENDA 2 IS <?php echo $activation2 . "^" . $buz2; ?></h1>
						<p class="date"><?php echo $time2; ?></p>
						<div class="dua-2">
							<h1 id="t2" class="location"><?php echo $tempat2; ?></h1>
							<?php if($tempat2 == 'Unknown Rooms'): ?>
								<a href="#"><img src="img/sound-off.png" alt="sound-off"></a>
							<?php else: ?>
								<a href="updateBuzzer.php?buzzer2=<?php echo $tbuzzer2; ?>"><img src="<?php echo "img/" . $gtbuzzer2 . ".png"; ?>" alt="sound-on"></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="card-2-btn">
					<?php if($activation2 == "Unconnected"): ?>
						<a href="updateBluetooth.php?bluetooth2=Connected" class="turn">turn off</a>
					<?php elseif($activation2 == "Connected"): ?>
						<a href="updateBluetooth.php?bluetooth2=Unconnected" class="turn">turn on</a>
					<?php endif; ?>
					<?php if($mode2 == "Indoor"): ?>
						<a href="mode.php?mode2=<?php echo "Outdoor"; ?>" class="mode"><img src="img/<?php echo "indoor"; ?>.png" alt="<?php echo "indoor"; ?>"></a>
					<?php elseif($mode2 == "Outdoor"): ?>
						<a href="mode.php?mode2=<?php echo "Indoor"; ?>" class="mode"><img src="img/<?php echo "outdoor"; ?>.png" alt="<?php echo "outdoor"; ?>"></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<h2 class="footer-text">Copyright 2022 by Rizal Fathurrahman</h2>
	</div>
	<p id="mode1"><?php echo "&" . $tempat1; ?></p>
	<p id="mode2"><?php echo "&" . $tempat2; ?></p>
	<p id="latitude"></p>
	<p id="longitude"></p>
	<script type="text/javascript">
		if(document.getElementById("word").innerHTML == "@Wifi Of - `BENDA 1 IS Unconnected^Of"){
        	document.getElementById("word").innerHTML = "WIFI OFF - BENDA 1 IS UNCONNECTED AND BUZZER IS OFF";
        }else if(document.getElementById("word").innerHTML == "@Wifi Of - `BENDA 1 IS Connected^Of"){
        	document.getElementById("word").innerHTML = "WIFI OFF - BENDA 1 IS CONNECTED AND BUZZER IS OFF";
        }else if(document.getElementById("word").innerHTML == "@Wifi Of - `BENDA 1 IS Connected^On"){
        	document.getElementById("word").innerHTML = "WIFI OFF - BENDA 1 IS CONNECTED AND BUZZER IS ON";
        }else if(document.getElementById("word").innerHTML == "@Wifi On - `BENDA 1 IS Unconnected^Of"){
        	document.getElementById("word").innerHTML = "WIFI ON - BENDA 1 IS UNCONNECTED AND BUZZER IS OFF";
        }else if(document.getElementById("word").innerHTML == "@Wifi On - `BENDA 1 IS Connected^Of"){
        	document.getElementById("word").innerHTML = "WIFI ON - BENDA 1 IS CONNECTED AND BUZZER IS OFF";
        }else if(document.getElementById("word").innerHTML == "@Wifi On - `BENDA 1 IS Connected^On"){
        	document.getElementById("word").innerHTML = "WIFI ON - BENDA 1 IS CONNECTED AND BUZZER IS ON";
        }

        if(document.getElementById("words").innerHTML == "@Wifi Of - `BENDA 2 IS Unconnected^Of"){
        	document.getElementById("words").innerHTML = "WIFI OFF - BENDA 2 IS UNCONNECTED AND BUZZER IS OFF";
        }else if(document.getElementById("words").innerHTML == "@Wifi Of - `BENDA 2 IS Connected^Of"){
        	document.getElementById("words").innerHTML = "WIFI OFF - BENDA 2 IS CONNECTED AND BUZZER IS OFF";
        }else if(document.getElementById("words").innerHTML == "@Wifi Of - `BENDA 2 IS Connected^On"){
        	document.getElementById("words").innerHTML = "WIFI OFF - BENDA 2 IS CONNECTED AND BUZZER IS ON";
        }else if(document.getElementById("words").innerHTML == "@Wifi On - `BENDA 2 IS Unconnected^Of"){
        	document.getElementById("words").innerHTML = "WIFI ON - BENDA 2 IS UNCONNECTED AND BUZZER IS OFF";
        }else if(document.getElementById("words").innerHTML == "@Wifi On - `BENDA 2 IS Connected^Of"){
        	document.getElementById("words").innerHTML = "WIFI ON - BENDA 2 IS CONNECTED AND BUZZER IS OFF";
        }else if(document.getElementById("words").innerHTML == "@Wifi On - `BENDA 2 IS Connected^On"){
        	document.getElementById("words").innerHTML = "WIFI ON - BENDA 2 IS CONNECTED AND BUZZER IS ON";
        }
        
        if(document.getElementById("t1").innerHTML == "&Rizal"){
            document.getElementById("t1").innerHTML = "Ytes";
        }else if(document.getElementById("t1").innerHTML == "&Ruang Tamu"){
            document.getElementById("t1").innerHTML = "Ruang Tamu";
        }else if(document.getElementById("t1").innerHTML == "&Kamar Tidur"){
            document.getElementById("t1").innerHTML = "Kamar Tidur";
        }else if(document.getElementById("t1").innerHTML == "&Outdoor"){
            document.getElementById("t1").innerHTML = "Outdoor";
        }
        
        // if(document.getElementById("t2").innerHTML == "&Unknown Rooms"){
        //     document.getElementById("t2").innerHTML = "Unknown Rooms";
        // }else if(document.getElementById("t2").innerHTML == "&Ruang Tamu"){
        //     document.getElementById("t2").innerHTML = "Ruang Tamu";
        // }else if(document.getElementById("t2").innerHTML == "&Kamar Tidur"){
        //     document.getElementById("t2").innerHTML = "Kamar Tidur";
        // }else if(document.getElementById("t2").innerHTML == "&Outdoor"){
        //     document.getElementById("t2").innerHTML = "Outdoor";
        // }

		var x = document.getElementById("latitude");
		var y = document.getElementById("longitude");
		// getLocation();
		

		function getLocation() {
		  if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(showPosition);
		  } else { 
		    x.innerHTML = "Geolocation is not supported by this browser.";
		  }
		}

		function showPosition(position) {
			x.innerHTML = position.coords.latitude;
			y.innerHTML = position.coords.longitude;


			var httpRequest = new XMLHttpRequest();
			// httpRequest.open("POST","https://dtags.000webhostapp.com/index.php",true);
			httpRequest.open("POST","index.php",true);
			// httpRequest.setRequestHeader('Content-type', 'application/json; charset=utf-8');
			httpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			// (-7.3598195).toFixed(10)
			httpRequest.send("latitude="+x.innerHTML+"&longitude="+y.innerHTML);
// 			httpRequest.onload = function() {
// 			  alert(`Loaded: ${httpRequest.status} ${httpRequest.response}`);
// 			};
		}


	</script>
	
	<p id="mode1"><?php echo "*" . $mode1; ?></p>
	<p id="mode2"><?php echo "*" . $mode2; ?></p>
</body>
</html>

