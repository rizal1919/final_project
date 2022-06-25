<?php 
require "function.php";

if(isset($_GET['mode1'])){
	$kondisi = $_GET["mode1"];
	if(updateMode1($kondisi)>0){
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

if(isset($_GET['mode2'])){
	$kondisi = $_GET["mode2"];
	if(updateMode2($kondisi)>0){
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