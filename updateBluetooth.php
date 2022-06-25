<?php

require "function.php";

if(isset($_GET['bluetooth1'])){
	$kondisi = $_GET["bluetooth1"];
	if(updateBluetooth1($kondisi)>0){
	echo "
		<script>
			document.location.href = 'index.php';
		</script>
	";
	}else{
		echo "
			<script>
				document.location.href = 'index.php';
			</script>
		";
		echo mysqli_error($conn);
	}
}

if(isset($_GET['bluetooth2'])){
	$kondisi = $_GET["bluetooth2"];
	if(updateBluetooth2($kondisi)>0){
	echo "
		<script>
			document.location.href = 'index.php';
		</script>
	";
	}else{
		echo "
			<script>
				document.location.href = 'index.php';
			</script>
		";
		echo mysqli_error($conn);
	}
}

?>