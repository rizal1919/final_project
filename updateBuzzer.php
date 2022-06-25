<?php

require "function.php";

if(isset($_GET['buzzer1'])){
	$kondisi = $_GET["buzzer1"];
	if(updateBuzzer1($kondisi)>0){
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

if(isset($_GET['buzzer2'])){
	$kondisi = $_GET["buzzer2"];
	if(updateBuzzer2($kondisi)>0){
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