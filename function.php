<?php  
$connection1 = mysqli_connect("localhost","id18262646_dtags","Y\skb/q@ISWkaG1p","id18262646_root");
// $connection1 = mysqli_connect("localhost","root","","dtags");
// $connection2 = mysqli_connect("localhost","root","","test");

function queryKondisi($query){
	global $connection1;
	$result = mysqli_query($connection1, $query);
	// var_dump($result);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows [] = $row;
	}

	return $rows;
}

function filterHistory($query){
	global $connection1;
	mysqli_query($connection1, "UPDATE swap SET count=$count, huruf='$huruf'");
}

function tambahWaktu($Nama, $Tanggal, $Waktu, $Tempat, $Titik1, $Titik2, $Kondisi, $Time){
	global $connection1;
	// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
	mysqli_query($connection1, "INSERT INTO `history` (`id`, `namabenda`, `tanggal`, `waktu`, `tempat`, `titik1`, `titik2`, `mode`, `timestamps`) VALUES (NULL, '$Nama', '$Tanggal', '$Waktu','$Tempat', $Titik1, $Titik2, '$Kondisi', '$Time')");
	var_dump(mysqli_affected_rows($connection1));

}

function updateMode1($Kondisi){
		global $connection1;
		// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
		mysqli_query($connection1, "UPDATE kondisi SET kondisi1 ='$Kondisi' WHERE id=1");
		return mysqli_affected_rows($connection1);
	}

function updateMode2($Kondisi){
		global $connection1;
		// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
		mysqli_query($connection1, "UPDATE kondisi SET kondisi2 ='$Kondisi' WHERE id=1");
		return mysqli_affected_rows($connection1);
	}

function updateBluetooth1($Kondisi){
		global $connection1;
		// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
		mysqli_query($connection1, "UPDATE actionsfirst SET bluetooth1 ='$Kondisi' WHERE id=1");
		return mysqli_affected_rows($connection1);
	}

function updateBluetooth2($Kondisi){
		global $connection1;
		// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
		mysqli_query($connection1, "UPDATE actionsfirst SET bluetooth2 ='$Kondisi' WHERE id=1");
		return mysqli_affected_rows($connection1);
	}

function updateBuzzer1($Kondisi){
		global $connection1;
		// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
		mysqli_query($connection1, "UPDATE actionsfirst SET buzzer1 ='$Kondisi' WHERE id=1");
		return mysqli_affected_rows($connection1);
	}

function updateBuzzer2($Kondisi){
		global $connection1;
		// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
		mysqli_query($connection1, "UPDATE actionsfirst SET buzzer2 ='$Kondisi' WHERE id=1");
		return mysqli_affected_rows($connection1);
	}

function lastSeen($id){
    $time = date("Y-m-d H:i:s", mktime(date('H'),date('i'), date('s'), date('m'),date('d'),date('Y')));
    // echo $time . "<br>";
    $array1 = queryKondisi("SELECT timestamps FROM history WHERE id=$id");
    foreach ($array1 as $key) {
        $lalu = $key['timestamps'];
    	$SECOND = queryKondisi("SELECT TIMESTAMPDIFF(SECOND,'$lalu','$time') as NEW");
    // 	var_dump($SECOND);
    // 	echo "<br>";
    	$MINUTE = queryKondisi("SELECT TIMESTAMPDIFF(MINUTE,'$lalu','$time') as NEW");
    	$HOUR = queryKondisi("SELECT TIMESTAMPDIFF(HOUR,'$lalu','$time') as NEW");
    	$DAY = queryKondisi("SELECT TIMESTAMPDIFF(DAY,'$lalu','$time') as NEW");
    	$MONTH = queryKondisi("SELECT TIMESTAMPDIFF(MONTH,'$lalu','$time') as NEW");
    	$YEAR = queryKondisi("SELECT TIMESTAMPDIFF(YEAR,'$lalu','$time') as NEW");
    	foreach ($SECOND as $new) {
    		$hasil = $new['NEW'];
    // 		echo "Hasil <br>";
    // 		var_dump($hasil);
    		$riz = (int)$hasil;
    // 		echo $riz;
    		$tampilkan = "Udah ok";
    
    		if($riz < 60){
    			foreach ($SECOND as $times) {
    				$tampilkan = $times['NEW'] . " seconds ago";
    				return $tampilkan;
    			}
    		}elseif ($riz >= 60 && $riz < 3600) {
    			foreach ($MINUTE as $times) {
    				$tampilkan = $times['NEW'] . " minutes ago";
    				return $tampilkan;
    			}
    		}elseif ($riz >= 3600 && $riz < 86400) {
    			foreach ($HOUR as $times) {
    				$tampilkan = $times['NEW'] . " hours ago";
    				return $tampilkan;
    			}
    		}elseif ($riz >= 86400 && $riz < 590000) {
    		  //  echo $riz;
    			foreach ($DAY as $times) {
    				$tampilkan = $times['NEW'] . " days ago";
    				return $tampilkan;
    			
    			}
    		}elseif ($riz >= 590000 && $riz < 17700000) {
    			foreach ($MONTH as $times) {
    				$tampilkan = $times['NEW'] . " months ago";
    				return $tampilkan;
    			}
    		}else{
    			foreach ($YEAR as $times) {
    				$tampilkan = $times['NEW'] . " year ago";
    				return $tampilkan;
    			}
    
    		}
    
    	}
    }
}

function updateLokasi1($KondisiLokasi){
	global $connection1;
	// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
	mysqli_query($connection1, "UPDATE lokasi SET ruangan1='$KondisiLokasi' WHERE id=1");
}

function updateLokasi2($KondisiLokasi){
	global $connection1;
	// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
	mysqli_query($connection1, "UPDATE lokasi SET ruangan2='$KondisiLokasi' WHERE id=1");
}

function updateWifi1($KondisiWifi1){
	global $connection1;
	// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
	mysqli_query($connection1, "UPDATE internet SET transmitter1='$KondisiWifi1' WHERE id=1");
}


function updateWifi2($KondisiWifi2){
	global $connection1;
	// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
	mysqli_query($connection1, "UPDATE internet SET transmitter2='$KondisiWifi2' WHERE id=1");
}

function set1($t1){
	global $connection1;
	mysqli_query($connection1, "UPDATE `internet` SET timestamps1 = '$t1'");
}

function set2($t2){
	global $connection1;
	mysqli_query($connection1, "UPDATE `internet` SET timestamps2 = '$t2'");
}

// function setHistoryTimestamp1($t1){
// 	global $connection1;
// 	mysqli_query($connection1, "UPDATE `history` SET timestampsHistroy1 = $t1");
// }

// function setHistoryTimestamp2($t2){
// 	global $connection1;
// 	mysqli_query($connection1, "UPDATE `history` SET timestampsHistroy2 = $t2");
// }


function counter($counts){
	global $connection1;
	// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
	mysqli_query($connection1, "UPDATE counter SET count='$counts' WHERE id=1");
}

function updateKondisi($kon){
    global $connection1;
	mysqli_query($connection1, "UPDATE kondisi SET kondisi='$kon' WHERE id=1");
}

function tambahLokasi($titik1, $titik2){
	global $connection1;
	mysqli_query($connection1, "INSERT INTO `location` (`ID`, `latitude`, `longitude`) VALUES ('', '$titik1', '$titik2')");
	echo "entahlah";
	echo(mysqli_affected_rows($connection1));
    
}

// function updateLokasi($KondisiLokasi){
// 	global $conn;
// 	// query("UPDATE arahan SET status ='$Kondisi' WHERE nomor=1");
// 	query("UPDATE lokasi SET ruangan ='$KondisiLokasi' WHERE id=1");
// 	return mysqli_affected_rows($conn);
// }



?>